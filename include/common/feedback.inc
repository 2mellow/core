<?
class feedback {
	
	function feedback(){	
	}
	
	//add an alert 3 types, warning, error, success
	function add($text = 'an unkown error has occured.',$type = 'error'){
		$_SESSION['alerts'][$type][] = $text; 
	}
	
	function generate_html(){
		//if there are alerts generate the html
		if($_SESSION['alerts']){
			//loop through all the alerts
			foreach($_SESSION["alerts"] as $type => $alert){
			?>
				<div class="alert alert-block alert-<?php if($type == 'error'){echo 'danger';}else{echo $type;}?> fade in">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<h4 class="alert-heading"><?=ucfirst($type)?></h4>
					<? foreach($alert as $a){ //loop through each warning ?>
					   <p><?=ucfirst($a)?></p>
					<? } ?>
				</div>             
	 <? }
			//unset the session after displaying the alerts
			unset($_SESSION['alerts']);
		} else { //there were no alerts to display
			return false;
		}
	}
	
	function is_error(){
		if(isset($_SESSION['alerts']['error'])){
			return true;
		} else {
			return false;
		}
	}
	
}
?>