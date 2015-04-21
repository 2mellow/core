<?
class cms {
	
	function cms(){
		
		//Set site config variables
		$this->SITE_NAME = "2 Mellow CMS Demo";
		$this->SITE_DOMAIN = "http://cms.2mellow.com";
		$this->SUPPORT_EMAIL = "brandonfredericksen@gmail.com";
		$this->meta_keywords = "2 Mellow CMS";
		$this->meta_description = "2 Mellow CMS";
		
		//File variables
		$this->DIR_PAGES = "./include/pages/";
		$this->DIR_TEMPLATES = "./include/templates/";
		$this->DIR_COMMON_TEMPLATES = "./include/templates/common/";
		$this->DIR_POST = "./include/post/";
		$this->DIR_MANUAL = "./include/manual/";
		
		//Set request variables
		$this->url_vars = $this->get_url_vars();
		
		//get PDO db instance
		global $db;
		$this->db = $db;
		
	}
	
	//gets variables from url
	function get_url_vars() {
	
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		
		$path = trim(parse_url($url, PHP_URL_PATH), '/');
		$path_chunks = preg_split('/\/+/', $path);
		
		$arr = array();
		
		foreach($path_chunks as $k => $v){
		   $arr[$k] = sanitize($v, false, false);
		}
	
		return $arr;
	}
	
	function get_full_url($urlvars) {
		if(!empty($urlvars[0])){
			$fullurl = "/".implode("/", $urlvars)."/";
			return $fullurl;
		} else {
			return false;
		}
	}
	
	function display_result_message($keepsession=false){
		
		if(isset($_SESSION['err'])){
			
			$msg = "<span class='errorlrg'>";
			
			if(!empty($_SESSION['err']['txt'])) {
				$msg .= $_SESSION['err']['txt'];
			} else {
				$msg .= "There was an error! Settings have not been saved. Please check below.";
			}
			
			$msg .= "</span>";
			
			if(!$keepsession){
				unset($_SESSION['err']);
			}
			
			return $msg;
		} else if(isset($_SESSION['success'])){
			$msg = "<span class='successlrg'>";
			
			if(!empty($_SESSION['success']['txt'])) {
				$msg .= $_SESSION['success']['txt'];
			} else {
				$msg .= "Settings saved successfully!";
			}
			
			$msg .= "</span>";
			
			unset($_SESSION['success']);
			
			return $msg;
		} else {
			return false;
		}
	}
	
	function remove_result_message(){
		unset($_SESSION['success']);
		unset($_SESSION['err']);
	}
	
	function get_cms_pages($id = false){
		if(!$id){
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `pages`")){
				return $r;
			}
		} else {
			if($r = $this->db->fetch_single_row("SELECT * FROM `pages` WHERE id=?",array($id))){
				return $r;
			}
		}
	}
	
	function cms_page_from_url($url){
		if($r = $this->db->fetch_single_row("SELECT * FROM `pages` WHERE clean_url = ?", array($url))){
			return $r;
		} else {
			return false;
		}
	}
	
	function get_cms_pages_parents(){
		if($r = $this->db->fetch_multiple_rows("SELECT * FROM `pages` WHERE `parent` = ? ORDER BY `order` ASC", array(0))){
			return $r;
		} else {
			return false;	
		}
	}
	
	function get_cms_pages_children($parentid){
		if($r = $this->db->fetch_multiple_rows("SELECT * FROM `pages` WHERE `parent` = ? ORDER BY `order` ASC", array($parentid))){
			return $r;
		} else {
			return false;	
		}
	}
	
	function get_cms_childs_parent($parentid){
		if($r = $this->db->fetch_single_row("SELECT * FROM `pages` WHERE `id` = ? ORDER BY `order` ASC", array($parentid))){
			return $r;
		} else {
			return false;	
		}
	}
	
	function gen_page_parent_options($selected = false){		
		//get all parents
		$parents = $this->db->fetch_multiple_rows("SELECT * FROM pages WHERE parent = ? ORDER BY `order` ASC",array(0));
		
		//foreach parent get its children
		foreach($parents as $v){
			if($v->id == $selected){
				 $html .= '<option selected="selected" value="'.$v->id.'">'.$v->title.'</option>';
			} else {
				 $html .= '<option value="'.$v->id.'">'.$v->title.'</option>';
			}	
		}
		return $html;
	}
	
	function gen_page_options($selected = false){		
			//get all parents
			$parents = $this->db->fetch_multiple_rows("SELECT * FROM pages WHERE parent = ? ORDER BY `order` ASC",array(0));
			
			//foreach parent get its childrenz
			foreach($parents as $v){
				//debug_var($v);
				if($v->id == $selected){
					 $html .= '<option selected="selected" value="'.$v->id.'">&bull; '.$v->title.'</option>';
				} else {
					 $html .= '<option value="'.$v->id.'">&bull; '.$v->title.'</option>';
				}
			   if($childrenz = $this->db->fetch_multiple_rows("SELECT * FROM pages WHERE parent=? ORDER BY `order` ASC", array($v->id))){
				   foreach($childrenz as $tv){
					  $html .= "<option disabled=\"disabled\" value='".$tv->id."'>-- ".$tv->title."</option>";
				   }
			   }
			
		}
		return $html;
	}
	
	function build_link($id){
		if($p1 = $this->get_cms_pages($id)){
			if($p1->{'parent'} == 0){
				$link = $this->SITE_DOMAIN."/".$p1->clean_url."/";
			} else { 
				$p2 = $this->get_cms_childs_parent($p1->{'parent'});
				$link = $this->SITE_DOMAIN."/".$p2->clean_url."/".$p1->clean_url."/";
			}
			return $link;
		}
	}
	
	function buildMeta($page, $type) {
		if($type == "description"){
			if($page->meta_description){
				$output = $page->meta_description;
			} else {
				$output = $this->meta_description;
			}
		} else {
			if($page->meta_keywords){
				$output = $page->meta_keywords;
			} else {
				$output = $this->meta_keywords;
			}
		}
		return $output;
	}
	
	function getsetting($setting){
	}
}