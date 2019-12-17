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
    background:#daf1ef;
}

</style>
<script src="js/jquery.min.js"></script>
<button class="btn btn-warning"><a href="mainpage.php">ADMIN</a></button>
<button class="btn btn-danger float-right"><a href="logout.php">LOGOUT</a></button>
   <div id="register">
   <?php

   include("../models/config.php");
  
		if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
		{
			$id=$_GET[ 'edit_id'];
			$stmt_update=$db_conn->prepare('SELECT * FROM treemap_marker WHERE marker_id=:uid');
			$stmt_update->execute(array(':uid'=>$id));
			$data=$stmt_update->fetch(PDO::FETCH_ASSOC);
			extract($data);
        }
	

		if(isset($_POST['update'])){

			
          $species=$_POST['species'];
          $location=$_POST['location'];
          $tree_height=$_POST['height'];
          $diameter=$_POST['dba'];
          $meter_height=$_POST['meter'];
          $volume=$_POST['volume'];
          $gps_lat=$_POST['gpslat'];
          $gps_long=$_POST['gpslong'];
          $category=$_POST['category'];
          $date_planted=$_POST['planted'];
           $date_discover=$_POST['natural'];
          $owner=$_POST['owner'];
          $health=$_POST['condition'];
          $code=$_POST['issue'];
          $remark=$_POST['remark'];

if($date_planted==""){
  $stmt=$db_conn->prepare('UPDATE treemap_marker SET species=:species,location=:loct,tree_height=:th,dba=:dba,mh=:mh,volume=:vol,coord_latitude=:lat,coord_longitude=:long,tree_category=:th_category,date_planted=:date_plant,date_discover=:date_discover,owner_tree=:holder,tree_health=:th_health,stem_quality_code=:stem_code,remarks=:remark WHERE marker_id=:id');
                // use bindparam instead execute array
                $stmt->bindParam(':species',   $species);
                $stmt->bindParam(':loct', $location);
                $stmt->bindParam(':th', $tree_height);
                $stmt->bindParam(':dba', $diameter);
                $stmt->bindParam(':mh', $meter_height);
                $stmt->bindParam(':vol', $volume);
                $stmt->bindParam(':lat',  $gps_lat);
                $stmt->bindParam(':long', $gps_long);
                $stmt->bindParam(':th_category',  $category);
                $stmt->bindParam(':date_plant',   $date_planted);
                $stmt->bindParam(':date_discover',   $date_discover );
                $stmt->bindParam(':holder', $owner);
                $stmt->bindParam(':th_health',  $health);
                $stmt->bindParam(':stem_code',  $code);
                $stmt->bindParam(':remark', $remark);
                $stmt->bindParam(':id', $_GET['edit_id']);
             
                if($stmt->execute())
        {
          ?>
          <script type="text/javascript">
            alert('Successfully Update');
            window.location.href="showdata.php";
          </script>
          <?php 
        }else 

        ?>
        <script type="text/javascript">
          alert('Error updating data');
          window.location.href="showdatatree.php";
        </script>

<?php }?>
  
<?php
if($date_discover==""){
  $stmt=$db_conn->prepare('UPDATE treemap_marker SET species=:species,location=:loct,tree_height=:th,dba=:dba,mh=:mh,volume=:vol,coord_latitude=:lat,coord_longitude=:long,tree_category=:th_category,date_planted=:date_plant,date_discover=:date_discover,owner_tree=:holder,tree_health=:th_health,stem_quality_code=:stem_code,remarks=:remark WHERE marker_id=:id');
                // use bindparam instead execute array
                $stmt->bindParam(':species',   $species);
                $stmt->bindParam(':loct', $location);
                $stmt->bindParam(':th', $tree_height);
                $stmt->bindParam(':dba', $diameter);
                $stmt->bindParam(':mh', $meter_height);
                $stmt->bindParam(':vol', $volume);
                $stmt->bindParam(':lat',  $gps_lat);
                $stmt->bindParam(':long', $gps_long);
                $stmt->bindParam(':th_category',  $category);
                $stmt->bindParam(':date_plant',   $date_planted);
                $stmt->bindParam(':date_discover',   $date_discover );
                $stmt->bindParam(':holder', $owner);
                $stmt->bindParam(':th_health',  $health);
                $stmt->bindParam(':stem_code',  $code);
                $stmt->bindParam(':remark', $remark);
                $stmt->bindParam(':id', $_GET['edit_id']);
             
                if($stmt->execute())
        {
          ?>
          <script type="text/javascript">
            alert('Successfully Update');
            window.location.href="showdata.php";
          </script>
          <?php 
        }else 

        ?>
        <script type="text/javascript">
          alert('Error updating data');
          window.location.href="showdata.php";
        </script>

<?php }

else{
  echo "<script>alert('Only one date is allow');</script>";
}

?>
  

<?php
if($date_discover==""){
  $stmt=$db_conn->prepare('UPDATE treemap_marker SET species=:species,location=:loct,tree_height=:th,dba=:dba,mh=:mh,volume=:vol,coord_latitude=:lat,coord_longitude=:long,tree_category=:th_category,date_planted=:date_plant,date_discover=:date_discover,owner_tree=:holder,tree_health=:th_health,stem_quality_code=:stem_code,remarks=:remark WHERE marker_id=:id');
                // use bindparam instead execute array
                $stmt->bindParam(':species',   $species);
                $stmt->bindParam(':loct', $location);
                $stmt->bindParam(':th', $tree_height);
                $stmt->bindParam(':dba', $diameter);
                $stmt->bindParam(':mh', $meter_height);
                $stmt->bindParam(':vol', $volume);
                $stmt->bindParam(':lat',  $gps_lat);
                $stmt->bindParam(':long', $gps_long);
                $stmt->bindParam(':th_category',  $category);
                $stmt->bindParam(':date_plant',   $date_planted);
                $stmt->bindParam(':date_discover',   $date_discover );
                $stmt->bindParam(':holder', $owner);
                $stmt->bindParam(':th_health',  $health);
                $stmt->bindParam(':stem_code',  $code);
                $stmt->bindParam(':remark', $remark);
                $stmt->bindParam(':id', $_GET['edit_id']);
             
                if($stmt->execute())
        {
          ?>
          <script type="text/javascript">
            alert('Successfully Update');
            window.location.href="showdata.php";
          </script>
          <?php 
        }else 

        ?>
        <script type="text/javascript">
          alert('Error updating data');
          window.location.href="showdata.php";
        </script>

<?php }

else{
  echo "<script>alert('Only one date is allow');</script>";
}















    		<?php 
              
    
            }
	

	
?>
      <div class="container">
         <div class="row">
            <div class="col-md-7 offset-3">
               <form  method="POST">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h2 class="text-center">CREATING TREE FIELDS</h2>
                     </div>
                     <div class="panel-body">
						<!-- species data -->
								<div class="form-group form-control">
                                    <label for="species">SPECIES</label>
                                    ( This area is name of tree example:<b> mahogany)</b>
										<input type="text" name="species" class="form-control" id="species"   required="" oninvalid="this.setCustomValidity('SPECIES IS IMPORTANT')" value="<?php echo $species; ?>" oninput="this.setCustomValidity('')">
								</div>
                        <!-- location of activities -->
                               
                                <div class="form-group form-control">
                                <label for="location">LOCATION</label> (Fill up this location, example:<b>Pingit Baler Aurora)</b>
                                    <textarea name="location"  class="form-control" id="location" cols="70" rows="2"  required="" oninvalid="this.setCustomValidity('Location is required')" value="<?php echo $location?>" oninput="this.setCustomValidity('')"><?php echo $location;?></textarea>
                                </div>

                        <!-- tree height -->
                        <div class="form-group form-control">
                        <label for="species">TREE HEIGHT</label>  (You can use interger or decimal example<b> 0-9,1.0)</b>
                            <input type="number" name="height" class="form-control" id="height"  required="" oninvalid="this.setCustomValidity('HEIGHT IS REQUIRED')" oninput="this.setCustomValidity('')" value="<?php echo $tree_height;?>">
                        </div>
                        <!-- diameter tree -->
                        <div class="form-group form-control">
                                    <label for="species">DBA/DIAMETER BREAST HEIGHT</label>(You can use interger or decimal example<b> 0-9,1.0)</b>
										<input type="text" name="dba" class="form-control" id="dba"  required="" oninvalid="this.setCustomValidity('DIAMETER IS REQUIRED')" oninput="this.setCustomValidity('')" value="<?php echo $dba;?>">
						</div>

                        <!-- meter height of tree -->
                        <div class="form-group form-control">
                                    <label for="species">Merchandable Height</label>(You can use interger or decimal example<b> 0-9,1.0)</b>
										<input type="decimal" name="meter" class="form-control" id="meter"  required="" oninvalid="this.setCustomValidity('Meter Height is required')" oninput="this.setCustomValidity('')" value="<?php echo $mh;?>">
						</div>
                        <!-- volume size of tree  -->
                        <div class="form-group form-control">
                                    <label for="species">VOLUME</label>(You can use interger or decimal example<b> 0-9,1.0)</b>
										<input type="decimal" name="volume" class="form-control" id="volume"   required="" oninvalid="this.setCustomValidity('Volume is required')" oninput="this.setCustomValidity('')" value="<?php echo $volume;?>">
                        </div>

                        <div class="form-group form-control">
                                    <label for="species">GPS READING</label> (This filled is your point marker position to te map <b>latitude</b> or <b>x-axis</b> and <b>longitude</b> or <b>y-axis</b>) example <b>121.4595,15.8016</b>
										<input type="decimal" placeholder="LATITUDE" name="gpslat" class="form-control" id="gpslat"  required="" oninvalid="this.setCustomValidity('COORDINATES LATITUDE IS MISSING')" oninput="this.setCustomValidity('')" value="<?php echo $coord_latitude;?>">
                                        <input type="decimal" placeholder="LONGITUDE" name="gpslong" class="form-control" id="gpslong"  required="" oninvalid="this.setCustomValidity('COORDINATES LONGITUDE IS MISSING')" oninput="this.setCustomValidity('')" value="<?php echo $coord_longitude;?>">
            
                        </div>
					

<!-- for choosing select dropdown box it depend on what tree category it is -->
                        <div class="form-group form-control">
                        <!-- define what trees belong natural or planted -->
                        <label for="treecategory">TREE CATEGORY</label> (Choose only one either <b>PLANTED</b> or <b> NATURAL</b>)
           <select name="category" id="category" value="<?php echo $tree_category;?>">
                <option disabled value="<?php echo $tree_category;?>"><?php echo $tree_category;?></option>
                                    <option  value="PLANTED">PLANTED</option>
                                    <option  value="NATURAL">NATURAL</option>
                            </select>
                              <div id="natural" style="display:none;" >
                                     
                                            
                          <label >DATE DISCOVER</label>(Define particular date of planting activities its either planting or discover)example:<b>07/28/1998</b>
                            <input type="date" value="<?php echo $date_discover;?>" name="natural"  >

                                     

                            
                             </div>


                             <div id="planted" style="display:none;" >
                          
                                   
                          <label >DATE PLANTED</label>(Define particular date of planting activities its either planting or discover)example:<b>07/28/1998</b>
                            <input type="date" name="planted" value="<?php echo $date_planted;?>"  >
                       

                            
                             </div>


                              </div>

                        </div>
                        <!-- what particular date that seedling of tree is planted -->


              
                        <div class="form-control">
                        <label for="person">NAME OF HOLDER</label>   (Example Ownner <b>RAUL BATANG</b>)
                        <input type="text" name="owner" id="owner" placeholder="OWNER" class="form-control" required="" oninvalid="this.setCustomValidity('DEFINE YOUR OWNER')" oninput="this.setCustomValidity('')" value="<?php echo $owner_tree;?>">
                        
                        </div>
            <!-- define what trees condition is either bad or good-->
                        <div class="form-group">
                        <label for="health">TREE HEALTH</label> (Choose type of condition depend on your tree its either <b>BAD</b> OR <b>GOOD</b>)
                            <select name="condition" id="condition" class="form-control" required="" oninvalid="this.setCustomValidity('HEALTH OF TREE IS NOT DEFINE')" oninput="this.setCustomValidity('')" value="<?php echo $tree_health;?>">
                                    <option name="condition" value="GOOD">GOOD</option>
                                    <option name="condition" value="BAD">BAD</option>
                            </select>
                        </div>

                        <!-- define the issues that trees happen -->
                        <div class="form-control form-group">
                            <label for="issue">STEM QUALITY CODE OF TREE</label> (Choose one what <b>particular shape</b> that tree is belong)
                            <select name="issue" id="issue" class="form-control" required="" oninvalid="this.setCustomValidity('YOU NOT DEFINE EXACTLY TYPE BELONG')" oninput="this.setCustomValidity('')" value="<?php echo $stem_quality_code?>">
                            
                                <option name="issue" value="1">CODE 1</option>
                                <option name="issue" value="2">CODE 2</option>
                                <option name="issue" value="3">CODE 3</option>
                            
                            </select>
                        
                        
                        </div>
                        <div class="form-group form-control">
                                <label for="remark">REMARKS</label>  (Define your issues for the tree data example <b>TRIM,CUT,COPPIECE</b>)
                               <input type="text" name="remark" id="remark" PLACEHOLDER="REMARKS" class="form-control"required="" oninvalid="this.setCustomValidity('define your remarks')" oninput="this.setCustomValidity('')" value="<?php echo $remarks?>">
                            
                        </div>
                    </div>
                      <br>
                     <div class="panel-footer col-md-9 offset-9">
                        <button type="reset" name="reset" class="btn btn-primary">RESET</button>
                        <button type="submit" name="update" class="btn btn-danger pull-right">SAVE</button>
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
