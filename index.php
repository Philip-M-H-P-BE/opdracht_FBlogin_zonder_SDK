<?php
session_start();

/* waarde opslaan in $action, indien nodig standaardwaarde toekennen */
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
		include('./view/na_inloggen.php');
		break;
	case 'logout':
		header('Location: ./model/revoke_granted_permissions.php');
		break;
	case 'permissies_intrekken_geslaagd':
		include('./view/homepage.html');
		break;		
}
/* eindversie */
?>