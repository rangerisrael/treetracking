<?php
		include("database.php");



		session_start();


			$data=$pdo->prepare("select * from user_role where username=:user and password=:pass");


			$data->execute(array(':user' => $_POST['username'],':pass' => $_POST['password']));

			if($data->rowCount()==0){
						
						  header('Location: index.php?err=1');

			}
			else{
					$row=$data->fetch(PDO::FETCH_ASSOC);

						
							session_regenerate_id();

								$_SESSION['user_id']= $row['user_id'];
								$_SESSION['username']=$row['username'];
								$_SESSION['password']=$row['password'];
								$_SESSION['user_role']=$row['user_role'];

								session_write_close();

								if($_SESSION['user_role']=="1"){

									header("Location: admin.php");
								}
								if($_SESSION['user_role']=="2"){
									header("Location: user.php");
								}


							
			}


?>