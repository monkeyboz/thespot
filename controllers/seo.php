<?php 
    class seo extends db{
        public function seo($page){
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
        
        public function create(){
            if($_POST && sizeof($_POST)){
                $seoErrors = $this->validate($_POST['seo']);
                $seoPOST = $seoErrors['values'];
                
                if($seoErrors['total']){
                    $this->save($seoPOST);
                    header('Location: ?page=seo/showAll');
                } else {
                    $this->info = $seoPOST;
                    $this->errors = $seoErrors;
                    $this->render('seo/create');
                }
            } else {
                $this->info = null;
                $this->errors = null;
                $this->render('seo/create');
            }
        }
        
        public function display($id){
            $this->info = $this->query('SELECT * FROM seo WHERE id='.$id);
            $this->render('seo/display');
        }
        
        public function showAll(){
            $this->info = $this->query('SELECT * FROM seo');
            $this->render('seo/showAll');
        }
    }
?>