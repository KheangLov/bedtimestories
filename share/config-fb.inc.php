<?php
  // session_start();
  require_once('assets/libraries/Facebook/autoload.php');
  $FBObject = new \Facebook\Facebook([
    'app_id' => '373794453282051',
    'app_secret' => '2ab955faa493496926f4a10467a61106',
    'default_graph_version' => 'v3.2'
  ]);
  $handler = $FBObject->getRedirectLoginHelper();
?>