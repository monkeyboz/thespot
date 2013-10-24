<?php 
	class admin extends db{
		public function admin($page){
			switch($page[1]){
                case 'showCategories':
                    $this->showCategories();
                    break;
                case 'createCategory':
                    $this->createCategory();
                    break;
                default:
                    $this->display();
                    break;
            }
		}
		
		public function display(){
	        $this->newComments = $this->query('SELECT * FROM comments WHERE enabled = "n"');
            $this->newPosts = $this->query('SELECT * FROM users ORDER BY date LIMIT 0, 10');
			$this->render('admin/display');
		}
        
        public function createCategory(){
            if(isset($_POST) && sizeof($_POST) > 0){
                $categoryErrors = $this->validate($_POST['category']);
                $categoryPOST = $categoryErrors['values'];
                
                if($categoryErrors['total'] < 1){
                    $categoryPOST['name'] = strtolower($categoryPOST['name']);
                    $dbInfo = $this->save('categories', $categoryPOST);
                    $this->logs('Created category '.$dbInfo['id'], 0, 0);
                    //echo $this->debug; die();
                    header('LOCATION: ?page=admin/showCategories');
                } else {
                    $this->info['category'] = $categoryPOST;
                    $this->errors['category'] = $categoryErrors;
                    $this->render('admin/createCategory');
                }
            } else {
                $this->info['page'] = null;
                $this->render('admin/createCategory');
            }
        }
        
        public function showCategories(){
            $this->categories = $this->query('SELECT * FROM categories');
            $this->render('admin/showCategories');
        }
	}
?>