<?php

include_once 'layout/login.php';
require_once '../controllers/login.controller.php';
session_start();
if ( isset($_SESSION['user']['id']) ) {

   if ( $_SESSION['user']['role_type'] =="ADMIN" ) {

      
      header('location: adminpage.php?login=sucess');
   }
   else{
    $_SESSION['user']['role_type'] =="STAFF";
     header('location: mainpage.php?login=sucess');
   }
   if(!$_SESSION['user']['role_type']=="ADMIN"){
     header('location: forbidden.php?login=sucess');

   }
   if(!$_SESSION['user']['role_type']=="STAFF"){
     header('location: forbidden.php?login=sucess');

   }
}


?>
<script type='text/javascript' src='js/jquery.min.js'></script>
<link rel="stylesheet" href="css/w3.css">
<style>

/*.mySlides {display:none; opacity: 0.8;
    filter: alpha(opacity=80);}*/

</style>

</div>

   <img class="mySlides" src="background/finalback.jpg" style="width:100%;">
  <img class="mySlides" src="background/final9.jpg" style="width:100%;">
  <img class="mySlides" src="background/final7.jpg" style="width:100%;">
  
  <img class="mySlides" src="background/flower.jpg" style="width:100%;">
   <img class="mySlides" src="background/final11.jpg" style="width:100%;">
  <img class="mySlides" src="background/bamboo.jpg" style="width:100%;">


 


</div>
<div >
  <img src="background/ds.gif" style="width:30%; height: 40%; position: absolute;top: 35%; left:37%; opacity: 0.7;  ">
  <div style="width:30%; height: 40%; position: absolute;top: 35%; left:37%;"">
    <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="POST">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h2 class="text-center"style="color:white"><b>LOGIN ACCOUNT</b></h2>
                     </div>
                     <div class="panel-body">
                        <?php echo $general_err; ?>
                        <div class="form-group">
                           <h5 style="color:white"><b>USERNAME</b></h5>
                           <input type="text" placeholder="Username" name="email" style=" border-radius:10px;width:25vw; position:relative; left:2.5vw;" class="form-control <?php echo ( !empty($general_err) ) ? 'error' : ''; ?>" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                        <h5 style="color:white"><b>PASSWORD</b></h5>
                           <input type="password" placeholder="Password" id="pass"  style=" border-radius:10px;width:25vw; position:relative; left:2.5vw;" name="pwd" class="form-control <?php echo ( !empty($general_err) ) ? 'error' : ''; ?>" value="<?php echo $pwd; ?>">
                           <script>
                function show(){
                  var pass=document.getElementById('pass');
                  if(pass.type=="password"){
                      pass.type="text";
                  }
                  else{
                    pass.type="password";
                  }
                }
                </script>
        <input type="checkbox" style="position:relative; top:-2vw; left:28vw;"  class="control" name="title" title="SHOW PASSWORD" onclick="show();"  ><br>

                        </div>
                     </div>
                     <div class="panel-footer">
                        <button type="submit" name="login" class="btn btn-success pull-right">
                           <span class="glyphicon glyphicon-user"></span> Login
                        </button>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>


  </div>
 
</div>
<div>
  
</div>
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
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>


