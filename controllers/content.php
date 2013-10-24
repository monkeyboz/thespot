<?php
	class content extends db{
		public function content($page){
			$page[1] = (isset($page[1]))?$this->contentLayout($page[1]):null;
		}

        public function contentLayout($content = null){
			$content = ($content == null)?'main':$content;
			if($content != 'main'){
				$this->info = $this->query('SELECT * FROM contents WHERE type="'.$content.'" ORDER BY created DESC');
        		$this->render('content/layout');
			} else {
				$this->info = ('SELECT * FROM contents WHERE ORDERY BY created');
				$this->render('content/main');
			}
        }
	}
?>