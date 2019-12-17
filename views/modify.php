<?php
#
   include_once 'layout/header.php';
   require_once '../controllers/ipdetect.php';
  session_start();
   if ( !$_SESSION['user']['id'] ) {
      // If the user tries to change the url path to an inside-account page without being logged in,
      // It will redirect the user to login page as long as the user is not logging in
      header('location: login.php?attempt=failed');
   }
   // The sessions that you're seeing below are the sessions you created in login controller page
   // T
?>

<script>
function speak(text) {
    var msg = new SpeechSynthesisUtterance();
    var voices = speechSynthesis.getVoices();
    msg.voice = voices[10];
    msg.voiceURI = 'native';
    msg.volume = 5;
    msg.rate = 1;
    msg.pitch = 2;
    msg.text = text;
    msg.lang = 'en-US';

    speechSynthesis.speak(msg);
}
speak('<?php echo strtolower($_SESSION['user']['name']);?>'),
speak('MANAGE INFORMATION ACCOUNT');
speak('this area indicates that you are verified to manipulate user information')


	</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"  href="css/leaflet.css" />
    <link rel="stylesheet" href="css/geocoder.css" />
    <link rel="stylesheet"  href="css/dropdown.css"/>
    <link rel="stylesheet"  href="css/style.css"/>
 
  

    <script type='text/javascript' src='js/jquery.min.js'></script>
    <script type='text/javascript' src='js/leaflet.js'></script>
	  <script type='text/javascript' src='js/esri.js'></script>
	  <script type='text/javascript' src='js/geocoder.js'></script>
	

</style>
</head>

    </script>
<body>
<div class="header">
 

 <img src="img/logos.png" style="width: 15vw; height: 18vh; margin-top: -6vh;">

 <h1 style="width:40vw; height: 18vh; margin-top: -10vh; margin-left: 40vw; color: white;">TREE TRACKING</h1>

</div>
<div class="sidebar">
<?php include('sidebar.php');?>
</div>
 
 <div class="main">
 <script>
function logout(){
    
    var synth = window.speechSynthesis;
 var voices = synth.getVoices();
 var t = "<?php echo 'Your logout'.'good bye';?>";
 var u = new SpeechSynthesisUtterance(t);
 u.onend = function () { console.log("on end!"); }
 u.onerror = function () { console.log("on error!"); }
 u.onpause = function () { console.log("on pause"); }
 u.onresume = function () { console.log("on resume"); }
 u.onstart = function () { console.log("on start"); }
 synth.cancel();
 synth.speak(u);
 setInterval(function () {
     console.log("paused:" + synth.paused + " pending:" + synth.pending + " speak:" + synth.speaking);

 }, 100);
}
	</script>
<div class="log">
<a href="logout.php"class="btn logout float-right" onclick="logout();"  style="">Logout</a>

   

</div>
<br>

<br>
 <div class="account">
                <p>MANAGE INFORMATION ACCOUNT</p>
</div>
<div class="container">

            <div class="row">
            
            <div class="col-md-8 col-md-offset-2">
            <script>
function addvoice(){
    
    var synth = window.speechSynthesis;
 var voices = synth.getVoices();
 var t = "Adding account";
 var u = new SpeechSynthesisUtterance(t);
 u.onend = function () { console.log("on end!"); }
 u.onerror = function () { console.log("on error!"); }
 u.onpause = function () { console.log("on pause"); }
 u.onresume = function () { console.log("on resume"); }
 u.onstart = function () { console.log("on start"); }
 synth.cancel();
 synth.speak(u);
 setInterval(function () {
     console.log("paused:" + synth.paused + " pending:" + synth.pending + " speak:" + synth.speaking);

 }, 100);
}
	
</script>
          
                    <table class="table table-hover table-bordered" style="position:relative; left:-13vw; width:75vw; ">
                        <thead>
                                <tr>
                                <td>PROFILE</td>
                                <td>USERNAME</td>
                                <td>PASSWORD</td>
                                <td>NAME OF USER</td>                                
                                <td>UPDATE</td>
                                <td>REMOVE</td>
                                </tr>
                        </thead>
                        <td><?php
                            include("../models/config.php");
                            $id=$_SESSION['user']['id'];
                            $stmt_eidt=$db_conn->prepare('SELECT * FROM security WHERE id=:uid');
                            $stmt_eidt->execute(array(':uid'=>$id));
                            $edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC);
                            extract($edit_row);
                  
                          if($_SESSION['user']['profile']){

                         
                          echo "<img  style=' border:inset 5px  #FFCC66; margin-left:0.5vw;width:10vw; position:relative; top:-1vh; height:100px;' src='profile/".$profile."'  >";
                          }
                        
                          else{
                              echo "<img  style=' border:inset 5px  #FFCC66; margin-left:0.5vw;width:10vw; position:relative; top:-1vh; height:100px;' src='profile/a.jpg'>";   
 
                          }
 
 ?></td>
                        <td>
                        <?php echo $username;?></td>
                        <td><?php echo $pwd;?><a class="btn btn-success" href="changepassword.php?change_id=<?php echo $_SESSION['user']['id']?>" title="click for edit" onclick="return confirm('Are you sure you want to change your password?')"><span class="glyphicon glyphicone-edit"></span>CHANGE PASSWORD</a></td>
                       
                        <td><?php echo $nameofuser;?></td>
                        <td><a class="btn btn-info" href="editaccount.php?edit_id=<?php echo $_SESSION['user']['id']?>" title="click for edit" onclick="return confirm('Sure to edit this record')"><span class="glyphicon glyphicone-edit"></span>Edit</a></td>
                        <td><a class="btn btn-danger" href="?delete_id=<?php echo $_SESSION['user']['id']?>" title="click for delete" onclick="return confirm('Sure to delete this record?')">Delete</a></td>
                      
                    
                    </table>
            </div>
            
            
            
            </div>  
        
  
   
<!-- modal add function -->
<div id="signup" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <span class="close" style="margin-left:20vw;" data-dismiss="modal" aria-hidden="true">&times;</span>
                        </div>
                        <div style="text-align:center;"class="modal-title" id="view"><br><br>PERSONAL INFORMATION</div>
                        <div class="modal-body">
                        <span id="show" ></span>
                        <div class="form-group">
                        <input type="text" name="" id="user" class="form-control" placeholder="USERNAME"required="" oninvalid="this.setCustomValidity('username is empty')" oninput="this.setCustomValidity('')"><br>
                      
                        </div>
                        <div class="form-group">
                        <input type="password" name="" id="password" class="form-control" placeholder="PASSWORD"><br>
                      
                        
                        </div>
                        <div class="form-group">
                        
                        <input type="password" name="" id="cpassword" class="form-control" placeholder="RETYPE PASSWORD"><br>
                        
                        </div>
                        <div class="form-group">
                        <input type="text" id="name" placeholder="ROLE NAME" class="form-control"><br>
                        
                        
                        </div>
                        <div class="form-group">
                        
                        <input type="file" name="profile" id="profile">
                        
                        </div>
                        IP ADDRESS OF USER <label for="ip" name="ipaddress" value="<?php echo ip();?>"><?php echo ip();?></label><br>
                           YOUR MAC <label for="mac" name="macaddress" value="<?php echo mac();?>"><?php echo mac();?></label>

                          
                        </div>
                        <div class="modal-footer ">
                    
                        <button type="submit"  onclick="validate('add')" style="position:relative;left:-1.5vw;" class="btn btn-primary">SAVE </button>
                     
                    </div>
                
                </div>
        
        </div>

</body>



<!-- <div class="footer" style="text-align: center; padding: 10px 10px; color:white;">
	<h1>&copy; ALL RIGHT RESERVE @ 2019</h1>
</div> -->

<style>
.form-control{
    width:25vw;
}

.modal-backdrop {
  z-index: -1;
}
</style>


<script src="js/map.js"></script>
<!-- <script src="js/dropdown.js"></script> -->

<script>
    $(document).ready(function(){
            $("#add").on('click', function(){
                    $("#signup").modal('show');
            });


    });

//         function validate(key){
//             var user=$('#user');
//             var password=$('#password');
//             var cpassword=$('#cpassword');
//             var nameofuser=$('#name');
//             var profile=$('#profile');
          
        
//             if(isNotEmpty(user) || isNotEmpty(password) || isNotEmpty(cpassword) || isNotEmpty(nameofuser) ){
            
//                 $.ajax({
//                         url:'add.php',
//                         method:'POST',
//                         dataType:'text',
//                         data:{
//                             key:key,
//                             user:user.val(),
//                             password:password.val(),
//                             cpassword:cpassword.val(),
//                             nameofuser:nameofuser.val()
//                         },success:function(response){
//                             alert(response);
//                         }

//                 });
//             }
//         }


//        function isNotEmpty(caller){
//            if(caller.val() ==''){
//                caller.css('border','1px solid red');
//             alert('ALL FILLED REQUIRE');
//                return false;
//            }
//            else{
//                caller.css('border','');
//                return true;
//            }

      
//        }

//        if(user.val()!=''){
//            user.css('border','');
//        }
        
// </script>
</html>

<?php 
	include("../models/config.php");
	if(isset($_GET['delete_id']))
	{
		$stmt_select=$db_conn->prepare('SELECT * FROM security WHERE id=:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("profile/".$imgRow['profile']);
		$stmt_delete=$db_conn->prepare('DELETE FROM security WHERE id =:uid');
		$stmt_delete->bindParam(':uid', $_GET['delete_id']);
		if($stmt_delete->execute())
		{
			?>
			<script>
			alert("DATA HAS BEEN DELETED SUCCESSFULLY");
			window.location.href=('forbiddenaccount.php?logout=ok');

			</script>
			<?php 
		}else 

		?>
			<script>
			alert("YOUR FILE DOESNT DELETE BECAUSE WE ENCOUNTERED ERROR");
			window.location.href=('modifypost.php');
			</script>
			<?php 

	}

	?>

   