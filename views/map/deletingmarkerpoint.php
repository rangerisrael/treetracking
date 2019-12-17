<?php
 require_once("db.php");

 $id = intval($_POST['area']);

 $conn->deleteCompany($id);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Area deleted</title>
 </head>
 <body>
  <h1>Area has been deleted</h1>
 </body>
</html>