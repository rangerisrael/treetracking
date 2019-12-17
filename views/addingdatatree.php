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
.uid {
    background-color: transparent;
    width:4vw;
    color: black;
    outline: none;
    outline-style: none;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid black 1px;
    padding: 3px 1px;
    
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
<button class="btn btn-warning"><a href="adminpage.php">ADMIN</a></button>
<button class="btn btn-danger float-right"><a href="logout.php">LOGOUT</a></button>
  
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" name="form" method="POST" enctype="multipart/form-data">
                  <div class="panel panel-default">
                     <div class="">
                        <h2 class="text-center"><b>CREATING TREE FIELDS</b></h2>
                     </div>
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
<input id="profile"   type="file" name="profile"  onchange="PreviewImage();"   accept="jpg/png/gif/jpeg/gif"  required="" oninvalid="this.setCustomValidity('PROFILE IS REQUIRED')" oninput="setCustomValidity('')">
Browse Image
</label><br><br><br>


<div style="position: relative; top: 8vh; left:12vw;">
<label>ID</label>
   <!--  <input type="text" class="others" onkeyup="this.value = this.value.toUpperCase();" name="type" style="text-align: center;" placeholder="Input calling name"  > -->
   <select name="type" id="id" style="display: none;"class="others">
     <option>SELECT ADDRESS</option>
                              <option value="maria">MARIA AURORA</option>
                            <option value="baler">BALER AURORA</option>
                         <option value="san luis">SAN LUIS AURORA</option>
                        <option value="dipaculao">DIPACULAO AURORA</option>
                        <option value="casiguran">CASIGURAN AURORA</option>
                          <option value="dingalan">DINGALAN AURORA</option>
                         <option value="dilasag">DILASAG AURORA</option>
                        <option value="dinalungan">DINALUNGAN AURORA</option>

  
  </select>
    
  </div>

<script>
  
$(document).ready(function(){
  $('#id').on('change',function(){

    if(this.value=='maria'){
      $('#casiguran').hide();           
      $('#dilasag').hide();           

      $('#dingalan').hide();           
     
      $('#dinalungan').hide();           
      
      $('#sanluis').hide();           
            $('#dipaculao').hide();   
      $('#maria').show();      
    }

    if(this.value=='baler'){
      $('#casiguran').hide();           
      $('#dilasag').hide();           

      $('#dinalungan').hide();           
            
      $('#sanluis').hide();           
       $('#baler').show();      
      $('#dipaculao').hide();   
      $('#dingalan').hide();           
         
      $('#maria').hide();      
    }
    
     if(this.value=='san luis'){
      $('#casiguran').hide();           
      $('#dilasag').hide();           
      $('#dingalan').hide();           
      $('#dinalungan').hide();           

      $('#sanluis').show();           
      $('#dipaculao').hide();   
      $('#baler').hide();           
      $('#maria').hide();      
    }
    if(this.value=='dipaculao'){
      $('#casiguran').hide();           
      $('#dilasag').hide();           
      $('#dingalan').hide();           
      $('#dinalungan').hide();           
      
      $('#sanluis').hide();           
      $('#dipaculao').show();   
      $('#baler').hide();           
      $('#maria').hide();      
    }
    
    if(this.value=='casiguran'){
      $('#casiguran').show();           
      $('#dilasag').hide();           
      $('#dingalan').hide();           
      $('#dinalungan').hide();           
      
      $('#sanluis').hide();           
      $('#dipaculao').hide();   
      $('#baler').hide();           
      $('#maria').hide();      
    }

    if(this.value=='dilasag'){
      $('#casiguran').hide();           
      $('#dilasag').show();           
      $('#dingalan').hide();           
      $('#dinalungan').hide();           

      $('#sanluis').hide();           
      $('#dipaculao').hide();   
      $('#baler').hide();           
      $('#maria').hide();      
    }
   if(this.value=='dingalan'){
      $('#casiguran').hide();           
      $('#dilasag').hide();           
      $('#dingalan').show();           
      $('#dinalungan').hide();           

      $('#sanluis').hide();           
      $('#dipaculao').hide();   
      $('#baler').hide();           
      $('#maria').hide();      
    }

 if(this.value=='dinalungan'){
      $('#casiguran').hide();           
      $('#dilasag').hide();           
      $('#dingalan').hide();           
      $('#dinalungan').show();           

      $('#sanluis').hide();           
      $('#dipaculao').hide();   
      $('#baler').hide();           
      $('#maria').hide();      
    }


    

});


});



</script>


 <!--   <select name="type" class="others">
    <option value="Baler">3200</option>
    <option value="San Luis">3201</option>
    <option value="Maria Aurora">3202</option>
    <option value="Dipaculao">3203</option>
    <option value="Casiguran">3204</option>
    <option value="Dilasag">3205</option>
    <option value="Dinalungan ">3206</option>
    <option value="Dingalan">3207</option>

  
  </select> -->

<!-- dingalan id -->

<div style="position: relative; top: 10vh; left:12vw; display: none;" id="dinalungan">
  <label>ZIP CODE</label>
   <!--  <input type="text" class="others" onkeyup="this.value = this.value.toUpperCase();" name="type" style="text-align: center;" placeholder="Input calling name"  > -->
<?php
       include('../models/config.php');


    $stmt=$db_conn->prepare('select count(*) as ID from gps_data where location="dingalan"  ');
    
    $result=$stmt->execute();
    //to count and  add 1 to the id
      if (count($result) > 0) {
    while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
        $count=$result['ID']+1;
    }
      }
  
    
    

  
?>

  </select>     <select name="type" class="others">
  
 
    <option value="Dinalungan ">3206</option>
    
  
  </select>
    <input type="text" readonly=""  class="uid" name="genid" value="<?php echo "",str_pad($count,4,'0',STR_PAD_LEFT);?>">
  </div>











<!-- dingalan id -->

<div style="position: relative; top: 10vh; left:12vw; display: none;" id="dingalan">
  <label>ZIP CODE</label>
   <!--  <input type="text" class="others" onkeyup="this.value = this.value.toUpperCase();" name="type" style="text-align: center;" placeholder="Input calling name"  > -->
<?php
       include('../models/config.php');


    $stmt=$db_conn->prepare('select count(*) as ID from gps_data where location="dingalan"  ');
    
    $result=$stmt->execute();
    //to count and  add 1 to the id
      if (count($result) > 0) {
    while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
        $count=$result['ID']+1;
    }
      }
  
    
    

  
?>

  </select>     <select name="type" class="others">
  
 
    <option value="Dingalan">3207</option>

  
  </select>
    <input type="text" readonly=""  class="uid" name="genid" value="<?php echo "",str_pad($count,4,'0',STR_PAD_LEFT);?>">
  </div>

























<!-- dilasag id -->

<div style="position: relative; top: 10vh; left:12vw; display: none;" id="dilasag">
  <label>ZIP CODE</label>
   <!--  <input type="text" class="others" onkeyup="this.value = this.value.toUpperCase();" name="type" style="text-align: center;" placeholder="Input calling name"  > -->
<?php
       include('../models/config.php');


    $stmt=$db_conn->prepare('select count(*) as ID from gps_data where location="dilasag"  ');
    
    $result=$stmt->execute();
    //to count and  add 1 to the id
      if (count($result) > 0) {
    while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
        $count=$result['ID']+1;
    }
      }
  
    
    

  
?>

  </select>     <select name="type" class="others">
  
    <option value="Dilasag">3205</option>
    

  
  </select>
    <input type="text" readonly=""  class="uid" name="genid" value="<?php echo "",str_pad($count,4,'0',STR_PAD_LEFT);?>">
  </div>














<!-- casiguran id -->

<div style="position: relative; top: 10vh; left:12vw; display: none;" id="casiguran">
  <label>ZIP CODE</label>
   <!--  <input type="text" class="others" onkeyup="this.value = this.value.toUpperCase();" name="type" style="text-align: center;" placeholder="Input calling name"  > -->
<?php
       include('../models/config.php');


    $stmt=$db_conn->prepare('select count(*) as ID from gps_data where location="casiguran"  ');
    
    $result=$stmt->execute();
    //to count and  add 1 to the id
      if (count($result) > 0) {
    while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
        $count=$result['ID']+1;
    }
      }
  
    
    

  
?>

  </select>     <select name="type" class="others">
  
   
    <option value="Casiguran">3204</option>
  

  
  </select>
    <input type="text" readonly=""  class="uid" name="genid" value="<?php echo "",str_pad($count,4,'0',STR_PAD_LEFT);?>">
  </div>










<!-- dipaculao id -->

<div style="position: relative; top: 10vh; left:12vw; display: none;" id="dipaculao">
  <label>ZIP CODE</label>
   <!--  <input type="text" class="others" onkeyup="this.value = this.value.toUpperCase();" name="type" style="text-align: center;" placeholder="Input calling name"  > -->
<?php
       include('../models/config.php');


    $stmt=$db_conn->prepare('select count(*) as ID from gps_data where location="dipaculao"  ');
    
    $result=$stmt->execute();
    //to count and  add 1 to the id
      if (count($result) > 0) {
    while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
        $count=$result['ID']+1;
    }
      }
  
    
    

  
?>

  </select>     <select name="type" class="others">
  
    <option value="Dipaculao">3203</option>
    

  
  </select>
    <input type="text" readonly=""  class="uid" name="genid" value="<?php echo "",str_pad($count,4,'0',STR_PAD_LEFT);?>">
  </div>

























<!-- san luid id -->
<div style="position: relative; top: 10vh; left:12vw; display: none;" id="sanluis">
  <label>ZIP CODE</label>
   <!--  <input type="text" class="others" onkeyup="this.value = this.value.toUpperCase();" name="type" style="text-align: center;" placeholder="Input calling name"  > -->
<?php
       include('../models/config.php');


    $stmt=$db_conn->prepare('select count(*) as ID from gps_data where location="san luis"  ');
    
    $result=$stmt->execute();
    //to count and  add 1 to the id
      if (count($result) > 0) {
    while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
        $count=$result['ID']+1;
    }
      }
  
    
    

  
?>

  </select>     <select name="type" class="others">
  
     <option value="San Luis">3201</option>
   

  
  </select>
    <input type="text" readonly=""  class="uid" name="genid" value="<?php echo "",str_pad($count,4,'0',STR_PAD_LEFT);?>">
  </div>




<!-- baler id -->
<div style="position: relative; top: 10vh; left:12vw; display: none;" id="baler">
  <label>ZIP CODE</label>
   <!--  <input type="text" class="others" onkeyup="this.value = this.value.toUpperCase();" name="type" style="text-align: center;" placeholder="Input calling name"  > -->
<?php
       include('../models/config.php');


    $stmt=$db_conn->prepare('select count(*) as ID from gps_data where location="baler"  ');
    
    $result=$stmt->execute();
    //to count and  add 1 to the id
      if (count($result) > 0) {
    while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
        $count=$result['ID']+1;
    }
      }
  
    
    

  
?>

  </select> 
      <select name="type" class="others">
  
     <option value="Baler">3200</option>
  

  
  </select>
    <input type="text" readonly=""  class="uid" name="genid" value="<?php echo "",str_pad($count,4,'0',STR_PAD_LEFT);?>">
  </div>













<!-- maria id -->
<div style="position: relative; top: 10vh; left:12vw; display: none;" id="maria">
  <label>ZIP CODE</label>
   <!--  <input type="text" class="others" onkeyup="this.value = this.value.toUpperCase();" name="type" style="text-align: center;" placeholder="Input calling name"  > -->
<?php
       include('../models/config.php');


    $stmt=$db_conn->prepare('select count(*) as ID from gps_data where location="maria"  ');
    
    $result=$stmt->execute();
    //to count and  add 1 to the id
      if (count($result) > 0) {
    while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
        $count=$result['ID']+1;
    }
      }
  
    
    

  
?>


    <select name="type" class="others">
  
    <option value="Maria Aurora">3202</option>
  

  
  </select>
    <input type="text" readonly=""  class="uid" name="genid" value="<?php echo "",str_pad($count,4,'0',STR_PAD_LEFT);?>">
  </div>
                    <div class="row" style="position: relative; top: 8vh; left: 14vw;">
                        <div class="col-md-3">
                            <br>
                                    <b><label for="species">SPECIES</label></b>
                                  
                    <input type="text" name="species" id="species" class=" species" id="species" placeholder=""  required="" oninvalid="this.setCustomValidity('SPECIES IS IMPORTANT')" oninput="this.setCustomValidity('')">
                      </div>

                        <div class="col-md-3">
                            <br>
                                    <b><label for="species">LOCATION</label></b>
                                  
                    <select class="species" id="location" name="location">
                              <option>SELECT ADDRESS</option>
                              <option value="maria">MARIA AURORA</option>
                            <option value="baler">BALER AURORA</option>
                         <option value="san luis">SAN LUIS AURORA</option>
                        <option value="dipaculao">DIPACULAO AURORA</option>
                        <option value="casiguran">CASIGURAN AURORA</option>
                          <option value="dingalan">DINGALAN AURORA</option>
                         <option value="dilasag">DILASAG AURORA</option>
                        <option value="dinalungan">DINALUNGAN AURORA</option>

                          <option value="others">OTHERS</option>
                    </select>
                    <div style="display: none;" id="loc" name="loc">
                            <b>SPECIFY</b>
                            <input type="text" class="others" placeholder="Location"name="loc" id="loc">
                    </div>


                



                    </div>

<!--  -->

                      <div class="col-md-3">
                            
                             <br>
                                    <b><label for="species">TREE HEIGHT</label></b>
                                  <br>
                     <input type="decimal" name="tree_height" class="height" id="tree_height"  required="" oninvalid="this.setCustomValidity('HEIGHT IS REQUIRED')" oninput="this.setCustomValidity('')" maxlength="5">
                      </div>
    <!--  -->
                  <div class="col-md-2" style="position: relative; left:-15vw;">
                     <b><label for="dba">DIAMETER BREAST &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HEIGHT</label></b>
                        <input type="decimal" maxlength="5" name="dba" class="height" id="dba"  required="" oninvalid="this.setCustomValidity('DIAMETER IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>
                  <!--  -->
                    <div class="col-md-2" >
                     <b><label for="dba">Merchantable Height</label></b>
                        <input type="decimal" maxlength="5" name="mh" class="height" id="mh"  required="" oninvalid="this.setCustomValidity('Merchantable IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>

                     <div class="col-md-2" >
                     <b><label for="dba">Volume Height</label></b>
                        <input type="decimal" maxlength="5" name="volume" class="height" id="volume"  required="" oninvalid="this.setCustomValidity('Volume IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>


                    <div class="col-md-2" style="position: relative; left:-5vw;" >

                     <b><label for="species">GPS READING</label> </b>
                       <select name="reading" id="reading" class="others">
                        <option value="">SELECT COORDINATES</option>
                               <option value="degrees">DEGREE READING</option>
                              <option value="decimal">DECIMAL READING</option>
                       </select>

                       <div style="display: none;" id="deg">
                        <label><b>LATITUDE</b></label></br>
                            DEGREE <input type="decimal" name="latdegree" class="height" maxlength="3">
                            MINUTES  <input type="decimal" name="latminutes" class="height" maxlength="3">
                            SECOND  <input type="decimal" name="latsecond" class="height" maxlength="8">
                            <select id="direction" name="direction">
        <option value="E">E</option>
        
      </select>
                            <br><label><b>Longitude</b></label><br>
                           DEGREE <input type="decimal" name="longdegree" class="data" maxlength="3">
                            MINUTES  <input type="decimal" name="longminutes" class="height" maxlength="3">
                            SECOND  <input type="decimal" name="longsecond" class="height" maxlength="8">
                            <select id="direction" name="direction">
        <option value="N">N</option>
        
      </select>
                       </div>

                     <div style="display: none;" id="decimal">
                           LATITUDE<input type="decimal" name="latitude" class="others" maxlength="20">
                           LONGITUDE<input type="decimal" name="longitude" class="others" maxlength="20">
                    </div>


                  </div>
                   
                    <div class="col-md-2" >
                     <b><label for="dba">TREE CATEGORY</label></b>
                        
                        <select name="category" id="category" class="others">
                            <option value="">CHOOSE CATEGORY</option>
                            <option value="planted">PLANTED</option>
                            <option value="natural">NATURAL</option>
                        </select>

                        <div style="display: none;" id="planted">
                            <b>DATE PLANTED</b><input type="date" class="others" placeholder="date_planted"name="plant" id="planted">
                    </div>

                           <div style="display: none;" id="natural">
                            <b>DATE DISCOVER</b><input type="date" class="others" placeholder="date_discover"name="discover" id="discover">
                    </div>
                  <!--  -->
                    </div>
                      <div class="row">
                       <div class="col-md-1" >
                     <b><label for="dba">HOLDER</label></b>
                        <input type="decimal" maxlength="25" name="owner" class="others" id="owner"  required="" oninvalid="this.setCustomValidity('Holder IS REQUIRED')" oninput="this.setCustomValidity('')">
                  </div>


                  </div>
                  <div class="col-md-2" >
                     <b><label for="dba">TREE HEALTH</label></b>
                       <select name="tree_health" class="others">
                         <option>CHOOSE CONDITION</option>
                          <option value="good">GOOD</option>
                          <option value="bad">BAD</option>
                       </select>
                  </div>
                   <div class="col-md-2" >
                     <b><label for="dba">STEM QUALITY CODE</label></b>
                       <select name="code" class="others">
                        <option>CHOOSE BELOW</option>
                         <option  value="1">CODE 1 Straight cylindrical tree without visible defect</option>
                                <option value="2">CODE 2 Tree with the defect or damages</option>
                                <option    value="3">CODE 3 Tree with several defect or damage</option>
                       </select>

                  </div>

                    <div class="col-md-2" style="position: relative;left:20vw;" >
                     <b><label for="dba">REMARKS</label></b>
                       <select name="remark" id="remark" class="others">
                         <option value="">Choose Below</option>
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
                     <div class="row" style="position: relative;top:20vh; left:45vw;">

                        <button type="reset" name="reset" class="btn btn-primary">RESET</button>&nbsp;&nbsp;
                        <button type="submit" name="register" class="btn btn-danger pull-right">SAVE</button>
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




<?php 
       
       require_once 'config.php';
    
        
        // Set the input fields and error for every fields to empty value to avoid undefined notice.

        function validate($data) { // Input fields validator to avoid XSS and SQL Injection
           $data = trim($data); // remove extra white space(s)
           $data = stripslashes($data); // remove forward and back slashes
           $data = htmlspecialchars($data); // remove special characters
           return $data;
        }
        
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
       








           $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING ); // Validate and autoset $_POST variable(s)
        














          $species=validate($_POST['species']);
          $location=validate($_POST['location']);
           $sublocation=validate($_POST['loc']);
          $tree_height=validate($_POST['tree_height']);
          $diameter=validate($_POST['dba']);
          $meter_height=validate($_POST['mh']);
          $volume=validate($_POST['volume']);

           $gpsreading=validate($_POST['reading']);
           $deglat = x($_POST['latdegree'], $_POST['latminutes'], $_POST['latsecond'], $_POST['direction']);

$deglong = y($_POST['longdegree'], $_POST['longminutes'], $_POST['longsecond'], $_POST['direction']);

          $gps_lat=validate($_POST['latitude']);
          $gps_long=validate($_POST['longitude']);

          $category=validate($_POST['category']);
          $date_planted=validate($_POST['plant']);
           $date_discover=validate($_POST['discover']);
          
          $owner=validate($_POST['owner']);
          $health=validate($_POST['tree_health']);
          $code=validate($_POST['code']);
          $remark=validate($_POST['remark']);
          $remother=validate($_POST['remother']);
          

 

  

        $images=$_FILES['profile']['name'];
    $tmp_dir=$_FILES['profile']['tmp_name'];
    $imageSize=$_FILES['profile']['size'];
    $upload_dir='map/gps/';
    $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
    $valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
    $picProfile=rand(1000, 1000000).".".$imgExt;
        move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
        

 




  $stmtdata = $conn->prepare("INSERT INTO gps_data(
            species_name,
            species_profile,
            location,
            sub_location,
            tree_height,
            dba,
            mh,
            volume,
            gps,
            degreelat,
            degreelong,
            latdecimal,
            longdecimal,
            tree_category,
            date_planted,
            date_discover,
            holder,
            tree_health,
            code,
            remark,
            other_remark,
            date_created
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
    $stmtdata->bind_param("sssssssssssssssssssss",$species,$picProfile,$location,
$sublocation,
$tree_height,
$diameter,
$meter_height,
$volume,
$gpsreading,
$deglat,
$deglong,
$gps_lat,
$gps_long,
$category,
$date_planted,
$date_discover,
$owner,
$health,
$code,
$remark,
$remother
);
  


    
        
        if($stmtdata->execute()){
            echo "<script>alert('New data created');</script>";
        }
    









  

 
              
                    
      }

?>


<?php
function x($degrees = 0, $minutes = 0, $seconds = 0, $direction = 'e') {
  //converts DMS coordinates to decimal
  //returns false on bad inputs, decimal on success
  
  //direction must be n, s, e or w, case-insensitive
  $d = strtolower($direction);
  $ok = array('n', 's', 'e', 'w');
  
  //degrees must be integer between 0 and 180
  if(!is_numeric($degrees) || $degrees < 0 || $degrees > 180) {
    $decimal = false;
  }
  //minutes must be integer or float between 0 and 59
  elseif(!is_numeric($minutes) || $minutes < 0 || $minutes > 59) {
    $decimal = false;
  }
  //seconds must be integer or float between 0 and 59
  elseif(!is_numeric($seconds) || $seconds < 0 || $seconds > 59) {
    $decimal = false;
  }
  elseif(!in_array($d, $ok)) {
    $decimal = false;
  }
  else {
    //inputs clean, calculate
    $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);
    
    //reverse for south or west coordinates; north is assumed
    if($d == 's' || $d == 'w') {
      $decimal *= -1;
    }
  }
  
  return $decimal;
}
?>


<!--  -->

<?php
function y($degrees = 0, $minutes = 0, $seconds = 0, $direction = 'n') {
  //converts DMS coordinates to decimal
  //returns false on bad inputs, decimal on success
  
  //direction must be n, s, e or w, case-insensitive
  $d = strtolower($direction);
  $ok = array('n', 's', 'e', 'w');
  
  //degrees must be integer between 0 and 180
  if(!is_numeric($degrees) || $degrees < 0 || $degrees > 180) {
    $decimal = false;
  }
  //minutes must be integer or float between 0 and 59
  elseif(!is_numeric($minutes) || $minutes < 0 || $minutes > 59) {
    $decimal = false;
  }
  //seconds must be integer or float between 0 and 59
  elseif(!is_numeric($seconds) || $seconds < 0 || $seconds > 59) {
    $decimal = false;
  }
  elseif(!in_array($d, $ok)) {
    $decimal = false;
  }
  else {
    //inputs clean, calculate
    $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);
    
    //reverse for south or west coordinates; north is assumed
    if($d == 's' || $d == 'w') {
      $decimal *= -1;
    }
  }
  
  return $decimal;
}
?>


<!--  -->