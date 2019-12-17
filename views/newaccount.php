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





input{
  position:relative;
  left:8vw;
}
.user{
  width:60%;
  height:5vh;
  text-align:center;
  font-weight:bold;
  border-radius:5px;
}

.pass{
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
.user{
  width:60%;
  height:5vh;
  text-align:center;
  font-weight:bold;
  border-radius:5px;

}

 </style>
    <title>TRACK YOUR MAP EASILY</title>
</head>
<body>
<!-- for getting id from database and update the information -->



<div class="headertest w3-light-green" style="z-index: 1;">
 
 <img  src="background/trees.png" style="height:15vh;width: 100vw;">

 
</div>

<div class=" w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; position:fixed; z-index: 0; background:#222222; background-size:cover;     font-weight:bold;" id="mySidebar">
  <button class="test w3-bar-item w3-button w3-green" style="position: relative;top:-1vh;" 
  onclick="w3_close()">BACK</button>

 <div> <?php include('side.php');?></div>
 
</div>
<div id="main">
<div class="w3-white">

 <button id="openNav" style="position:fixed; top:11.2vh; opacity: 0.8; z-index: 1;" class="w3-button w3-green w3-sm" onclick="w3_open()">&#9776;</button>
 

  
  <div class="back" style="width:40vw; position:absolute; border:inset 15px  #FFCC66;   top:20vh; left:30vw;">
     <img src="background/ds.gif" style="width:105%; height: 105%; position: absolute;top: -1vh; left:-1vw; opacity: 0.76;  ">
			<h1 class="text-center">ADD ACCOUNT</h1>
			
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
      <img id="uploadPreview" style="width:15vw; position:relative; left:4vw; border:outset  5px white"   src="profile/a.png" required="" />
      <input id="uploadImage" style="position:relative; top:-1.8vw;left:21.3vw; " type="file" name="profile"  onchange="PreviewImage();"   accept="image/*" ></br>
								

			
				<input type="text" name="username"  placeholder="USERNAME" class="user" required="" oninvalid="this.setCustomValidity('USERNAME IS IMPORTANT')" oninput="this.setCustomValidity('')">   
				
      <br><br>
				<input type="password"  name="password" placeholder="PASSWORD" class="pass" id="pass"  maxlength="40" required="" oninvalid="this.setCustomValidity('PASSWORD IS IMPORTANT CLICK BOX ICON to SHOW')" oninput="this.setCustomValidity('')">
				<!-- <label>SHOW PASSWORD</label> -->

        <script>
								function show(){
									var pass=document.getElementById('pass');
									if(pass.type=="password"){
											pass.type="text";
									}
									else{
										pass.type="password";
									}
								}
                </script>
				<input type="checkbox" style="position:relative; top:-0.0vw; left:6vw;"  class="control" name="title" title="SHOW PASSWORD" onclick="show();"  ><br>
<br>
				
				<input type="text" name="role" placeholder="NAME OF USER" class="role" required="" oninvalid="this.setCustomValidity('NAME OF USER IS REQUIRED')" maxlenngth"15" oninput="this.setCustomValidity('')">
				<select name="user_role" class="user" required="" oninvalid="this.setCustomValidity('SELECT USER ROLE')"  oninput="this.setCustomValidity('')" style="position:relative; top:4vh; left:8vw;">
                <option>SELECT USER</option>
                <option value="ADMIN">ADMIN</option> 
                <option value="STAFF">STAFF</option> 

        </select>
<br><br>
        <button type="submit" style="position:relative; left:17vw; top:7vh;"  class="btn btn-success" name="btn-add">Add New </button><br>
		
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;YOUR IDENTITY <label for="mac" name="macaddress" value="<?php echo mac();?>"><?php echo mac();?></label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YOUR LOCATION <label for="ip" name="ipaddress" value="<?php echo ip();?>"><?php echo ip();?></label><br>
      
				
			</form>
		</div>
	</div>	
  
    

   </div>

 <!-- adding record for account -->
 <?php 
require_once '../models/config.php';
	
$user_error='';
	if(isset($_POST['btn-add']))
	{
	
function userExists($db_conn, $usernames)
{
    $userQuery = "SELECT * FROM security  WHERE username=:user;";
    $stmt = $db_conn->prepare($userQuery);
    $stmt->execute(array(':user' => $usernames));
    return !!$stmt->fetch(PDO::FETCH_ASSOC);
}

 $usernames=$_POST['username'];
$exists = userExists($db_conn, $usernames);
if($exists)
{
   echo "<script>alert('USER IS EXIST');</script>"; 


}	
	
		

else{



    $type=$_POST['user_role'];

    $password=$_POST['password'];
    $rolename=$_POST['role'];
		$images=$_FILES['profile']['name'];
		$tmp_dir=$_FILES['profile']['tmp_name'];
		$imageSize=$_FILES['profile']['size'];

if (empty($_FILES["profile"]["name"])){
    $default="profile.jpg";

     $passcode=password_hash($password,PASSWORD_DEFAULT);
    $stmt=$db_conn->prepare('INSERT INTO security(username,pwd,nameofuser,profile,ip_users,mac_user,role_type,date_created) VALUES (:user,:pass,:roles,:img,:ip,:mac,:user_type,NOW())');
    $stmt->bindParam(':user', $usernames);
    $stmt->bindParam(':pass', $passcode);
    $stmt->bindParam(':roles', $rolename);
    $stmt->bindParam(':img', $default);
    $stmt->bindParam(':ip', ip());
    $stmt->bindParam(':mac', mac());
    $stmt->bindParam(':user_type', $type);

    
  
    if($stmt->execute())
    {
      ?>
      <script>
        alert("new record successul");
        alert("YOU REDIRECT TO LOGIN PAGE to VERIFY YOUR ACCOUNT");
        window.location.href=('logout.php');
      </script>
    <?php
    }else 

    {
      ?>
      <script>
        alert("I have error encountered");
        window.location.href=('newaccount.php');
      </script>
    <?php
    }


}
else{

    $upload_dir='profile/';
    $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
    $valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
    $picProfile=rand(1000, 1000000).".".$imgExt;
    move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
    $passcode=password_hash($password,PASSWORD_DEFAULT);
    $stmt=$db_conn->prepare('INSERT INTO security(username,pwd,nameofuser,profile,ip_users,mac_user,role_type,date_created) VALUES (:user,:pass,:roles,:img,:ip,:mac,:user_type,NOW())');
    $stmt->bindParam(':user', $usernames);
    $stmt->bindParam(':pass', $passcode);
    $stmt->bindParam(':roles', $rolename);
    $stmt->bindParam(':img', $picProfile);
    $stmt->bindParam(':ip', ip());
    $stmt->bindParam(':mac', mac());
    $stmt->bindParam(':user_type', $type);
  
    if($stmt->execute())
    {
      ?>
      <script>
        alert("new record successul");
        alert("YOU RIDIRECT TO LOGIN PAGE to VERIFY YOUR ACCOUNT");
        window.location.href=('logout.php');
      </script>
    <?php
    }else 

    {
      ?>
      <script>
        alert("I have error encountered");
        window.location.href=('newaccount.php');
      </script>
    <?php
    }
}


}

	}
?>
    

   </div>
	

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.marginTop = "-2%";
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