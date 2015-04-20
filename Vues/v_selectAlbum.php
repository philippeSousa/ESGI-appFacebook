<?php	
	$helper = new FacebookRedirectLoginHelper($redirectLoginUrl);
	
		if ( isset($_SESSION) && isset($_SESSION['fb_token']) ) {
			$session = new FacebookSession($_SESSION['fb_token']);
		} else {
			$session = $helper->getSessionFromRedirect();
		}
		
	$user = null;
	$loginUrl = null;
	$graphObject = null;
	$albums = null;
	
	if ( isset($session) ) 
	{		 
		/* Init la connection et get le USER */
		$token = (string) $session->getAccessToken();
		$_SESSION['fb_token'] = $token;
		//Prepare
		$request = new FacebookRequest($session, 'GET', '/me');
		//execute
		$response = $request->execute();
		//transform la data graphObject
		$user = $response->getGraphObject("Facebook\GraphUser");
		
		/* Get les albums */
		$requestAlbums = new FacebookRequest($session, 'GET', '/me/albums');
		//execute
		$responseAlbums = $requestAlbums->execute();
		/* On convertit l'objet retourné en tableau et on recup les données */
		$albums = json_decode($responseAlbums->getRawResponse(), true);
		
	} else {
		/* S'il est pas connecté, il a pas accès à la page d'upload, on le redirige vers l'accueil */
        header('Location: index.php');    
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Epic pic contest !</title>
    <script>
        window.fbAsyncInit = function () {
          FB.init({
            appId: '1468256266797643',
            xfbml: true,
            version: 'v2.3'
          });
        };
        (function (d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) {
            return;
          }
          js = d.createElement(s);
          js.id = id;
          js.src = "//connect.facebook.net/fr_FR/sdk.js";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
  </head>
  <body>
    <h1> <?php echo "Bonjour ".$user->getName(); ?> Choisissez l'album qui contient la photo que vous allez envoyer ! </h1>
    <form method="post" action="selectPhotos.php" >
	    <select name="albumId">
		    <?php
			// see if we have a session
	
		    	foreach ($albums["data"] as $cetAlbum)
		    	{
		    		echo "<option value='".$cetAlbum["id"]."' >".$cetAlbum["name"]." </option>";
		    	}    	
		    	
		    ?>
	    </select>
		<input type='submit' value="GO" />
    </form>
  </body>
</html>