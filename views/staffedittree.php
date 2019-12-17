<?php


#
   include_once 'layout/headertree.php';
   
#
  session_start();
   if ( !$_SESSION['user']['id'] ) {
      // If the user tries to change the url path to an inside-account page without being logged in,
      // It will redirect the user to login page as long as the user is not logging in
      header('location: forbidden.php?attempt=failed');
   }
   // The sessions that you're seeing below are the sessions you created in login controller page
   // T
?>

<style>
.species {
    background-color: transparent;
    color: black;
    outline: none;
    outline-style: none;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid black 1px;
    padding: 3px 60px;
    
}

.others {
    background-color: transparent;
    color: black;
    outline: none;
    outline-style: none;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid black 1px;
    padding: 3px 10px;
    
}

.height {
    background-color: transparent;
    color: black;
    outline: none;
    width: 7vw;
    outline-style: none;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid black 1px;
    padding: 3px 10px;
    
}

.data {
    background-color: transparent;
    color: black;
    outline: none;
    width: 7vw;
    outline-style: none;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid black 1px;
    padding: 3px 10px;
    
}
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}

</style>
<script src="js/jquery.min.js"></script>
<button class="btn btn-warning"><a href="showdatastaff.php">STAFF</a></button>
<button class="btn btn-danger float-right"><a href="logout.php">LOGOUT</a></button>
  
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" name="form" method="POST" enctype="multipart/form-data">
                  <div class="panel panel-default">
                     <div class="">
                        <h2 class="text-center"><b>CREATING TREE FIELDS</b></h2>
                     </div>

      
<?php
    require_once '../models/config.php';


    $id=$_GET['edit_id'];
      $stmt=$db_conn->prepare('SELECT * from gps_data where gps_id=:id');

      $stmt->bindParam(':id',$id);


      $stmt->execute();

      while($row=$stmt->fetch(PDO::FETCH_ASSOC)){

          $species_name=$row['species_name'];
          $profile=$row['species_profile'];
          $location=$row['location'];

          $tree_height=$row['tree_height'];
          $diameter=$row['dba'];
          $meter=$row['mh'];
          $volume=$row['volume'];
          $gps=$row['gps'];

          $lat=$row['latdecimal'];
          $long=$row['longdecimal'];
          $deglat=$row['degreelat'];
          $deglong=$row['degreelong'];
          $code=$row['code'];
          $holder=$row['holder'];
          $remark=$row['remark'];
          $other=$row['other_remark'];
          $planted=$row['date_planted'];
          $natural=$row['date_discover'];
          $category=$row['tree_category'];
          $tree_health=$row['tree_health'];

      }








       require_once '../models/config.php';
    
        
        // Set the input fields and error for every fields to empty value to avoid undefined notice.

        function validate($data) { // Input fields validator to avoid XSS and SQL Injection
           $data = trim($data); // remove extra white space(s)
           $data = stripslashes($data); // remove forward and back slashes
           $data = htmlspecialchars($data); // remove special characters
           return $data;
        }

  
    $stmt=$db_conn->prepare('SELECT * from gps_data where gps_id=:id');

    $stmt->bindParam(':id',$id);


    $stmt->execute();

        
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {


          
          $species=validate($_POST['species']);
          $location=validate($_POST['location']);
           $sublocation=validate($_POST['loc']);
          $tree_height=validate($_POST['tree_height']);
          $diameter=validate($_POST['dba']);
          $meter_height=validate($_POST['mh']);
          $volume=validate($_POST['volume']);

          //decimal
          $gps_lat=validate($_POST['latitude']);
          $gps_long=validate($_POST['longitude']);


          //degree
          $gps_deglat=validate($_POST['deglat']);
          $gps_deglong=validate($_POST['deglong']);

          $category=validate($_POST['category']);
          $date_planted=validate($_POST['plant']);
           $date_discover=validate($_POST['discover']);
          


          $owner=validate($_POST['owner']);
          $health=validate($_POST['tree_health']);
          $code=validate($_POST['code']);
          $remark=validate($_POST['remark']);
          $remother=validate($_POST['remother']);
          

          $images=PATHINFO($_FILES['profile']['name']);
          
          if($category=="planted"){
          if (empty($_FILES["profile"]["name"])){
              $pic=$profile;
              $stmt=$db_conn->prepare('UPDATE gps_data SET species_name=:name,species_profile=:profile,
              location=:locate,tree_height=:height,
              dba=:diameter,
              degreelat=:deglat,
              degreelong=:deglong,
              mh=:mh,
              volume=:vol,
              date_planted=:planted,
              holder=:holder,
              tree_health=:health,
              code=:code,
              remark=:remarks WHERE gps_id=:id
              '  );



              $stmt->bindParam(':name', $species);
              $stmt->bindParam(':profile', $pic);
              $stmt->bindParam(':locate', $location);        
              $stmt->bindParam(':height', $tree_height);
              $stmt->bindParam(':diameter', $diameter);
              $stmt->bindParam(':deglat', $gps_deglat);
              $stmt->bindParam(':deglong', $gps_deglong);
              $stmt->bindParam(':mh', $meter);        
              $stmt->bindParam(':vol', $volume); 
              $stmt->bindParam(':planted', $date_planted);        
              $stmt->bindParam(':holder', $owner); 
              $stmt->bindParam(':health', $health);
              $stmt->bindParam(':code', $code);        
              $stmt->bindParam(':remarks', $remark);
              $stmt->bindParam(':id', $id);
  
              if($stmt->execute())
            {
              ?>
              <script type="text/javascript">
                alert('Successfully Updated ');
                window.location.href="showdatastaff.php";
              </script>
              <?php 
            }else 
    
            ?>
            <script type="text/javascript">
              alert('Error updating data');
              window.location.href="showdatastaff.php";
            </script>
            <?php 
    
          
          
          }
          }
          
        
          
  else{
          $images=$_FILES['profile']['name'];
          $tmp_dir=$_FILES['profile']['tmp_name'];
          $imageSize=$_FILES['profile']['size'];
          
                     
          $upload_dir='map/gps/';
          $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
          $valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
          $picProfile=rand(1000, 1000000).".".$imgExt;
          unlink($upload_dir.$profile);
          move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
  
            if($category=="natural"){

          $stmt=$db_conn->prepare('UPDATE gps_data SET species_name=:name,species_profile=:profile,
          location=:locate,tree_height=:height,
          dba=:diameter,
          latdecimal=:deglat,
          longdecimal=:deglong,
          mh=:mh,
          volume=:vol,
          date_discover=:discover,
          holder=:holder,
          tree_health=:health,
          code=:code,
          remark=:remarks WHERE gps_id=:id
          '  );


          $stmt->bindParam(':name', $species);
          $stmt->bindParam(':profile', $pic);
          $stmt->bindParam(':locate', $location);        
           $stmt->bindParam(':height', $tree_height);
          $stmt->bindParam(':diameter', $diameter);
          $stmt->bindParam(':deglat', $gps_lat);
          $stmt->bindParam(':deglong', $gps_long);
          $stmt->bindParam(':mh', $meter);        
          $stmt->bindParam(':vol', $volume); 
          $stmt->bindParam(':discover', $date_discover);        
          $stmt->bindParam(':holder', $owner); 
          $stmt->bindParam(':health', $health);
          $stmt->bindParam(':code', $code);        
          $stmt->bindParam(':remarks', $remark);
          $stmt->bindParam(':id', $ids);

            if($stmt->execute())
            {
              ?>
              <script type="text/javascript">
              alert('Successfully Update ');
              
                window.location.href="showdatastaff.php";
              </script>
              <?php 
            }else 
    
            ?>
            <script type="text/javascript">
              alert('Error updating data');
              window.location.href="showdatastaff.php";
            </script>
            <?php 
    
        
      }
    }     
      }

?>



                     <div class="panel-body">
                       <script type="text/javascript">
  function PreviewImage() {
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("profile").files[0]);
  oFReader.onload = function (oFREvent) {
  document.getElementById("uploadPreview").src = oFREvent.target.result;
  };
  };
</script>
						<!-- species data -->
             <img id="uploadPreview" style="width:15vw; height:15vw; position:relative; top:5vh; left:40vw; border:outset  5px white"   src="img/final.jpg" required="" oninvalid="this.setCustomValidity('PROFILE IS REQUIRED')" oninput="setCustomValidity('')" />
  <label class="custom-file-upload" style="position:relative;  top:16vh;left:27.5vw; background:aqua;">
<input id="profile"   type="file" name="profile"  onchange="PreviewImage();"   accept="image/*"   value="gps/'<?php echo $profile;?>'">
Browse Image
</label><br><br><br>
                    <div class="row" style="position: relative; top: 8vh; left: 14vw;">
                        <div class="col-md-3">
                            <br>
                                    <b><label for="species">SPECIES</label></b>
                                  
                    <input type="text" value="<?php echo $species_name;?>" name="species"  class=" species" id="species" placeholder=""  required="" oninvalid="this.setCustomValidity('SPECIES IS IMPORTANT')" oninput="this.setCustomValidity('')">
                      </div>
                 
                        <div class="col-md-3">
                            <br>
                                    <b><label for="species">LOCATION</label></b>
                                  
                    <select class="species" id="location" value="<?php echo $location?>" name="location">
                              <option ><?php echo  strtoupper($location).' AURORA'?></option>
                              <option value="maria">MARIA AURORA</option>
                            <option value="baler">BALER AURORA</option>
                         <option value="san luis">SAN LUIS AURORA</option>
                        <option value="dipaculao">DIPACULAO AURORA</option>
                        <option value="casiguran">CASIGURAN AURORA</option>
                          <option value="others">OTHERS</option>
                    </select>
                    <div style="display: none;" id="loc" name="loc">
                            <b>SPECIFY</b>
                            <input type="text" class="others" placeholder="Location"name="loc" id="loc">
                    </div>
                <div name="gps">
                    <?php if($gps=="decimal"){ ?>
                     <div  id="decimal" >
                    <p  id="decimal">DECIMAL COORDINATES</p>
                     
                    <b> LATITUDE</b><input type="decimal" value="<?php echo $lat?>" name="latitude" class="others" maxlength="20">
                    <b>LONGITUDE</b><input type="decimal" value="<?php echo $long?>" name="longitude" class="others" maxlength="20">
                    </div>
                  <?php }?>

                  <?php if($gps=="degrees"){ ?>
                     <div  id="degree">
                       <p id="degree">DEGREE COORDINATES</p>
                          <b> LATITUDE</b><input type="decimal" value="<?php echo $deglat?>" name="deglat" class="others" maxlength="20">
                           <b>LONGITUDE</b><input type="decimal" value="<?php echo $deglong?>" name="deglong" class="others" maxlength="20">
                    </div>
                  <?php }?>
                  </div>



                    </div>

<!--  -->

                      <div class="col-md-3">
                            
                             <br>
                                    <b><label for="species">TREE HEIGHT</label></b>
                                  <br>
                     <input type="decimal" value="<?php echo $tree_height?>" name="tree_height" class="height" id="tree_height"  required="" oninvalid="this.setCustomValidity('HEIGHT IS REQUIRED')" oninput="this.setCustomValidity('')" maxlength="5">
                      </div>
    <!--  -->
                  <div class="col-md-2" style="position: relative; left:-15vw;">
                     <b><label for="dba">DIAMETER BREAST &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HEIGHT</label></b>
                        <input type="decimal" value="<?php echo $diameter?>" maxlength="5" name="dba" class="height" id="dba"  required="" oninvalid="this.setCustomValidity('DIAMETER IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>
                  <!--  -->
                    <div class="col-md-2" >
                     <b><label for="dba">Merchantable Height</label></b>
                        <input type="decimal" value="<?php echo $meter?>" maxlength="5" name="mh" class="height" id="mh"  required="" oninvalid="this.setCustomValidity('Merchantable IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>

                     <div class="col-md-2" >
                     <b><label for="dba">Volume Height</label></b>
                        <input type="decimal" value="<?php echo $volume?>" maxlength="5" name="volume" class="height" id="volume"  required="" oninvalid="" alid="this.setCustomValidity('Volume IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>
              
                
                
                
                </div>

                  
              

                  </div>
                   
                    <div class="col-md-2" style="position:relative; left:40vw;" >
                     <b><label for="dba">TREE CATEGORY</label></b>
                        
                        <select name="category" value="<?php echo $category?>" id="category" class="others">
                            <option value="<?php echo $category?>"><?php echo strtoupper($category)?></option>
                            <option value="planted">PLANTED</option>
                            <option value="natural">NATURAL</option>
                        </select>
                      <?php if($category=="planted"){
                        ?>
                        <div style="display: none;" id="planted">
                            <b>DATE PLANTED</b><input value="<?php echo $planted;?>" type="date" class="others" placeholder="date_planted"name="plant" id="planted">
                  
                        
                    
                    </div>
                    <div style="display: none; position:relative; left:-2vw;" id="natural">
                            <b>DATE DISCOVER</b><input value="<?php echo $natural;?>" type="date" class="others" placeholder="date_discover"name="discover" id="discover">
                       
                    <?php 
                    }?>
                          <?php if($category=="natural"){?>
                           <div style="display: none; position:relative; left:-2vw;" id="natural">
                            <b>DATE DISCOVER</b><input value="<?php echo $natural;?>" type="date" class="others" placeholder="date_discover"name="discover" id="discover">
                        </div>
                        <div style="display: none;" id="planted">
                            <b>DATE PLANTED</b><input value="<?php echo $planted;?>" type="date" class="others" placeholder="date_planted"name="plant" id="planted">
                  
                          <?php }?>
                    </div>
                  <!--  -->
                    </div>
                      <div class="row">
                       <div class="col-md-2" style="position:relative;left:57vw; top:-8vh;">
                     <b><label for="dba">HOLDER</label></b>
                        <input type="decimal" value="<?php echo $holder?>" maxlength="25" name="owner" class="others" id="owner"  required="" oninvalid="this.setCustomValidity('Holder IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>


                  </div>
                  <div class="col-md-2" style="position:relative;left:75vw; top:-16vh;" >
                     <b><label for="dba">TREE HEALTH</label></b>
                       <select name="tree_health" class="others" value="<?php echo $tree_health?>">
                         <option value="<?php echo $tree_health?>"><?php echo strtoupper($tree_health)?></option>
                          <option value="good">GOOD</option>
                          <option value="bad">BAD</option>
                       </select>
                  </div>
                   <div class="col-md-2" style="position:relative;left:13vw; top:-16vh;" >
                     <b><label for="dba">STEM QUALITY CODE</label></b>
                       <select name="code" value="<?php echo $code;?>" class="others">
                        <option value="<?php $code?>"><?php echo $code?></option>
                         <option  value="1">1</option>
                                <option value="2">2</option>
                                <option    value="3">3</option>
                       </select>

                  </div>

                    <div class="col-md-2" style="position: relative; top:-24vh;left:30vw;" >
                   
                     <b><label for="dba">REMARKS</label></b>
                       <select name="remark" value="<?php $remark?>" id="remark" class="others">
                         <option value=""><?php echo $remark?></option>
                         <option value="trim">TRIM</option>
                         <option value="cut">CUT</option>
                         <option value="coppiece">Coppiece</option>
                         <option value="others">Others</option>
                       </select>
                        <div style="display: none;" id="specify">
                            <b>SPECIFY</b><input type="text" class="others" placeholder="remark"name="remother" id="remother">
                    </div>

                  </div>

							</div>

              </div>
      
                  </div>
                     <div class="row" style="position:relative;top:-15vh; left:45vw;">
        <button type="submit" name="register" class="btn btn-danger pull-right">UPDATE</button>
                        <div class="clearfix"></div>
                     </div>
               </form>
            </div>
         </div>
<!--  -->
<script>
$(document).ready(function(){
  $('#remark').on('change',function(){

   if(this.value=='others'){
       $('#specify').show();  
       

   }
   
    else{
       $('#specify').hide();  

    }
  
});


});



</script>
         <!--  -->
<!--  -->
<script>
$(document).ready(function(){
  $('#category').on('change',function(){

   if(this.value=='planted'){
       $('#planted').show();  
       $('#natural').hide();  

   }
   if(this.value=='natural'){

    $('#planted').hide();  
       $('#natural').show();  


   }

    if(this.value==''){

    $('#planted').hide();  
       $('#natural').hide();  


   }

  
});


});



</script>
    
<!--  -->

  <script>
$(document).ready(function(){
  $('#reading').on('change',function(){

   if(this.value=='degrees'){
       $('#deg').show();  
       $('#decimal').hide();  

   }
   if(this.value=='decimal'){

    $('#deg').hide();  
       $('#decimal').show();  


   }

    if(this.value==''){

    $('#deg').hide();  
       $('#decimal').hide();  


   }

  
});


});



</script>
    

<!-- for getting the value  -->
<script>
$(document).ready(function(){
  $('#location').on('change',function(){

    if(this.value=='others'){

     
         
      $('#loc').show();      
    }
    
   
    else{
     $('#loc').hide();
        
    }

});


});



</script>



