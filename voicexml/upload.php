<?php

//$uploaddir = '/var/www/uploads/';
//$uploaddir = '/var/www/uploads/';
$uploaddir = $_SERVER['DOCUMENT_ROOT'] . "/voicexml/schools/engineering/postgraduate/distant/courses/itm/courses/programming/six/";
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
echo $uploadfile;

//echo  $uploaddir . "<br/>";
//echo $uploadfile;
//echo "<p>";
// echo $_SERVER['DOCUMENT_ROOT'];
if(copy($_FILES['userfile']['name'], '/xxx.wav'))
{
echo "Successful<BR/>";
}
else {
echo "failure";
}

      

?> 