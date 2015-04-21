<?
if(isset($post)){
	if($user->admin_login($post['email'], $post['pass'])){
	} else {
		$feedback->add('Login info was incorrect!');
		$header_location = "/admin/";
	}
}
?>