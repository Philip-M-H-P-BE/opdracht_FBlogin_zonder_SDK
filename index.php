<?php
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
		header('Location: https://www.facebook.com/v2.9/dialog/oauth?client_id=829609807188888&redirect_uri=http://opdr.local/opdracht/model/first_redirect.php&scope=public_profile');
		break;
	case 'show_name_and_pic':
		$info = $_GET['gebruikersinfo'];
		include('./view/na_inloggen.php');
		break;
	case 'logout':
		// nog af te werken
		include('./view/homepage.html');
		break;
}
?>