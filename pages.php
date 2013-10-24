<?php
	class pages extends db{
		public function pages($page){
			if(isset($page[1])){
				switch($page[1]){
					case 'create':
						$this->create();
						break;
					case 'change':
						$this->change($page[2]);
						break;
					case 'list':
					case 'listPages':
						$page = (isset($_GET['pagenum']))?$_GET['pagenum']:0;
						$this->listPages($page);
						break;
					case 'remove':
						$this->remove($page[2]);
						break;
					case 'contact':
						$this->contact();
						break;
					default:
						$pages = isset($page[2])?$page[2]:$page[1];
						$this->show($pages);
						break;
				}
			} else {
				if(isset($page[2])){
					$this->show($page[2]);
					break;
				} else {
					$this->show($page[1]);
				}
			}
		}
		
		public function contact(){
			if(isset($_POST) && sizeof($_POST) > 0){
				$pageErrors = $this->validate($_POST['page']);
				$pagePOST = $pageErrors['values'];
			
				if($pageErrors['total'] < 1){
					$content = 'Email: '.$pagePOST['email']."\r\n";
					$content = 'Name: '.$pagePOST['name']."\r\n";
					$content = 'Body: '.$pagePOST['description']."\r\n";
					
					mail('taurean.wooley@gmail.com', 'MMG Inquiry', $pagePOST['description'], 'From: taurean.wooley@gmail.com');
					
					$this->logs('Contact '.$id);
					header('LOCATION: ?page=pages/contactSuccess');
				} else {
					$this->info['page'] = $pagePOST;
					$this->errors['page'] = $pageErrors;
					$this->render('pages/create');
				}
			} else {
				$this->info = null;
				$this->render('pages/contact');
			}
		}
		
		public function listPages($page=null){
			$where = $this->processPost();
			$total = 10;
			
			$this->pagination['totalPages'] = 0;
			$this->pagination['page'] = '?page=pages/listPages';
			$this->pagination['container'] = 'pagesHolder';
			$this->pagination['totalOnPage'] = $page*$total;
			$this->pagination['total'] = $this->query('SELECT COUNT(*) FROM pages');
			include('pagination.php');
			
			$whereQ = ' LIMIT '.$total*$page.','.$total;
			$query = 'SELECT * FROM pages '.$whereQ;
			$this->info = $this->query($query);
				
			$this->render('pages/list');
		}
		
		public function remove($id=null){
			$this->delete('pages', array('page_id'=>$id));
			$this->listPages();
		}
		
		public function show($id=null){
			if(is_numeric($id)){
				$this->info = $this->query('SELECT * FROM pages WHERE page_id='.$id);
				$this->render('pages/show');
			} else {
				$this->info = $this->query('SELECT * FROM pages WHERE name LIKE "'.$id.'"');
				$this->render('pages/show'); 
			}
		}
		
		public function change($id=null){
			if(isset($_POST) && sizeof($_POST) > 0){
				$pageErrors = $this->validate($_POST['page']);
        		$pagePOST = $pageErrors['values'];
        		
        		if($pageErrors['total'] < 1){
        			$pagePOST['name'] = strtolower($pagePOST['name']);
          			$dbInfo = $this->edit('pages', $pagePOST, array('page_id'=>$id));
          			$this->logs('Edited page '.$id);
          			header('LOCATION: ?page=pages/listPages');
        		} else {
        			$this->info['page'] = $pagePOST;
					$this->errors['page'] = $pageErrors;
					$this->info['parents'] = $this->query('SELECT name, page_id FROM pages WHERE parent_id=0');
					$this->render('pages/create');
        		}
			} else {
				$this->info['page'] = $this->query('SELECT * FROM pages WHERE page_id='.$id);
				$this->info['page'] = $this->info['page'][0];
				$this->info['parents'] = $this->query('SELECT name, page_id FROM pages WHERE parent_id=0');
				$this->render('pages/create');
			}
		}
		
		public function create(){
			if(isset($_POST) && sizeof($_POST) > 0){
				$pageErrors = $this->validate($_POST['page']);
        		$pagePOST = $pageErrors['values'];
        		
        		if($pageErrors['total'] < 1){
        			$pagePOST['name'] = strtolower($pagePOST['name']);
          			$dbInfo = $this->save('pages', $pagePOST);
          			$this->logs('Created page '.$dbInfo['id'], 0, 0);
          			//echo $this->debug; die();
          			header('LOCATION: ?page=pages/list');
        		} else {
        			$this->info['page'] = $pagePOST;
					$this->info['parents'] = $this->query('SELECT name, page_id FROM pages WHERE parent_id=0');
        			$this->errors['page'] = $pageErrors;
					$this->render('pages/create');
        		}
			} else {
				$this->info['page'] = null;
				$this->info['parents'] = $this->query('SELECT name, page_id FROM pages WHERE parent_id=0');
				$this->render('pages/create');
			}
		}
	}
?>