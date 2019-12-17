<?php
  require_once("database.php");
  $keyword = strip_tags( $_GET['keyword'] );
  $jsonData = $conn->fetchmarkerlocation( $keyword );
  print $jsonData;
?>