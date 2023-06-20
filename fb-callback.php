<?php

require_once 'vendor/autoload.php'; // Path to autoload.php from Facebook PHP SDK

$fb = new \Facebook\Facebook([
  'app_id' => 'YOUR_APP_ID',
  'app_secret' => 'YOUR_APP_SECRET',
  'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
  $response = $fb->get('/me?fields=id,name,email', $accessToken);
  $user = $response->getGraphUser();

  $userId = $user->getId();
  $userName = $user->getName();
  $userEmail = $user->getEmail();

  echo 'User ID: ' . $userId . '<br>';
  echo 'User Name: ' . $userName . '<br>';
  echo 'User Email: ' . $userEmail . '<br>';
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

?>
