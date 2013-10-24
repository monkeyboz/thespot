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
					case 'artists':
						$this->artists();
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
						echo 'testing';
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
					case 'deleteContent':
						$this->deleteContent($page[2]);
						break;
					case 'wall':
						$this->wall($page[2]);
						break;
					default:
						$this->main();
						break;
				}
			} else {
				$page[1] = (isset($page[1]))?$page[1]:'';
				switch($page[1]){
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
					case 'content':
						if($page[2] == 'show'){
							$this->showContent($page[3]);
						} elseif($page[2] == 'showall'){
							$this->showAllContent($page[3]);
						} else {
							$this->uploadContent($page[2]);
						}
						break;
					case 'deleteContent':
						$this->deleteContent($page[2]);
						break;
					case 'display':
						$this->displayUser($page[2]);
						break;
					case 'artists':
						$this->artists();
						break;
					default:
						$this->main();
						break;
				}
			}
		}
		
		public function showAllContent(){
			$this->info['content'] = $this->query('SELECT c.*, u.user_id FROM contents AS c JOIN users AS u ON u.user_id=c.user_id');
			$this->render('user/content');
		}
		
		public function artists(){
			$this->info['users'] = $this->query('SELECT user_id, username, city, state FROM users WHERE user_type="artist" ORDER BY date DESC');
			$this->render('user/main');
		}
		
		public function wall($id){
			$user = $this->query('SELECT * FROM users WHERE username="'.$id.'"');
			echo 'SELECT * FROM users WHERE username="'.$id.'"';
			$user = $user[0];
			$this->comments['holder'] = $this->query('SELECT c.*, u.username, u.city, u.state FROM comments AS c JOIN users As u ON c.user_id = u.user_id WHERE u.username="'.$id.'" ORDER BY date DESC');
			$this->comments['content_type'] = 'user';
			$this->comments['content_id'] = $user['user_id'];
			$this->render('comments/show');
		}
		
		public function deleteComment($id){
			$info = $this->query('SELECT * FROM comments WHERE comments_id='.$id);
			$info = $info[0];
			$this->delete('comments', array('comments_id'=>$id));
			switch($info['type']){
				case 'content':
					header('Location: ?page=user/content/show/'.$id);
					break;
				case 'user':
					$user = $this->query('SELECT * FROM users WHERE user_id='.$id);
					$user = $user[0];
					header('Location: ?page=user/display/'.$user['username']);
					break;
				default:
					header('Location: ?page=user/display/'.$_SESSION['username']);
				break;
			}
			header('Location: ?page=user/display/'.$_SESSION['username']);
		}
		
		public function addComment($type, $id){
			if($_POST && sizeof($_POST) > 0){
				$commentErrors = $this->validate($_POST['comment']);
				$commentPOST = $commentErrors['values'];
				
				if($commentErrors['total'] < 1){
					$this->save('comments', $commentPOST);
					switch($type){
						case 'content':
							header('Location: ?page=user/content/show/'.$id);
							break;
						case 'user':
							$user = $this->query('SELECT * FROM users WHERE user_id='.$id);
							$user = $user[0];
							header('Location: ?page=user/display/'.$user['username']);
							break;
						default:
							header('Location: ?page=user/display/'.$_SESSION['username']);
							break;
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
				$this->info = null;
				$this->info['content_type'] = $type;
				$this->info['content_id'] = $id;
				$this->info['description'] = null;
				$this->render('user/addComment');
			}
		}
		
		public function showContent($id){
			$this->info = $this->query('SELECT * FROM contents WHERE content_id="'.$id.'"');
			$this->comments = $this->comments('content', $id);
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
			header('Location: ?page=user/content/'.$_SESSION['username']);
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
					header('Location: ?page=user/content/'.$_SESSION['username']);
				} else {
					$userDir = $this->userDir.$this->id.'/';
					if(!is_dir($userDir)){
						mkdir($userDir);
					}
					
					if($contentUser['type'] == 'video'){
						$contentId = $this->save('contents', $contentUser);
						$this->info['content'] = $this->query('SELECT c.*, u.user_id FROM contents AS c JOIN users AS u ON u.user_id=c.user_id WHERE u.username="'.$id.'"');
						
						$this->render('user/content');
					} else {
						$contentType = explode('/', $_FILES['file']['type']);
						if(isset($contentType[1])){
							$contentType = $contentType[1];
						
							$contentUser['data'] = $contentType;
							
							$contentId = $this->save('contents', $contentUser);
							$this->info['content'] = $this->query('SELECT c.*, u.user_id FROM contents AS c JOIN users AS u ON u.user_id=c.user_id WHERE u.username="'.$id.'"');
													
							move_uploaded_file($_FILES['file']['tmp_name'], $userDir.$contentId.'.'.$contentType);
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
						header('Location: ?page=user/login');
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
          			header('LOCATION: ?page=admin/userInfo/'.$id);
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
			header('LOCATION: ?page=admin');
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
        				$content = file_get_contents('views/templates/email_forgot.html');
        				$content = str_replace('[email]', $user[0]['email'], $content);
        				$content = str_replace('[username]', $user[0]['username'], $content);
        				$content = str_replace('[password]', $user[0]['password'], $content);
        				$content = str_replace('[logo]', '<img src="'.STATIC_SERVER.'/images/p1p_logo.png" width="200px;"/>', $content);
        				$content = str_replace('[name]', $user[0]['first_name'].' '.$user[0]['last_name'], $content);
        				
        				$headers  = "From: admin@page1posting.com\r\n";
    					$headers .= "Content-type: text/html\r\n";
    					
        				mail($userPOST['email'], 'admin@page1posting.com', $content, $header);
          			
          				$this->logs('User-Forgot Password', 0, 0);
          				header('LOCATION: ?page=home');
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
			$this->pagination['page'] = '?page=user/listSupport/'.$id;
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
				header('LOCATION: ?page=user/display');
			}
		}
	    
	    public function displayUser($username){
	    	$this->info['user'] = $this->query('SELECT * FROM users WHERE username="'.$username.'"');
	    	$this->info['user'] = $this->info['user'][0];
	    	$this->comments = $this->comments('user', $this->info['user']['user_id']);
	    	$this->render('user/display');
	    }
		
		public function create($id=null){
			if(isset($_POST) && sizeof($_POST) > 0){
				$userErrors = $this->validate($_POST['user']);
        		$userPOST = $userErrors['values'];
        		//$this->showData($userErrors);
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
          			header('LOCATION: ?page=home/successfulsignup');
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
				
        		//$this->showData($userErrors);
        		
        		if($userErrors['total'] < 1){
	        		if($id == null){
						$id = $_SESSION['user_id'];
					}
          			$dbInfo = $this->edit('users', $userPOST, array('user_id'=>$id));
          			
          			$description = $this->validate($_POST['description']);
          			$this->edit('pages', $description['values'], array('parent_id'=>$id, 'content_type'=>"user"));
          			
          			if(isset($_FILES) && isset($_FILES['profile']['name'])){
          				if(!is_dir('uploads/usersDir/'.$_SESSION['user_id'])){
          					mkdir('uploads/usersDir/'.$_SESSION['user_id']);
          				}
          				$file = './uploads/usersDir/'.$_SESSION['user_id'].'/profile.jpg';
          				if(is_file($file)) unlink($file);
          				 
          				move_uploaded_file($_FILES['profile']['tmp_name'], $file);
          			}
          			
          			$this->logs('User-edit', 0, $_SESSION['user_id']);
          			if($id == null){
          				header('LOCATION: ?page=user/change');
          			} else {
          				header('LOCATION: ?page=user/change/'.$id);
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
					echo $description;
					$this->description = $this->query('SELECT * FROM pages WHERE parent_id='.$this->id.' AND content_type="user"');
				}
				$this->render('user/change');
			}
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
          				header('LOCATION: ?page=user/userpage');
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
	    		$this->search = $this->query('SELECT * FROM users WHERE username="'.$_POST['username'].'" AND password="'.$_POST['password'].'"');
	    		
	    		$this->logs('User-Log in', 0, $_SESSION['user_id']);
	    		if(sizeof($this->search) > 0){
					$this->payment = $this->query('select * from tbl_payments WHERE user_id="'.$this->search[0]['user_id'].'" OR user_id="'.$this->search[0]['parent_id'].'" AND user_id != 1 order by expdate desc');
					
					
	    		} else {
	    			$this->logs('User-Login Failed', 0, $_SESSION['user_id']);
	    			header('LOCATION: ?page=home');
	    		}
	    	} else {
				if(isset($_SESSION['username'])){
					$this->userpage();
				} else {
	    			header('Location: ?page=login');
				}
	    	}
	    }
	    
	    
		public function logout(){
	    	session_destroy();
	    	$this->logs('User-Logout', 0, $_SESSION['user_id']);
	    	header('LOCATION: ?page=home');
	    }
	}
?>