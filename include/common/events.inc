<?
class events {
	
	function events(){
		//get PDO db instance
		global $db;
		$this->db = $db;
	}
	
	function get($id=false){
		if($id){
			if($r = $this->db->fetch_single_row("SELECT * FROM `events` WHERE `id` = ?", array($id)))
				return $r;
		} else {
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `events` ORDER BY `id` DESC"))
				return $r;
		}
	}
	
	function get_list($pg, $status="published", $base="/article/"){
		if($status){
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `events` WHERE status = ? ORDER BY `id` DESC", array($status), $base, $pg, 12))
				return $r;
		} else {
			if($r = $this->db->fetch_multiple_rows("SELECT * FROM `events` ORDER BY `id` DESC", array(), $base, $pg, 30))
				return $r;
		}
	}
	
	function get_from_url($url){
		if($r = $this->db->fetch_single_row("SELECT * FROM `events` WHERE `clean_url` = ?", array($url)))
			return $r;
	}
	
	function get_dates($id){
		if($r = $this->db->fetch_multiple_rows("SELECT * FROM `event_dates` WHERE `parent_id` = ?", array($id))){
			return $r;
		}
	}
	
	function get_front_list($date=false){
		if(!$date)
			$date = date("m/d/Y", time());
		if($r = $this->db->fetch_multiple_rows("SELECT * FROM `event_dates` WHERE `event_date` > ? ORDER BY `event_date`", array($date)))
			return $r;
	}
}
?>