<?php
  require_once '../controllers/ipdetect.php';
require_once '../models/login.model.php';
// Set the input fields and error for every fields to empty value to avoid undefined notice.
$email = $pwd = '';
$general_err = '';

function validate($data) { // Input fields validator to avoid XSS and SQL Injection
   $data = stripslashes($data); // remove forward and back slashes
   $data = htmlspecialchars($data); // remove special characters   
   $data = trim($data); // remove extra white space(s)
   return $data;
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {


   $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING ); // Validate $_POST variable

   $email = validate( $_POST['email'] );
   $pwd = validate( $_POST['pwd'] );

   if ( empty($email) && empty($pwd) ) {
   
      $general_err = '<div style="background:red; color:white; position:relative;top:1vh;" class="alert alert-danger text-center">BOTH FIELD REQUIRED</div>';
   }
    if ( empty($email) && !empty($pwd) ) {
   
     $general_err = '<div style="background:red; color:white; position:relative;top:1vh;" class="alert alert-danger text-center">USERNAME IS REQUIRED</div>';
   
   }
    if ( !empty($email) && empty($pwd) ) {
   
      $general_err = '<div style="background:red; color:white; position:relative;top:1vh;" class="alert alert-danger text-center">PASSWORD IS REQUIRED</div>';
   }
   
 
   else {

      if ( empty($general_err) ) {
         if ( !empty($email) && !empty($pwd) ) {
            // If all fields are clear then execute login function
            $loginUser = Login::loginUser( $email );

            if ( $loginUser->rowCount() > 0 ) {
             
               if ( $row = $loginUser->fetch() ) {
                  // Pass the encrypted pwd from DB to a hashed_pwd var.
                  $data= $row->pwd;
                $hash=password_verify($pwd,$data);
                  // If hashed_pwd has been verified and matched to the pwd var, then login the user
                  if ($hash==$data){
                    $id=$row->id;
                    $user= "ASSIGNED ACCOUNT ".$row->username ;
                    $person= "ASSIGNED NAME " .$row->nameofuser;
                    $ip= "IP ADDRESS OF USER " .ip();
                    $mac= "MAC ADDRESS " .mac();
                 
                  $date= "        DATE " .$row->dated;
                  $time= "TIME ". $row->tim;


                  $id=$row->id;
                  $users= $row->username;
                  $persons= $row->nameofuser;
                  $ips= ip();
                  $macs= mac();
               
                
                  
$myfile = fopen("login_log.txt", "w") or die("Unable to open file!");
$txt = "$id  $user  $person $ip $mac  $date $time";
fwrite($myfile, $txt);
fclose($myfile);

                    $loginUser = Login::getuserlog($id,$users,$persons,$ips,$macs);
                  
                    

                     // Start the session of User information
                     session_start();
                     $_SESSION['user']['id'] = $row->id;
                     $_SESSION['user']['username'] = $row->username;
                     $_SESSION['user']['profile'] = $row->profile;
                     $_SESSION['user']['pwd'] = $row->pwd;
                     $_SESSION['user']['name'] = $row->nameofuser;
                     $_SESSION['user']['ip'] = $row->ip_users;
                     $_SESSION['user']['mac'] = $row->mac_user;
                     $_SESSION['user']['role_type']=$row->role_type;

                     $loginadmin=$_SESSION['user']['role_type']=="ADMIN";
                     $loginstaff=$_SESSION['user']['role_type']=="STAFF";
                    
               

                  
                  } else {
                     // If pwd does not verified and does not matched to what the user was typed,
                     // an error will show
                     $general_err = '<div style="background:red; color:white; position:relative;top:1vh;" class="alert alert-danger text-center">PASSWORD IS REQUIRED</div>';
                     $pwd = '';
                  }
               }
			   ////
			   else {

                  die('Something went wrong');
                  exit;
               }
            } else {
               // If the user tries to login a non-existing email in DB,
               // an error will show
               $general_err = '<div style="background:red; color:white; position:relative;top:1vh;" class="alert alert-danger text-center">USER DOES NOT RECOGNIZED</div>';
               $email = '';
               $pwd = '';
            }
         }
      }
   }
}

