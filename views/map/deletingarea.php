<?php
 require_once("db.php");

 $id = intval($_POST['areaname']);

 $conn->deleteArea($id);
?>
