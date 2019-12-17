<?php include('layout/userheader.php');?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SUGGESTIONS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<h3 style="position:relative;top:10vh; left:11vw;"><b>PLEASE ENTER YOUR SUGGESTION BELOW</b></h3>

    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post">
   <center> <textarea style="position:relative; top:10vh; border:2px solid black; font-size:25px; "name="suggest" id="suggest" cols="70" rows="10" maxlength="500" placeholder="type here......"></textarea></center>
   <input type="reset" value="RESET" style="position:relative;top:10vh; background:red; width:7vw; height:6vh; left:75.3vw;">
    <input type="submit" name="save" value="SEND" style="position:relative;top:10vh; background:limegreen; width:7vw; height:6vh; left:75vw;">
    </form>
    
</body>

</html>

<?php
include('../models/config.php');
require_once '../controllers/ipdetect.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

$suggest=$_POST['suggest'];
   
    if($suggest==""){
        echo "<center><div style='font-size:20px;color:white; background:red; width:15vw; margin-top:5vh;'> FIELD REQUIRED</div></center>";
    }
    else{
        $stmt=$db_conn->prepare("INSERT INTO user_suggest(use_pc,ip_address,user_comment,date_suggestion) VALUES(:mac,:ip,:user,NOW())");
        $stmt->execute(array(
            ':mac' =>mac(),
            ':ip' => ip(),
            ':user' => $suggest
        ));

       

      
        echo "<script>
        alert('SUGGESTION HAS BEEN SENT   ');
        window.location.href=('user.php');
        </script>";
       
    }
 
    echo "";
     
    
       


}


?>