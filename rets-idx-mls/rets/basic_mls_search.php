<?php require "phrets.class.php"; ?>
<html>
<body>
<h1> MLS Retrieval Demo </h1>
<form action="basic_mls_search.php" method="get">

Enter MLS ID#: &nbsp;<input type="text" name="mlsid" /></input>
<input type="submit" value="Go GET IT" />
* Eg: 211007081,209033971, 2010161, 2010405 etc

</form>
<br/>
<?php

if( $_GET["mlsid"]) {
$rets = new phRETS;

$rets->AddHeader("Accept", "*/*");
$rets->AddHeader("RETS-Version", "RETS/1.5");
$rets->AddHeader("User-Agent", "phRETS/0.2");

$rets->SetParam("cookie_file", "phrets_cookies.txt");
$rets->SetParam("debug_mode", TRUE); // ends up in rets_debug.txt

$rets->Connect("http://rets2.sunshinemls.com:6103/rets/login","smlsdowningfrye2010","2010e92h8htr463wjow","");




// use http://retsmd.com to help determine the SystemName of the DateTime field which
// designates when a record was last modified
//$rets_modtimestamp_field = "LIST_87";
$rets_modtimestamp_field = "datelisting";
 
// use http://retsmd.com to help determine the names of the classes you want to pull.
// these might be something like RE_1, RES, RESI, 1, etc.
$property_classes = array("RES");

// DateTime which is used to determine how far back to retrieve records.
// using a really old date so we can get everything
$previous_start_time = "1980-01-01T00:00:00";


 // $query = "(mlnum=" . $_GET["mlsid"] . "+)";
  
  $query = "(mlnum=" . $_GET["mlsid"] . ")";
// make search request
$search = $rets->SearchQuery("Property","RES",$query);


// get the first record returned
$listing = $rets->FetchRow($search);
// get list of fields for our loop
$fields = $rets->SearchGetFields($search);
// loop through each field in the response and pull it's value
echo "<div style='float:left;width:400px;height:500px;overflow:auto'>";
echo "<font size=10>";
echo "<table border=1 cellspacing=0 cellpadding=0 width=30%>";
foreach ($fields as $field) {
      //  echo "+ {$field} value is {$listing[$field]}<br/>";
		echo "<tr>";
		echo "<td> {$field}</td>";
		echo "<td> {$listing[$field]}</td>";
		echo "</tr>";
}
echo "</table>";
echo "</font>";
echo "</div>";
echo "<div style='float:left;overflow:auto;width:800px;height:500px;vertical-align:top'>";
//photo pull start
$photos = $rets->GetObject("Property", "Photo", $_GET["mlsid"] ,"*",1 );
foreach ($photos as $photo) {
        $listing = $photo['Content-ID'];
        $number = $photo['Object-ID'];

        if ($photo['Success'] == true) {
              //  file_put_contents("image-{$listing}-{$number}.jpg", $photo['Data']);
			  echo "<div style='float:left;vertical-align:top;padding:10px;'>";
                echo "<img src='". $photo['Location'] . "' >";
                echo "</div>";

        }
        else {
                echo "({$listing}-{$number}): {$photo['ReplyCode']} = {$photo['ReplyText']}\n";
        }

}
echo "</div>";
//photo pull end

//echo "+ Disconnecting<br>\n";
$rets->Disconnect();

}


?>
</body>
</html>