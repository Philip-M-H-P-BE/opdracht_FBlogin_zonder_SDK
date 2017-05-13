<?php
	session_start();
	
	
	/* CODEBLOK I : ontvangen "Authorization Code" ophalen en in variabele opslaan */
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
	    $receivedFacebookCode = $_GET['code'];
	}
	
	
	/* CODEBLOK II : 
		II-a : een functie definiëren die we zullen aanroepen om
		       een "Access Token" op te halen
		II-b : de "Authorization Code" als argument meegeven bij het aanroepen van
	           deze functie
	*/
	// II-a declaratie
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
	// II-b aanroep
	$ontvangenJSON = getAccessToken($receivedFacebookCode);	
	$eindResultaat = json_decode($ontvangenJSON);	
	$_SESSION['accesstoken'] = $eindResultaat->access_token;
	
	
	/* CODEBLOK III :
		III-a : een functie definiëren die de gegevens van de ingelogde
		        websitebezoeker ophaalt met behulp van het "Access Token"
		III-b : deze functie aanroepen, het "Access Token" wordt als
		        argument meegegeven; na ontvangst van de gegevens van de
				websitebezoeker beschouwen we deze laatste als volledig 
				ingelogd
	*/
	// III-a declaratie
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
	// III-b aanroep
    $_SESSION['userinfo'] = getUserInfo($_SESSION['accesstoken']);
	if (isset($_SESSION['userinfo'])) {
		$_SESSION['bezitter_gegevens_ingelogd'] = true;
	}
	header('Location: ../index.php?action=show_name_and_pic');

	
	
	
	

?>