<?php
#
   include_once 'layout/header.php';
   require_once '../controllers/addpost.php';
  session_start();
   if ( !$_SESSION['user']['id'] ) {
      // If the user tries to change the url path to an inside-account page without being logged in,
      // It will redirect the user to login page as long as the user is not logging in
      header('location: login.php?attempt=failed');
   }
   // The sessions that you're seeing below are the sessions you created in login controller page
   // T
?>
<?php 
	include("../models/config.php");
		if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
		{
			$id=$_GET[ 'edit_id'];
			$stmt_eidt=$db_conn->prepare('SELECT * FROM postdata WHERE post_id=:uid');
			$stmt_eidt->execute(array(':uid'=>$id));
			$edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC);
			extract($edit_row);
		}else 

		{
			header("Location: modifypost.php");
		}

		if(isset($_POST['btn-save']))

			{

				$title=$_POST['title'];
				$desc=$_POST['desc'];
				$images=$_FILES['profile']['name'];
				$tmp_dir=$_FILES['profile']['tmp_name'];
				$imageSize=$_FILES['profile']['size'];

				$upload_dir='uploads/';
				$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
				$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
				$picProfile=rand(1000, 1000000).".".$imgExt;
				unlink($upload_dir.$edit_row['photo']);
				move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
				$stmt=$db_conn->prepare('UPDATE postdata SET title_post=:title,post_desc=:desc, photo=:uprofile WHERE post_id=:uid');
				$stmt->bindParam(':title', $title);
				$stmt->bindParam(':desc', $desc);
				$stmt->bindParam(':uprofile', $picProfile);
				$stmt->bindParam(':uid', $id);
				if($stmt->execute())
				{
					?>
					<script type="text/javascript">
						alert('Successfully Update');
						window.location.href="modifypost.php";
					</script>
					<?php 
				}else 

				?>
				<script type="text/javascript">
					alert('Error updating data');
					window.location.href="modifypost.php";
				</script>
				<?php 

			}

	
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
 

 <div class="edit-form" style="width:20vw; position:absolute;top:20vh; left:50vw; background: linear-gradient(to bottom, #33cc33 0%, #ccff99 100%);">
			<h1 class="text-center">Edit form </h1>
			<form method="post" enctype="multipart/form-data">
				<label>Title</label>
				<input type="text" name="title" class="form-control" value="<?php echo $title_post; ?>">
				<label>Description</label>
				<input type="text" name="desc" class="form-control" value="<?php echo $post_desc; ?>">
			
				<label>Picture Profile</label>
				<img src="uploads/<?php echo $photo; ?>" class="img-rounded">
				<input type="file" name="profile"  required="" accept="*/image">
				<button type="submit" name="btn-save" style="position:relative; left:15.5vw;">Update </button>
				
			</form>
		</div>
    

   </div>
</body class="design">

<style type="text/css">
	.edit-form img {
		width: 150px;
		height: 100px;
	}
</style>
<!-- <div class="footer" style="text-align: center; padding: 10px 10px; color:white;">
	<h1>&copy; ALL RIGHT RESERVE @ 2019</h1>
</div> -->
<script src="js/map.js"></script>
<!-- <script src="js/dropdown.js"></script> -->

</html>
