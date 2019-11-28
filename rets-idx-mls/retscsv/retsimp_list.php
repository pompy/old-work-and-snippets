<?php
require "phrets.class.php";

$rets = new phRETS;

$rets->AddHeader("Accept", "*/*");
$rets->AddHeader("RETS-Version", "RETS/1.5");
$rets->AddHeader("User-Agent", "phRETS/0.2");

//$rets->SetParam("compression_enabled", true);
$rets->SetParam("offset_support", true); 
$rets->SetParam("cookie_file", "phrets_cookies.txt");
$rets->SetParam("debug_mode", true); // ends up in rets_debug.txt

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

echo "Start DateTime" .   date('D, d M Y H:i:s T');

foreach ($property_classes as $class) {

        echo "+ Property:{$class}<br>\n";

        $file_name = strtolower("property_{$class}.csv");
        $fh = fopen($file_name, "w+");

        $fields_order = array();

        $query = "({$rets_modtimestamp_field}={$previous_start_time}+)";

        // run RETS search
        echo "   + Resource: Property   Class: {$class}   Query: {$query}<br>\n";
        $search = $rets->SearchQuery("Property", $class, $query, array('Limit' => 1000));

        if ($rets->NumRows($search) > 0) {

                // print filename headers as first line
                $fields_order = $rets->SearchGetFields($search);
                fputcsv($fh, $fields_order);

                // process results
                while ($record = $rets->FetchRow($search)) {
                        $this_record = array();
                        foreach ($fields_order as $fo) {
                                $this_record[] = $record[$fo];
                        }
                        fputcsv($fh, $this_record);
                }

        }

        echo "    + Total found: {$rets->TotalRecordsFound($search)}<br>\n";

        $rets->FreeResult($search);

        fclose($fh);

        echo "  - done<br>\n";

}

echo "+ Disconnecting<br>\n";
$rets->Disconnect();



?>