<?php
  require_once("db.php");
  $keyword = strip_tags( $_GET['keyword'] );
  $jsonData = $conn->fetchmarkerinfo( $keyword );
  print $jsonData;
?>