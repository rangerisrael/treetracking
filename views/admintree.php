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
#register{


}


</style>
<script src="js/jquery.min.js"></script>
<button class="btn btn-warning"><a href="adminpage.php">ADMIN</a></button>
<button class="btn btn-danger float-right"><a href="logout.php">LOGOUT</a></button>
   <div id="register">
      <div class="container">
         <div class="row">
            <div class="col-md-7 offset-3">
               <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"] ); ?>" name="form" method="POST">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h2 class="text-center">CREATING TREE FIELDS</h2>
                     </div>
                     <div class="panel-body">
						<!-- species data -->
								<div class="form-group form-control">
                                    <label for="species">SPECIES</label>
                                    ( This area is name of tree example:<b> mahogany)</b>
										<input type="text" name="species" id="species" class="form-control" id="species"   required="" oninvalid="this.setCustomValidity('SPECIES IS IMPORTANT')" oninput="this.setCustomValidity('')">
								</div>
                        <!-- location of activities -->
                               
                                <div class="form-group form-control">
                                <label for="location">LOCATION</label> (Fill up this location, example:<b>Pingit Baler Aurora)</b>
                                    <textarea name="location" class="form-control" id="location" cols="70" rows="2"  required="" oninvalid="this.setCustomValidity('Location is required')" oninput="this.setCustomValidity('')"></textarea>
                                </div>

                        <!-- tree height -->
                        <div class="form-group form-control">
                        <label for="species">TREE HEIGHT</label>  (You can use interger or decimal example<b> 0-9,1.0)</b>
                            <input type="number" name="height" class="form-control" id="height"  required="" oninvalid="this.setCustomValidity('HEIGHT IS REQUIRED')" oninput="this.setCustomValidity('')">
                        </div>
                        <!-- diameter tree -->
                        <div class="form-group form-control">
                                    <label for="species">DBA/DIAMETER BREAST HEIGHT</label>(You can use interger or decimal example<b> 0-9,1.0)</b>
										<input type="text" name="dba" class="form-control" id="dba"  required="" oninvalid="this.setCustomValidity('DIAMETER IS REQUIRED')" oninput="this.setCustomValidity('')">
						</div>

                        <!-- meter height of tree -->
                        <div class="form-group form-control">
                                    <label for="species">Merchantable Height</label>(You can use interger or decimal example<b> 0-9,1.0)</b>
										<input type="decimal" name="meter" class="form-control" id="meter"  required="" oninvalid="this.setCustomValidity('Meter Height is required')" oninput="this.setCustomValidity('')">
						</div>
                        <!-- volume size of tree  -->
                        <div class="form-group form-control">
                                    <label for="species">VOLUME</label>(You can use interger or decimal example<b> 0-9,1.0)</b>
										<input type="decimal" name="volume" class="form-control" id="volume"   required="" oninvalid="this.setCustomValidity('Volume is required')" oninput="this.setCustomValidity('')">
                        </div>

                        <div class="form-group form-control">
                                    <label for="species">GPS READING</label> ( <b>latitude</b> or <b>x-axis</b> and <b>longitude</b> or <b>y-axis</b>) example <b>15.8016,121.4595</b>
										<input type="decimal" placeholder="LATITUDE" name="gpslat" class="form-control" id="gpslat"  required="" oninvalid="this.setCustomValidity('COORDINATES LATITUDE IS MISSING')" oninput="this.setCustomValidity('')">
                                        <input type="decimal" placeholder="LONGITUDE" name="gpslong" class="form-control" id="gpslong"  required="" oninvalid="this.setCustomValidity('COORDINATES LONGITUDE IS MISSING')" oninput="this.setCustomValidity('')">
            
                        </div>
					

<!-- for choosing select dropdown box it depend on what tree category it is -->
                        <div class="form-group form-control">
                        <!-- define what trees belong natural or planted -->
                        <label for="treecategory">TREE CATEGORY</label> (Choose only one either <b>PLANTED</b> or <b> NATURAL</b>)
                            <select name="category" id="category"  required="" oninvalid="this.setCustomValidity('TREE CATEGORY IS MISSING')" oninput="this.setCustomValidity('')">
                                    <option>CHOOSE PARTICULAR DATE</option>
                                    <option  value="PLANTED">PLANTED</option>
                                    <option  value="NATURAL">NATURAL</option>
                            </select>
                              <div id="natural" style="display:none;" >
                                     
                                            
                          <label >DATE DISCOVER</label>(Define particular date of planting activities its either planting or discover)example:<b>07/28/1998</b>
                            <input type="date" name="natural"  >
                                     

                            
                             </div>


                             <div id="planted" style="display:none;" >
                          
                                   
                          <label >DATE PLANTED</label>(Define particular date of planting activities its either planting or discover)example:<b>07/28/1998</b>
                            <input type="date" name="planted"  >
                       

                            
                             </div>


                              </div>

                        </div>
                        <!-- what particular date that seedling of tree is planted -->

                        <div class="form-control">
                        <label for="person">NAME OF HOLDER</label>   (Example Owner <b>RAUL BATANG</b>)
                        <input type="text" name="owner" id="owner" placeholder="OWNER" class="form-control" required="" oninvalid="this.setCustomValidity('DEFINE YOUR OWNER')" oninput="this.setCustomValidity('')">
                        
                        </div>
            <!-- define what trees condition is either bad or good-->
                        <div class="form-control form-group">
                        <label for="health">TREE HEALTH</label> (Choose type of condition depend on your tree its either <b>BAD</b> OR <b>GOOD</b>)
                            <select name="condition" id="condition" class="form-control" required="" oninvalid="this.setCustomValidity('HEALTH OF TREE IS NOT DEFINE')" oninput="this.setCustomValidity('')">
                                    <option name="condition" value="good">GOOD</option>
                                    <option name="condition" value="bad">BAD</option>
                            </select>
                        </div>

                        <!-- define the issues that trees happen -->
                        <div class="form-control form-group">
                            <label for="issue">STEM QUALITY CODE OF TREE</label> (Choose one what <b>particular shape</b> that tree is belong)
                            <select name="issue" id="issue" class="form-control" required="" oninvalid="this.setCustomValidity('YOU NOT DEFINE EXACTLY TYPE BELONG')" oninput="this.setCustomValidity('')">
                            
                                <option name="issue" value="1">CODE 1 Straight cylindrical tree without visible defect</option>
                                <option name="issue" value="2">CODE 2 Tree with the defect or damages</option>
                                <option name="issue" value="3">CODE 3 Tree with several defect or damage</option>
                            
                            </select>
                        
                        
                        </div>
                        <div class="form-group form-control">
                                <label for="remark">REMARKS</label>  (Define your issues for the tree data example <b>TRIM,CUT,COPPIECE</b>)
                               <input type="text" name="remark" id="remark" PLACEHOLDER="REMARKS" class="form-control"required="" oninvalid="this.setCustomValidity('define your remarks')" oninput="this.setCustomValidity('')">
                            
                        </div>
                    </div>
                      <br>
                     <div class="panel-footer col-md-9 offset-9">
                        <button type="reset" name="reset" class="btn btn-primary">RESET</button>
                        <button type="submit" name="register" class="btn btn-danger pull-right">SAVE</button>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

<!-- for getting the value  -->
<script>
$(document).ready(function(){
  $('#category').on('change',function(){

    if(this.value=='PLANTED'){

      $('#natural').hide();
         
      $('#planted').show();      
    }
    else if(this.value=='NATURAL'){
     $('#natural').show();
         
      $('#planted').hide();     
      
    }
   
    else{
     $('#natural').hide();
         
      $('#planted').hide();     
      
    }

});


});



</script>




<?php 
       
       require_once '../models/config.php';
    
        
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
          $tree_height=validate($_POST['height']);
          $diameter=validate($_POST['dba']);
          $meter_height=validate($_POST['meter']);
          $volume=validate($_POST['volume']);
          $gps_lat=validate($_POST['gpslat']);
          $gps_long=validate($_POST['gpslong']);
          $category=validate($_POST['category']);
          $owner=validate($_POST['owner']);
          $health=validate($_POST['condition']);
          $code=validate($_POST['issue']);
          $remark=validate($_POST['remark']);
           $date_planted=validate($_POST['planted']);
           $date_discover=validate($_POST['natural']);
          
                function latlongexist($db_conn, $gps_lat,$gps_long)
{
    $userQuery = "SELECT coord_latitude,coord_latitude from treemap_marker  WHERE coord_latitude=:lat AND coord_longitude=:long";
    $stmt = $db_conn->prepare($userQuery);
    $stmt->execute(array(':lat' => $gps_lat,':long'=> $gps_long));
    return !!$stmt->fetch(PDO::FETCH_ASSOC);
}


$exists = latlongexist($db_conn, $gps_lat,$gps_long);
if($exists)
{
   echo "<script>alert('Coordinates has been taken');</script>"; 


} 


  
else{
     $stmt=$db_conn->prepare('INSERT INTO treemap_marker(species,location,tree_height,dba,mh,volume,coord_latitude,coord_longitude,tree_category,date_planted,date_discover,owner_tree,tree_health,stem_quality_code,remarks) VALUES(UCASE(:species),UCASE(:loct),:th,:dba,:mh,:vol,:lat,:long,:th_category,:date_plant,:date_discover,UCASE(:holder),UCASE(:th_health),:stem_code,UCASE(:remark))');
                  $row=  $stmt->execute(array(

                        ':species' => $species,
                        ':loct' =>$location,
                        ':th' => $tree_height,
                        ':dba' =>$diameter,
                        ':mh' =>$meter_height,
                        ':vol' =>$volume,
                        ':lat' =>$gps_lat,
                        ':long' =>$gps_long,
                        ':th_category' =>$category,
                        ':date_plant' =>$date_planted,
                        ':date_discover'=>$date_discover,
                        ':holder' =>$owner,
                        ':th_health' => $health,
                        ':stem_code' =>$code,
                        ':remark' => $remark
                      
                     


                    ));
                    
                    if(!$row){
                        echo "<script>alert('TREES DATA have an error');</script>";
           

                    }
                    else{
                        echo "<script>alert('SAVE SUCCESS');</script>";
                      
                       echo "<script>window.location.href=('showdata.php')</script>";
              
                    }
                // }
                

            
           
                        
                    
                 
               
                 
        

          }
        
 
              
                    
      }

?>