<?php
	class user extends db{
		
		public function user($page){
			if(isset($page[1]) && $this->checkLogin()){
				switch($page[1]){
					case 'edit':
					case 'change':
						$user = (isset($page[2]))?$page[2]:null;
						$this->change($user);
						break;
					case 'artist':
					case 'actor':
					case 'model':
					case 'promoter':
					case 'producer':
						$type = (isset($page[1]))?$page[1]:'';
						$this->artists($type);
						break;
					case 'changeStatus':
						$this->changeStatus($page[2], $page[3]);
						break;
					case 'addComment':
						$this->addComment($page[2], $page[3]);
						break;
					case 'create':
						$user_id = (isset($page[2]))?$page[2]:null;
						$this->create($user_id);
						break;
					case 'delete':
						$this->delete($page[2]);
						break;
					case 'forgot':
						$this->forgot();
						break;
					case 'changePassword':
						$this->changePassword();
						break;
					case 'paymentInfo':
					case 'payment':
						$id = (isset($page[2]))?$page[2]:null;
						$this->paymentInfo($id);
						break;
					case 'addPayment':
						$this->addPayment($page[2]);
						break;
					case 'deletePayment':
						$this->deletePayment($page[2]);
						break;
					case 'login':
						$this->login();
						break;
					case 'logout':
						$this->logout();
						break;
					case 'userpage':
						$this->userpage();
						break;
					case 'carStatsMonth':
						$this->carStatsMonth();
						break;
					case 'carStatsOverall':
						$this->carStatsOverall();
						break;
					case 'inventory':
						$this->carStatsOverall();
						break;
					case 'support':
						$this->support();
						break;
					case 'listSupport':
						$id = (isset($page[2]))?$page[2]:null;
						$this->listSupport($id);
						break;
					case 'editSupport':
						$this->editSupport($page[2]);
						break;
                    case 'editCalendar':
                    case 'createCalendar':
                        $page[2] = (isset($page[2]))?$page[2]:null;
                        $this->createCalendar($page[2]);
                        break;
                    case 'showCalendar':
                        $id = (isset($page[2]))?$page[2]:null;
                        $this->showCalendar($id);
                        break;
                    case 'removeCalendar':
                        $this->removeCalendar($page[2]);
                        break;
					case 'email':
						$this->email($page[2]);
						break;
					case 'help':
						$this->help();
						break;
					case 'display':
						$this->displayUser($page[2]);
						break;
					case 'content':
						if($page[2] == 'show'){
							$this->showContent($page[3]);
						} elseif($page[2] == 'showall'){
							$this->showAllContent($page[3]);
						} else {
							$this->uploadContent($page[2]);
						}
						break;
					case 'deleteComment':
						$this->deleteComment($page[2]);
						break;
                    case 'editComment':
                        $this->addComment('edit', $page[2]);
                        break;
                    case 'likeComment':
                        $this->like('comment', $page[2]);
                        break;
					case 'deleteContent':
						$this->deleteContent($page[2]);
						break;
					case 'wall':
						$this->wall($page[2]);
						break;
                    case 'showEvent':
                        $this->showEvent($page[2]); 
                        break;
                    case 'deleteCalendar':
                        $this->deleteCalendar($page[2]);
                        break;
                    case 'addFriend':
                        $this->addFriend($page[2]);
                        break;
                    case 'addEvent':
                        $this->addEvent($page[2]);
                        break;
                    case 'checkUser':
                        $this->checkUser($page[2]);
                        break;
                    case 'checkPlace':
                        $this->checkPlace($page[2]);
                        break;
                    case 'checkCity':
                        $this->checkCity($page[2]);
                        break;
                    case 'checkRelations':
                        $this->checkRelations($page[2]);
                        break;
					default:
						$this->main();
						break;
				}
			} else {
				$page[1] = (isset($page[1]))?$page[1]:'';
				switch($page[1]){
				    case 'addEvent':
                        $this->addEvent($page[2]);
                        break;
				    case 'checkUser':
                        $this->checkUser($page[2]);
                        break;
				    case 'showFriends':
                        $this->showFriends($page[2]);
                        break;
					case 'login':
						$this->login();
						break;
					case 'forgot':
						$this->forgot();
						break;
					case 'addComment':
						$this->login();
						break;
					case 'logout':
						$this->logout();
						break;
					case 'help':
						$this->help();
						break;
					case 'signup':
						$this->signup();
						break;
					case 'display':
						$this->displayUser($page[2]);
						break;
					case 'artist':
					case 'actor':
					case 'model':
					case 'promoter':
					case 'producer':
						$type = (isset($page[1]))?$page[1]:'';
						$this->artists($type);
						break;
                    case 'wall':
                        $this->wall($page[2]);
                        break;
                    case 'likeComment':
                        $this->like('comment', $page[2]);
                        break;
                    case 'showCalendar':
                        $id = (isset($page[2]))?$page[2]:null;
                        $this->showCalendar($id);
                        break;
                    case 'showEvent':
                        $this->showEvent($page[2]); 
                        break;
                    case 'checkUser':
                        $this->checkUser($page[2]);
                        break;
                    case 'checkCity':
                        $this->checkCity($page[2]);
                        break;
                    case 'content':
                        if($page[2] == 'show'){
                            $this->showContent($page[3]);
                        } elseif($page[2] == 'showall'){
                            $this->showAllContent($page[3]);
                        } else {
                            $this->uploadContent($page[2]);
                        }
                        break;
					default:
						$this->main();
						break;
				}
			}
		}

        public function addRelations($id, $type){
            $search = $this->query('SELECT * FROM user_relations WHERE content_id='.$id.' AND type="'.$type.'" AND user_id='.$_SESSION['user_id']);
            if(sizeof($search) < 1){
                $event = array('user_id'=>$_SESSION['user_id'], 'content_id'=>$id, 'type'=>$type);
                $this->save('user_relations', $event);
            }
        }
        
        public function checkRelations($id, $type){
            $search = $this->query('SELECT * FROM user_relations WHERE content_id='.$id.' AND type="'.$type.'" AND user_id='.$_SESSION['user_id']);
            if(sizeof($search) < 1){
                return true;
            } else {
                return false;
            }
        }
		
		public function like($type, $id){
			if(isset($_SESSION['user_id'])){
				$search = $this->query('SELECT * FROM ratings WHERE content_id='.$id.' AND content_type="'.$type.'" AND user_id='.$_SESSION['user_id']);
				if(sizeof($search) < 1){
					$rating = array('content_id'=>$id, 'content_type'=>$type, 'user_id'=>$_SESSION['user_id'], 'rating'=>'like');
					$this->save('ratings', $rating);
				}
				header('Location: '.$_SERVER['HTTP_REFERER']);
			} else {
				header('Location: ?'.LINK_URL.'user/signup');	
			}
		}

        public function addEvent($id=null){
            if(isset($_SESSION['user_id'])){
                $this->addRelations($id, 'event');
                if(!isset($_GET['ajax'])){
                    header('Location: '.$_SERVER['HTTP_REFERER']);
                }
            } else {
                header('Location: ?'.LINK_URL.'user/signup');
            }
        }
        
        public function addFriend($id=null){
            if(isset($_SESSION['user_id'])){
                $this->addRelations($id, 'friend');
                if(!isset($_GET['ajax'])){
                    header('Location: '.$_SERVER['HTTP_REFERER']);
                }
            } else {
                header('Location: ?'.LINK_URL.'user/signup');
            }
        }

        public function checkCity($name=null){
            $checkPlace = $this->query('SELECT * FROM contents WHERE data LIKE "%\"city\":\"'.$_POST['data'].'%"');
            
            $json = '{"object":[';
            
            $used = array();
            
            foreach($checkPlace as $c){
                $checkCityAvailable = true;
                foreach($used as $u){
                    if($data->city == $u){
                        $checkCityAvailable = false;
                    }
                }
                
                if($checkCityAvailable){
                    $data = json_decode($c['data']);
                    $json .= '"'.$data->city.'",';
                    $used[] = $data->city;
                }
            }
            $json = substr($json, 0, -1);
            $json .= '],';
            $json .= '"url":"?'.LINK_URL.'user/pages"}';
            
            echo $json;
        }

        public function checkUser($name=null){
            $checkUsers = $this->query('SELECT * FROM users WHERE user_type="artist" and username LIKE "%'.$_POST['data'].'%"');
            $json = '{"object":[';
            
            foreach($checkUsers as $c){
                $json .= '"'.$c['username'].'",';
            }
            
            if(sizeof($checkUsers) > 0){
                $json = substr($json, 0, -1);
            }
            $json .= '],"url":"?pages="}';
            echo $json;
        }
        
        public function checkPlace(){
            $checkPlace = $this->query('SELECT * FROM contents WHERE data LIKE "%\"placeName\":\"'.$_POST['data'].'%"');
            $json = '{"object":[';
            
            foreach($checkPlace as $c){
                $data = json_decode($c['data']);
                $json .= '"'.$data->placeName.'",';
            }
            $json = substr($json, 0, -1);
            $json .= '],';
            $json .= '"url":"?'.LINK_URL.'user/pages"}';
            
            echo $json;
        }

        public function showFriends($name=null){
            $this->info = $this->query('SELECT * FROM user_relations AS s JOIN users AS u ON s.user_id=u.user_id WHERE u.username="'.$name.'" AND s.type="friend"');
            $this->render('user/showFriends');
        }
        
        public function deleteFriend($id){
            $search = $this->query('SELECT * FROM friends WHERE id='.$id);
            $user = $this->query('SELECT * FROM users WHERE user_id='.$search[0]['user_id']);
            $this->delete('friends', array('id'=>$id));
            header('Location: ?'.LINK_URL.'user/friends/'.$user[0]['username']);
        }

        public function showEvent($id){
            $this->content = $this->query('SELECT * FROM contents WHERE content_id='.$id);
            $data = json_decode($this->content[0]['data']);
            $this->users = array();
            foreach($data->users as $d){
                $this->users[] = $d;
            }
            //$this->users = $this->query('SELECT * FROM users WHERE user_id='.$this->content[0]['user_id']);
            
            $this->render('user/calendar/showEvent');
        }

        public function showCalendar($id){
            $this->user = $this->query('SELECT * FROM users WHERE username="'.$id.'"');
            $this->info = $this->query('SELECT * FROM contents WHERE user_id='.$this->user[0]['user_id'].' AND type="calendar"');
            
            $this->render('user/calendar/showCalendar');
        }
        
        public function createCalendar($id = null){
            $this->category = $this->query('SELECT * FROM categories');
            
            if($id != null){
                $this->info = $this->query('SELECT * FROM contents WHERE content_id='.$id);
                $this->info = $this->info[0];
                    
                $this->data = json_decode($this->info['data']);
                $this->info['city'] = $this->data->city;
                $this->info['place'] = $this->data->placeName;
                $this->info['data'] = $this->data->date;
                $this->info['category'] = $this->data->type;
                $this->info['users'] = array();
                foreach($this->data->users as $u){
                    $this->info['users'][] = $u;
                }
                $this->content = $id;
            } else {
                $this->info = null;
                $id = $this->query('SELECT * FROM contents ORDER BY content_id DESC LIMIT 1');
                $this->content = $id[0]['content_id'];
            }
            
            if($_POST && sizeof($_POST) > 0){
                $calendarError = $this->validate($_POST['calendar']);
                $calendarPOST = $calendarError['values'];
                
                if($calendarError['total'] < 1){
                    $users = '"users":[';
                    foreach($_POST['adduser'] as $a){
                        $users .= '"'.$a.'",';
                    }
                    $users = substr($users, 0, -1).']';
                    
                    $data = '{"date":"'.$calendarPOST['data'].'", "type":"'.$calendarPOST['category'].'", "city":"'.$calendarPOST['city'].'", "placeName":"'.$calendarPOST['place'].'", '.$users.'}';
                    $calendarPOST['data'] = null;
                    $calendarPOST['city'] = null;
                    $calendarPOST['place'] = null;
                    $calendarPOST['category'] = null;
                    
                    $calendarPOST['data'] = $data;
                    
                    $list = array('type'=>$calendarPOST['type'], 'data'=>$calendarPOST['data'], 'name'=>$calendarPOST['name'], 'description'=>$calendarPOST['description'], 'user_id'=>$calendarPOST['user_id']);
                    $this->save('contents', $list);
                    $user = $this->query('SELECT * FROM users WHERE user_id='.$_SESSION['user_id']);
                    header('Location: ?'.LINK_URL.'user/showCalendar/'.$user[0]['username']);
                } else {
                    $this->info = $calendarPOST;
                    $this->errors['categories'] = $calendarError;
                    $this->render('user/calendar/createCalendar');
                }
            } else {
                $this->errors = null;
                $this->render('user/calendar/createCalendar');
            }
        }
        
        public function deleteCalendar($id){
            $info = $this->query('SELECT * FROM contents WHERE content_id='.$id);
            $user = $this->query('SELECT * FROM users WHERE user_id='.$info[0]['user_id']);
            $this->delete('contents', array('content_id'=>$id));
            header('Location: ?'.LINK_URL.'user/showCalendar/'.$user[0]['username']);
        }
		
		public function showAllContent(){
			$this->info['content'] = $this->query('SELECT c.*, u.user_id FROM contents AS c JOIN users AS u ON u.user_id=c.user_id');
			$this->render('user/content');
		}
		
		public function artists($type=''){
			if($type=='') $type="artist";
			$this->info['users'] = $this->query('SELECT user_id, username, city, state FROM users WHERE user_type="'.$type.'" ORDER BY date DESC');
			$this->render('user/main');
		}
		
		public function wall($username){
			$user = $this->query('SELECT * FROM users WHERE username="'.$username.'"');
			$user = $user[0];
			$this->comments['holder'] = $this->query('SELECT c.*, u.username, u.city, u.state FROM comments AS c JOIN users As u ON c.user_id = u.user_id WHERE (c.content_id="'.$user['user_id'].'" AND content_type="user") OR c.user_id="'.$user['user_id'].'" ORDER BY date DESC');
			foreach($this->comments['holder'] as $k=>$c){
			    $this->comments['holder'][$k]['description'] = $this->addParagraphs($this->comments['holder'][$k]['description']);
			}
			$this->comments['content_type'] = 'user';
			$this->comments['content_id'] = $user['user_id'];
			$this->render('comments/show');
		}
		
		public function deleteComment($id){
			$info = $this->query('SELECT * FROM comments WHERE comments_id='.$id);
			$info = $info[0];
			$this->delete('comments', array('comments_id'=>$id));
            
			if(!isset($_GET['ajax'])){
                switch($type){
                    case 'content':
                        header('Location: ?'.LINK_URL.'user/content/show/'.$id);
                        break;
                    case 'user':
                        if($this->type == 'edit'){
                            $user = $this->query('SELECT * FROM users WHERE user_id='.$id);
                        } else {
                            $user = $this->query('SELECT u.* FROM comments AS c JOIN users AS u ON c.content_id=u.user_id WHERE c.contents_id='.$id); 
                        }
                        $user = $user[0];
                        header('Location: ?'.LINK_URL.'user/display/'.$user['username']);
                        break;
                    default:
                        header('Location: ?'.LINK_URL.'user/display/'.$_SESSION['username']);
                        break;
                }
            } else {
                $this->type = $info['content_type'];
                $this->content_id = $info['content_id'];
                $user = $this->query('SELECT * FROM users WHERE user_id='.$this->content_id);
                $user = $user[0];
                $this->comments['holder'] = $this->query('SELECT c.*, u.username, u.city, u.state FROM comments AS c JOIN users As u ON c.user_id = u.user_id WHERE (c.content_id="'.$this->content_id.'" AND content_type="'.$this->type.'") ORDER BY date DESC');
                foreach($this->comments['holder'] as $k=>$c){
                    $this->comments['holder'][$k]['description'] = $this->addParagraphs($this->comments['holder'][$k]['description']);
                }
                $this->comments['content_type'] = $this->type;
                $this->comments['content_id'] = $user['user_id'];
                include('./controllers/helper/show.php');
            }
		}
        
        public function likeComment($id){
            
        }
        
		public function addComment($type, $id){
		    $this->type = $type;
			if($_POST && sizeof($_POST) > 0){
				$commentErrors = $this->validate($_POST['comment']);
				$commentPOST = $commentErrors['values'];
				
				if($commentErrors['total'] < 1){
				    if($this->type == 'edit'){
				       $this->edit('comments', $commentPOST, array('comments_id'=>$id));
				    } else {
					   $this->save('comments', $commentPOST);
                    }
                    if(!isset($_GET['ajax'])){
    					switch($type){
    						case 'content':
    							header('Location: ?'.LINK_URL.'user/content/show/'.$id);
    							break;
    						case 'user':
                                if($this->type == 'edit'){
                                   $user = $this->query('SELECT * FROM users WHERE user_id='.$id);
                                } else {
                                   $user = $this->query('SELECT u.* FROM comments AS c JOIN users AS u ON c.content_id=u.user_id WHERE c.contents_id='.$id); 
                                }
    							$user = $user[0];
    							header('Location: ?'.LINK_URL.'user/display/'.$user['username']);
    							break;
    						default:
    							header('Location: ?'.LINK_URL.'user/display/'.$_SESSION['username']);
    							break;
    					}
					} else {
					    $user = null;
					    if($this->type != 'edit'){
					       $user = $this->query('SELECT * FROM users WHERE user_id='.$id);
                            $user = $user[0];
                            $this->comments['holder'] = $this->query('SELECT c.*, u.username, u.city, u.state FROM comments AS c JOIN users As u ON c.user_id = u.user_id WHERE (c.content_id="'.$user['user_id'].'" AND content_type="'.$this->type.'") ORDER BY date DESC');
                            foreach($this->comments['holder'] as $k=>$c){
                                $this->comments['holder'][$k]['description'] = $this->addParagraphs($this->comments['holder'][$k]['description']);
                            }
                            $this->comments['content_type'] = $type;
                            $this->comments['content_id'] = $user['user_id'];
                            include('./controllers/helper/show.php');
                        } else {
                            $this->comment = $this->query('SELECT c.*, u.username, u.city, u.state FROM comments AS c JOIN users As u ON c.user_id = u.user_id WHERE c.comments_id="'.$id.'" ORDER BY date DESC');
                            echo preg_replace('/@(\w+)/i', '<a href="?'.LINK_URL.'user/display/@${1}">@${1}</a>', $this->comment[0]['description']).'<br/>';
                            echo '<div style="margin-top: 10px; font-weight: bold; font-size: 14px;">'.$this->comment[0]['username'].' - '.$this->comment[0]['city'].', '.$this->comment[0]['state'].' - '.date('M d, Y', strtotime($this->comment[0]['date'])).'</div>';
                            if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $this->comment[0]['user_id']){
                                echo '<div style="clear: both; margin-top: 10px;">';
                                echo '<a href="?'.LINK_URL.'user/deleteComment/'.$this->comment[0]['comments_id'].'" style="color: #00AEFF;" class="delete">Delete</a> | ';
                                echo '<a href="?'.LINK_URL.'user/editComment/'.$this->comment[0]['comments_id'].'" style="color: #00AEFF;" class="edit">Edit</a> | ';
                                echo '</div>';
                            }
                            echo '<a href="?'.LINK_URL.'user/likeComment/'.$this->comment[0]['comments_id'].'" style="color: #00AEFF;">Like</a>';
                            echo '<script type="text/javascript" src="./js/edit.js"></script>';
                        }
					}
				} else {
					$this->errors = $commentErrors['errors'];
					$this->info = $commentPOST;
					$this->info['content_type'] = $type;
					$this->info['content_id'] = $id;
					$this->info['description'] = $commentPOST['description'];
					$this->render('user/addComment');
				}
			} else {
			    if($type != 'edit'){
    				$this->info = null;
    				$this->info['content_type'] = $type;
    				$this->info['content_id'] = $id;
    				$this->info['description'] = null;
    				$this->render('user/addComment');
				} else {
				    $comments = $this->query('SELECT * FROM comments WHERE comments_id='.$id);
                    $comments = $comments[0];
				    $this->info = null;
                    $this->info['content_type'] = $comments['content_type'];
                    $this->info['content_id'] = $comments['content_id'];
                    $this->info['description'] = $comments['description'];
                    $this->info['comments_id'] = $comments['comments_id'];
                    $this->info['type'] = $type;
                    $this->render('user/addComment');
				}
			}
		}
		
		public function showContent($id){
			$this->info = $this->query('SELECT * FROM contents WHERE content_id="'.$id.'"');
			$this->comments = $this->comments('content', $id);
			$this->title = $this->info[0]['name'];
			$this->render('user/showContent');
		}
		
		public function deleteContent($id){
			$content = $this->query('SELECT * FROM contents WHERE content_id='.$id);
			$content = $content[0];
			if($content['user_id'] == $_SESSION['user_id']){
				$this->delete('contents', array('content_id'=>$id));
				$file = $this->userDir.$content['user_id'].'/'.$content['content_id'].'.'.$content['data'];
				if(is_file($file)){
					unlink($file);
				}
			}
			header('Location: '.LINK_URL.'user/content/'.$_SESSION['username']);
		}
		
		public function uploadContent($id){
			$this->id = $id;
			$this->info['user'] = $this->query('SELECT * FROM users WHERE username = "'.$id.'"');
			$this->info['content'] = $this->query('SELECT c.*, u.user_id FROM contents AS c JOIN users AS u ON u.user_id=c.user_id WHERE u.username="'.$id.'"');
			$this->id = $this->info['user'][0]['user_id'];
			$this->info['upload'] = null;
			
			if($_POST && sizeof($_POST) > 0){
				$contentError = $this->validate($_POST['content']);
				$contentUser = $contentError['values'];
				
				if($contentError['total'] > 0 || (isset($_FILES['file']) && $_FILES['file']['name'] == '' && $contentUser['type'] != 'video')){
					$this->info['upload'] = $contentUser;
					header('Location: '.LINK_URL.'user/content/'.$_SESSION['username']);
				} else {
					$userDir = $this->userDir.$id;
					
					if(!is_dir(getcwd().'uploads/usersDir/'.$id)){
						mkdir(getcwd().'uploads/usersDir/'.$id);
					}
					
					if($contentUser['type'] == 'video' || $contentUser['type'] == 'article'){
						$contentId = $this->save('contents', $contentUser);
						$this->info['content'] = $this->query('SELECT c.*, u.user_id FROM contents AS c JOIN users AS u ON u.user_id=c.user_id WHERE u.username="'.$id.'"');
						
						$this->render('user/content');
					} else {
						$contentType = explode('.', $_FILES['file']['name']);
						
						if(isset($contentType[sizeof($contentType)-1])){
							$contentType = $contentType[sizeof($contentType)-1];
						
							$contentUser['data'] = $contentType;
							
							$contentId = $this->save('contents', $contentUser);
							$this->info['content'] = $this->query('SELECT c.*, u.user_id FROM contents AS c JOIN users AS u ON u.user_id=c.user_id WHERE u.username="'.$id.'"');
							
							move_uploaded_file($_FILES['file']['tmp_name'], getcwd().'/'.str_replace('/thespot','',$userDir).$contentId.'.'.$contentType) or die(getcwd().'/'.$userDir.$contentId.'.'.$contentType);
							$this->render('user/content');
						} else {
							$this->render('user/content');
						}
					}
				}
			} else {
				$this->info['upload'] = null;
				$this->render('user/content');
			}
		}
			
		public function main(){
			$this->info['users'] = $this->query('SELECT user_id, username, city, state FROM users WHERE user_type="general" ORDER BY date DESC');
			$this->render('user/main');
		}
		
		public function signup(){
			if($_POST && sizeof($_POST) > 0){
				$userError = $this->validate($_POST['user']);
				$userPOST = $userError['values'];
				
				if($userError['total'] < 1){
					$users = $this->query('SELECT * FROM users WHERE username="'.$userPOST['username'].'"');
					print_r($userError);
					if(sizeof($users) > 0){
        				$userError['username']['error'] = 'Username Already Taken.';
        				$this->info = $userPOST;
						$this->errors['user'] = $userError;
						$this->render('user/signup');
					} else {
						$this->save('users', $userPOST);
						header('Location: '.LINK_URL.'user/login');
					}
				} else {
					$this->info = $userPOST;
					$this->errors['user'] = $userError;
					$this->render('user/signup');
				}
			} else {
				$this->info = null;
				$this->render('user/signup');
			}
		}
		
		public function email($id=null){
			if(isset($_POST) && sizeof($_POST) > 0){
				$userErrors = $this->validate($_POST['user']);
        		$userPOST = $userErrors['values'];
				
        		if($userErrors['total'] < 1){
        			$info = $this->query('SELECT * FROM users where user_id='.$id);
        			$info = $info[0];
					mail($info['email'], $userPOST['subject'], $userPOST['body'], 'From: info@micarloader.com');
					$this->showData($info);
					
          			$this->logs('User-Emailed User '.$id, 0, $_SESSION['user_id']);
          			header('LOCATION: '.LINK_URL.'admin/userInfo/'.$id);
        		} else {
        			$this->info = $userPOST;
        			$this->id = $id;
					$this->errors['user'] = $userErrors;
					$this->render('user/email');
        		}
			} else {
				$this->info = null;
				$this->id = $id;
				$this->render('user/email');
			}
		}
		
		public function remove($id = null){
			$this->delete('users', array('user_id'=>$id));
			$this->logs('User-Delete '.$id, 0, $_SESSION['user_id']);
			header('LOCATION: '.LINK_URL.'admin');
		}
		
		public function changeStatus($status = null, $id = null){
			$save = array('paid_status'=>$status);
			$this->logs('User-Change Status '.$id, 0, $_SESSION['user_id']);
			$this->save('users', $save, array('user_id'=>$id));
		}
		
		public function forgot(){
			if(isset($_POST) && sizeof($_POST) > 0){
				$userErrors = $this->validate($_POST['login']);
        		$userPOST = $userErrors['values'];
        		
        		if($userErrors['total'] < 1){
        			$user = $this->query('SELECT * FROM users WHERE email="'.$userPOST['email'].'"');
        			if(sizeof($user) > 0){
        				$content = file_get_contents('views/template/email_forgot.html');
        				$content = str_replace('[email]', $user[0]['email'], $content);
        				$content = str_replace('[username]', $user[0]['username'], $content);
        				$content = str_replace('[password]', $user[0]['password'], $content);
        				$content = str_replace('[logo]', '<img src="'.STATIC_SERVER.'/images/p1p_logo.png" width="200px;"/>', $content);
        				//$content = str_replace('[name]', $user[0]['first_name'].' '.$user[0]['last_name'], $content);
        				
        				$headers  = "From: admin@page1posting.com\r\n";
    					$headers .= "Content-type: text/html\r\n";
    					
        				mail($userPOST['email'], 'admin@page1posting.com', $content, $headers);
          			
          				$this->logs('User-Forgot Password', 0, 0);
          				$this->render('user/forgot_success');
        			} else {
        				$userErrors['email']['error'] = 'That email is not in our system, please try again.';
        				$this->info = $userPOST;
						$this->errors['user'] = $userErrors;
						$this->render('user/forgot');
        			}
        		} else {
        			$this->info = $userPOST;
					$this->errors['user'] = $userErrors;
					$this->render('user/forgot');
        		}
			} else {
				$this->info = null;
				$this->render('user/forgot');
			}
		}
		
		public function listSupport($id=null){
			$this->render('user/help');
			$count = 0;
			$page = 0;
			$post = array();
			$total = 20;
			if(isset($_GET['pagenum'])) $page = $_GET['pagenum'];
			if($id != null){
				$query = 'WHERE m.user_id='.$id;
			} else {
				if($_SESSION['user_type'] == 'admin'){
					$search = '';
				} else {
					$search = 'WHERE m.user_id'.$_SESSION['user_id'];
				}
			}
			
			$this->pageQ = array('query'=>$query);
			$this->pagination['page'] = '?'.LINK_URL.'user/listSupport/'.$id;
			$this->pagination['container'] = 'searchHolder';
			$this->pagination['total'] = $this->query('SELECT COUNT(*) FROM support AS s JOIN users AS m ON m.user_id = s.user_id '.$query);
			$this->pagination['totalOnPage'] = $page*$total;
			$this->pagination['totalPages'] = $total/$this->pagination['total'][0]['COUNT(*)'];
			include('pagination.php');
			$query .= ' ORDER BY support_id DESC LIMIT '.($page*$total).','.$total;
			
			$this->logs('User-List Support '.$id, 0, $_SESSION['user_id']);
			$this->info = $this->query('SELECT * FROM support AS s JOIN users AS m ON m.user_id = s.user_id '.$query);
			$this->render('user/listsupport');
		}
		
		public function userpage(){
	    	if(isset($_SESSION['username'])){
	    		
				$this->info['messages'] = $this->query('SELECT * FROM messages WHERE user_id = '.$_SESSION['user_id']);
	    		
		    	$this->render('user/userpage');
			} else {
				header('LOCATION: '.LINK_URL.'user/display');
			}
		}
	    
	    public function displayUser($username){
	    	$this->info['user'] = $this->query('SELECT * FROM users WHERE username="'.$username.'"');
            
            if(sizeof($this->info['user']) < 1){ header('Location: http://twitter.com/#!/'.$username); }
            
            $this->info['user'][0]['description'] = $this->query('SELECT description FROM pages WHERE parent_id="'.$this->info['user'][0]['user_id'].'" AND content_type="user"');
	    	$this->info['user'] = $this->info['user'][0];
            $this->info['user']['description'] = $this->addParagraphs($this->info['user']['description'][0]['description']);
            $this->comments['content_type'] = 'user';
            $this->comments['content_id'] = $this->info['user']['user_id'];
	    	$this->comments = $this->comments('user', $this->info['user']['user_id']);
	    	$this->render('user/display');
	    }
		
		public function create($id=null){
			if(isset($_POST) && sizeof($_POST) > 0){
				$userErrors = $this->validate($_POST['user']);
        		$userPOST = $userErrors['values'];
        		$check = $this->query('SELECT * FROM users WHERE username="'.$userPOST['username'].'"');
        		
        		if($userErrors['total'] < 1 && sizeof($check)<1){
        			if($id != null) $userPOST['parent_id'] = $id;
          			$dbInfo = $this->save('users', $userPOST);
          			if(isset($_FILES) && sizeof($_FILES) > 0){
          				move_uploaded_file($_FILES['user']['tmp_name']['member_header'], 'uploads/'.$_SESSION['user_id'].'.jpg');
          				move_uploaded_file($_FILES['user']['tmp_name']['member_image'], 'uploads/mem-'.$_SESSION['user_id'].'.jpg');
          			}
          			
          			require_once( './forums/config.php' );
					define('IN_PHPBB',true);
					$phpbb_root_path = "./forums/";
					$phpEx = "php";
					
					$user_row = array(
					'username' => $userPOST['username'],
					'user_password' => md5($userPOST['password']),  // have to pass in md5 hashed pword
					'user_email' => $userPOST['email'],
					'user_timezone' => '0',
					'user_lang' => 'en',
					'user_level' => '2',
					'user_actkey' => '');
					$phpbb_id = $this->save('phpbb_users', $user_row);
					$this->edit('users', array('phpbb_user_id'=>$phpbb_id, 'parent_id'=>$id), array('user_id'=>$dbInfo));
					
          			$this->logs('User-create', 0, $_SESSION['user_id']);
                    header('LOCATION: '.LINK_URL.'user/successfulsignup');
        		} else {
        			if(sizeof($check) > 0){
        				$userErrors['username']['error'] = 'Username is already taken';
        			}
        			$this->id = null;
        			$this->info = array($userPOST);
					$this->errors['user'] = $userErrors;
					$this->render('user/change');
        		}
			} else {
				$this->info = null;
				$this->id = $id;
				$this->render('user/change');
			}
		}
	    
		public function change($id=null){
			if(isset($_POST) && sizeof($_POST) > 0){
				$userErrors = $this->validate($_POST['user']);
        		$userPOST = $userErrors['values'];
        		
        		if($userErrors['total'] < 1){
	        		if($id == null){
						$id = $_SESSION['user_id'];
					}
          			$dbInfo = $this->edit('users', $userPOST, array('user_id'=>$id));
          			
          			$description = $this->validate($_POST['description']);
                    $description['values']['description'];
          			$this->edit('pages',$description['values'], array('parent_id'=>$id, 'content_type'=>"'user'"));
          			
          			if(isset($_FILES) && sizeof($_FILES) > 0){
          				if(!is_dir('./uploads/usersDir/'.$_SESSION['user_id'])){
          					mkdir('./uploads/usersDir/'.$_SESSION['user_id']);
          				}
          				$file = './uploads/usersDir/'.$_SESSION['user_id'].'/profile.jpg';
          				
          				move_uploaded_file($_FILES['profile']['tmp_name'], $file);
          			}
          			
          			$this->logs('User-edit', 0, $_SESSION['user_id']);
          			if($id == null){
          				header('LOCATION: '.LINK_URL.'/user/change');
          			} else {
          				header('LOCATION: '.LINK_URL.'user/change/'.$id);
          			}
        		} else {
        			$this->info = array($userPOST);
        			$this->id = null;
					$this->errors['user'] = $userErrors;
					$this->render('user/change');
        		}
			} else {
				if($id == null){
					$this->id = $_SESSION['user_id'];
				} else {
					$this->id = $id;
				}
				$this->info = $this->query('SELECT * FROM users WHERE user_id='.$this->id);
				$this->description = $this->query('SELECT * FROM pages WHERE parent_id='.$this->id.' AND content_type="user"');
				$this->description = $this->description[0];
                
				if(sizeof($this->description) < 1){
					$description = array('description'=>'','name'=>'','content_type'=>'user','parent_id'=>$this->id);
					$this->save('pages', $description);
					$this->description = $this->query('SELECT * FROM pages WHERE parent_id='.$this->id.' AND content_type="user"');
                    $this->description = $this->description['description'];
				}
				$this->render('user/change');
			}
		}

        public function successfulsignup(){
            $this->info = 'Thank you for signing up for TheSpot.';
            $this->render('user/successfulsignup');
        }
		
		public function changePassword(){
			if(isset($_POST) && sizeof($_POST) > 0){
				$userErrors = $this->validate($_POST['user']);
        		$userPOST = $userErrors['values'];
				
        		if($userErrors['total'] < 1){
        			$user = $this->query('SELECT * FROM users WHERE username="'.$_SESSION['username'].'" AND password="'.$userPOST['oldPassword'].'"');
        			if($userPOST['oldPassword'] == $user[0]['password']){
        				$newPassword['password'] = $userPOST['newPassword'];
          				$this->edit('users', $newPassword, array('user_id'=>$_SESSION['user_id']));
          				$this->logs('Changed Password '.$_SESSION['user_id']);
          				header('LOCATION: '.LINK_URL.'/user/userpage');
        			} else {
        				$this->info = array($userPOST);
						$this->errors['user'] = $userErrors;
						$this->errors['user']['oldPassword'] = array('error'=>'Password does not match');
						$this->render('user/changePassword');
        			}
        		} else {
        			$this->info = array($userPOST);
					$this->errors['user'] = $userErrors;
					$this->render('user/changePassword');
        		}
			} else {
				$this->info = null;
				$this->render('user/changePassword');
			}
		}
		
		public function login(){
	    	if(isset($_POST) && sizeof($_POST)){
				echo 'testing';
				die();
	    		$this->search = $this->query('SELECT * FROM users WHERE username="'.$_POST['username'].'" AND password="'.$_POST['password'].'"');
	    		
	    		$this->logs('User-Log in', $_SESSION['user_id'], $_SESSION['user_id']);
	    		if(sizeof($this->search) > 0){
					header('LOCATION: '.LINK_URL.'/user/display/'.$_SESSION['username']);
					//$this->payment = $this->query('select * from tbl_payments WHERE user_id="'.$this->search[0]['user_id'].'" OR user_id="'.$this->search[0]['parent_id'].'" AND user_id != 1 order by expdate desc');
					
					
	    		} else {
	    			$this->logs('User-Login Failed', 0, $_SESSION['user_id']);
	    			header('LOCATION: '.LINK_URL.'/home');
	    		}
	    	} else {
				if(isset($_SESSION['username'])){
					$this->userpage();
				} else {
	    			header('Location: '.LINK_URL.'/login');
				}
	    	}
	    }
	    
	    
		public function logout(){
	    	session_destroy();
	    	$this->logs('User-Logout', 0, $_SESSION['user_id']);
	    	header('LOCATION: '.LINK_URL.'/home');
	    }
	}
?>