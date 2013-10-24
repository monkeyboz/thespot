<?php
	class releases extends db{
		var $releaseDir = './uploads/releases/';
		
		public function releases($page){
			if(isset($page[1]) && $this->checkLogin()){
				switch($page[1]){
					case 'show':
						$this->show($page[2]);
						break;
					case 'create':
					case 'edit':
						$page[2] = (isset($page[2]))?$page[2]:null;
						$this->create($page[2]);
						break;
					case 'delete':
						$this->delete($page[1]);
						break;
					default:
						$this->showAll();
						break;
				}
			} else {
				if(!isset($page[1])) $page[1] = null;
				switch($page[1]){
					case 'show':
						$this->show($page[2]);
						break;
					default:
						$this->showAll();
						break;
				}
			}
		}
		
		public function create($id=null){
			$this->users = $this->query('SELECT * FROM users WHERE user_type="artist"');
			if($_POST && sizeof($_POST) > 0){
				$releaseError = $this->validate($_POST['release']);
				$releaseUser = $releaseError['values'];
		
				if($releaseError['total'] > 0 ){
					$this->info = $releaseUser;
					$this->errors = $releaseError;
					$this->tracks = array();
					foreach($_POST['tracks'] as $p){
						$this->tracks[] = $p;
					}
					$this->render('release/creates');
				} else {
					$this->id = $this->save('releases', $releaseUser);
					
					if($_POST['tracks']){
						foreach($_POST['tracks'] as $p){
							$track = array('name'=>$p, 'release_id'=>$this->id);
							$this->save('tracks', $track);
						}
					}
					
					$userDir = $this->releaseDir.$this->id;
					
					if(isset($contentType[1])){
						$contentType = explode('/', $_FILES['file']['type']);
						$contentType = $contentType[1];
						$releaseUser['data'] = $contentType;
		
						$contentId = $this->save('contents', $releaseUser);
						
						move_uploaded_file($_FILES['file']['tmp_name'], $userDir.'.'.$contentType);
						
					}
					header('LOCATION: ?page=releases/list');
				}
			} else {
				if($id == null){
					$this->info = null;
					$this->tracks = array();
				} else {
					$this->info = $this->query('SELECT * FROM releases WHERE release_id='.$id);
					$this->info = $this->info[0];
					$this->tracks = $this->query('SELECT * FROM tracks WHERE release_id='.$id);
				}
				$this->render('releases/create');
			}
		}
		
		public function getReleasePic($id){
			$profilePics = $this->releaseDir.$id.'.jpg';
	    	if(is_file($profilePics)){
	    		return $profilePics;
	    	} else {
	    		return $this->releaseDir.'place_holder.jpg';
	    	}
	    }
		
		public function showAll(){
			$this->info = $this->query('SELECT * FROM releases AS r JOIN users AS u on u.user_id=r.user_id');
			$this->render('releases/showAll');
		}
		
		public function show($id=null){
			$this->info = $this->query('SELECT * FROM releases AS r JOIN users AS u ON u.user_id=r.user_id WHERE release_id='.$id);
			$this->tracks = $this->query('SELECT * FROM tracks WHERE release_id='.$id);
			$this->render('releases/show');
		}
	}
?>