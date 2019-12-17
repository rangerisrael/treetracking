<?php


function insert_area()
{
    
    include("../../models/config.php");
    function validate($data) { // Input fields validator to avoid XSS and SQL Injection
        $data = trim($data); // remove extra white space(s)
        $data = stripslashes($data); // remove forward and back slashes
        $data = htmlspecialchars($data); // remove special characters
        return $data;
     }
    
     $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING ); // Validate and autoset $_POST variable(s)
    
    
     
     $tree_area=validate($_POST['areaname']);
     $geo=validate($_POST['geo']);
     $hectare=validate($_POST['hectare']);
    
    


      $stmt = $db_conn->prepare( "INSERT INTO treemap_area(area_name,geopoint,sizeofland) VALUES(:area,:geo,:hec)");
      $stmt->bindParam(':area', $tree_area);
      $stmt->bindParam(':geo', $geo);
      $stmt->bindParam(':hec', $hectare);
   
      if($stmt->execute())
      {
          ?>
          <script type="text/javascript">
              alert('Successfully ADDED');
              window.location.href="addarea.php";
          </script>
          <?php 
      }else 

      ?>
      <script type="text/javascript">
          alert('Error adding data');
          window.location.href="addarea.php";
      </script>
      <?php 

  
      
}

function  insert_marker(){

    include("../../models/config.php");
    function validate($data) { // Input fields validator to avoid XSS and SQL Injection
        $data = trim($data); // remove extra white space(s)
        $data = stripslashes($data); // remove forward and back slashes
        $data = htmlspecialchars($data); // remove special characters
        return $data;
     }
    
     $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING ); // Validate and autoset $_POST variable(s)

        $images=$_FILES['profile']['name'];
		$tmp_dir=$_FILES['profile']['tmp_name'];
		$imageSize=$_FILES['profile']['size'];
		$upload_dir='marker/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
		$picProfile=rand(1000, 1000000).".".$imgExt;
        move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
        
        $species_name=validate($_POST['name']);
        $location=validate($_POST['location']);
        $tree_height=validate($_POST['theight']);
        $diameter=validate($_POST['dba']);
        $meter_height=validate($_POST['mh']);
        $volume_height=validate($_POST['vol']);
        $lat=validate($_POST['latitude']);
        $long=validate($_POST['longitude']);
        $tc=validate($_POST['thcategory']);
        $date=validate($_POST['date']);
        $holder=validate($_POST['owner']);
        $thealth=validate($_POST['thealth']);
        $code=validate($_POST['code']);
        $cause=validate($_POST['remark']);

        function latlongexist($db_conn, $lat,$long)
{
    $userQuery = "SELECT latitude,latitude from markerpoint  WHERE latitude=:lat AND longitude=:long";
    $stmt = $db_conn->prepare($userQuery);
    $stmt->execute(array(':lat' => $lat,':long'=> $long));
    return !!$stmt->fetch(PDO::FETCH_ASSOC);
}


$exists = latlongexist($db_conn, $lat,$long);
if($exists)
{
   echo "<script>alert('Position has been taken');</script>"; 


} 
else{
       
        $marker=$db_conn->prepare('INSERT INTO markerpoint(
           species_profile,
           species_name,
           location,
           tree_height,
           diameter_breast_height,
           merchantable_height,
           volume_height,
           latitude,
           longitude,
           tree_category,
           date_planted,
           name_of_holder,
           tree_health,
           code,
           remark  
        )
        VALUES(
            :sp,
            :sn,
            :loc,
            :tr,
            :dba,
            :mh,
            :vh,
            :lat,
            :long,
            :tc,
            :dt,
            :nm,
            :th,
            :cd,
            :rm
        )')  ;
        $marker->bindParam(':sp',$picProfile);
        $marker->bindParam(':sn',$species_name);
        $marker->bindParam(':loc',$location);        
        $marker->bindParam(':tr',$tree_height);
        $marker->bindParam(':dba',$diameter);
        $marker->bindParam(':mh',$meter_height);
        $marker->bindParam(':vh',$volume_height);
        $marker->bindParam(':lat',$lat);
        $marker->bindParam(':long',$long);
        $marker->bindParam(':tc',$tc);
        $marker->bindParam(':dt',$date);
        $marker->bindParam(':nm',$holder);
        $marker->bindParam(':th',$thealth);
        $marker->bindParam(':cd',$code);
        $marker->bindParam(':rm',$cause);
        
        
        if($marker->execute())
        {
            ?>
            <script type="text/javascript">
                alert('Marker has been ADDED');
                window.location.href="showmap.php";
            </script>
            <?php 
        }else 
  
        ?>
        <script type="text/javascript">
            alert('Error adding data');
            window.location.href="showmap.php";
        </script>
        <?php 

   


}

function updatemarker(){

    include("../../models/config.php");

    $stmt_eidt=$db_conn->prepare('SELECT * FROM markerpoint where point_id');
    $stmt_eidt->execute();
    while($edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC)){
        extract($edit_row);

    }
   

    $images=$_FILES['profile']['name'];
	$tmp_dir=$_FILES['profile']['tmp_name'];
    $imageSize=$_FILES['profile']['size'];
    $upload_dir='marker/';
    $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
    $valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
    $picProfile=rand(1000, 1000000).".".$imgExt;
    unlink($upload_dir.$edit_row['species_profile']);
    move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
    

 $id = intval($_POST['area']);

 
 $location=strip_tags($_POST['location']);
 $tree_height=strip_tags($_POST['theight']);
 $diameter=strip_tags($_POST['dba']);
 $merchantable_height=strip_tags($_POST['mh']);
 $volume=strip_tags($_POST['vol']);
 $latitude=strip_tags($_POST['latitude']);
 $longitude=strip_tags($_POST['longitude']);
$tree_category=strip_tags($_POST['thcategory']);
$date=strip_tags($_POST['date']);
$holder=strip_tags($_POST['owner']);
$treeheath=strip_tags($_POST['thealth']);
$code=strip_tags($_POST['code']);
$remark=strip_tags($_POST['remark']);


$statement = $db_conn->prepare("UPDATE markerpoint SET species_profile = :sp, location= :loc,tree_height= :tr,$diameter_breast_height=:dba ,merchantable_height = :mh, volume_height= :vol, latitude=:lat , longitude = :long,tree_category = :cat ,date_planted = :dt, name_of_holder= :holder, tree_health= :th, code=:cd, remark= :rm where point_id = :id");
$statement->bindParam(':sp',$picProfile);
        $statement->bindParam(':loc',$location);        
        $statement->bindParam(':tr',$tree_height);
        $statement->bindParam(':dba',$diameter);
        $statement->bindParam(':mh',$merchantable_height);
        $statement->bindParam(':vol',$volume);
        $statement->bindParam(':lat',$latitude);
        $statement->bindParam(':long',$longitude);
        $statement->bindParam(':cat',$tree_category);
        $statement->bindParam(':dt',$date);
        $statement->bindParam(':holder',$holder);
        $statement->bindParam(':th',$treeheath);
        $statement->bindParam(':cd',$code);
        $statement->bindParam(':rm',$remark);
        $statement->bindParam(':id',$id);
        
        	




}


}
?>