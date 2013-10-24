<?php
	class search extends db{
		public function search($page = null){
			$this->searches();
		}
		
		public function testing(){
			$this->render('search/search');
		}
		
		public function searches(){
			if(sizeof($_POST) > 1){
				$this->search['content'] = $this->query('SELECT * FROM contents WHERE name LIKE "%'.$_POST['query'].'%" OR description LIKE "%'.$_POST['query'].'%" ORDER BY created DESC');
				$this->search['users'] = $this->query('SELECT * FROM users WHERE username LIKE "%'.$_POST['query'].'%" ORDER BY date DESC');
				$this->search['pages'] = $this->query('SELECT * FROM pages WHERE name LIKE "%'.$_POST['query'].'%" OR description LIKE "%'.$_POST['query'].'%" ORDER BY date DESC');
				$this->search['comments'] = $this->query('SELECT * FROM comments WHERE description LIKE "%'.$_POST['query'].'%" ORDER BY date DESC');
				
				$this->render('search/results');
			} else {
				$this->search['content'] = array();
				$this->search['users'] = array();
				$this->search['pages'] = array();
				$this->search['comments'] = array();
				$this->render('search/results');
			}
		}
		
	}
?>