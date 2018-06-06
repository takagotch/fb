<?php

require './facebook-php-sdk/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => 'APP ID',
  'secret' => 'APP SECRET',
));

$user = $facebook->getUser();

if($user){
  try{
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e){
    error_log($e);
    $user = null;
  }
}

if($user){
  $params = array( 'next' => 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'] );
  $logoutUrl = $facebook->getLogoutUrl($params);

  $facebook->destorySession();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

echo <<<_HEADER_
<html>
  <head>
    <meta content='text/html; charset=utf-8' http-equiv='content-type'>
  </head>
  <h1></h1>
  <p></p>
  <ul>
    <li>login,logout</li>
    <li>info</li>
    <li>friend lists</li>
  </ul>
_HEADER_;

echo '<hr />'."\n";
if($user){
  echo '<a href="'. $logoutUrl .'>LOGOUT</a>'."\n";
} else {
  echo '<div<a href="'.$loginUrl .'">LOGIN</a></div>'."\n";
}

echo '<hr />'."\n";


if($user){
  echo ''."";
  echo ''.$user .''."";

  echo ''."";
  echo ''."";
  echo ''."";
  echo ''."";

  echo '';
  echo '';
} else {
  echo '';
}

echo<<<_FOOTER_
</body>
</html>
__FOOTER_;



