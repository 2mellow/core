<?
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '1');

//ini_set("log_errors", 1);
//ini_set("error_log", "./php_error.log");

//press the on button
include("include/core.inc");

// Run commands based on POST action and then reload
// either the current page or whichever page instructed to
if($_POST){
	$post = $_POST;
    //$post = array_map("filter_data",$_POST);
	
    if(isset($post['action']) && file_exists($cms->DIR_POST . $post['action'] . '.php')){
		//include the post file
        include_once($cms->DIR_POST . $post['action'] . '.php');
		
		//if https
		if(isset($_SERVER['HTTPS']) || $_SERVER['HTTPS']){ $https = true; }
		if($https){ $http = "https"; } else { $http = "http"; }
		
		//redirect
		header("Location: ".$http."://" . $_SERVER['HTTP_HOST'] . (isset($header_location) ? $header_location : $cms->get_full_url($cms->url_vars)));
    	exit();
    }
}

//main template, and file builder
	// First check if any url vars are set, if no, then we are at the home page
	// Validate page accessz
	// Then check to see if the folder exists in the navigation folder
	// Finally, if not, give 404
	
	if($cms->url_vars[0] == ''){
		//we are at the home page, so we'll set url vars as needed
		$cms->url_vars = array("home");
		//$template = "home";
	}
	
	// Validate Page Access
	// Search for areas we want to restrict. redirect as needed.
	switch($cms->url_vars[0]){
		case 'logout':
			unset($_SESSION['user']);
			$redirect = "/admin/";
		break;
		case 'admin':
			if(!$user->is_admin()){
				$template = "login";
			} else {
				$template = "admin";
			}
		break;
	}
	
	//redirect if needed
	if(isset($redirect)){
		if($https){ $http = "https"; } else { $http = "http"; }
		header("Location: ".$http."://" . $_SERVER['HTTP_HOST'] . $redirect);
		exit;
	}
	//http handling
	else if(isset($https) && (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS'])){ 
		header("Location: https://" . $_SERVER['HTTP_HOST'] . $cms->get_full_url($cms->url_vars));
		exit;
	}
	
	// Core Page Construction
	if(
	is_dir($cms->DIR_PAGES.$cms->url_vars[0].'/') || 
	file_exists($cms->DIR_PAGES.$cms->url_vars[0].".php") || 
	$parent = $cms->cms_page_from_url($cms->url_vars[0])
	){
		//we have a folder that matches the first varible in the url
		if(
		isset($cms->url_vars[1]) && file_exists($cms->DIR_PAGES.$cms->url_vars[0].'/'.$cms->url_vars[1].'/index.php') || 
		isset($cms->url_vars[2]) && file_exists($cms->DIR_PAGES.$cms->url_vars[0].'/'.$cms->url_vars[1].'/'.$cms->url_vars[2].'.php')
		){
			//manual inc based on url vars or goto the default index.php in sub directory
			if(isset($cms->url_vars[2]) && file_exists($cms->DIR_PAGES.$cms->url_vars[0].'/'.$cms->url_vars[1].'/'.$cms->url_vars[2].'.php')){
				$pginc = $cms->url_vars[2];
			} else {
				$pginc = 'index';
			}
			
			//include the page
			ob_start();
			include_once($cms->DIR_PAGES.$cms->url_vars[0].'/'.$cms->url_vars[1].'/'.$pginc.'.php');
			$__output__ = ob_get_contents();
			ob_end_clean();
			
		} else if(isset($cms->url_vars[1]) && file_exists($cms->DIR_PAGES.$cms->url_vars[0].'/'.$cms->url_vars[1].'.php')){
			
			//include the physical page, since we have one 
			ob_start();
			include_once($cms->DIR_PAGES.$cms->url_vars[0].'/'.$cms->url_vars[1].'.php');
			$__output__ = ob_get_contents();
			ob_end_clean();

		} else if(file_exists($cms->DIR_PAGES.$cms->url_vars[0].'/index.php')) {
			
			//root file of sub directory
			ob_start();
			include_once($cms->DIR_PAGES.$cms->url_vars[0].'/index.php');
			$__output__ = ob_get_contents();
			ob_end_clean();
			
		} else if(file_exists($cms->DIR_PAGES.$cms->url_vars[0].'.php')) {
			
			//root file of sub directory
			ob_start();
			include_once($cms->DIR_PAGES.$cms->url_vars[0].'.php');
			$__output__ = ob_get_contents();
			ob_end_clean();
			
		} else if($_p = $cms->cms_page_from_url($cms->url_vars[0])) {
			//this must be a cms page!
			if($childactive = $cms->cms_page_from_url($cms->url_vars[2])){
				$itemid = $childactive->id;
				$content = $childactive->content;
			} else if($childactive = $cms->cms_page_from_url($cms->url_vars[1])){
				$itemid = $childactive->id;
				$content = $childactive->content;
			} else {
				$itemid = $_p->id;
				$content = $_p->content;
			}
			//$template = "cms";
			$_page = $cms->get_cms_pages($itemid);
			$__output__ = $content;
		}
	} else {
		//cant find what your looking for, 404
		$template = 404;
	}
	
	//if we have no template, go default
	if( !isset($template) ){
		$template = 'default';
	}
	
	//template, I choose you!
	if( $template && file_exists($cms->DIR_TEMPLATES.$template.'.php') ){
		include($cms->DIR_TEMPLATES.$template.'.php');
	} else {
		//we have reached nothing, go 404
		include($cms->DIR_TEMPLATES.'404.php');
	}