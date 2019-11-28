<?php session_start();  ?>

<?php 
$scope='';
$oauth_url    = 'https://www.facebook.com/dialog/oauth/?client_id=251675014923969&display=page&redirect_uri=&redirect_uri='.urlencode('http://www.facebook.com/pages/Techteer-Systems/110140812367981?sk=app_251675014923969').'&scope='.$scope;

?>
<html xmlns="http://www.w3.org/1999/xhtml" style="overflow: hidden">
<head>
<script type="text/javascript">
// Setup fan page tab to autoresize with most browsers
window.fbAsyncInit = function() {
    FB.Canvas.setAutoResize();
};


 
  
</script>
<style>
body {background-color:#FFFF66;font-family:Arial, Helvetica, sans-serif;}
</style>
</head>
<body >
<?php
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
  

  
    
	
    <pre><?php 
	
	//print_r($_SESSION); 
	
	?></pre>


	
	<?php
if($page_id) {

if($like_status==1) {
	 
  if ($uservalue): 
 //echo $logoutUrl; 
     else: 
      
       //echo $loginUrl;
	   
	   
        $redirect  = '<style type="text/css">span{font-family:"lucida grande",tahoma,verdana,arial,sans-serif; font-size:11px; color:#333333} a{color:#3b5998; outline-style:none; text-decoration:none; font-weight:bold} a:hover{text-decoration:underline}</style>';
		$redirect .= '<script type="text/javascript"> function lagMessage(){document.getElementById("message").innerHTML="Waiting for authorization&hellip; <a href=\"'.$oauth_url.'\" target=\"_top\">retry</a>"}';
		$redirect .= 'top.location.href="'.$oauth_url.'"; document.write("<span id=\"message\"></span>"); setTimeout("lagMessage()",2000); </script>';
		exit($redirect);
	    ?>
        
       
      </div>
    <?php endif ?>
        
        <?php
		
	echo "<img width=\"800\" border=0 src=\"http://hollistercarwash.com/wp-content/themes/twentyeleven/images/banner9.jpg\"><br/><h3>Bring this QR Code Coupon at our center ...REDEEM and obtain discount!</h3>";
$db = new DB($base, $server, $user, $pass);
$name='';
$email='';
$contact='';
$user_id=$_SESSION['fb_251675014923969_user_id'];
//echo $user_id;
$count = $db->countOf("codes", "fbusername='" . $user_id . "'");
if($count ==0) {
$db->execute("Insert into codes(name,email,contact,fbusername,created) values ('". $name . "','". $email . "','". $contact ."','". $user_id ."',NOW())" , false);
}

$id = $db->queryUniqueValue("SELECT id FROM codes WHERE fbusername='" . $user_id . "'");


?>

 <center>
 <table border="0">
 <tr>
 <td valign="top">
    <img src="http://chart.apis.google.com/chart?cht=qr&chl=http://hollistercarwash.com/qdiscount/index.php?id=<?php echo $id; ?>%26coupon=FAC&chs=220x220"
alt="Redeem" />
</td><td valign="middle"> 
<h3 align="left">You may do any of the following</h3></center>
<ul>
<li>Take print out of this coupon </li>
<li>Take photograph of this coupon</li>
<li>Show this page on your mobile</li>
</ul>
   </td>
   </tr>
   </table>
	
<?php 
}

//}
else {
echo "<h3 style='color:red' align='center'> Like Us to get a free discount code!</h3>";
echo "<center><img src='like.jpg'></center>";
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
