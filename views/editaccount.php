<?php
#
   include_once 'layout/header.php';
   require_once '../controllers/ipdetect.php';
  session_start();
   if ( !$_SESSION['user']['id'] ) {
      // If the user tries to change the url path to an inside-account page without being logged in,
      // It will redirect the user to login page as long as the user is not logging in
      header('location: forbidden.php?attempt=failed');
   }
   // The sessions that you're seeing below are the sessions you created in login controller page
   // T
?>
<?php 
	include("../models/config.php");
		if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
		{
			$id=$_GET[ 'edit_id'];
			$stmt_eidt=$db_conn->prepare('SELECT * FROM security WHERE id=:uid');
			$stmt_eidt->execute(array(':uid'=>$id));
			$edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC);
			extract($edit_row);
		}else 

		{
			header("Location: modifypost.php");
		}

		if(isset($_POST['update']))

			{

                $username=$_POST['username'];
                $role_name=$_POST['role'];
				$images=$_FILES['profile']['name'];
				$tmp_dir=$_FILES['profile']['tmp_name'];
				$imageSize=$_FILES['profile']['size'];
                   
				$upload_dir='profile/';
				$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
				$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
				$picProfile=rand(1000, 1000000).".".$imgExt;
				unlink($upload_dir.$profile);
				move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
				$stmt=$db_conn->prepare('UPDATE security SET username=:user,nameofuser=:roles,profile=:uprofile,date_updated=NOW() WHERE id=:ids');
				$stmt->bindParam(':user', $username);
				$stmt->bindParam(':roles', $role_name);
                $stmt->bindParam(':uprofile', $picProfile);        
				$stmt->bindParam(':ids', $id);
				if($stmt->execute())
				{
					?>
					<script type="text/javascript">
						alert('Successfully Update');
						window.location.href="modify.php";
					</script>
					<?php 
				}else 

				?>
				<script type="text/javascript">
					alert('Error updating data');
					window.location.href="modify.php";
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
<style>
.form-control{
  width:20vw;
  position:relative;
  left:10vw;
}

img {
    opacity: 0.8;
    filter: alpha(opacity=50); /* For IE8 and earlier */
}

img:hover {
    opacity: 1.0;
    filter: alpha(opacity=80); /* For IE8 and earlier */
}
.back{
  opacity: 0.8;
    filter: alpha(opacity=50);
}
.back:hover{
  opacity: 1.0;
    filter: alpha(opacity=80); /* For IE8 and earlier */
  
}

</style>
 <div class="back" style="width:40vw; position:absolute; border:inset 15px  #FFCC66;  background: #fff2df; top:13vh; left:39vw;">
			<h1 class="text-center">UPDATE ACCOUNT</h1>
			
			<form method="post" enctype="multipart/form-data">
<script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
	oFReader.onload = function (oFREvent) {
	document.getElementById("uploadPreview").src = oFREvent.target.result;
	};
	};
</script>
      <label style="position:relative; top:6.5vw; left:15.9vw;">&nbsp;&nbsp;&nbsp;YOUR PROFILE</label>

	 <?php  
	   include("../models/config.php");
	   $id=$_SESSION['user']['id'];
	   $stmt_eidt=$db_conn->prepare('SELECT * FROM security WHERE id=:uid');
	   $stmt_eidt->execute(array(':uid'=>$id));
	   $edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC);
	   extract($edit_row);

	 
     if($_SESSION['user']['profile']){
      echo "<img id='uploadPreview'   style=' border:inset 5px  #FFCC66; margin-left:0.5vw;width:18.5vw; position:relative; top:-1vh; height:25vh;' src='profile/".$profile."'  >";
     }
     else{
        echo "<img id='uploadPreview' style=' border:inset 5px  #FFCC66; margin-left:0.5vw;width:18.5vw; position:relative; top:-1vh; height:25vh;' src='profile/a.jpg'  >";
    }
    ?>
      <input id="uploadImage" style="position:relative; top:-1.8vw;left:21.3vw; " type="file" name="profile"  onchange="PreviewImage();"   accept="image/*" required=""oninvalid="this.setCustomValidity('PROFILE IS REQUIRED')" oninput="setCustomValidity('')" value="profile/".$_SESSION['user']['profile']."" ></br>
								

				<label style="position:relative;left:10vw;">USERNAME</label>
				<input type="text" name="username" class="form-control" required="" oninvalid="this.setCustomValidity('USERNAME IS IMPORTANT')" oninput="this.setCustomValidity('')" value="<?php echo $username; ?>">   
				
       
				<label  style="position:relative;left:10vw;">NAME OF USER</label>
				<input type="text" name="role" class="form-control" requied="" oninvalid="this.setCustomValidity('NAME OF USER IS REQUIRED')" maxlenngth"15" oninput="this.setCustomValidity('')" value="<?php echo $nameofuser;?>">
					
        <button type="submit" style="position:relative; left:16.9vw; top:4vh;"  class="btn btn-warning" name="update">UPDATE </button>
		
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        YOUR IDENTITY <label for="mac" name="macaddress" value="<?php echo mac();?>"><?php echo mac();?></label>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YOUR LOCATION <label for="ip" name="ipaddress" value="<?php echo ip();?>"><?php echo ip();?></label><br>
      
				
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
