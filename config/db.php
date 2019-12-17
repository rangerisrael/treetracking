<?php
		$host="localhost";
		$database="treetracking";
		$user="root";
		$pass="";





			  $pdo = new PDO("mysql:dbname={$database};host={$host};port={3306}", $user, $pass);

					if(!$pdo){
						die('connection not set correctly');
					}
?>