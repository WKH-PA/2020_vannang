<?php
// session_start();
// $app_id         = "444808486094343";
// $app_secret     = "8894cbc549eebbd896b8e4992f3c5bc9";
$app_id         = $thongtin['fb_app_id']; // "2841505299407155";
$app_secret     = $thongtin['fb_app_secret']; // "ad73e066e42e507d44ff15125031429c";
$getLoginUrl    = $thongtin['fb_url']; // "https://".$full_url."/?login=fb";

require_once 'Facebook/autoload.php';

$fb = new Facebook\Facebook ([
  'app_id' => $app_id, 
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.2',
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
    $permissions = array('public_profile','email'); // Optional permissions
    $loginUrl = $helper->getLoginUrl($getLoginUrl, $permissions);
    header("Location: ".$loginUrl);  
  exit;
}

try {
  // Returns a `Facebook\FacebookResponse` object
  $fields = array('id', 'name', 'email', 'gender', 'picture');
  $response = $fb->get('/me?fields='.implode(',', $fields).'', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

$hinhanh = json_decode($user['picture'], true);
$hinhanh = $hinhanh['url'];
 

$check_fb = DB_que("SELECT `id`,`email` FROM `#_members` WHERE `id_facebook` = '".$user['id']."' LIMIT 1");
if(!mysql_num_rows($check_fb)) {
  $tentruycap = md5($user['id'].time());
  $email      = $user['email'] != "" ? $user['email'] : $user['id']."@facebook.com";
  

  DB_que("INSERT INTO `#_members`(`tentruycap`, `matkhau`, `hoten`, `email`, `id_facebook`,`google_icon`) VALUES('$tentruycap', '$tentruycap','".$user['name']."','".$email."','".$user['id']."', '$hinhanh')");
  $_SESSION['id']    = mysql_insert_id();
// print_r($user);
// exit();
}
else {
  $email      = $user['email'] != "" ? $user['email'] : $user['id']."@facebook.com";

  DB_que("UPDATE `#_members` SET `hoten` = '".$user['name']."', `email` = '".$email."', `google_icon` = '$hinhanh' WHERE `email` = '".$user['email']."'");
  $_SESSION['id']    = mysql_result($check_fb, 0, "id");

}

header("Location: ".$full_url);  
?>
