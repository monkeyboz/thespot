<?php
  session_start();
  $cachefile = '';
  
  define('DEBUG',1);
  define('MAINPAGE','micarloader');
  define('STATIC_URL', '/thespot/');
  define('LINK_URL', '/thespot/?page=');
  
  if(DEBUG == 1){
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
  }
  $clearCache = (isset($_GET['cache']))?$_GET['cache']:0;
  
  include_once('controllers/db.php');
  $contents = new db();
  
  //checks to make sure the page variable is passed
  $page = array();
  if(isset($_GET['page']) && $_GET['page'] != 'index.php'){
    define('PAGE', $_GET['page']);
    $page = explode('/', $_GET['page']);
    //if statement checks for 404 error
    
    if(is_file('controllers/'.$page[0].'.php')){
      //if controller exists then we create object and contents for page
	    
    	if(isset($page[1]) && $page[1] == 'logout'){
        	unset($_SESSION);
      	}
      include_once('controllers/'.$page[0].'.php');
      $contents = new $page[0]($page);
    } else {
      $pageAll = '';
      foreach($page as $pi){
        $pageAll .= $pi.'/';
      }
      $pageAll = substr($pageAll,0,-1);
      if(is_file($pageAll)){
        include_once($pageAll);
        exit;
      } else {
        echo 'directory does not exists';
      }
      //404 error message for all pages
    }
  } else {
	    include_once('controllers/home.php');
      	$contents = new home(array());
  }
  
  //$contents->contents = str_replace('?page=', '/thespot/page/', $contents->contents);
  
  if(!isset($_GET['ajax'])){
  	/*$fp = fopen($cachefile, 'w');
  	fwrite($fp, $contents->contents);
  	fclose($fp);*/
	
    include($contents->display);
    
    $contents->debug;
  } else {
    if(isset($contents)){
      echo $contents->contents;
    }
  }
  
?>