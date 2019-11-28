<?php session_start(); 
error_reporting(0); 
if($_SESSION["isLoggedIn"]!=1) {
header("Location: login.php");
}
include("config.php");
include("db.class.php");
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Qdiscount</title>
  
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css"/> 
    
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script> 
        <script type="text/javascript" src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script> 
        
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />

</head>
<body> 

<div data-role="page">
 <div data-role="header" >
        <h1>Process</h1>
        <a href="logout.php" data-icon="gear" class="ui-btn-right">Logout</a>
   
    </div><!-- /header -->
    
    <div data-role="content" >
<?php

$id= $_POST["id"];
$name= $_POST["name"];
$email= $_POST["email"];
$contact= $_POST["contact"];
$discountcoupon= $_POST["discountcoupon"];


// Open the base (construct the object):
$db = new DB($base, $server, $user, $pass);
if(strlen($id)>0) {



$count = $db->countOf("codes", "id='" . $id . "'");
if($count>0) {
$db->execute("UPDATE codes SET name='". $name . "', email='". $email . "',contact='". $contact ."' where id=" . $id, false);
$db->execute("INSERT into redeemed(codeid,couponcode,redeemdate) values('" . $id . "','" . $discountcoupon . "',NOW())",false);
echo "<a href=\"redeemlist.php\" id=\"btnRedemmedSuccessfully\" data-role=\"button\">REDEEMED SUCCESSFULLY</a>";

}

}
else {
$count = $db->countOf("codes", "email='" . $email . "'");

if($count >0) {
$db->execute("UPDATE codes SET name='". $name . "', email='". $email . "',contact='". $contact ."' where email='" . $email . "'", false);
$db->execute("INSERT into redeemed(codeid,couponcode,redeemdate) values('" . $id . "','" . $discountcoupon . "',NOW())",false);
echo "<a href=\"redeemlist.php\" id=\"btnRedemmedSuccessfully\" data-role=\"button\">REDEEMED SUCCESSFULLY</a>";
}
else {
$db->execute("Insert into codes(name,email,contact,created) values ('". $name . "','". $email . "','". $contact ."',NOW())" , false);
$lastId = $db->lastInsertedId();
$db->execute("INSERT into redeemed(codeid,couponcode,redeemdate) values('" . $lastId . "','" . $discountcoupon . "',NOW())",false);
echo "<a href=\"redeemlist.php\" id=\"btnRedemmedSuccessfully\" data-role=\"button\">REDEEMED SUCCESSFULLY</a>";
}

}

/*
if($_POST["username"]=="admin" && $_POST["password"]=="admin") {

	echo "<script>document.location.href=\"index.php\";</script>";
}
else {
	echo "<script>document.location.href=\"login.php?error=invalid login\";</script>";
}

*/

?>

    </div><!-- /content -->



<div data-role="footer" data-position="fixed">
    <div data-role="navbar">
        <ul>
            <li><a href="index.php" data-icon="grid" data-iconpos="top" class="ui-btn-active  ui-state-persist">Process</a></li>
            <li><a href="history.php" data-icon="star"  data-iconpos="top">List</a></li>
            <li><a href="about.php" data-icon="gear" data-iconpos="top">About</a></li>
        </ul>
    </div><!-- /navbar -->
    
    <h4>Copyright &copy; 2013</h4>
</div>

</div><!-- /page -->

</body>
</html>