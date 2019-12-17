
<?php 
	require_once '../models/config.php';
		if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
		{
			$id=$_GET[ 'edit_id'];
			$stmt_eidt=$db_conn->prepare('SELECT * FROM postdata WHERE post_id=:uid');
			$stmt_eidt->execute(array(':uid'=>$id));
			$edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC);
			extract($edit_row);
		}else 

		{
			header("Location: index.php");
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
					alert('Error while update data and iamge');
					window.location.href="modifypost.php";
				</script>
				<?php 

			}

	
?>
		