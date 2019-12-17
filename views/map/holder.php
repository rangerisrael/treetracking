<?php
  require_once("database.php");
  $keyword = strip_tags( $_GET['keyword'] );
  $jsonData = $conn->holderinfo( $keyword );
  print $jsonData;
?>