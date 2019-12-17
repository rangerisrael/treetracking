<?php

include_once 'layout/login.php';
require_once '../controllers/login.controller.php';
session_start();
if ( isset($_SESSION['user']['id']) ) {

   if ( $_SESSION['user']['id'] ) {

              $role=$_SESSION['user']['role_type'];

              if($role=="ADMIN");
      header('location: mainpage.php?login=sucess');
   }
}

?>
<script type='text/javascript' src='js/jquery.min.js'></script>

<script>
$(document).ready(function() {
    var timeToDisplay = 3000;

    var slideshow = $('#slideshow');
    var urls = [
       'background/back1.png',
       'background/back2.png',
       'background/back3.png',
       'background/back4.png',
       'background/back5.png'
       
     
    ];

    var index = 0;
    var transition = function() {
        var url = urls[index];

        slideshow.css('background-image', 'url(' + url + ')');
        slideshow.css('opacity=0.5');
        index = index + 1;
        if (index > urls.length - 1) {
            index = 0;
        }
    };
    
    var run = function() {
        transition();
        slideshow.fadeIn('fast', function() {
            setTimeout(function() {
                slideshow.fadeOut('fast', run);
            }, timeToDisplay);
        });
    }
        
    run();
});
</script>
<style>
#slideshow {
    
  background-size:cover;
  height:100vh;
  
}


</style>

</div>
<div id="slideshow">
  
</div>
   <div id="register" style="margin-left:35vw; margin-top:-70vh;">
      <div class="container ">
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
               <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="POST">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h2 class="text-center"style="color:white">LOGIN ACCOUNT</h2>
                     </div>
                     <div class="panel-body">
                        <?php echo $general_err; ?>
                        <div class="form-group">
                           <h5 style="color:white">USERNAME</h5>
                           <input type="text" placeholder="Username" name="email" class="form-control <?php echo ( !empty($general_err) ) ? 'error' : ''; ?>" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                        <h5 style="color:white">PASSWORD</h5>
                           <input type="password" placeholder="Password" id="pass" name="pwd" class="form-control <?php echo ( !empty($general_err) ) ? 'error' : ''; ?>" value="<?php echo $pwd; ?>">
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
                        <button type="submit" name="login" class="btn btn-primary pull-right">
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
<?php include_once 'layout/footer.php'; ?>

    