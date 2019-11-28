<html>
  <head>
    <title>University Recorded Videos</title>
    <script type="text/javascript" src = "./vendor/debug.js"></script>
    <script type="text/javascript" src = "./vendor/jquery.js"></script>
    <script type="text/javascript">
    
      $(document).ready(function(e){
        debug.log('try to play alarm');
        //play.sound('alarm');
      });
    
      var play = {
        sound: function ( wav ) {
          debug.log(wav);
          
          var e = $('#' + wav);
          debug.log(e);
          $('#alarm').remove();

          $(e).attr('autostart',true);
          $('body').append(e);
          
          
          return wav;
        }
      };
    
    </script>
    
  </head>
  <body>
    <h1>University Recorded Videos</h1>
    
    <!-- embed all the assets first so they are cached -->
    <!--
    <embed id = "alarm" autostart = "false" src = "./wavs/alarm.wav"/>
    <embed id = "crinkle" autostart = "false" src = "./wavs/crinkle.wav"/>
    <embed id = "ding" autostart = "false" src = "./wavs/ding.wav"/>
    <embed id = "flush" autostart = "false" src = "./wavs/flush.wav"/>
    <embed id = "intro" autostart = "false" src = "./wavs/intro.wav"/>
	

    <embed id = "hat" autostart = "false" src = "./wavs/drums/tick.wav"/>
    <embed id = "snare" autostart = "false" src = "./wavs/drums/snare.wav"/>
    <embed id = "kick" autostart = "false" src = "./wavs/drums/kick.wav"/>
    -->
 <?php
	 //$imgdir = '/techteer007/demo.techteer.com/voicexml/'; // the directory, where your images are stored
 	 $imgdir = realpath('./');
	 $allowed_types = array('wav'); // list of filetypes you want to show
 	 $dimg = opendir($imgdir);
	 while($imgfile = readdir($dimg))
	 {
	  if(in_array(strtolower(substr($imgfile,-3)),$allowed_types))
	  {
	   $a_img[] = $imgfile;
	   sort($a_img);
 	   reset ($a_img);
  } 
 }
	 $totimg = count($a_img); // total image number
	 
	// echo $totimg;
	 for($x=0; $x < $totimg; $x++)
	 {
	  echo "Created: " . date ("F d Y H:i:s.", filemtime($imgdir.'/'.$a_img[$x]));
	  echo " <br/><embed id = \"" . $a_img[$x]  . "\" autostart = \"false\" src = \"". $a_img[$x] . "\" /><hr/>";
	 }
 	 ?>
    
  </body>
</html>