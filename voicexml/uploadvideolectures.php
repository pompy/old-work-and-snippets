<html>
  <head>
    <title>University Recorded Upload Audio</title>
  
    
  </head>
  <body>
    <h3>Upload Lecture (Please keep the name of the audio files clear as it will be lecture title</h3><br/>
	<form enctype="multipart/form-data" action="upload.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
    Select File: <input name="userfile" type="file" />
    <input type="submit" value="Upload" />
</form>
    
  </body>
</html>