
<?php
// https://developer.facebook.com/apps

require_once './sdk/src/facebook.php';

$facebook = new Facebook(array(
  'appId' => '****',
  'secret' => '****',
  'cookie' => true,
));

$user = $facebook->getUser();
$me = null;
$friends = null;
if($user){
  try{
    $uid = $facebook->getUser();
    $me = $facebook->api('/me');
    $friends = $facebook->api('/me/friends');
  }
  catch(FacebookApiException $err){
    error_log($err);
  }
}

if($me){
  $logoutUrl = $facebook->getLogoutUrl();
}else{
  $loginUrl = $facebook->getLoginUrl();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"!>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja" xmlns:fb="http://www.facebook.com/2008/fbml" >
<head>
<meta http-equiv="Content-Type" content="text/html; cjarset=UTF-8">
<meta http-equiv="Content-Type" content="text/html">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Script-Type" content="text/css">
<title></title>
</head>
<body>
</body>

<h1>Hello</h1>

<?php

if($me){
  echo 'Hello'.$me['name'];
  echo '<br/>';
  echo '[ <a href="'.$logoutUrl.'">Logout</a>]';
  echo '<br/>';
  print_r($me);
}else{
  echo 'Not login yet';
  echo '<br/>';
  echo '[ <a href="'.$loginUrl.'">Login</a>]';
}

?>

</head>
<html>



