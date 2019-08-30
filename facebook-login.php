<?php
  include "share/db-conn.inc.php";
  include "share/constant.inc.php";
  session_start();
  include "assets/libraries/facebook-php-graph-sdk/autoload.php";

  $fb = new Facebook\Facebook([
    'app_id' => FB_APP_ID,
    'app_secret' => FB_APP_SECRET,
    'default_graph_version' => 'v3.2',
  ]);

  $helper = $fb->getRedirectLoginHelper();

  try {
    $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  if (! isset($accessToken)) {
    if ($helper->getError()) {
      header('HTTP/1.0 401 Unauthorized');
      echo "Error: " . $helper->getError() . "\n";
      echo "Error Code: " . $helper->getErrorCode() . "\n";
      echo "Error Reason: " . $helper->getErrorReason() . "\n";
      echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
      header('HTTP/1.0 400 Bad Request');
      echo 'Bad request';
    }
    exit;
  }

  // Logged in
  echo '<h3>Access Token</h3>';
  var_dump($accessToken->getValue());

  // The OAuth 2.0 client handler helps us manage access tokens
  $oAuth2Client = $fb->getOAuth2Client();

  // Get the access token metadata from /debug_token
  $tokenMetadata = $oAuth2Client->debugToken($accessToken);
  echo '<h3>Metadata</h3>';
  var_dump($tokenMetadata);

  // Validation (these will throw FacebookSDKException's when they fail)
  $tokenMetadata->validateAppId('{app-id}'); // Replace {app-id} with your app id
  // If you know the user ID this access token belongs to, you can validate it here
  //$tokenMetadata->validateUserId('123');
  $tokenMetadata->validateExpiration();

  if (! $accessToken->isLongLived()) {
    // Exchanges a short-lived access token for a long-lived one
    try {
      $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
      echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
      exit;
    }

    echo '<h3>Long-lived</h3>';
    var_dump($accessToken->getValue());
  }

  $_SESSION['fb_access_token'] = (string) $accessToken;

  // User is logged in with a long-lived access token.
  // You can redirect them to a members-only page.
  header('Location: admin/index.php');

  // use Facebook\Facebook;
  // use Facebook\Exceptions\FacebookResponseException;
  // use Facebook\Exceptions\FacebookSDKException;
  // use Facebook\FacebookSession;
  // use Facebook\FacebookRedirectLoginHelper;
  // use Facebook\FacebookRequest;
  // use Facebook\FacebookResponse;
  // use Facebook\FacebookSDKException;
  // use Facebook\FacebookRequestException;
  // use Facebook\FacebookAuthorizationException;
  // use Facebook\GraphObject;
  // use Facebook\Entities\AccessToken;
  // use Facebook\HttpClients\FacebookCurlHttpClient;
  // use Facebook\HttpClients\FacebookHttpable;

  // $fb = new Facebook(array(
  //   'app_id' => FB_APP_ID,
  //   'app_secret' => FB_APP_SECRET,
  //   'default_graph_version' => 'v3.2'
  // ));

  // FacebookSession::setDefaultApplication( '373794453282051','2ab955faa493496926f4a10467a61106' );
  // $helper = new FacebookRedirectLoginHelper('http://bedtimestories.devs/');
  // try {
  //   $session = $helper->getSessionFromRedirect();
  // } catch( FacebookRequestException $ex ) {
  //   // When Facebook returns an error
  // } catch( Exception $ex ) {
  //   // When validation fails or other local issues
  // }
 
  // see if we have a session
  // if ( isset( $session ) ) {
  //   // graph api request for user data
  //   $request = new FacebookRequest( $session, 'GET', '/me' );
  //   $response = $request->execute();
    
  //   // get response
  //   $graphObject = $response->getGraphObject();
  //   $fbid = $graphObject->getProperty('id');           // To Get Facebook ID
  //   $fbfullname = $graphObject->getProperty('name');   // To Get Facebook full name
  //   $femail = $graphObject->getProperty('email');      // To Get Facebook email ID
    
  //   /* ---- Session Variables -----*/
  //   $_SESSION['FBID'] = $fbid;
  //   $_SESSION['FULLNAME'] = $fbfullname;
  //   $_SESSION['EMAIL'] =  $femail;
    
  //   /* ---- header location after session ----*/
  //   header("Location: admin/index.php");
  // }else {
  //   $loginUrl = $helper->getLoginUrl();
  //   header("Location: ".$loginUrl);
  // }

  // $helper = $fb->getRedirectLoginHelper();

  // try {
  //   if(isset($_SESSION['facebook_access_token'])) {
  //     $accessToken = $_SESSION['facebook_access_token'];
  //   } else {
  //     $accessToken = $helper->getAccessToken();
  //   }
  // } catch(FacebookResponseException $e) {
  //   echo 'Graph returned an error: ' . $e->getMessage();
  //   exit;
  // } catch(FacebookSDKException $e) {
  //   echo 'Facebook SDK returned an error: ' . $e->getMessage();
  //   exit;
  // }

  // function checkUser($userData = array()){
  //   if(!empty($userData)){
  //     // Check whether user data already exists in database
  //     $prevQuery = "SELECT * FROM thirdparty_users WHERE oauth_provider = '" . $userData['oauth_provider'] . "' AND oauth_uid = '" .$userData['oauth_uid'] . "'";
  //     $prevResult = mysqli_query($conn, $prevQuery);
  //     if($prevResult->num_rows > 0){
  //       // Update user data if already exists
  //       $query = "UPDATE thirdparty_users SET 
  //         firstname = '" . $userData['first_name'] . "', 
  //         lastname = '" . $userData['last_name']."', 
  //         email = '" . $userData['email'] . "', 
  //         gender = '" . $userData['gender'] . "', 
  //         picture = '" . $userData['picture'] . "', 
  //         link = '" . $userData['link'] . "', 
  //         modified = NOW() 
  //         WHERE oauth_provider = '" . $userData['oauth_provider'] . "' 
  //         AND oauth_uid = '" . $userData['oauth_uid'] . "'";
  //       $update = $conn->query($query);
  //     } else {
  //         // Insert user data
  //         $query = "INSERT INTO thirdparty_users SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', picture = '".$userData['picture']."', link = '".$userData['link']."', created = NOW(), modified = NOW()";
  //         $insert = $conn->query($query);
  //     }
      
  //     // Get user data from the database
  //     $result = mysqli_query($conn, $prevQuery);
  //     $userData = $result->fetch_assoc();
  //   }
    
  //   // Return user data
  //   return $userData;
  // }

  // if(isset($accessToken)) {
  //   if(isset($_SESSION['facebook_access_token'])) {
  //     $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  //   } else {
  //     $_SESSION['facebook_access_token'] = (string) $accessToken;
  //     $oAuth2Client = $fb->getOAuth2Client();
  //     $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
  //     $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
  //     $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  //   }

  //   if(isset($_GET['code'])) {
  //     header("Location: ./");
  //   }

  //   try {
  //     $graphResponse = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,picture');
  //     $fbUser = $graphResponse->getGraphUser();
  //   } catch(FacebookResponseException $e) {
  //     echo 'Graph returned an error: ' . $e->getMessage();
  //     session_destroy();
  //     header('Location: ./');
  //     exit;
  //   } catch(FacebookSDKException $e) {
  //     echo 'Facebook SDK returned an error: ' . $e->getMessage();
  //     exit;
  //   }

  //   $fbUserData = array();
  //   $fbUserData['oauth_uid'] = !empty($fbUser['id']) ? $fbUser['id'] : '';
  //   $fbUserData['firstname'] = !empty($fbUser['firstname']) ? $fbUser['firstname'] : '';
  //   $fbUserData['lastname'] = !empty($fbUser['lastname']) ? $fbUser['lastname'] : '';
  //   $fbUserData['email'] = !empty($fbUser['email']) ? $fbUser['email'] : '';
  //   $fbUserData['gender'] = !empty($fbUser['gender']) ? $fbUser['gender'] : '';
  //   $fbUserData['image'] = !empty($fbUser['image']) ? $fbUser['image'] : '';
  //   $fbUserData['link'] = !empty($fbUser['link']) ? $fbUser['link'] : '';
  //   $fbUserData['oauth_probider'] = 'facebook';

  //   $userData = checkUser($fbUserData);
  //   $_SESSION['userData'] = $userData;
  //   $_SESSION['isLogin'] = true;
  //   $_SESSION['success_mess'] = true;
  //   header("Location: admin/index.php");

  //   $logoutURL = $helper->getLogoutUrl($accessToken, FB_REDIRECT_URL . 'logout.php');
  // } else {
  //   $permission = ['email'];
  //   $loginURL = $helper->getLoginUrl(FB_REDIRECT_URL, $permission);
  // }
?>