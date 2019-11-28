<?php
session_start(); 
error_reporting(0); 
if($_SESSION["isLoggedIn"]!=1) {
header("Location: login.php");
}
include("config.php");
include("db.class.php");

// Open the base (construct the object):
$db = new DB($base, $server, $user, $pass);
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
        <h1>Redeem List</h1>
        <a href="logout.php" data-icon="gear" class="ui-btn-right">Logout</a>
   
    </div><!-- /header -->

    <div data-role="content" >
	<p>
	<div align="center" style="width:300px;" id="save">
		 <a href="history.php" id="btnSave" data-role="button">Like List</a>
</div></p>

       <ul data-role="listview" data-inset="true">
	   <?
	   
	   $result = $db->query("select a.id,b.redeemdate,b.couponcode,b.discount,a.name,a.email,a.contact,a.fbusername from  codes a, redeemed b where a.id=b.codeid order by b.redeemdate");
while ($line = $db->fetchNextObject($result)) {

?>
 <li>
        <a target="_blank" href="<?php echo "http://www.facebook.com/" .   $line->fbusername; ?>">
		
		<h3 class="ui-li-heading"><?php echo $line->name; ?></h3>
		<p class="ui-li-desc">
		<?php echo $line->email . ' ' .  $line->contact . ' ' .  $line->couponcode; ?></p>
           <!--  <img src="images/icon1.png" alt="icon1" class="ui-li-icon"> -->
        </p>
            <span class="ui-li-count"><?php echo   date(  "F j, Y", strtotime($line->redeemdate)); ?></span>
        </a>
    </li>

<?php 
}
?>


   
</ul>
	
    </div><!-- /content -->



<div data-role="footer" data-position="fixed">
    <div data-role="navbar">
        <ul>
            <li><a href="index.php" data-icon="grid" data-iconpos="top" >Process</a></li>
            <li><a href="history.php" data-icon="star"  data-iconpos="top" class="ui-btn-active  ui-state-persist">List</a></li>
            <li><a href="about.php" data-icon="gear" data-iconpos="top">About</a></li>
        </ul>
    </div><!-- /navbar -->
    
    <h4>Copyright &copy; 2012</h4>
</div>

</div><!-- /page -->

</body>
</html>