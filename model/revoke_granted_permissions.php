<?php
session_start();

/* gebruik van "POST method" om gevoelige informatie zoals
   het "Access Token" te verzenden
*/
$userInfo = json_decode($_SESSION['userinfo']);
$url = 'https://graph.facebook.com/' . $userInfo->id . '/permissions';
$data = ["access_token" => $_SESSION['accesstoken'], "method" => "delete"];
$context = stream_context_create([
	'http' => [
	              'method' => 'POST',
		          'header' => ['Accept: application/json', 'Content-Type: application/json'],
		          'content' => json_encode($data)
    ]
]);
$result = file_get_contents($url, false, $context);
$result = json_decode($result);

/* indien geslaagd terug naar controller, websitebezoeker niet langer als ingelogd beschouwd */
if($result->success == true) {
	$_SESSION = array();
	session_destroy();
	header('Location: ../index.php?action=permissies_intrekken_geslaagd');
}
?>