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

<?php
   require_once("map/database.php");
 $arr = $conn->getMarkerList();

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
<button class="btn btn-warning"><a href="showingdata.php">ADMIN</a></button>
<button class="btn btn-danger float-right"><a href="logout.php">LOGOUT</a></button>
  
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <form action="editmarker.php" name="form" method="POST" enctype="multipart/form-data">
                  <div class="panel panel-default">
                     <div class="">
                        <h2 class="text-center"><b>UPDATING TREE FIELDS</b></h2>
                     </div>
<?php
        include('../models/config.php');

        $stmt=$db_conn->prepare('select * from gps_data where gps_id=:id');

        $stmt->execute(array(
            ':id'=>$_GET['edit_id']
        ));
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $gps=$row['gps'];
            $category=$row['tree_category'];

         $date_plant=$row['date_planted'];
         $date_discover=$row['date_discover'];

         $remark=$row['other_remark'];
          $profile=$row['species_profile'];
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
             <img id="uploadPreview" style="width:15vw; height:15vw; position:relative; top:5vh; left:40vw; border:outset  5px white"   src="map/gps/<?php echo $profile; ?>" required="" oninvalid="this.setCustomValidity('PROFILE IS REQUIRED')" oninput="setCustomValidity('')" />
  <label class="custom-file-upload" style="position:relative;  top:16vh;left:27.5vw; background:aqua;">
<input id="profile"   type="file" name="profile" id="profile" onchange="PreviewImage();"   accept="image/*"   value="map/gps/'<?php echo $profile;?>'">
Browse Image
</label><br><br><br>
<select name="area" id="area" class="others" style="position:relative; left:20vw;">
 
 <option value="0"> CHOOSE ID</option>
<?php for($i=0; $i < count($arr); $i++) { print '<option value="'.$arr[$i]['gps_id'].'">'.$arr[$i]['gps_id'].' '.$arr[$i]['species_name'].'</option>'; } ?>
</select>
                    <div class="row" style="position: relative; top: 8vh; left: 14vw;">
                        <div class="col-md-3">
                            <br>
                            
                                    <b><label for="species">SPECIES</label></b>
                                  
                    <input type="text"  name="species"  class=" species" id="species" placeholder=""  required="" oninvalid="this.setCustomValidity('SPECIES IS IMPORTANT')" oninput="this.setCustomValidity('')">
                      </div>
                 
                        <div class="col-md-3">
                            <br>
                                    <b><label for="species">LOCATION</label></b>
                                  
                    <select class="species" id="location" value="<?php echo $location?>" name="location"> 
                         
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
                     <div  id="decimal" name="decimal " >
                    <p  id="decimal">DECIMAL COORDINATES</p>
                     
                    <b> LATITUDE</b><input type="decimal" id="deslat"   name="latitude" class="others" maxlength="20">
                    <b>LONGITUDE</b><input type="decimal" id="deslong"  name="longitude" class="others" maxlength="20">
                    </div>
                  <?php }?>

                  <?php if($gps=="degrees"){ ?>
                     <div  id="degree" name="degree">
                       <p id="degree">DEGREE COORDINATES</p>
                          <b> LATITUDE</b><input type="decimal" id="deglat" name="deglat" class="others" maxlength="20">
                           <b>LONGITUDE</b><input type="decimal" id="deglong"  name="deglong" class="others" maxlength="20">
                    </div>
                  <?php }?>
                  </div>



                    </div>

<!--  -->

                      <div class="col-md-3">
                            
                             <br>
                                    <b><label for="species">TREE HEIGHT</label></b>
                                  <br>
                     <input type="decimal"  name="tree_height" class="height" id="tree_height"  required="" oninvalid="this.setCustomValidity('HEIGHT IS REQUIRED')" oninput="this.setCustomValidity('')" maxlength="5">
                      </div>
    <!--  -->
                  <div class="col-md-2" style="position: relative; left:-15vw;">
                     <b><label for="dba">DIAMETER BREAST &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HEIGHT</label></b>
                        <input type="decimal"  maxlength="5" name="dba" class="height" id="dba"  required="" oninvalid="this.setCustomValidity('DIAMETER IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>
                  <!--  -->
                    <div class="col-md-2" >
                     <b><label for="dba">Merchantable Height</label></b>
                        <input type="decimal"  maxlength="5" name="mh" class="height" id="mh"  required="" oninvalid="this.setCustomValidity('Merchantable IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>

                     <div class="col-md-2" >
                     <b><label for="dba">Volume Height</label></b>
                        <input type="decimal"  maxlength="5" name="volume" class="height" id="volume"  required="" oninvalid="" alid="this.setCustomValidity('Volume IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>
              
                
                
                
                </div>

                  
              

                  </div>
                   
                    <div class="col-md-2" style="position:relative; left:40vw;" >
                     <b><label for="dba">TREE CATEGORY</label></b>
                        
                        <select name="category" value="<?php echo $category?>" id="category" class="others">
                           
                            <option value="planted">PLANTED</option>
                            <option value="natural">NATURAL</option>
                        </select>
                      <?php if($category=="planted"){
                        ?>
                        <div style="display: none;" id="planted">
                            <b>DATE PLANTED</b>
                            <input  type="date" class="others" placeholder="date_planted"name="plant" id="plant" value="<?php echo $date_plant;?>">
                  
                        
                    
                    </div>
                    <div style="display: none; position:relative; left:-2vw;" id="natural">
                            <b>DATE DISCOVER</b>
                            <input  type="date" class="others" placeholder="date_discover"name="discover" id="nature" >
                       
                    <?php 
                    }?>
                          <?php if($category=="natural"){?>
                   <div style="display: none; position:relative; left:-2vw;" id="natural">
                            <b>DATE DISCOVER</b><input  type="date" class="others" placeholder="date_discover"name="discover" id="nature" value="<?php echo $date_discover?>">
                        </div>
                        <div style="display: none;" id="planted">
                            <b>DATE PLANTED</b><input  type="date" class="others" placeholder="date_planted"name="plant" id="plant">
                  
                          <?php }?>
                    </div>
                  <!--  -->
                    </div>
                      <div class="row">
                       <div class="col-md-2" style="position:relative;left:57vw; top:-8vh;">
                     <b><label for="dba">HOLDER</label></b>
                        <input type="decimal"  maxlength="25" name="owner" class="others" id="owner"  required="" oninvalid="this.setCustomValidity('Holder IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>


                  </div>
                  <div class="col-md-2" style="position:relative;left:75vw; top:-16vh;" >
                     <b><label for="dba">TREE HEALTH</label></b>
                       <select name="tree_health" id="th" class="others" >
                       
                          <option value="good">GOOD</option>
                          <option value="bad">BAD</option>
                       </select>
                  </div>
                   <div class="col-md-2" style="position:relative;left:13vw; top:-16vh;" >
                     <b><label for="dba">STEM QUALITY CODE</label></b>
                       <select name="code" id="code"  class="others">
                     
                         <option  value="1">1</option>
                                <option value="2">2</option>
                                <option    value="3">3</option>
                       </select>

                  </div>

                    <div class="col-md-2" style="position: relative; top:-24vh;left:30vw;" >
                   
                     <b><label for="dba">REMARKS</label></b>
                       <select name="remark"  id="remark" class="others">
                        
                         <option value="trim">TRIM</option>
                         <option value="cut">CUT</option>
                         <option value="coppiece">Coppiece</option>
                         <option value="others">Others</option>
                       </select>
                        <div style="display: none;" id="specify">
                            <b>SPECIFY</b><input type="text" class="others" value="<?php echo $remark?>" placeholder="remark"name="remother" id="remother">
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

<script >
  $("#area").change(function() {
     for(var i=0;i<arr.length;i++) {
      if(arr[i]['gps_id'] == $('#area').val()) {
           
           
                 $('#deslat').val(arr[i]['latdecimal']);
              $('#deslong').val(arr[i]['longdecimal']);

           
               $('#deglat').val(arr[i]['degreelat']);
               $('#deglong').val(arr[i]['degreelong']);
      
          

       $('#species').val(arr[i]['species_name']);
      

       

          $('#category').val(arr[i]['tree_category']);
      

      
       $('#location').val(arr[i]['location']);

       $('#tree_height').val(arr[i]['tree_height']);
       $('#dba').val(arr[i]['dba']);
       $('#mh').val(arr[i]['mh']);
       $('#volume').val(arr[i]['volume']);
       $('#latitude').val(arr[i]['latitude']);
       $('#longitude').val(arr[i]['longitude']);
       $('#thcategory').val(arr[i]['tree_category']);
       $('#date').val(arr[i]['date_planted']);
       $('#owner').val(arr[i]['holder']);
       $('#th').val(arr[i]['tree_health']);
       $('#code').val(arr[i]['code']);
       $('#remark').val(arr[i]['remark']);

       
 
      
      }
     }
    });
  
    var arr = JSON.parse( '<?php echo json_encode($arr) ?>' );



</script>
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



