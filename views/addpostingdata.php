<?php
#
   include_once 'layout/test.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/w3.css">

   
    <style>
   #map{

    height: 92.5vh;
    width: 100vw;
}

.edit-form img {
		width: 150px;
		height: 100px;
	}

    </style>
    <title>TRACK YOUR MAP EASILY</title>
</head>
<body>

<div class="headertest w3-light-green">
 
 <img  src="background/trees.png" style="height:15vh;width: 100vw;">


</div>

<div class=" w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; background:#222222;font-weight:bold;" id="mySidebar">
  <button class="w3-bar-item w3-button w3-green"
  onclick="w3_close()">BACK</button>

 <div> <?php include('side.php');?></div>
 
</div>
<div id="main">
<div class="w3-white">

  <button id="openNav" class="w3-button w3-green w3-xlarge" onclick="w3_open()">&#9776;</button>
 

 <div style="width:20vw; position:absolute;  background: linear-gradient(to bottom, #33cc33 0%, #ccff99 100%); top:25vh; left:45vw;">
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



</div>

 
	

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "20%";
  document.getElementById("mySidebar").style.color = "red";
  document.getElementById("mySidebar").style.background = "light-green";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "block";
}
</script>


	



    <script src="js/script.js"></script>
    <script>
    
    </script>
    <script type='text/javascript' src='js/jquery.min.js'></script>
    




<!-- <div class="footer" style="text-align: center; padding: 10px 10px; color:white;">
	<h1>&copy; ALL RIGHT RESERVE @ 2019</h1>
</div> -->
<script src="js/map.js"></script>
<!-- <script src="js/dropdown.js"></script> -->

</html>

</body>
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
				window.location.href=('modifyposts.php');
			</script>
		<?php
		}else 

		{
			?>
			<script>
				alert("I have error encountered");
				window.location.href=('addpostingdata.php');
			</script>
		<?php
		}

	}
?>