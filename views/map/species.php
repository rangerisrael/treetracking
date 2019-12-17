<?php
  require_once("database.php");
  $keyword = strip_tags( $_GET['keyword'] );
  $jsonData = $conn->fetchmarkerinfo( $keyword );
  print $jsonData;
?>