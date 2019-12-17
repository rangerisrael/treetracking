<?php

require_once '../models/register_admin.model.php';
  require_once '../controllers/ipdetect.php';
// Set the input fields and error for every fields to empty value to avoid undefined notice.
$username=$password=$person=$cpassword=$role='';
$general_err = $username_err = $person_err = $password_err = $cpassword_err = '';

function validate($data) { // Input fields validator to avoid XSS and SQL Injection
   $data = trim($data); // remove extra white space(s)
   $data = stripslashes($data); // remove forward and back slashes
   $data = htmlspecialchars($data); // remove special characters
   return $data;
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

   $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING ); // Validate and autoset $_POST variable(s)


   $role=  validate($_POST['role']);
   $username=validate($_POST['user']);
   $password = validate( $_POST['password'] );
   $cpassword = validate( $_POST['cpassword'] );
   $person= validate(ucwords($_POST['person']));
   // If all fields are empty then return a general error
   if ( empty($username) && empty($password) && empty($cpassword) && empty($person)) {

      $general_err = "<div class='alert alert-danger text-center'>All fields must be filled out</div>";

   } else {
      // Validate Last name field
      if ( empty($person) ) {

         $username_err = "<span class='text-danger'>Name of user required";

      } elseif ( !preg_match("/^[a-zA-Z ]*$/", $person ) ) {
         // preg_match(chars pattern, var)
         $person_err = "<span class='text-danger'>Only letters and space are allowed</span>";
         $person = '';

      } elseif ( strlen($person) > 50 ) {

         $person_err = "<span class='text-danger'>Please input according to valid value</span>";
         $person = '';

      } else {

         $person_err = '';
      }
      // Validate First name field
    
      // Validate Username field
      if ( empty($username) ) {

         $username_err = "<span class='text-danger'>Username is required</span>";

      } elseif ( !preg_match( "/^[a-zA-Z0-9!@#$%^&*()-_=+,. ]*$/", $username ) ) {

         $username_err = "<span class='text-danger'>Special characters are not allowed</span>";
         $username = '';

      } elseif ( strlen($username) > 50 ) {

         $username_err = "<span class='text-danger'>Please input valid value</span>";
         $username = '';

      } else {

         $countUid = Register::countUid( $username );
         if ( $countUid->rowCount() > 0 ) {

            $username_err = "<span class='text-danger'>Username is already taken</span>";
            $username= '';

         } else {

            $username_err = '';
         }
      }
     
      // Validate Password field
      if ( empty($password) ) {

         $password_err = "<span class='text-danger'>Password is required</span>";

      } elseif ( !preg_match("/^[a-zA-Z0-9!@#$%^&*(),. ]*$/", $password ) ) {

         $password_err = "<span class='text-danger'>Special characters are not allowed</span>";
         $password = '';

      } elseif ( strlen($password) < 5 ) {

         $password_err = "<span class='text-danger'>You must input at least 5 characters above</span>";
         $password = '';

      } else {

         $password_err = '';
      }
      // Validate Confirm Password field
      if ( !empty($password) && empty($cpassword) ) {

         $cpassword_err = "<span class='text-danger'>Please confirm your password</span>";

      } elseif ( $cpassword !== $password ) {

         $cpassword_err = "<span class='text-danger'>Password did not matched! Please try again</span>";
         $cpassword = '';

      } else {

         $cpassword_err = '';
      }
   }
   // If all input and error fields are not empty then register user.
   if ( !empty($person) && !empty($username) && !empty($password) && !empty($cpassword) ) {
      if ( empty($general_err) && empty($person_err) && empty($username_err) && empty($password_err) && empty($cpassword_err) ) {
         // Hash the password for security and loyalty purpose :)
         $ip=ip();
         $mac=  mac();
        
        $hash=password_hash($password,PASSWORD_DEFAULT);
        echo" <script>alert('DATA IS SAVE');</script>";
         $registered = Register::registerUser( $username, $hash,$person,$ip,$mac,$role);
         
   
      
      }
   }
}