<?
class salesbarn {
	
	function salesbarn(){
		//get PDO db instance
		global $db;
		$this->db = $db;
	}
	
	function get($id=false){
		if($id){
			if($r = $this->db->fetch_single_row("SELECT * FROM `salesbarn` WHERE `id` = ?", array($id)))
				return $r;
		} else {
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `salesbarn` ORDER BY `id` DESC"))
				return $r;
		}
	}
	
	function get_list($pg, $status="published", $base="/salesbarn/"){
		if($status){
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `salesbarn` WHERE status = ? ORDER BY `id` DESC", array($status), $base, $pg, 20))
				return $r;
		} else {
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `salesbarn` ORDER BY `id` DESC", array(), $base, $pg, 20))
				return $r;
		}
	}
	
	function get_from_url($url){
		if($r = $this->db->fetch_single_row("SELECT * FROM `salesbarn` WHERE `clean_url` = ?", array($url)))
			return $r;
	}
}
?>