<!DOCTYPE html>

  <?php
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
            echo "<a href='selectAlbum.php'> Je veux participer au concours en uploadant une photo !</a>";
        } else {
            echo "<a href='" . $loginUrl . "'>Se connecter pour have fun with us !!!!</a>";
        }
        ?>
<form method="post">
  
</form>


</body>
</html>

