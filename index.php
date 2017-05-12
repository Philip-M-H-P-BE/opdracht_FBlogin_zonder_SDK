<?php
session_start();
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'display_homepage';
    }
}  

switch ($action) {
    case 'display_homepage':
        include('./view/homepage.html');
        break;
	case 'contact_Facebook':
		header('Location: https://www.facebook.com/v2.9/dialog/oauth?client_id=829609807188888&redirect_uri=http://opdr.local/opdracht/model/first_redirect.php&scope=user_about_me');
		break;
	case 'show_name_and_pic':
		include('./view/na_inloggen.php');
		break;
	case 'logout':
		/*
		var_dump($_SESSION['userinfo']);
		*/
		$_SESSION['userinfo'] = json_decode($_SESSION['userinfo']);
		/*
		var_dump($_SESSION['userinfo']);
		var_dump($_SESSION['userinfo']->id);
		var_dump($_SESSION['accesstoken']);
		*/
		$result = file_get_contents('https://graph.facebook.com/' . $_SESSION['userinfo']->id . '/permissions?access_token=' . $_SESSION['accesstoken'] . '&method=delete');
		// var_dump($result);
		include('./view/homepage.html');
		$_SESSION = array();
		session_destroy();
		break;
		
}
?>