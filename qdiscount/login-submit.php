<?php
session_start(); 
error_reporting(0); 
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

    
<?php
if($_POST["username"]=="admin" && $_POST["password"]=="admin") {
 $_SESSION["isLoggedIn"]=1;  
$id=$_POST["id"];
$coupon=$_POST["coupon"];
	echo "<script>document.location.href=\"index.php?id=" . $id . "&coupon=". $coupon . "\";</script>";
	
}
else {
 $_SESSION["isLoggedIn"]=0; 
	echo "<script>document.location.href=\"login.php?error=invalid login\";</script>";
}
?>


<div data-role="footer" data-position="fixed">
  
    
    <h4>Copyright &copy; 2012</h4>
</div>

</div><!-- /page -->

</body>
</html>