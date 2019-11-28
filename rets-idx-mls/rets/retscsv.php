<?php
require "phrets.class.php";

$rets = new phRETS;

$rets->AddHeader("Accept", "*/*");
$rets->AddHeader("RETS-Version", "RETS/1.5");
$rets->AddHeader("User-Agent", "phRETS/0.2");

$rets->SetParam("cookie_file", "phrets_cookies.txt");
$rets->SetParam("debug_mode", TRUE); // ends up in rets_debug.txt

$rets->Connect("http://rets2.sunshinemls.com:6103/rets/login","smlsdowningfrye2010","2010e92h8htr463wjow","");

/*
//GET OBJECT
print "<h3>GetObject</h3>";		
list($headers,$body) = $rets->RETSRequest($rets->capability_url['GetObject'],
		array(
		'Resource' => 'Property',
		'Type' => 'Photo',
		'Location' => 0,
		'ID' => '262063:*')
	);
	
print "HEADERS: <br>";
print "<pre>";
print_r($headers);
print "</pre>";

print "BODY: <br>";
print "<pre>";
print_r($body);
print "</pre>";
*/

/*
$fields = $rets->GetMetadataTable("Property", "RES");
$last_url = $rets->LastRequestURL();
echo $fields;
echo "+ Last URL: {$last_url}\n";
*/

/*
$types = $rets->GetMetadataTypes();

// check for errors
if (!$types) {
        print_r($rets->Error());
}
else {
        foreach ($types as $type) {
                echo "+ Resource {$type['Resource']}<br>\n";

                foreach ($type['Data'] as $class) {
                        echo "  + Class {$class['ClassName']}<br>\n";
                }
        }
}

echo "+ Disconnecting<br>\n";
$rets->Disconnect();

*/


// use http://retsmd.com to help determine the SystemName of the DateTime field which
// designates when a record was last modified
//$rets_modtimestamp_field = "LIST_87";
$rets_modtimestamp_field = "datelisting";
 
// use http://retsmd.com to help determine the names of the classes you want to pull.
// these might be something like RE_1, RES, RESI, 1, etc.
$property_classes = array("RES","B","C");

// DateTime which is used to determine how far back to retrieve records.
// using a really old date so we can get everything
$previous_start_time = "1980-01-01T00:00:00";



foreach ($property_classes as $class) {

        echo "+ Property:{$class}<br>\n";

        $file_name = strtolower("property_{$class}.csv");
        $fh = fopen($file_name, "w+");

        $maxrows = true;
        $offset = 1;
        $limit = 1000;
        $fields_order = array();

        while ($maxrows) {

            //    $query = "({$rets_modtimestamp_field}={$previous_start_time}+)";

		 $query = "(status=871)";
                // run RETS search
                echo "   + Query: {$query}  Limit: {$limit}  Offset: {$offset}<br>\n";
                $search = $rets->SearchQuery("Property", $class, $query, array('Limit' => $limit, 'Offset' => $offset, 'Format' => 'COMPACT-DECODED', 'Count' => 1));

                if ($rets->NumRows() > 0) {

                        if ($offset == 1) {
                                // print filename headers as first line
                                $fields_order = $rets->SearchGetFields($search);
                                fputcsv($fh, $fields_order);
                        }

                        // process results
                        while ($record = $rets->FetchRow($search)) {
                                $this_record = array();
                                foreach ($fields_order as $fo) {
                                        $this_record[] = $record[$fo];
                                }
                                fputcsv($fh, $this_record);
                        }

                        $offset = ($offset + $rets->NumRows());

                }

                $maxrows = $rets->IsMaxrowsReached();
                echo "    + Total found: {$rets->TotalRecordsFound()}<br>\n";

                $rets->FreeResult($search);
        }

        fclose($fh);

        echo "  - done<br>\n";

}

echo "+ Disconnecting<br>\n";
$rets->Disconnect();



?>