<?PHP
header('Cache-Control: no-cache');

error_reporting (0);

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo "<vxml version=\"2.0\">";

echo "<form id=\"main\">";
echo "<block>";

if ($HTTP_POST_FILES) {
  
srand ((double) microtime( )*1000000);
$random_number = rand( );
$filename=$random_number.".wav";

    if (!copy($HTTP_POST_FILES['audio']['tmp_name'], $filename)) {
      echo "Opps Could not save filename: " . $HTTP_POST_FILES['audio']['tmp_name'];
    } // if statement
    else {
      echo "Successfully saved filename: " . $ServerSide;
    }  // else statement

  }  // for each statement
 // if statement

echo "</block>";
echo "</form>";
echo "</vxml>";
?>