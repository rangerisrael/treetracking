<?php
#
   include_once 'layout/header.php';
   require_once '../controllers/register_admin.controller.php';
   require_once '../controllers/ipdetect.php';
  
#
?>

  
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-md-offset-3">
               <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" method="POST">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h2 class="text-center">Create an Account</h2>
                     </div>
                     <div class="panel-body">
                        <?php echo $general_err; ?>
                        <div class="form-group">
                           <label for="lname">USERNAME</label>
                           <input type="text" name="user" class="form-control <?php echo ( !empty($username_error) ) ? 'error' : ''; ?>" value="<?php echo $username; ?>">
                           
                        </div>
                        <div class="form-group">
                           <label for="pwd">PASSWORD</label>
                           <input type="password" name="password" id="pass" class="form-control <?php echo ( !empty($password_err) ) ? 'error' : ''; ?>" value="<?php echo $password; ?>">
							Show Password<input type="checkbox" onclick="show();" />
							
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
                        </div>

                          <div class="form-group">
                           <label for="pwd"> RETYPE PASSWORD</label>
                           <input type="password" name="cpassword" class="form-control <?php echo ( !empty($cpassword_err) ) ? 'error' : ''; ?>" value="<?php echo $cpassword; ?>">
                      
                        </div>
                         <div class="form-group">
                           <label for="pwd"> NAME OF ADMIN USER</label>
                           <input type="text" name="person" class="form-control <?php echo ( !empty($person_err) ) ? 'error' : ''; ?>" value="<?php echo $person; ?>">
                      
                        </div>
                        <div class="form-group">

                           IP ADDRESS OF USER <label for="ip" name="ipaddress" value="<?php echo ip();?>"><?php echo ip();?></label><br>
                           YOUR MAC <label for="mac" name="macaddress" value="<?php echo mac();?>"><?php echo mac();?></label>

                          
                         
                        </div>
                        <div class="form-group">
                           <label for="role">ROLE TYPE</label>
                           <select name="role"><option value="ADMIN" name="role">ADMIN</option></select>
                       
                        </div>
                    
                     </div>
                     <div class="panel-footer">
                     
                        <button type="submit" name="register" class="btn btn-danger pull-right">Register ACCOUNT</button>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   
<?php include_once 'layout/footer.php'; ?>