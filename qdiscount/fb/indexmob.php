<?php session_start();
 ?>
 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"> </script>
   
<script>

$scope='';
$oauth_url    = 'https://www.facebook.com/dialog/oauth/?client_id=251675014923969&display=page&redirect_uri=&redirect_uri='.urlencode('http://www.facebook.com/pages/Techteer-Systems/110140812367981?sk=app_251675014923969').'&scope='.$scope;


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
//echo $uservalue;
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
 $logoutUrl1=$facebook->getLogoutUrl();
//$logoutUrl1 =$facebook->getLogoutUrl($params);
$logoutUrl="logout.php";
} else {
  $loginUrl = $facebook->getLoginUrl();
}





$signed_request = $_REQUEST["signed_request"];
list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
$pinfo = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

$canvas_page="https://apps.facebook.com/662832347109594/";
		

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
      <style type="text/css">
#content { 
display: none;
padding: 20px 0 0 0;
}
</style>     
<style>
body {background-color:#fcfcfc;font-family:Arial, Helvetica, sans-serif;}
</style>
  </head>
  <body><div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=662832347109594";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>




      <script>
      window.fbAsyncInit = function() {
        FB.init({appId: '662832347109594', status: true, cookie: true,
                 xfbml: true});
				 window.fbAsyncInit = function() {
FB.Canvas.setAutoResize();
}


				 
		
FB.Event.subscribe('edge.create', function(href, widget) {
jQuery('#content').show();
jQuery('#likegate').hide();
      });
      FB.Event.subscribe('edge.remove', function(href, widget) {
jQuery('#content').hide();
jQuery('#likegate').show();
      });
  };
      (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
       e.async = true;
        document.getElementById('fb-root').appendChild(e);
        
      }());
    </script>
    
<center>
<?php
    	echo "<img width=\"400\" height=\"400\" border=0 src=\"http://saverscarwash.com/wp-content/uploads/2013/08/banner3.jpg\"><br/><h3>Bring this QR Code Coupon at our center ...<br/>REDEEM and obtain discount!</h3>";
?>

  
  <?php if ($uservalue): ?>
 
   <a href="<?php echo $logoutUrl1; ?>">Logout</a>
    <?php else: ?>
      <div>
        <a href="<?php echo $loginUrl; ?>"><img src="facebook.png"><br/> to get Discount Coupon</a>
      </div>
    <?php endif ?>

  
	
    <pre><?php //print_r($_SESSION); 
	
	?></pre>


	
	<?php

if($uservalue) {
$db = new DB($base, $server, $user, $pass);
$name='';
$email='';
$contact='';
$user_id=$_SESSION['fb_662832347109594_user_id'];
//echo $user_id;
//$count = $db->countOf("codes", "fbusername='" . $user_id . "'");
//if($count >0) {
//$db->execute("Insert into codes(name,email,contact,fbusername,created) values ('". $name . "','". $email . "','". $contact ."','". $user_id ."',NOW())" , false);




$count = $db->countOf("codes", "fbusername='" . $user_id . "'");
if($count ==0) {
$db->execute("Insert into codes(name,email,contact,fbusername,created) values ('". $name . "','". $email . "','". $contact ."','". $user_id ."',NOW())" , false);
}

$id = $db->queryUniqueValue("SELECT id FROM codes WHERE fbusername='" . $user_id . "'");

//echo $id . "" . $user_id;
?>
 <div id="likegate">
<h2> You must like this page & post to facebook</h2>
<h6>If the like button is disabled and you cannot see the QR code then you must unlike and then again relike by clicking on the button</h6>
 </div>
  <div id="content">
 <table border="0">
 <tr>
 <td valign="top">
    <img src="http://chart.apis.google.com/chart?cht=qr&chl=http://saverscarwash.com/qdiscount/index.php?id=<?php echo $id; ?>%26coupon=FAC&chs=220x220"
alt="Redeem" />
</td><td valign="middle"> 
<h3 align="left">You may do any of the following</h3>
<ul>
<li>Take print out of this coupon </li>
<li>Take photograph of this coupon</li>
<li>Show this page on your mobile</li>
</ul>
   </td>
   </tr>
   </table>
   </div>
	
<?php 
}

//}
else {
//echo "<img src='likeme.jpg'> ";
}
	
	?>
	<br/>
	
	<div class="fb-like" data-href="https://www.facebook.com/pages/Savers-Carwash/559200420820055" data-send="true" data-width="450" data-show-faces="true"></div>
<div id="wrapper">
	
	
	

</div><!-- /wrapper -->


 </center>

  </body>
</html>
