<?php error_reporting(E_ALL);
  ini_set("display_errors", 1);
  require 'vendor/autoload.php';
  session_start();

  use Facebook\FacebookSession;
  use Facebook\FacebookRedirectLoginHelper;
  use Facebook\FacebookRequest;
  use Facebook\FacebookResponse;
  use Facebook\FacebookSDKException;
  use Facebook\FacebookRequestException;
  use Facebook\FacebookAuthorizationException;
  use Facebook\GraphObject;
  use Facebook\Entities\AccessToken;
  use Facebook\HttpClients\FacebookCurlHttpClient;
  use Facebook\HttpClients\FacebookHttpable;

const id = "1468256266797643";
const mdp = "5598726dd2d32c30ca7e11b7eeb68016";

FacebookSession::setDefaultApplication(id, mdp);

$redirectLoginUrl = "https://esgifacebook.herokuapp.com/";

 $helper = new FacebookRedirectLoginHelper($redirectLoginUrl);
  
  if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
      $session = new FacebookSession($_SESSION['fb_token']);
  } else {
      $session = $helper->getSessionFromRedirect();
  }
  
  $user = null;
  $loginUrl = null;
  
  if (isset($session)) {
  
      /* Init la connection et get le USER */
      $token = (string) $session->getAccessToken();
      $_SESSION['fb_token'] = $token;
      //Prepare
      $request = new FacebookRequest($session, 'GET', '/me');
      //execute
      $response = $request->execute();
      //transform la data graphObject
      $user = $response->getGraphObject("Facebook\GraphUser");

  } else {
      // show login url with permissions
      $loginUrl = $helper->getLoginUrl(['user_photos']);
  }


?>
<!DOCTYPE html>
<H2>localhost</H2>
<html>
    <head>
        <title> Localhost !</title>
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
        <h1> Epic pic contest, concours quotidien de winnage des meilleures photos du jour ! Comment ca marche? postez une photo EPIC ! </h1>
        <div
            class="fb-like"
            data-share="true"
            data-width="450"
            data-show-faces="true">
        </div>
        <?php
        if (isset($session)) {
            echo "Bonjour " . $user->getName();
            echo "<a href='Vues/selectAlbum.php'> Je veux participer au concours en uploadant une photo !</a>";
        } else {
            echo "<a href='" . $loginUrl . "'>Se connecter pour have fun with us !!!!</a>";
        }
        ?>


</body>
</html>
