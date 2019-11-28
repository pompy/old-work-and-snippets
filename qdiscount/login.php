<?php session_start(); 
error_reporting(0); 
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Qdiscount Savers</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css"/> 
    
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script> 
        <script type="text/javascript" src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script> 
        
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />

</head>
<body> 

<div data-role="page">

    <div data-role="header" >
        <h1>Security</h1>
    </div><!-- /header -->

    <div data-role="content" >
   
        <div data-role="fieldcontain" class="ui-hide-label">
         <form id="theForm" name="theForm" action="login-submit.php" method="post">
	<label for="username">Username:</label>
	<input type="text" name="username" id="username" value="" placeholder="Username"/>
    <label for="password">Password:</label>
	<input type="password" name="password" id="password" value="" placeholder="Password"/>
	<input type="hidden" name="id" id="id" value="<?php echo $_GET["id"];  ?>" />
		<input type="hidden" name="coupon" id="coupon" value="<?php echo $_GET["coupon"];  ?>" />
    <input type="submit" value="Sign In" name="logout" >
    </form>
    <center>
    <img src="http://chart.apis.google.com/chart?cht=qr&chl=http://saverscarwash.com/qdiscount/login.php&chs=120x120"
alt="Login to Admin" /> <br/>
<h6>*Scan this to load this page on your mobile</h6>
    </center>
</div>

    </div><!-- /content -->

  <div data-role="footer" data-position="fixed">
         <h4>Copyright &copy; 2013</h4>
    </div><!-- /header -->
</div><!-- /page -->

</body>
</html>