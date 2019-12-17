<?php


 require_once("db.php");

 $id = intval($_POST['areaname']);
 $geo = strip_tags($_POST['geo']);
 $hectare = strip_tags($_POST['hectare']);

 $conn->updateArea( $id, $geo, $hectare);

?>

    



