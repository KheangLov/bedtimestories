<?php
  include "share/db-conn.inc.php";
  include "share/constant.inc.php";
  session_start();
  include "assets/libraries/facebook-php-graph-sdk/autoload.php";

  use Facebook\Facebook;
  use Facebook\Exceptions\FacebookResponseException;
  use Facebook\Exceptions\FacebookSDKException;

  $fb = new Facebook(array(
    'app_id' => FB_APP_ID,
    'app_secret' => FB_APP_SECRET,
    'default_graph_version' => 'v3.2'
  ));

  $helper = $fb->getRedirectLoginHelper();

  try {
    if(isset($_SESSION['facebook_access_token'])) {
      $accessToken = $_SESSION['facebook_access_token'];
    } else {
      $accessToken = $helper->getAccessToken();
    }
  } catch(FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  function checkUser($userData = array()){
    if(!empty($userData)){
        // Check whether user data already exists in database
        $prevQuery = "SELECT * FROM thirdparty_users WHERE oauth_provider = '" . $userData['oauth_provider'] . "' AND oauth_uid = '" .$userData['oauth_uid'] . "'";
        $prevResult = mysqli_query($conn, $prevQuery);
        if($prevResult->num_rows > 0){
            // Update user data if already exists
            $query = "UPDATE thirdparty_users SET firstname = '" . $userData['first_name'] . "', lastname = '" . $userData['last_name']."', email = '" . $userData['email'] . "', gender = '" . $userData['gender'] . "', picture = '" . $userData['picture'] . "', link = '" . $userData['link'] . "', modified = NOW() WHERE oauth_provider = '" . $userData['oauth_provider'] . "' AND oauth_uid = '" . $userData['oauth_uid'] . "'";
            $update = $conn->query($query);
        }
        // }else{
        //     // Insert user data
        //     $query = "INSERT INTO thirdparty_users SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', picture = '".$userData['picture']."', link = '".$userData['link']."', created = NOW(), modified = NOW()";
        //     $insert = $conn->query($query);
        // }
        
        // Get user data from the database
        $result = mysqli_query($conn, $prevQuery);
        $userData = $result->fetch_assoc();
    }
    
    // Return user data
    return $userData;
  }

  if(isset($accessToken)) {
    if(isset($_SESSION['facebook_access_token'])) {
      $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
      $_SESSION['facebook_access_token'] = (string) $accessToken;
      $oAuth2Client = $fb->getOAuth2Client();
      $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
      $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
      $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }

    if(isset($_GET['code'])) {
      header("Location: ./");
    }

    try {
      $graphResponse = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,picture');
      $fbUser = $graphResponse->getGraphUser();
    } catch(FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      session_destroy();
      header('Location: ./');
      exit;
    } catch(FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    $fbUserData = array();
    $fbUserData['oauth_uid'] = !empty($fbUser['id']) ? $fbUser['id'] : '';
    $fbUserData['firstname'] = !empty($fbUser['firstname']) ? $fbUser['firstname'] : '';
    $fbUserData['lastname'] = !empty($fbUser['lastname']) ? $fbUser['lastname'] : '';
    $fbUserData['email'] = !empty($fbUser['email']) ? $fbUser['email'] : '';
    $fbUserData['gender'] = !empty($fbUser['gender']) ? $fbUser['gender'] : '';
    $fbUserData['image'] = !empty($fbUser['image']) ? $fbUser['image'] : '';
    $fbUserData['link'] = !empty($fbUser['link']) ? $fbUser['link'] : '';
    $fbUserData['oauth_probider'] = 'facebook';

    $userData = checkUser($fbUserData);
    $_SESSION['userData'] = $userData;
    $_SESSION['isLogin'] = true;
    $_SESSION['success_mess'] = true;
    header("Location: admin/index.php");

    $logoutURL = $helper->getLogoutUrl($accessToken, FB_REDIRECT_URL . 'logout.php');
  } else {
    $permission = ['email'];
    $loginURL = $helper->getLoginUrl(FB_REDIRECT_URL, $permission);
  }
?>