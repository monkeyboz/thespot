<?php 
	class photos extends db{
		public function photos($page){
			$page[1] = (isset($page[1]))?$page[1]:null;
			switch($page[1]){
				case 'show':
					$this->show($page[2]);
					break;
				default:
					$this->showAll();
					break;
			}
		}
		
		public function show($id=null){
			$this->info = $this->query('SELECT * FROM contents WHERE content_type="image" AND content_id='.$id);
			$this->render('tv/show');
		}
		
		public function showAll(){
			$this->info['content'] = $this->query('SELECT * FROM contents WHERE type="image" ORDER BY created DESC');
			$this->contents .= '<div style="float: left; width: 820px;">';
			$this->contents .= '<h2 style="margin-top: 10px;">Photos</h2>';
			$this->render('user/content');
			$this->contents .= '</div>';
		}
	}
?>