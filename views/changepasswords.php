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

<?php 
	include("../models/config.php");
		if(isset($_GET['change_id']) && !empty($_GET['change_id']))
		{
			$id=$_GET[ 'change_id'];
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
					$current=$_POST['currentpassword'];
					$new=$_POST['newpassword'];

					if(isset($_POST['currentpassword'])){
						$hash=password_verify($current,$pwd);
						if($hash==true){
							if(isset($_POST['newpassword'])){

								$password=password_hash($new,PASSWORD_DEFAULT);
								$stmt=$db_conn->prepare('UPDATE security SET pwd=:newpassword WHERE id=:ids');
								$stmt->bindParam(':newpassword', $password);  
								$stmt->bindParam(':ids', $id);
								if($stmt->execute())
								{
									?>
									<script type="text/javascript">
										alert('Successfully Update');
										alert('You need to login to verify your changing password');
										
										window.location.href="logout.php";
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
									
						}
						else{
							echo "<script>alert('INCORRECT CURRENT PASSWORD');</script>";
						}
					}
                
			

			}

	
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




    </style>
    <title>TRACK YOUR MAP EASILY</title>
</head>
<body>
<!-- for getting id from database and update the information -->

<div class="headertest w3-light-green">
 
 <img  src="background/trees.png" style="height:15vh;width: 100vw;">

</div>

<div class=" w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; position:fixed;background:#222222; background-size:cover;     font-weight:bold;" id="mySidebar">
  <button class="test w3-bar-item w3-button w3-green"
  onclick="w3_close()">BACK</button>	

 <div> <?php include('adminside.php');?></div>
 
</div>
<div id="main">
<div class="w3-white">

  <button id="openNav" class="w3-button w3-green w3-xlarge" onclick="w3_open()">&#9776;</button>
 
  <a href="logout.php"class="btn logout float-right" onclick="logout();"  style="">Logout</a>

  <div class="back" style="width:40vw; position:absolute; border:inset 15px  #FFCC66;   top:19vh; left:30vw;">
  	  <img src="background/ds.gif" style="width:105%; height: 105%; position: absolute;top: -1vh; left:-1vw; opacity: 0.76;  ">
			<h1 class="text-center">CHANGING PASSWORD</h1>
			
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
    
		<p style="text-align:center; font-size:20px;font-weight:bold;"><?php echo strtoupper($_SESSION['user']['username'])?></p>
	<br>	<p style="text-align:center; font-size:20px;font-weight:bold;">TYPE CURRENT PASSWORD</p>
		<input type="password"  name="currentpassword" id="curpass" class="user" maxlength="40" required="" placeholder="CURRENT PASSWORD" oninvalid="this.setCustomValidity('PASSWORD IS IMPORTANT CLICK BOX ICON to SHOW')" oninput="this.setCustomValidity('')" >
	<br><br>
		<input type="password"  name="newpassword" id="newpass" class="user" maxlength="40" required="" placeholder="NEW PASSWORD" oninvalid="this.setCustomValidity('PASSWORD IS IMPORTANT CLICK BOX ICON to SHOW')" oninput="this.setCustomValidity('')" >
	
		<!-- <label>SHOW PASSWORD</label> -->

<script>
						function showed(){
							var pass=document.getElementById('curpass');
							if(pass.type=="password"){
									pass.type="text";
							}
							else{
								pass.type="password";
							}
						}
						function show(){
							var pass=document.getElementById('newpass');
							if(pass.type=="password"){
									pass.type="text";
							}
							else{
								pass.type="password";
							}
						}
		</script>
		<input type="checkbox" style="position:relative; top:-8vh; left:5vw;"  class="control" name="title" title="SHOW PASSWORD" onclick="showed();"  ><br>
		<input type="checkbox" style="position:relative; top:-4vh; left:28vw;"  class="control" name="title" title="SHOW PASSWORD" onclick="show();"  ><br>
	
        <button type="submit" style="position:relative; left:16.9vw; top:4vh;"  class="btn btn-warning" name="update">UPDATE </button><br>
		
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        YOUR IDENTITY <label for="mac" name="macaddress" value="<?php echo mac();?>"><?php echo mac();?></label>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YOUR LOCATION <label for="ip" name="ipaddress" value="<?php echo ip();?>"><?php echo ip();?></label><br>
      
				
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