<?
if(isset($post) && $user->is_admin()){
	
	$plugin = "events";
	
	//error checking
	if(empty($post["title"])){
		$feedback->add('You must specify a Title');
	} else {
		$post["clean_url"] = sanitize($post["title"], true);
	}
	
	if(!$feedback->is_error()){
		$data = array(
			'title' => $post['title'],
			'contact_name' => $post['contact_name'],
			'contact_email' => $post['contact_email'],
			'contact_phone' => $post['contact_phone'],
			'location' => $post['location'],
			'clean_url' => $post['clean_url'],
			'description' => $post['description']
		);
		
		if(!empty($post['id'])){
			$id = $post['id'];
			$db->dbinsert($data, $plugin, $id);
		} else {
			$data['date_created'] = time();
			$db->dbinsert($data, $plugin);
			$id = $db->lastid();
		}
		
		//input sideitems
		if($post["event_date"]){
			$db->execute("DELETE FROM `event_dates` WHERE `parent_id` = ?",array($id));
			foreach($post["event_date"] as $k => $v){
				if(!empty($post["event_date"][$k])){
					$data = array(
						'event_date' => $post["event_date"][$k],
						'parent_id' => $id
					);
					$db->dbinsert($data, "event_dates");
				} else {
					$feedback->add('A date was empty!','error');
				}
			}
		}
		
		$feedback->add('Item was updated or added','success');
		$header_location = "/admin/".$plugin."/manage/".$id."/";
	} else {
		createArray($post, "post");
		$header_location = "/admin/".$plugin."/manage/".$post['id']."/";
	}
}
?>