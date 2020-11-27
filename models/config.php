<?php

// 	$db_host='localhost';
// 	$db_user='root';
// 	$db_pass='';
// 	$db_name='treetracking';

	$db_host='sql12.freemysqlhosting.net';
	$db_user='sql12378754';
	$db_pass='VB8hK9jQyM';
	$db_name='sql12378754';


	try {
		$db_conn= new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
		$db_conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	}catch(PDOException $e){
		echo $e->getMessage();
	}

?>
