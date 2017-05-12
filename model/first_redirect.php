<?php
    $receivedFacebookCode = $_GET['code'];

    function getAccessToken($RFC) {
        $url = 'https://graph.facebook.com/v2.9/oauth/access_token';
        $data = ["client_id" => '829609807188888',
                 "redirect_uri" => 'http://opdr.local/opdracht/model/first_redirect.php',
                 "client_secret" => '2d6a2697beaa93b262e58dbc5c379891',
				 "fields" => "all",
                 "code" => $RFC];
        $getAddress = $url . '?' . http_build_query($data);
        $response = file_get_contents($getAddress);
		return $response;         
	}	

	$ontvangenJSON = getAccessToken($receivedFacebookCode);	
	$eindResultaat = json_decode($ontvangenJSON);
	$accessToken = $eindResultaat->access_token;	

    function getUserInfo($accessToken) {
         $graph_url = 'https://graph.facebook.com/me';
		 $data = ["access_token" => $accessToken];
		 $requiredAddress = $graph_url . '?' . http_build_query($data);
		 $user = file_get_contents($requiredAddress);
		 if($user != null) {
              return $user;
         }
         echo "mislukt!!!";
    }
	
	// gegevens ophalen met behulp van access token
    $user = getUserInfo($accessToken);
	header("Location: ../index.php?action=show_name_and_pic&gebruikersinfo=$user");

	
	
	
	

?>