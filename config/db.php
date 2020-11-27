<?php
		$host="sql12.freemysqlhosting.net";
		$database="sql12378754";
		$user="sql12378754";
		$pass="VB8hK9jQyM";





			  $pdo = new PDO("mysql:dbname={$database};host={$host};port={3306}", $user, $pass);

					if(!$pdo){
						die('connection not set correctly');
					}
?>
