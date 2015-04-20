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
  <h2>Upload d'une ptin d'img</h2>
<form method="post" action="receptionImg.php" enctype="multipart/form-data">
  <input type="file" name="icone" id="icone" /><br />
  </form>