<?php 
	class tv extends db{
		public function tv($page){
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
			$this->info = $this->query('SELECT * FROM contents WHERE content_type="video" AND content_id='.$id);
			$this->render('tv/show');
		}
		
		public function showAll(){
			$this->info = $this->query('SELECT * FROM contents WHERE type="video"');
			$this->contents .= '<h2 style="margin-top: 10px;">Monte Music Group TV</h2>';
			$this->render('tv/showAll');
		}
	}
?>