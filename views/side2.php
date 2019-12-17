
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="user/css/bootstrap.min.css">
  <script src="user/js/jquery.min.js"></script>
  <script src="user/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet"  href="css/style.css"/>

  <script>
   $(document).ready(function(){
    $("#log").hover(function() {
             $(this).css("cursor","pointer");
    $("#log").click(function(){
     
      $("#hide").toggle();
     
});
});
   });
 </script>

<style type="text/css">
 .m1:hover{
  background: green;
  opacity: 1;
 }
</style>
</head>
<body>

<!-- <h2 style=" background: linear-gradient(to bottom, #339933 0%, #00ff00 100%); text-shadow: 0 0 3px #FF0000;" id="log">&nbsp;&nbsp;&nbsp;LOGIN AS</h2> -->

      <h1 style=" color: white;
    text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px #666600;font-size:20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
<?php
  include("../models/config.php");
  $id=$_SESSION['user']['id'];
  $stmt_eidt=$db_conn->prepare('SELECT * FROM security WHERE id=:uid');
  $stmt_eidt->execute(array(':uid'=>$id));
  $edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC);
  extract($edit_row);

  
  if($_SESSION['user']['profile']){
    echo "<img  style='
    border-radius:50%; margin-left:3vw;width:120px; position:relative; top:-5.5vh; height:120px;' src='profile/".$profile."'  >";

   }
 else{
    echo "<img ' style=' border:inset 5px  #FFCC66; margin-left:0.5vw;width:250px; height:150px;' src='profile/".$profile."'>";   
  }

?>
 

  
 
   

	<?php 


    if(strlen($_SESSION['user']['name']) <= 4 ){
    
    echo "<center style='color:green; position:absolute; top:19.8vh;left:2vw; text-shadow: 1px 1px 2px black, 0 0 25px black, 0 0 5px #666600;font-size:20px;'>";
    
    echo ucwords($_SESSION['user']['name']);
    echo "</center>";

   }                      

                         
	if(strlen($_SESSION['user']['name']) >=6){
		
		echo "<center style='color:yellow; position:absolute; top:19.8vh;left:7vw; text-shadow: 1px 1px 2px black, 0 0 25px black, 0 0 5px #666600;font-size:20px;'>";
		
		echo ucwords($_SESSION['user']['name']);
		echo "</center>";

  }
  
else{
		echo "<p style='color:white;  position:absolute; top:14vh; left:7vw;  font-family:'Comics Sans MS',cursive, san-serif;'>";
		echo ucwords($_SESSION['user']['name']);
		echo "</p>";
	}


	
	

	?>
 
  </h1>
        
        <div class="dropdown">
  
             <a   data-toggle="dropdown"><img class="m1" src="background/icon/M1.gif" style="position:relative; cursor:pointer; left:0vw; padding: 10px; " width="100%" height="70"/></a>
			 <i  class=""></i></button>
                <ul class="dropdown-menu" style="position: relative;top: -1.5vh; background: #5a5b59; left: 1vw; ">
                  <li ><a  style="color:black;font-weight: bold;" href="newaccount.php">ADD ACCOUNT</a></li>
                  <li "><a style="color:black;font-weight: bold;" href="modifies.php">MODIFY ACCOUNT</a></li>
                 
                 
                </ul>
      </div>



      <div class="dropdown">
        <br>
            <a   data-toggle="dropdown"><img class="m1" src="background/icon/M2.gif" style="position:relative; cursor:pointer; left:0vw; padding: 10px;" width="100%" height="70"/> </a>
			<i  class=""></i></button>
                <ul class="dropdown-menu" style="position: relative;top: -1.5vh; background: #5a5b59; left: 1vw; ">
                 
                  <li><a style="color:black;font-weight: bold;" href="addtree.php">ADD TREE</a></li>
                  <li><a style="color:black;font-weight: bold;"href="showdatatree.php">MODIFY TREE</a></li>
                 
                 
                </ul>
      </div>


      


      <div class="dropdown"><br>
       <a   data-toggle="dropdown"><img class="m1" src="background/icon/M3.gif" style="position:relative; cursor:pointer; left:0vw; padding: 10px; " width="100%" height="70"/></a>
	  <i class=""></i>
      <ul class="dropdown-menu" style="position: relative;top: -1.5vh; background: #5a5b59; left: 1vw; ">
       
                  <li><a style="color:black;font-weight: bold;" href="addpostingdata.php" id="post" >ADD POST</a></li>
                  <li><a style="color:black;font-weight: bold;" href="addannoucement.php" id="post" >ADD ANNOUNCEMENT</a></li>
                  <li><a style="color: black;font-weight: bold;" href="modifyposts.php">MANAGE POST</a></li>
                  <li><a style="color:black;font-weight: bold;" href="manage_announcement.php">MANAGE ANNOUNCEMENT</a></li>
                 
                 
                </ul>
      </div>

   


<div class="dropup">    <br>
  <a   data-toggle="dropdown"><img class="m1" src="background/icon/M4.gif" style="position:relative;  cursor:pointer; left:0vw; padding: 10px;" width="100%" height="70"/></a>
              <ul class="dropdown-menu" style="position: relative;top: -1.5vh; background: #5a5b59; left: 1vw;  ">
                
                 <li><a style="color:black;font-weight: bold;"href="map/showmap.php">Show Map</a></li>
                
            </ul>
        
        
         </div>
     
       
    <div class="dropup">    <br>
  <a   data-toggle="dropdown"><img class="m1" src="background/icon/M5.gif" style="position:relative;  cursor:pointer; left:0vw; padding: 10px;" width="100%" height="70"/></a>
              <ul class="dropdown-menu" style="position: relative;top: -14vh; background: #5a5b59; left: 1vw; ">
                
                 <li><a style="color:black; font-weight: bold;"href="logout.php?success">Sign Out</a></li>
                 <li><a style="color:black; font-weight: bold;"href="mainpage.php?success">Back</a></li>
                
            </ul>
        
        
         </div>
  
        
 
 

  </div>
  
</div>  
    
     
  </div>



 
</div>

</div>

</body>

</html>
