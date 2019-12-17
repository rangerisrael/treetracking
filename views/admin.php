<?php
#
   include_once 'layout/header.php';
  session_start();
   if ( !$_SESSION['user']['id'] ) {
      // If the user tries to change the url path to an inside-account page without being logged in,
      // It will redirect the user to login page as long as the user is not logging in
    
      header('location: forbidden.php?attempt=failed');
   }
   // The sessions that you're seeing below are the sessions you created in login controller page
   // T
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script>
   
function speak(t){
    
    var synth = window.speechSynthesis;
 var voices = synth.getVoices();

 var u = new SpeechSynthesisUtterance(t);
 u.onend = function () { console.log("on end!"); }
 u.onerror = function () { console.log("on error!"); }
 u.onpause = function () { console.log("on pause"); }
 u.onresume = function () { console.log("on resume"); }
 u.onstart = function () { console.log("on start"); }
 synth.cancel();
 synth.speak(u);
 setInterval(function () {
     console.log("paused:" + synth.paused + " pending:" + synth.pending + " speak:" + synth.speaking);

 }, 100);
}

speak('<?php echo  strtolower($_SESSION['user']['name']).'Welcome to tree tracking system  ';?>');


	</script>
    <link rel="stylesheet"  href="css/leaflet.css" />
    <link rel="stylesheet" href="css/geocoder.css" />
    
    <link rel="stylesheet"  href="css/style.css"/>
	 <link rel="stylesheet"  href="css/leaflet.draw.css"/>
	
    <style>
  
    
    </style>
    <script src="js/script.js"></script>
  
    <script type='text/javascript' src='js/jquery.min.js'></script>
    <script type='text/javascript' src='js/leaflet.js'></script>
	  <script type='text/javascript' src='js/esri.js'></script>
	  <script type='text/javascript' src='js/geocoder.js'></script>
    


</style>
</head>

    </script>

<div class="header">
 

 <img src="img/logos.png" style="width: 15vw; height: 18vh; margin-top: -6vh;">

 <h1  class="admindesign"style=" margin-top: -10vh; margin-left: 40vw;">TREE TRACKING</h1>

</div>



<div class="sidebar">
<?php include('sidebar.php');?>
</div>
 
 <div class="main">

	<script>
function logout(){
    
    var synth = window.speechSynthesis;
 var voices = synth.getVoices();
 var t = "<?php echo 'Your logout'.'good bye'.strtolower($_SESSION['user']['name']);?>";
 var u = new SpeechSynthesisUtterance(t);
 u.onend = function () { console.log("on end!"); }
 u.onerror = function () { console.log("on error!"); }
 u.onpause = function () { console.log("on pause"); }
 u.onresume = function () { console.log("on resume"); }
 u.onstart = function () { console.log("on start"); }
 synth.cancel();
 synth.speak(u);
 setInterval(function () {
     console.log("paused:" + synth.paused + " pending:" + synth.pending + " speak:" + synth.speaking);

 }, 100);
}
	</script>
 <a href="logout.php"class="btn logout float-right" onclick="logout();"  style="">Logout</a>

   
    <?php include('map/showmapping.php');?>
	
    

   </div>
</body>


<div class="footer" style="text-align: center; padding: 10px 10px; color:white;">
	<h1>&copy; ALL RIGHT RESERVE @ 2019</h1>
</div>
<script src="js/map.js"></script>

	
</html>