<?php
 require_once("../models/config.php");



?><?php




$id = intval($_POST['area']);

$stmt_eidt=$db_conn->prepare('SELECT  species_profile from gps_data where gps_id=:id');
			$stmt_eidt->execute(array(':id' =>$id));
			$edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC);
			extract($edit_row);





   
?>

<?php
require_once('map/db.php');

$images=PATHINFO($_FILES['profile']['name']);
$species_name=strip_tags($_POST['species']);
$location=strip_tags($_POST['location']);
$sub_location=strip_tags($_POST['loc']);

$tree_height=strip_tags($_POST['tree_height']);
$diameter=strip_tags($_POST['dba']);
$merchantable_height=strip_tags($_POST['mh']);
$volume=strip_tags($_POST['volume']);
$latitude=strip_tags($_POST['latitude']);
$longitude=strip_tags($_POST['longitude']);


$tree_category=strip_tags($_POST['category']);

$planted=strip_tags($_POST['plant']);
$discover=strip_tags($_POST['discover']);

$holder=strip_tags($_POST['owner']);
$treeheath=strip_tags($_POST['tree_health']);
$code=strip_tags($_POST['code']);
$remark=strip_tags($_POST['remark']);
$remother=strip_tags($_POST['remother']);

if (empty($_FILES["profile"]["name"])){
	$profile=$edit_row['species_profile'];
	

	
$stmt=$db_conn->prepare('UPDATE gps_data set species_name=:name,species_profile=:profile,location=:location,sub_location=:sub,tree_height:tr,dba=:dba,mh=:mh,volume=:vol,latdecimal=:lat,longdecimal=:long,tree_category=:tc,date_planted=:date_planted,date_discover=:discover,holder=:hold,tree_health=:th,code=:code,remark=:remark,other_remark=:other');

	$stmt->bindParam(':name', $species_name);
	$stmt->bindParam(':profile', $profile);
	$stmt->bindParam(':location', $location);
	$stmt->bindParam(':sub', $sub_location);
	$stmt->bindParam(':tr', $tree_height);
	$stmt->bindParam(':dba', $diameter);
	$stmt->bindParam(':mh', $merchantable_height);
	$stmt->bindParam(':vol', $volume);
	$stmt->bindParam(':lat', $latitude);
	$stmt->bindParam(':long', $longitude);
	$stmt->bindParam(':tc', $tree_category);
	$stmt->bindParam(':date_planted', $planted);
	$stmt->bindParam(':discover', $discover);
	$stmt->bindParam(':hold', $holder);
	$stmt->bindParam(':th', $treeheath);
	$stmt->bindParam(':code', $code);

	$stmt->bindParam(':remark', $remark);
	$stmt->bindParam(':other', $remother);
	
	if($stmt->execute()){
		echo "<script>alert('test');</script>";
	
	}
			


}



else{


	$images=$_FILES['profile']['name'];
				$tmp_dir=$_FILES['profile']['tmp_name'];
				$imageSize=$_FILES['profile']['size']; 
				$upload_dir='map/gps/';
				$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
				$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
				$species_profile=rand(1000, 1000000).".".$imgExt;
				unlink($upload_dir.$edit_row['species_profile']);
				move_uploaded_file($tmp_dir, $upload_dir.$species_profile);
	
	
		
$stmt=$db_conn->prepare('UPDATE gps_data set species_name=:name,species_profile=:profile,location=:location,tree_height:tr,dba=:dba,mh=:mh,volume=:vol,latdecimal=:lat,longdecimal=:long,tree_category=:tc,date_planted=:date_planted,date_discover=:discover,holder=:hold,tree_health=:th,code=:code,remark=:remark');

	$stmt->bindParam(':name', $species_name);
	$stmt->bindParam(':profile', $species_profile);
	$stmt->bindParam(':location', $location);
	$stmt->bindParam(':tr', $tree_height);
	$stmt->bindParam(':dba', $diameter);
	$stmt->bindParam(':mh', $merchantable_height);
	$stmt->bindParam(':vol', $volume);
	
	
	$stmt->bindParam(':lat', $latitude);
	$stmt->bindParam(':long', $longitude);
	$stmt->bindParam(':tc', $tree_category);
	$stmt->bindParam(':date_planted', $planted);
	$stmt->bindParam(':discover', $discover);
	$stmt->bindParam(':hold', $holder);
	$stmt->bindParam(':th', $treeheath);
	$stmt->bindParam(':code', $code);
	$stmt->bindParam(':remark', $remark);
	

			if($stmt->execute())
				{
					?>
					<script type="text/javascript">
						alert('Successfully Update');
						window.location.href="showingdata.php";
					</script>
					<?php 
				}else 

				?>
				<script type="text/javascript">
					alert('Error updating data');
					window.location.href="showingdata.php";
				</script>
				<?php 

			
}


?>
    



