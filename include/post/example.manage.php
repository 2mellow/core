<?
if(isset($post) && $user->is_admin()){
	
	$plugin = "example";
	
	//error checking
	if(empty($post["horsename"])){
		$feedback->add('You must specify a Horse Name');
	} else {
		$post["clean_url"] = sanitize($post["horsename"], true);
	}
	
	if($_FILES['image']['tmp_name']){
	
		//array for use
		$file = $_FILES['image'];
	
		//image folder
		$folder = "uploads/".$plugin."/";
		
		//make directory for image
		if (!mkdirfull($folder))  $feedback->add('Error creating image directory.');
		
		//get info or somethign is wrong
		if (($img_info = getimagesize($file['tmp_name'])) == FALSE){
		  $feedback->add('Image not found or not an image.');
		}
		
		//make it into an accepted image type
		switch ($img_info[2]) {
		  case IMAGETYPE_GIF  : $image = imagecreatefromgif($file['tmp_name']);  break;
		  case IMAGETYPE_JPEG : $image = imagecreatefromjpeg($file['tmp_name']); break;
		  case IMAGETYPE_PNG  : $image = imagecreatefrompng($file['tmp_name']);  break;
		  default : $feedback->add('File must be gif, jpg or png.');
		}
		
		//randomize image name
		$imgname = substr(md5(rand(1, 100000)), 0, -15);
		
		//no errors? lets grow.
		if( !$feedback->is_error() ){
			//print_r($image);
			if(createprecrop($image, $folder.$imgname.'.jpg', 700, 550)){
				//create thumb
				createprecrop($image, $folder."thumb-".$imgname.'.jpg', 120, 100);
				//set db variable
				$profileimage = $imgname.'.jpg';
			}
		}
	}
	
	
	if(!$feedback->is_error()){
		$data = array(
			'horsename' => $post['horsename'],
			'breed' => $post['breed'],
			'gender' => $post['gender'],
			'datefoalded' => $post['datefoalded'],
			'price' => $post['price'],
			'height' => $post['height'],
			'weight' => $post['weight'],
			'temperament' => $post['temperament'],
			'regassn' => $post['regassn'],
			'body' => $post['body'],
			'clean_url' => $post['clean_url'],
			'status' => $post['status']
		);
		
		if($profileimage){
			$data['image'] = $profileimage;
		}
		
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