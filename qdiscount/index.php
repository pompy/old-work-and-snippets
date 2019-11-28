<?php session_start(); 
error_reporting(0);  
if($_SESSION["isLoggedIn"]!=1) {
$id=$_GET["id"];
$coupon=$_GET["coupon"];
header("Location: login.php?id=".$id."&coupon=" . $coupon);
}
?>
<?php

include("config.php");
include("db.class.php");
$id= $_GET["id"];
$coupon= $_GET["coupon"];
if(strlen($id)>0) {
$db = new DB($base, $server, $user, $pass);
$result = $db->query("select id,name,email,contact,fbusername from  codes where id=". $id);
while ($line = $db->fetchNextObject($result)) {
$id=$line->id ;
$name=$line->name ;
$email=$line->email;
$contact=$line->contact;
$fbusername=$line->fbusername;
}
}
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
      <form id="theForm" name="theForm" action="index-submit.php" method="post">
            <div data-role="fieldcontain">
                <label for="name">Name :</label>
                <input type="text" name="name" id="name" value="<?php echo $name; ?>"  />
            </div>
            <!-- 
            <div data-role="fieldcontain">
                <label for="password">password :</label>
                <input type="password" name="password" id="password" value=""  />
            </div>
			-->
			
			
            <div data-role="fieldcontain">
                <label for="email">Email Address :</label>
                <input type="text" name="email" id="email" value="<?php echo $email; ?>"  />
            </div>
            
            <div data-role="fieldcontain">
                <label for="contact">Mobile No. :</label>
                <input type="text" name="contact" id="contact" value="<?php echo $contact; ?>"  />
            </div>
            
            
            <div data-role="fieldcontain">
                <label for="discountcoupon">Discount Coupon :</label>
                <input type="text" name="discountcoupon" id="discountcoupon" value="<?php echo $coupon; ?>"  />
				<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
            </div>
            
           
            
            <div id="message"></div>
                    <input type="submit" value="Redeem" name="Redeem" >
			
        </form>
        
            <ul data-role="listview" data-inset="true">
	   <?
	   
$db1 = new DB($base, $server, $user, $pass);
	   $result1 = $db1->query("select a.id,b.redeemdate,b.couponcode,b.discount,a.name,a.email,a.contact,a.fbusername from  codes a, redeemed b where a.id=b.codeid  and a.id='" . $id ."' order by b.redeemdate");
while ($line1 = $db1->fetchNextObject($result1)) {

?>
 <li>
        <a target="_blank" href="<?php echo "http://www.facebook.com/" .   $line->fbusername; ?>">
		
		<h3 class="ui-li-heading"><?php echo $line1->name; ?></h3>
		<p class="ui-li-desc">
		<?php echo $line1->email . ' ' .  $line1->contact . ' ' .  $line1->couponcode; ?></p>
           <!--  <img src="images/icon1.png" alt="icon1" class="ui-li-icon"> -->
        </p>
            <span class="ui-li-count"><?php echo   date(  "F j, Y", strtotime($line1->redeemdate)); ?></span>
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
            <li><a href="index.php" data-icon="grid" data-iconpos="top" class="ui-btn-active  ui-state-persist">Process</a></li>
            <li><a href="redeemlist.php" data-icon="star"  data-iconpos="top">List</a></li>
            <li><a href="about.php" data-icon="gear" data-iconpos="top">About</a></li>
        </ul>
    </div><!-- /navbar -->
    
    <h4>Copyright &copy; 2012</h4>
</div>

</div><!-- /page -->

</body>
</html>