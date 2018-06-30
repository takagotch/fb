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
  echo '<h3></h3>'."\n";
  echo '<img src="https://graph.facebook.com/' .$user .'/picture'. "\n";

  echo '<h3>Login info person</h3>'."\n";
  echo '<pre>'."\n";
  echo print_r($user_profile);
  echo '</pre>'."\n";

  echo '<h3>Login friends list</h3>';
  $user_friends_data = $user_friends['data'];
  echo '<h4>frineds Number:'. count($user_frineds_data) . ' person</h4>'. "\n";
  $i=0;
  foreach ($user_frineds_data as $fkey=>fvalue){
    $i++;
    echo '<a href="http://www.facebook.com/profile.php?id='.$fvalue[id].'"><img src="https://graph.facebook.com/' .$fvalue[id] . '/picture" border="0" title=""' .$fvalue[name].'"/></a>';
    if($i % 5 == 0){
      echo '<br><br>';
    }
  }

} else {
  echo '<strong><em>NOT LOGIN</em></strong>'."\n";
}

echo<<<_FOOTER_
</body>
</html>
__FOOTER_;



