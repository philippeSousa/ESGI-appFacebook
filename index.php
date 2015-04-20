<?php error_reporting(E_ALL);
  ini_set("display_errors", 1);
  require 'vendor/autoload.php';
  session_start();
  print_r("ddddddddddddddd")
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

?>


<?php

if(!isset($_REQUEST['uc']))
{$uc = 'accueil';}
else
{$uc = $_REQUEST['uc'];}

switch($uc)
{
	case 'accueil':
	{ 
    print_r("dans laccueil");
		include('vues/v_accueil.php');
		break;
	}
	case 'album':
	{
   // include("controleurs/c_gestion.php");
		include("vues/v_selectAlbum.php");
		break;
	}
	
}
?>