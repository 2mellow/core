<?
if(isset($post) && $user->is_admin()){
	$plugin = "articles";
	
	//error checking
	if(empty($post["title"]))
		$feedback->add('You must specify a Page Title');
		
	if(empty($post["clean_url"])){
		$feedback->add('You must specify a Clean URL');
	} else {
		if($t = $db->fetch_single_row("SELECT id FROM `".$plugin."` WHERE clean_url=?", array($post["clean_url"]))){
			if($t->id !== $post['id'])
				$feedback->add('Clean URL is already in use');
		}
	}
	
	if(!$feedback->is_error()){
		$data = array(
			'title' => $post['title'],
			'meta_description' => $post['meta_description'],
			'meta_keywords' => $post['meta_keywords'],
			'clean_url' => $post['clean_url'],
			'status' => $post['status'],
			'body' => $post['body']
		);
		
		if(!empty($post['id'])){
			$id = $post['id'];
			$db->dbinsert($data, $plugin, $id);
		} else {
			$data['date_created'] = time();
			$db->dbinsert($data, $plugin);
			$id = $db->lastid();
		}
		
		$feedback->add('Item was updated or added','success');
		$header_location = "/admin/".$plugin."/manage/".$id."/";
	} else {
		createArray($post, "post");
		$header_location = "/admin/".$plugin."/manage/".$post['id']."/";
	}
}
?>