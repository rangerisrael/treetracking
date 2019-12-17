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

speak('<?php echo 'Access Granted'. strtolower($_SESSION['user']['name']).'Welcome to tree tracking system i hope you enjoy this project its entitled to our capstone project develop by, IT student of aurora state college of technology ';?>');


	</script>
    <link rel="stylesheet"  href="css/leaflet.css" />
    <link rel="stylesheet" href="css/geocoder.css" />
    <link rel="stylesheet"  href="css/dropdown.css"/>
    <link rel="stylesheet"  href="css/style.css"/>
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

 <h1 style="width:40vw; height: 18vh; margin-top: -10vh; margin-left: 40vw; color: white;">TREE TRACKING</h1>

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


 <div style="width:20vw; position:absolute;  background: linear-gradient(to bottom, #33cc33 0%, #ccff99 100%); top:20vh; left:50vw;">
			<h1 class="text-center">ADD POST</h1>
			<form method="post" enctype="multipart/form-data">
				<label>TITLE</label>
				<input type="text" name="title" class="form-control" required="">
				<label>Description</label>
                <textarea name="desc" id="" cols="30" rows="3" class="form-control"></textarea required>
				<label>Picture POST</label>
				<input type="file" name="profile"  required="" accept="*/image">
				<button type="submit" style="position:relative; left:14.8vw;" name="btn-add">Add New </button>
				
			</form>
		</div>
	</div>	
  
    

   </div>
</body class="design">


<!-- <div class="footer" style="text-align: center; padding: 10px 10px; color:white;">
	<h1>&copy; ALL RIGHT RESERVE @ 2019</h1>
</div> -->
<script src="js/map.js"></script>
<!-- <script src="js/dropdown.js"></script> -->

</html>
<?php 
require_once '../models/config.php';
	
	if(isset($_POST['btn-add']))
	{
		date_default_timezone_set('Asia/Manila');
	
		$title=$_POST['title'];
		$desc=$_POST['desc'];
	$date=date("d/m/Y h:i:s:A");
	$daynow=date('d/m/Y h:i:s:A',strtotime($date));
		$images=$_FILES['profile']['name'];
		$tmp_dir=$_FILES['profile']['tmp_name'];
		$imageSize=$_FILES['profile']['size'];

		$upload_dir='uploads/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
		$picProfile=rand(1000, 1000000).".".$imgExt;
		move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
		$username=  $_SESSION['user']['name'];
		$stmt=$db_conn->prepare('INSERT INTO postdata(title_post,post_desc,photo,post_created,nameofuser) VALUES (:title, :desc,:upic,NOW(),:name)');
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':desc', $desc);
		$stmt->bindParam(':upic', $picProfile);
		$stmt->bindParam(':name', $username	);
		
		if($stmt->execute())
		{
			?>
			<script>
				alert("new record successul");
				window.location.href=('modifypost.php');
			</script>
		<?php
		}else 

		{
			?>
			<script>
				alert("I have error encountered");
				window.location.href=('addpost.php');
			</script>
		<?php
		}

	}
?>