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
      

	  <style>
    .error{
   position:absolute; 
   left:44vw;top:20vw;
    width:30vw;
   background:red;
   padding:3vw;
  
    text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px #666600;font-size:20px;
    
    -webkit-animation-name: example; /* Safari 4.0 - 8.0 */
    -webkit-animation-duration: 10s; /* Safari 4.0 - 8.0 */
    animation-name: example;
    animation-duration: 6s;     
    animation-iteration-count: infinite;
}
    /* animating font */
    @-webkit-keyframes example {
        0%   {color: red;   background:white;}
        10%  {color:white;   background:yellow;}
        25%  {color: yellow;   background:red;}
        50%  {color: blue;   background:green;}
        100% {color: green;   background:blue;}
    }
    
    /* Standard syntax */
    @keyframes example {
        0%   {color: red;   background:white;}
        10%  {color:white;   background:yellow;}
        25%  {color: yellow;   background:red;}
        50%  {color: blue;   background:green;}
        100% {color: green;   background:blue;}
      }

    }
 

</style>
  
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
 <a href="user.php"class="btn logout float-right"   style="">USER PAGE</a>


			 <table class="table table-hover table-bordered">
             <?php 
			 include '../models/config.php';
			$stmt=$db_conn->prepare('SELECT * FROM postdata where nameofuser=:name ');
				$stmt->execute(array(':name'=>$_SESSION['user']['name']));
				if($stmt->rowCount()>0)
				{
					while($row=$stmt->fetch(PDO::FETCH_ASSOC))
					{
					
						?>
                        <thead>
                                
							<th>PHOTOS</th>
							<th>POST_TITLE</th>
							<th>POST_DESCRIPTION</th>
							<th>DATE</th>
							<th >Edit</th>
							<th >Delete</th>                              
                        </thead>
			
				<td><a target="_blank" href="uploads/<?php echo $row['photo']?>"><img style="5vw; height:5vw;" src="uploads/<?php echo $row['photo']?>"></td>

								<td ><?php echo $row['title_post']; ?></td>
								<td><?php echo $row['post_desc'];?></td>
								<td><?php echo $row['post_created'];?></td>
			<td><a class="btn btn-info" href="editpost.php?edit_id=<?php echo $row['post_id']?>" title="click for edit" onclick="return confirm('Sure to edit this record')"><span class="glyphicon glyphicone-edit"></span>Edit</a></td>
			<td><a class="btn btn-danger" href="?delete_id=<?php echo $row['post_id']?>" title="click for delete" onclick="return confirm('Sure to delete this record?')">Delete</a></td>
		
                        
            
             	<?php 

				}
			}
			else{
				echo "<div class='error' style='background: linear-gradient(to bottom, #00ffff 0%, #ffffff 100%);' title='To create post go to manage post'  > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOT FOUND</div>";
			}
			?>
           </table>  


		
    

   </div>
</body class="design">


<!-- <div class="footer" style="text-align: center; padding: 10px 10px; color:white;">
	<h1>&copy; ALL RIGHT RESERVE @ 2019</h1>
</div> -->
<script src="js/map.js"></script>
<!-- <script src="js/dropdown.js"></script> -->

</html>
<?php 
	include("../models/config.php");
	if(isset($_GET['delete_id']))
	{
		$stmt_select=$db_conn->prepare('SELECT * FROM postdata WHERE post_id=:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("uploads/".$imgRow['photo']);
		$stmt_delete=$db_conn->prepare('DELETE FROM postdata WHERE post_id =:uid');
		$stmt_delete->bindParam(':uid', $_GET['delete_id']);
		if($stmt_delete->execute())
		{
			?>
			<script>
			alert("DATA HAS BEEN DELETED SUCCESSFULLY");
			window.location.href=('modifypost.php');
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