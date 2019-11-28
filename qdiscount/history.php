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
        <h1>Like List</h1>
        <a href="logout.php" data-icon="gear" class="ui-btn-right">Logout</a>
   
    </div><!-- /header -->

    <div data-role="content" >
	  <p>
		<div align="center" style="width:300px;" id="save">
		 <a href="redeemlist.php" id="btnSave" data-role="button">Redeem List</a>
</div>
		
		</p>
       <ul data-role="listview" data-inset="true">
	   <?
	   
	   $result = $db->query("select date(created) as date, count(*) as count from codes group by Date(created) order by created desc");
while ($line = $db->fetchNextObject($result)) {

?>
 <li>
        <a href="#">
           <!--  <img src="images/icon1.png" alt="icon1" class="ui-li-icon"> -->
            <?php echo date(  "F j, Y", strtotime($line->date)); ?>
            <span class="ui-li-count"><?php echo $line->count . ' likes'; ?></span>
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
    
    <h4>Copyright &copy; 2013</h4>
</div>

</div><!-- /page -->

</body>
</html>