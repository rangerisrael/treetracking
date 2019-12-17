<!DOCTYPE html>
<html>
<head>
	<title>IMPORTING CSV FILE TYPE</title>
</head>
<body>
		<form method="#takedata" enctype="multipart/data-form">
			
			<input type="file" name="csv">

			<input type="submit" name="import" value="UPLOAD">
		</form>
</body>
</html>

<?php
	$status=0;

	if(isset($_POST['import'])){
			if($_FILES['csv']['size']>0){
				$target_file=basename($_FILES['csv']['name']);
				$filename=$_FILES['csv']['tmp_name'];
				$target_dir="csvdata/";


				$target_file=$target_dir.basename($_FILES['csv']['name']);

				$upload="0";
				$myfile=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				if($myfile !="csv"){
					echo "<script>alert('YOUR FILETYPE IS NOT VALID');</script>";
				}
				else{
					if(file_exists($target_file)){
						$target_file=$target_dir.rand(0,9). '_' . basename($_FILES['csv']['name']);
						$status=1;
					}
				}

				if($status==1){
						$row=1;
						$count=0;

						if($_FILES['csv']['size']>0){
							$file=fopen(filename, 'r');
							move_uploaded_file($_FILES['csv']['tmp_name'], $target_file);
							
						}
				}


			}
	}


?>