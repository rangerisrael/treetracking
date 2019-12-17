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
    <link rel="stylesheet" href="css/style.css">

   
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

 <div> <?php include('side.php');?></div>
 
</div>
<div id="main">
<div class="w3-white">

  <button id="openNav" class="w3-button w3-green w3-xlarge" onclick="w3_open()">&#9776;</button>
 

  

 <a href="user.php"class="btn logout float-right"   style="background: #5a5b59;">USER PAGE</a>

<h3><center><b>LIST OF SUGGESTION</b></center></h3>
			 <table class="table table-hover table-bordered">
			  <thead>
                            <tr>    
							<th>Suggestion</th>
							<th>USER ADDRESS</th>
							<th>USE MAC ADDRESS</th>
							<th>DATE</th>
							<th>REMOVE</th>
                            
							    
							</tr>                          
                        </thead>
			
             <?php 
			 include '../models/config.php';
			$stmt=$db_conn->prepare('SELECT * FROM user_suggest ');
				$stmt->execute();
				
				if($stmt->rowCount()>0)
				{
					while($row=$stmt->fetch(PDO::FETCH_ASSOC))
					{
					
						?>
                       <tr>
				
								<td ><?php echo $row['user_comment']; ?></td>
								<td><?php echo $row['ip_address'];?></td>
								<td><?php echo $row['use_pc'];?></td>
								<td><?php echo $row['date_suggestion'];?></td>
								
                                <td><a class="btn btn-danger" href="?delete_id=<?php echo $row['user_id'];?>" title="click for delete" onclick="return confirm('Are you sure you want to delete')">Delete</a></td>
		
                        </tr>
            
             	<?php 

				}
			}
			else{
				echo "<div class='activity' style='text-align:center;background: linear-gradient(to bottom, #00ffff 0%, #ffffff 100%);  height:10vh;padding:5px;' title='To create post go to manage post'  > &nbsp;&nbsp;&nbsp;NO ACTIVIES CREATED</div>";
			}
			?>
           </table>  


		
    

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
<?php 
	include("../models/config.php");
	if(isset($_GET['delete_id']))
	{
		$stmt_select=$db_conn->prepare('SELECT * FROM user_suggest WHERE user_id=:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
	
		$stmt_delete=$db_conn->prepare('DELETE FROM user_suggest WHERE user_id =:uid');
		$stmt_delete->bindParam(':uid', $_GET['delete_id']);
		if($stmt_delete->execute())
		{
			?>
			<script>
			alert("DATA HAS BEEN DELETED SUCCESSFULLY");
			window.location.href=('suggest.php?deletesucess');
			</script>
			<?php 
		}else 

		?>
			<script>
			alert("YOUR FILE DOESNT DELETE BECAUSE WE ENCOUNTERED ERROR");
			window.location.href=('suggest.php?deletefailed');
			</script>
			<?php 

	}

	?>

</body>
</html>