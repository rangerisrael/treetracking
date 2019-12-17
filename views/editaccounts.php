<?php
#
   include_once 'layout/test.php';
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

.user{
	width:60%;
	height:5vh;
	text-align:center;
	font-weight:bold;
	border-radius:5px;
  }
  
  
  .role{
	width:60%;
	height:5vh;
	text-align:center;
	font-weight:bold;
	border-radius:5px;
  
  }

  input{
  position:relative;
  left:8vw;
}
   filter: alpha(opacity=80); /* For IE8 and earlier */
}


    </style>
    <title>TRACK YOUR MAP EASILY</title>
</head>
<body>
<!-- for getting id from database and update the information -->
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
			header("Location: modifies.php");
		}

		if(isset($_POST['update']))

			{
				

				
                $username=$_POST['username'];
                $role_name=$_POST['role'];
			
				
				$images=PATHINFO($_FILES['profile']['name']);
				if (empty($_FILES["profile"]["name"])){
						$profile=$edit_row['profile'];
						$stmt=$db_conn->prepare('update security SET username=:user,nameofuser=:roles,profile=:uprofile,date_updated=NOW() WHERE id=:ids');
						$stmt->bindParam(':user', $username);
						$stmt->bindParam(':roles', $role_name);
                		$stmt->bindParam(':uprofile', $profile);        
						$stmt->bindParam(':ids', $id);

						if($stmt->execute())
					{
						?>
						<script type="text/javascript">
							alert('Successfully Updated you need to verify your account');
							window.location.href="logout.php";
						</script>
						<?php 
					}else 
	
					?>
					<script type="text/javascript">
						alert('Error updating data');
						window.location.href="modifies.php";
					</script>
					<?php 
	
				
				


				}
				else{

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
						alert('Successfully Update you need to verify your account');
						
							window.location.href="logout.php";
						</script>
						<?php 
					}else 
	
					?>
					<script type="text/javascript">
						alert('Error updating data');
						window.location.href="modifies.php";
					</script>
					<?php 
	
				}
				

			}



			
	
?>



<div class="headertest w3-light-green">
 

<img  src="background/trees.png" style="height:15vh;width: 100vw;">

</div>
<div class=" w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; position:fixed;background:#222222; background-size:cover; z-index:-1;   border-radius: 15px 50px;  font-weight:bold;" id="mySidebar">
  <button class="test w3-bar-item w3-button w3-green" style="position: relative; top:4vh;" 
  onclick="w3_close()">BACK</button>

 <div> <?php include('side.php');?></div>
 
</div>
<div id="main">
<div class="w3-white">

  <button id="openNav" class="w3-button w3-green w3-xlarge" onclick="w3_open()">&#9776;</button>
 


  <div class="back" style="width:40vw; position:absolute; border:inset 15px  #FFCC66;   top:25vh; left:30vw;">
  	 <img src="background/ds.gif" style="width:105%; height: 105%; position: absolute;top: 35%-1vh; left:-1vw; opacity: 0.7;  ">
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
      <label style="position:relative; top:6.5vw; z-index: -1; left:15.9vw;">&nbsp;&nbsp;&nbsp;YOUR PROFILE</label>

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
      <input id="uploadImage" style="position:relative; top:-1.8vw;left:21.3vw; " type="file" name="profile"  onchange="PreviewImage();"   accept="image/*"  value="profile/".$_SESSION['user']['profile']."" ></br>
								

				
				<input type="text" name="username" class="user" placeholder="USERNAME" required="" oninvalid="this.setCustomValidity('USERNAME IS IMPORTANT')" oninput="this.setCustomValidity('')" value="<?php echo $username; ?>">   
				
       <br><br>
				<input type="text" name="role" class="role" placeholder="NAME OF USER" requied="" oninvalid="this.setCustomValidity('NAME OF USER IS REQUIRED')" maxlenngth"15" oninput="this.setCustomValidity('')" value="<?php echo $nameofuser;?>">
					
        <button type="submit" style="position:relative; left:-5.5vw; top:8vh;"  class="btn btn-warning" name="update">UPDATE </button>
		<br>
		<br>
		<br>
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;YOUR IDENTITY <label for="mac" name="macaddress" value="<?php echo mac();?>"><?php echo mac();?></label>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YOUR LOCATION <label for="ip" name="ipaddress" value="<?php echo ip();?>"><?php echo ip();?></label><br>
      
				
			</form>
		</div>
	</div>	
  
    

   </div>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.marginTop = "-3%";

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