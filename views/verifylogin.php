
<?php

if($_GET['login']="failed"){
    
    if(!$_SESSION['user']['id']){
     header('Location: logout.php?accessdenied');
    }
     
  }
 
?>