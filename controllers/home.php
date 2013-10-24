<?php 
	class home extends db{
		public function home(){
			$this->display();
		}
		
		public function display(){
			$this->carousel = true;
			$this->info['users'] = $this->query('SELECT * FROM users WHERE user_type="general" ORDER BY date DESC LIMIT 8');
			$this->info['artists'] = $this->query('SELECT * FROM users WHERE user_type="artist" ORDER BY date DESC LIMIT 8');
			$this->info['content']['images'] = $this->query('SELECT * FROM contents WHERE type="image" ORDER BY created DESC LIMIT 4');
			$this->info['content']['music'] = $this->query('SELECT * FROM contents WHERE type="music" ORDER BY created DESC LIMIT 4');
			$this->render('home/display');
		}
	}
?>