<?php
#
   include_once 'layout/userheader.php';
  include_once '../models/config.php';

   
   // The sessions that you're seeing below are the sessions you created in login controller page
   //
   
?>
<?php
#
  
  session_start();
 
?>

<style>
body {
     
  font-family: Arial;
  margin: 0;

    
}

* {
  box-sizing: border-box;
}

img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
.topnav {
  overflow: hidden;
  background-color: #333;
  margin-top:-7vh;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

.background{
        
    margin: 0;
    padding: 0;
    background: #c1c1c1;
    background-size: cover;
    background-position: center;
    font-family: sans-serif;

}
.caurosel{

}


/* main area */
div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 180px;
}
img {
    opacity: 0.8;
    filter: alpha(opacity=50); /* For IE8 and earlier */
}

img:hover {
    opacity: 1.0;
    filter: alpha(opacity=100); /* For IE8 and earlier */
    background:red;
}
div.gallery:hover {
    border: 1px solid #777;
    
}

div.gallery img {
    width: 100%;
    height: 40vh;
}

div.desc {
    padding: 15px;
    text-align: center;
}

.mySlides {display:none; width:100%; height:70vh;}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
 <link href="fonts/font-awesome.min.css" rel="stylesheet" />
 <link href="css/general.css" rel="stylesheet" />
 <link href="css/signin.css" rel="stylesheet" />
   <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
  function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
 </head>
 <body class="background">
<div class="topnav" id="myTopnav">
  <a href="user.php?=home" class="active">Home</a>
 
  <a style="float: right;"  href="mainpage.php">LOGIN&nbsp;<img src="user/icon.png" width="20"></a>
  <a href="usersuggestion.php">SUGGESTIONS</a>  
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>

 </body>
 <h3 style="position:relative;top:10vh; left:16vw;"><b>PLEASE ENTER YOUR SUGGESTION BELOW</b></h3>

    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="post">
   <center> <textarea style="position:relative; top:10vh; border:2px solid black; font-size:25px; "name="suggest" id="suggest" cols="70" rows="10" maxlength="500" placeholder="type here......"></textarea></center>
   <input type="reset" value="RESET" style="position:relative;top:10vh; background:red; width:7vw; height:6vh; left:70.3vw;">
    <input type="submit" name="save" value="SEND" style="position:relative;top:10vh; background:limegreen; width:7vw; height:6vh; left:70vw;">
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
 


