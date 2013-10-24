<?php 
	class content extends db{
		function __construct($page = null){
			if(isset($page[1])){
				switch($page[1]){
					case 'create':
					case 'edit':
						$this->create();
						break;
					case 'delete':
						$this->delete($);
						break;
					case 'show':
					case 'media':
						$this->display($page[2]);
						break;
					default:
						$this->display();
						break;
				}
			} else {
				$this->display();
			}
		}
		
		private function display($user_id){
			$this->info['media'] = $this->query('SELECT * FROM content WHERE user_id='.$user_id);
			$this->render('media/display');
		}
		
		private function create(){
			if($_POST && sizeof($_POST) > 0){
				$createErrors = $this->validate($_POST['media']);
				$createValues = $createErrors['values'];
				
				if(sizeof($createErrors['errors']) < 1){
					$this->save('content', $createValues);
					header('Location: ?page=media/display/'.$_SESSION['user_id']);
				} else {
					$this->render('media/create');
				}
			} else {
				$this->info = null
				$this->render('media/create');
			}
		}
		
		private function delete($id){
			$this->remove('content', array('content_id'=>$id));
			header('Location: ?page=media/display/'.$_SESSION['user_id']);
		}
	}
?>