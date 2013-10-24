<?php
	class categories extends db{
		public function categories($page){
			if(isset($page[1])){
				switch($page[1]){
                    case 'list':
                        $page[2] = (isset($page[2]))?$page[2]:null;
                        $this->lists($page[2]);
                        break;
                    case 'create':
                    case 'edit':
                        $info = (isset($page[2]))?$page[2]:null;
                        $this->create($info);
                        break;
                    case 'delete':
                        $this->remove($page[2]);
                        break;
                    case 'showCategory':
                        $this->showCategory($page[2]);
                        break;
                    case 'showCategories':
						$layout = (isset($page[2]))?$page[2]:'calendar';
                        $this->showCategories($layout);
                        break;
                    case 'city':
                        $this->city($page[2]);
                        break;
                    case 'venue':
                        $this->venue($page[2]);
                        break;
                    case 'tickets':
                        $this->tickets($page[2]);
                        break;
					default:
						$pages = isset($page[2])?$page[2]:$page[1];
						$this->show($pages);
						break;
				}
			} else {
				if(isset($page[2])){
				    switch($page[1]){
                        case 'city':
                            $this->city($page[2]);
                            break;
                        case 'venue':
                            $this->venue($page[2]);
                            break;
                        case 'tickets':
                            $this->tickets($page[2]);
                            break;
                        default:
					       $this->showCategories($page[2]);
					       break;
                    }
				} else {
					$this->showCategories($page[2]);
				}
			}
		}

        function contains($str, $content, $ignorecase=true){
            if ($ignorecase){
                $str = strtolower($str);
                $content = strtolower($content);
            }  
            return strpos($content,$str) ? true : false;
        }

        public function tickets($id){
        // Keywords from Query String
        $query = $this->query('SELECT * FROM contents WHERE content_id='.$id);
        $data = json_decode($query[0]['data']);
        
        $q = $data->placeName.' '.$query[0]['name'];
        $searched_lower = strtolower($q);
        $searched = strtoupper($searched_lower);
        $searchedURL = urlencode($searched); 
        
        $endpoint_stubhub = "http://publicfeed.stubhub.com/listingCatalog/select/";
        
        if(!empty($_POST['ancestorDescriptions'])){
            $ancestorDescriptions = $_POST['ancestorDescriptions'];
        }elseif(empty($_POST['ancestorDescriptions'])){
            $ancestorDescriptions = '';
        }
        
        if(!empty($_POST['sort_what'])){
            $sort_what = $_POST['sort_what'];
        }elseif(empty($_POST['sort_what'])){
            $sort_what = 'event_date_time_local';
        }
        
        if(!empty($_POST['sort_how'])){
            $sort_how = $_POST['sort_how'];
        }elseif(empty($_POST['sort_how'])){
            $sort_how = 'asc';
        }
        
        // StubHub API Query - JSON Response
        $url = "$endpoint_stubhub?q=%252BstubhubDocumentType%253Aevent%250D%250A%252B"
                . "%2Bleaf%253A%2Btrue%250D%250A%252B"
                . "%2Bdescription%253A%2B%22$searchedURL%22%250D%250A%252B"
                . "%3B$sort_what%20$sort_how"
                . "&version=2.2"
                . "&start=0"
                . "&indent=on"
                . "&wt=json"
                . "&fl=description+event_date+event_date_local+event_time_local+geography_parent+venue_name+city+state+genreUrlPath+urlpath+leaf+channel";
        
        
        // Send Request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, "http://www.taureanwooleyf.com/");
        $body = curl_exec($ch);
        
        curl_close($ch);
        
        // Process JSON string - Convert JSON to PHP Array
        $json = json_decode($body);
            
        // Number of Returned Results
        $num = $json->response->numFound;
                                
            if ($num > 0){
                // Today's timestamp date
                $today = date(c);
                // Results Loop 
                $i = 0;
                while ($i<$num) {
                    // Filter out results with event title "mirror" - StubHub API anomaly
                    if(strstr($json->response->docs[$i]->description,"mirror") == false){
                    // Filter out results with event title "coming soon" - StubHub API anomaly
                    if(strstr($json->response->docs[$i]->description,"coming soon") == false){
                    // Filter out results with event title "posted here" - StubHub API anomaly
                    if(strstr($json->response->docs[$i]->description,"posted here") == false){
                    // Filter out results with event date earlier than today
                    if ($json->response->docs[$i]->event_date >= $today)
                    {
                    // Result format with JSON variables
                    $results_events .= "
                        <tr>\r\n
                            <td valign=\"top\">".$json->response->docs[$i]->description."</td>\r\n
                            <td valign=\"top\">".date("F j, Y", strtotime($json->response->docs[$i]->event_date_local))."</td>\r\n
                            <td valign=\"top\">".$json->response->docs[$i]->venue_name."</td>
                            <td valign=\"top\">".$json->response->docs[$i]->city.", ".$json->response->docs[$i]->state."</td>\r\n
                        </tr>\r\n";
                    }
                    }
                    }
                    }
                // Loop continuance - finite
                $i++;
                }
                }elseif ($num == 0){
                    $results_events .= "
                        <tr>\r\n
                            <td>There are currently no events listed for your query.</td>\r\n
                        </tr>\r\n";
                }
        }

        public function city($id=null){
            $this->info = $this->query('SELECT * FROM contents WHERE type="calendar" AND data LIKE "%\"city\":\"'.$id.'\"%"');
            $this->render('categories/search');
        }
        
        public function venue($id=null){
            $this->info = $this->query('SELECT * FROM contents WHERE type="calendar" AND data LIKE "%\"placeName\":\"'.$id.'\"%"');
            $this->render('categories/search');
        }
         
        public function showCategory($id = null){
            $this->info = $this->query('SELECT * FROM contents WHERE type="calendar" AND data LIKE "%\"type\":\"'.$id.'\"%"');
            $this->render('categories/showCategory');
        }
        
        public function showCategories($layout = 'calendar'){
            $this->info = $this->query('SELECT * FROM categories');
            $this->categories = array();
            foreach($this->info as $i){
                $this->categories[$i['name']]['events'] = $this->query('SELECT * FROM contents WHERE data LIKE "%\"type\":\"'.$i['name'].'\"%" AND data LIKE "%\"date\":\"'.date('m').'%" AND type="'.$layout.'"');
            }
            $this->render('categories/showCategories');
        }
		
        public function lists($name=''){
            $this->info = $this->query('SELECT * FROM categories');
            $this->render('categories/list');
        }
        
        public function remove($id){
            $this->delete('categories', array('id'=>$id));
            header('Location: ?page=categories/list');
        }
        
        public function create($id=null){
            $this->id = $id;
            if($_POST and sizeof($_POST) > 0){
                $catPost = $this->validate($_POST['categories']);
                $catVals = $catPost['values'];
                
                if($catPost['total'] < 1){
                    if($id != null){
                        $this->edit('categories', $catVals, array('id'=>$id));
                    } else {
                        $this->save('categories', $catVals);
                    }
                    header('Location: ?page=categories/list');
                } else {
                    $this->info = $catVals;
                    $this->render('categories/create');
                }
            } else {
                $this->info = null;
                if($id != null){
                    $this->info = $this->query('SELECT * FROM categories WHERE id='.$id);
                }
                $this->render('categories/create');
            }
        }
	}
?>