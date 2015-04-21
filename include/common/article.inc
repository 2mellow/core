<?
class article {
	
	function article(){
		//get PDO db instance
		global $db;
		$this->db = $db;
	}
	
	function get($id=false){
		if($id){
			if($r = $this->db->fetch_single_row("SELECT * FROM `articles` WHERE `id` = ?", array($id)))
				return $r;
		} else {
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `articles` ORDER BY `id` DESC"))
				return $r;
		}
	}
	
	function get_list($pg, $status="published", $base="/article/"){
		if($status){
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `articles` WHERE status = ? ORDER BY `id` DESC", array($status), $base, $pg, 12))
				return $r;
		} else {
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `articles` ORDER BY `id` DESC", array(), $base, $pg, 20))
				return $r;
		}
	}
	
	function get_from_url($url){
		if($r = $this->db->fetch_single_row("SELECT * FROM `articles` WHERE `clean_url` = ?", array($url)))
			return $r;
	}
}
?>