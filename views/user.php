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
    background:url(background/test.jpg);
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
 
  <a style="float: right;"  href="testloginpage.php">LOGIN&nbsp;<img src="user/icon.png" width="20"></a>
  <a href="usersuggestion.php">SUGGESTIONS</a>  
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
<div class="container">
 <?php 

        $stmt=$db_conn->prepare('SELECT * FROM post_announcement ORDER BY announcement_id ASC ');
        $stmt->execute();
        if($stmt->rowCount()>0)
        {
          while($row=$stmt->fetch(PDO::FETCH_ASSOC))
          {
          
            ?>


<br>
  <img class="mySlides w3-animate-fading"  src="pic_announcement/<?php echo $row['post_picture']?>" style="width:100%; top:40vh; border: 5px inset black; ">
    <div style="width:100%; position: relative; "> 

       
</span>
    </div>
             

    
<?php }}else{
  echo "<p style='font-size:40px;position:relative; top:10vh; left:30vw;'>NO POST CREATED </p>";
} ?>


 <?php 

        $stmt=$db_conn->prepare('SELECT announcement_id from post_announcement  ');
        $stmt->execute();
        if($stmt->rowCount()>0)
        {
          while($row=$stmt->fetch(PDO::FETCH_ASSOC))
          {
          
            ?>

    <button style="position: relative; left:36vw;" class="w3-button demo" onclick="currentDiv(<?php echo $row['announcement_id']?>)">
      <?php echo $row['announcement_id']?></button> 
  <?php }} ?>
  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-red", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-red";
}
</script>


<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 5000); // Change image every 2 seconds
}
</script>


  </div>



  </div>
  <?php 

    		$stmt=$db_conn->prepare('SELECT * FROM postdata ORDER BY post_id ');
				$stmt->execute();
				if($stmt->rowCount()>0)
				{
					while($row=$stmt->fetch(PDO::FETCH_ASSOC))
					{
					
						?>
   
 
<div class="gallery" class="w3-card-4" style="position:relative; top:15vh; left:20vw;width:60vw; background: white; height:50vh; padding-bottom:60vh;  border:5px groove green">
  
    <header class="w3-container w3-yellow">
     
              <center><b><?php echo ucwords($row['title_post'])?></b></center>

  </header>
   
<div class="w3-container w3-green">

  <a target="_blank" href="uploads/<?php echo $row['photo']?>">
    <img src="uploads/<?php echo $row['photo']?>" alt="">

  </a>

  <br>
</div>


  <div><i><?php echo ucwords($row['post_desc']);?></i></div><br>
<?php echo 'Date of		 '. '&nbsp;	'. ucwords($row['post_created']);?>
  <div ><?php echo  'Posted by	'. ucwords($row['nameofuser']);?></div>
 


 </div>

 
  <?php 

}
  }
  
else{
	echo "<div class='error' style='position:relative; padding:10px; font-size:22px; top:30vw; left:20vw; width:30vw;background: linear-gradient(to bottom, #00ffff 0%, #ffffff 100%);' title='To create post go to manage post'  > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No activities posted</div>";
}	

?>
 </div>
 </body>
 
 
    <script src="js/jquery-slim.min.js"></script>
    <script src="js/bootstrap.js" rel="stylesheet"></script>

 <script src="js/validationtest.js" rel="stylesheet"></script>


<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>


<script type="text/javascript" src="js/holder.js"></script>



</html>