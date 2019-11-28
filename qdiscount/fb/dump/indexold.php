<?php session_start();  ?>
<script>
  var oauth_url = 'https://www.facebook.com/dialog/oauth/';
  oauth_url += '?client_id=251675014923969';
  oauth_url += '&redirect_uri=' + encodeURIComponent('https://www.facebook.com/pages/null/110140812367981/251675014923969');
  oauth_url += ''

 // window.top.location = oauth_url;
</script>

<html xmlns="http://www.w3.org/1999/xhtml" style="overflow: hidden">
<head>
<script type="text/javascript">
// Setup fan page tab to autoresize with most browsers
window.fbAsyncInit = function() {
    FB.Canvas.setAutoResize();
};


 
  
</script><?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require 'src/facebook.php';
include("config.php");
include("../config.php");
include("../db.class.php");
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => $app_id,
  'secret' =>  $app_secret,
));

// Get User ID
$uservalue = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($uservalue) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $uservalue = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($uservalue) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}





$signed_request = $_REQUEST["signed_request"];
list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
$pinfo = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

$canvas_page="https://apps.facebook.com/251675014923969/";
		

// Save Facebook Variable returned from connection

$page_id = $pinfo["page"]["id"];
$page_admin = $pinfo["page"]["admin"];
$like_status = $pinfo["page"]["liked"];


// grab current page info from Facebook
if ($pinfo["page"]["id"]) {
	$path = "/".$pinfo["page"]["id"];
	$current_page = $facebook->api($path,'GET');
}


?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title></title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <h1>Scan QR code and Get Discount</h1>

  
  <?php if ($uservalue): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>

  
    <h3>PHP Session</h3>
	
    <pre><?php print_r($_SESSION); 
	
	?></pre>


	
	<?php
if($page_id) {

if($like_status==1) {
$db = new DB($base, $server, $user, $pass);
$name='';
$email='';
$contact='';
$user_id=$_SESSION['fb_251675014923969_user_id'];
//echo $user_id;
$count = $db->countOf("codes", "fbusername='" . $user_id . "'");
//if($count >0) {
//$db->execute("Insert into codes(name,email,contact,fbusername,created) values ('". $name . "','". $email . "','". $contact ."','". $user_id ."',NOW())" , false);
?>
 <center>
    <img src="http://chart.apis.google.com/chart?cht=qr&chl=http://apps.brandlocato.com/qdiscount/index.php?id=1&coupon=FAC&chs=120x120"
alt="Redeem" />
    </center>
	
<?php 
}

//}
else {
echo "<img src='likeme.jpg'> ";
}
	//like_status
	//echo $page_id;
	//echo "<br/>" . $like_status;
	}
	?>
	
<div id="wrapper">
	
	
	

</div><!-- /wrapper -->




  </body>
</html>
