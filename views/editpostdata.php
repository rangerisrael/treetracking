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
			header("Location: modifyposts.php");
		}

		if(isset($_POST['btn-save']))

			{

				$title=$_POST['title'];
				$desc=$_POST['desc'];
			
				$images=PATHINFO($_FILES['profile']['name']);

				if (empty($_FILES["profile"]["name"])){
					$profile=$edit_row['photo'];
					$stmt=$db_conn->prepare('UPDATE postdata SET title_post=:title,post_desc=:desc, photo=:uprofile WHERE post_id=:uid');
					$stmt->bindParam(':title', $title);
					$stmt->bindParam(':desc', $desc);
					$stmt->bindParam(':uprofile', $profile);
					$stmt->bindParam(':uid', $id);

					if($stmt->execute())
				{
					?>
					<script type="text/javascript">
						alert('Successfully Update');
						window.location.href="modifyposts.php";
					</script>
					<?php 
				}else 

				?>
				<script type="text/javascript">
						alert('Error updating data');
						window.location.href="modifyposts.php";
					</script>
					<?php 
	
				
				


				}
				else{
				$images=$_FILES['profile']['name'];
				$tmp_dir=$_FILES['profile']['tmp_name'];
				$imageSize=$_FILES['profile']['size']; 
				$upload_dir='uploads/';
				$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
				$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
				$picProfile=rand(100.0, 1000000)".".$imgExt;
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
						window.location.href="modifyposts.php";
					</script>
					<?php 
				}else 

				?>
				<script type="text/javascript">
					alert('Error updating data');
					window.location.href="modifyposts.php";
				</script>
				<?php 

			}

				}

				

	
?>

<div class="headertest w3-light-green">
 


 <img  src="background/headerstest.png" style="height:15vh;width: 100vw;">

</div>

<div class=" w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; position:fixed;background:#5a5b59; background-size:cover;   border-radius: 15px 50px;  font-weight:bold;" id="mySidebar">
  <button class="test w3-bar-item w3-button w3-green"
  onclick="w3_close()">BACK</button>

 <div> <?php include('side.php');?></div>
 
</div>
<div id="main">
<div class="w3-white">

  <button id="openNav" class="w3-button w3-green w3-xlarge" onclick="w3_open()">&#9776;</button>
 

 <div class="edit-form" style="width:20vw; position:absolute;top:30vh; left:40vw; background: #5a5b59;">
			<h1 class="text-center">Edit form </h1>
			<form method="post" enctype="multipart/form-data">
				<label>Title</label>
				<input type="text" name="title" class="form-control" value="<?php echo $title_post; ?>">
				<label>Description</label>
				<input type="text" name="desc" class="form-control" value="<?php echo $post_desc; ?>">
			
				<label>Picture Profile</label>
				<img src="uploads/<?php echo $photo; ?>" class="img-rounded">
				<input type="file" name="profile" value="DASDSA"  accept="*/image">
				<button type="submit" name="btn-save" style="position:relative; left:15.5vw;">Update </button>
				
			</form>
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

</body>
</html>