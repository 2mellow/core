<?

class user {
    
    function user() {
        //get PDO db instance
        global $db;
        $this->db = $db;
    }
	
	function get_user($id) {
        if ($user = $this->db->fetch_single_row("SELECT * FROM `user` WHERE id = ?", array($id))) {
            return $user;
        } else {
			return false;
		}
    }
	
	function is_logged(){
		if($_SESSION['user'] && $this->get_user($_SESSION['user'])){
			return true;
		} else {
			return false;
		}
	}
	
	function is_admin(){
		if($_SESSION['admin'] && $this->get_admin($_SESSION['admin'])){
			return true;
		} else {
			return false;
		}
	}
	
	
	function get_admin($id) {
        if ($user = $this->db->fetch_single_row("SELECT * FROM `admins` WHERE id = ?", array($id))) {
            return $user;
        } else {
			return false;
		}
    }
	
	function admin_login($email, $pass) {
		if ($admin = $this->db->fetch_single_row("SELECT * FROM `admins` WHERE email = ? AND pass = ?", array($email, md5($pass)))) {
            $_SESSION['admin'] = $admin->id;
			return true;
        } else {
			return false;
		}
	}	
}
?>