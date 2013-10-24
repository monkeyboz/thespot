<?php
	class login extends db{
		public function login($page){
			if($this->checkLogin()){
				header('Location: ?page=user/display/'.$_SESSION['username']);
			} else {
				$this->display();
			}
		}
		
		private function display(){
			if($_POST && sizeof($_POST) > 0){
				$userError = $this->validate($_POST['user']);
				$userPOST = $userError['values'];
				
				if($userError['total'] < 1){
					$check = $this->query('SELECT * FROM users WHERE username="'.$userPOST['username'].'" AND password="'.$userPOST['password'].'"');
					if(sizeof($check) > 0){
						$_SESSION['username'] = $check[0]['username'];
						$_SESSION['user_id'] = $check[0]['user_id'];
						$_SESSION['user_type'] = $check[0]['user_type'];
						header('Location: ?page=user/display/'.$_SESSION['username']);
					} else {
						$userError['username']['error'] = 'username and password do not match.';
						$this->errors = $userError;
						$this->info = $userPOST;
						$this->render('login/login');
					}
				} else {
					$this->info = $userPOST;
					$this->errors = $userError;
					$this->render('login/login');
				}
			} else {
				$this->info = null;
				$this->render('login/login');
			}
		}
	}
?>