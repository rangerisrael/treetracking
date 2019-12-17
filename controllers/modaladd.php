<?php

function validate($data) { // Input fields validator to avoid XSS and SQL Injection
    $data = trim($data); // remove extra white space(s)
    $data = stripslashes($data); // remove forward and back slashes
    $data = htmlspecialchars($data); // remove special characters
    return $data;
 }
if(isset($_POST['submit'])){

    $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING ); //validate autoset post
    
    $user=validate($_POST['user']);
    $password=validate($_POST['password']);
    $cpassword=validate($_POST['cpassword']);
    $person=validate($_POST['person']);

    $error=false;
    $errorpass=false;
        if(empty($user) || empty($password) || empty($cpasword) || empty($person)){

            echo "<span style='color:red;'>ALL FIELD REQUIRE</span>";
            $error=true;
        }
        elseif($password!=$word){
            echo "<span style='color:red;'>PASSWORD MISMATCH</span>";
            $errorpass=true;
            
        }
            
        

        
}


?>
<style>
.input-error{
    color:red;
}
</style>
<script>

var error="<?php echo $error;?>";
var errorpass="<?php echo $errorpass;?>";

if(error==true){
    $("#user,#password,#cpassword,#person").addClass("input-error");
}
if(error==false){
    $("#user,#password,#cpassword,#person").val("");

}

if(errorpass==true){
    $("#user,#password,#cpassword,#person").addClass("input-error");
}
if(errorpass==false){
    $("#user,#password,#cpassword,#person").val("");

}
</script>