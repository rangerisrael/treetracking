
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="user/css/bootstrap.min.css">
  <script src="user/js/jquery.min.js"></script>
  <script src="user/js/bootstrap.min.js"></script>
  
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


</head>
<body>

<!-- <h2 style=" background: linear-gradient(to bottom, #339933 0%, #00ff00 100%); text-shadow: 0 0 3px #FF0000;" id="log">&nbsp;&nbsp;&nbsp;LOGIN AS</h2> -->
<div id="hide">
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
    echo "<img  style=' border:inset 5px  #FFCC66; margin-left:0.5vw;width:250px; position:relative; top:-4vh; height:150px;' src='profile/".$profile."'  >";

   }
 else{
    echo "<img ' style=' border:inset 5px  #FFCC66; margin-left:0.5vw;width:250px; height:150px;' src='profile/a.jpg'>";   
  }

?>
 

  
 
   

	<?php 


                          

                         
	if(strlen($_SESSION['user']['name']) >6){
		
		echo "<center style='color:yellow; position:absolute; top:17vh;left:3vw; text-shadow: 1px 1px 2px black, 0 0 25px black, 0 0 5px #666600;font-size:20px;'>";
		
		echo ucwords($_SESSION['user']['name']);
		echo "</center>";

  }
  
else{
		echo "<p style='color:blue; position:absolute; top:39vh; left:7vw;'>";
		echo ucwords($_SESSION['user']['name']);
		echo "</p>";
	}
	
	
	

	?>
 
  </h1>
        
        <div class="dropup">
             <a   data-toggle="dropdown"><img src="images/act.png" style="position:relative; cursor:pointer; left:3vw;" width="180" height="100"/></a>
			 <i  class=""></i></button>
                <ul class="dropdown-menu">
                  <li><a href="addaccount.php">ADD ACCOUNT</a></li>
                  <li><a href="modify.php">MODIFY ACCOUNT</a></li>
                 
                 
                </ul>
      </div>

      <div class="dropdown">
            <a   data-toggle="dropdown"><img src="images/b.png" style="position:relative; cursor:pointer; left:4vw;" width="130" height="80"/> </a>
			<i  class=""></i></button>
                <ul class="dropdown-menu">
                 
                  <li><a href="addtree.php">ADD TREE</a></li>
                  <li><a href="showdatatree.php">MODIFY TREE</a></li>
                 
                 
                </ul>
      </div>


      
      <div class="dropdown">
       <a   data-toggle="dropdown"><img src="images/c.png" style="position:relative; cursor:pointer; left:3vw;" width="180" height="100"/> </a>
	  <i class=""></i>
      <ul class="dropdown-menu">
                  <li><a href="post.php" id="post" >ADD POST</a></li>
                  <li><a href="modifypost.php">MODIFY POST</a></li>
                 
                 
                </ul>
      </div>
<div class="dropup">      
  <a   data-toggle="dropdown"><img src="images/a.png" style="position:relative;  cursor:pointer; left:3vw;" width="180" height="100"/> </a>
              <ul class="dropdown-menu">
                
                 <li><a href="map/showmap.php">Show Map</a></li>
                
            </ul>
        
        
         </div>
  
     
         <!-- for the add modal -->
<!-- The Modal -->
  
 
</form>
  </div>
  
</div>  
    
     
  </div>
 
  <script src="js/modaladd.js"></script>
<!--data-->


 
</div>

</div>


</body>

</html>
