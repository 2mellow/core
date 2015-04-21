<?
class example {
	
	function example(){
		//get PDO db instance
		global $db;
		$this->db = $db;
	}
	
	function get($id=false){
		if($id){
			if($r = $this->db->fetch_single_row("SELECT * FROM `example` WHERE `id` = ?", array($id)))
				return $r;
		} else {
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `example` ORDER BY `id` DESC"))
				return $r;
		}
	}
	
	function get_list($pg, $status="published", $base="/example/"){
		if($status){
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `example` WHERE status = ? ORDER BY `id` DESC", array($status), $base, $pg, 20))
				return $r;
		} else {
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `example` ORDER BY `id` DESC", array(), $base, $pg, 20))
				return $r;
		}
	}
	
	function get_from_url($url){
		if($r = $this->db->fetch_single_row("SELECT * FROM `example` WHERE `clean_url` = ?", array($url)))
			return $r;
	}
}
?>