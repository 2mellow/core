<?
if(isset($post) && $user->is_admin()){
	
	//error checking
	if(empty($post["title"]))
		$feedback->add('You must specify a Page Title');
	if(empty($post["clean_url"]))
		$feedback->add('You must specify a Clean URL');
		
	if(!$feedback->is_error()){
		$data = array(
			'parent' => $post['parent'],
			'title' => $post['title'],
			'heading' => $post['heading'],
			'sub_heading' => $post['sub_heading'],
			'meta_description' => $post['meta_description'],
			'meta_keywords' => $post['meta_keywords'],
			'sub_heading' => $post['sub_heading'],
			'clean_url' => $post['clean_url'],
			'content' => $post['content'],
			'last_updated' => date("Y-m-d H:i:s", time())
		);
		
		if(!empty($post['id'])){
			$id = $post['id'];
			$db->dbinsert($data, "pages", $id);
		} else {
			$db->dbinsert($data, "pages");
			$id = $db->lastid();
		}
		
		$feedback->add('Page was updated or added','success');
		$header_location = "/admin/pages/manage/".$id."/";
	} else {
		createArray($post, "post");
		$header_location = "/admin/pages/manage/new/";
	}
}
?>