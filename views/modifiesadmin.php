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
    <link rel="stylesheet"  href="css/leaflet.css" />
    <link rel="stylesheet" href="css/geocoder.css" />
    <link rel="stylesheet"  href="css/dropdown.css"/>
	 <link rel="stylesheet"  href="css/leaflet.draw.css"/>
    <style>
   #map{

    height: 92.5vh;
    width: 100vw;
}

    </style>
    <title>TRACK YOUR MAP EASILY</title>
</head>
<body>
<div class="headertest w3-light-green">
 

 <img  src="background/trees.png" style="height:15vh;width: 100vw;">

</div>

<div class=" w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; position:fixed;background:#222222; background-size:cover;     font-weight:bold;" id="mySidebar">
  <button class="test w3-bar-item w3-button w3-green"
  onclick="w3_close()">BACK</button>

 <div id="test"> <?php include('adminside.php');?></div>
 
</div>
<div id="main">
<div class="w3-white">

 <button id="openNav" style="position:fixed; top:11.2vh; opacity: 0.8; z-index: 1;" class="w3-button w3-green w3-sm" onclick="w3_open()">&#9776;</button>

<script>
  function logout(){
    
    var synth = window.speechSynthesis;
 var voices = synth.getVoices();
 var t = "<?php echo 'Your logout'.'good bye';?>";
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
<div class="log">
<a href="logout.php"class="btn logout float-right" onclick="logout();"  style="">Logout</a>

   

</div>
<br>

<br>
 <div class="account">
                <p>MANAGE INFORMATION ACCOUNT</p>
</div>
<div class="container">

            <div class="row">
            
            <div class="col-md-8 col-md-offset-2">
            <script>
function addvoice(){
    
    var synth = window.speechSynthesis;
 var voices = synth.getVoices();
 var t = "Adding account";
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
          
                    <table class="table table-hover table-bordered" style="position:relative; left:-13vw; width:75vw; ">
                        <thead>
                                <tr>
                                <td>PROFILE</td>
                                <td>USERNAME</td>
                                <td>PASSWORD</td>
                                <th>ROLE TYPE</th>
                                <td>NAME OF USER</td>                        
                                <td>UPDATE</td>
                                <td>REMOVE</td>
                                </tr>
                        </thead>
                        <tbody>
                       
                        <?php
                            include("../models/config.php");
                        
                       $stmt_eidt=$db_conn->prepare('SELECT * FROM security ');
                           
                           $stmt_eidt->execute();

                           while($row=$stmt_eidt->fetch(PDO::FETCH_ASSOC)){





                  
                         

                         
                          echo " <tr><td><img  style=' border:inset 5px  #FFCC66; margin-left:0.5vw;width:10vw; position:relative; top:-1vh; height:100px;' src='profile/".$row['profile']."'  >";
                         
 
 ?></td>
                        <td>
                        <?php echo $row['username'];?></td>
                        <td><?php echo $row['pwd'];?><a class="btn btn-success" href="adminpassword.php?change_id=<?php echo $row['id']?>" title="click for edit" onclick="return confirm('Are you sure you want to change your password?')"><span class="glyphicon glyphicone-edit"></span>CHANGE PASSWORD</a></td>
                       <td><?php echo $row['role_type'];?></td>
                        <td><?php echo $row['nameofuser'];?></td>
                        <td><a class="btn btn-info" href="editadminaccount.php?edit_id=<?php echo $row['id'] ?>" title="click for edit" onclick="return confirm('Sure to edit this record')"><span class="glyphicon glyphicone-edit"></span>Edit</a></td>
                        <td><a class="btn btn-danger" href="?delete_id=<?php echo $row['id']?>" title="click for delete" onclick="return confirm('Sure to delete this record?')">Delete</a></td>
                      </tr>
                    <?php }?>
                  </tbody>
                  
                    </table>
            </div>
            
            
            
            </div>  
        

<?php 
	include("../models/config.php");
	if(isset($_GET['delete_id']))
	{
		$stmt_select=$db_conn->prepare('SELECT * FROM security WHERE id=:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("profile/".$imgRow['profile']);
		$stmt_delete=$db_conn->prepare('DELETE FROM security WHERE id =:uid');
		$stmt_delete->bindParam(':uid', $_GET['delete_id']);
		if($stmt_delete->execute())
		{
			?>
			<script>
			alert("DATA HAS BEEN DELETED SUCCESSFULLY");
			window.location.href=('forbiddenaccount.php?logout=ok');

			</script>
			<?php 
		}else 

		?>
			<script>
			alert("YOUR FILE DOESNT DELETE BECAUSE WE ENCOUNTERED ERROR");
			window.location.href=('modifypost.php');
			</script>
			<?php 

	}

	?>


<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "22%";
  document.getElementById("mySidebar").style.width = "20%";
  document.getElementById("mySidebar").style.color = "red";
  document.getElementById("test").style.marginTop = "-7%";
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
    


   

</body>
</html>