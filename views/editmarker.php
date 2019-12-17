<?php
 require_once("../models/config.php");



?><?php




$id = intval($_POST['area']);

$stmt_eidt=$db_conn->prepare('SELECT species_profile from gps_data where gps_id=:id');
			$stmt_eidt->execute(array(':id' =>$id));
			$edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC);
			extract($edit_row);





   
?>

<?php
require_once('map/database.php');

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
	

	$conn->updateExistprofile( $id,$species_name,$profile,$location,$sub_location,$tree_height,$diameter,$merchantable_height,$volume, $latitude, $longitude, $tree_category, $planted,$discover,$holder,$treeheath,$code,$remark,$remother);





}



else{


	$images=$_FILES['profile']['name'];
				$tmp_dir=$_FILES['profile']['tmp_name'];
				$imageSize=$_FILES['profile']['size']; 
				$upload_dir='map/gps/';
				$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
				$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
				$sprofile=rand(1000, 1000000).".".$imgExt;
				unlink($upload_dir.$edit_row['species_profile']);
				move_uploaded_file($tmp_dir, $upload_dir.$sprofile);
	
	

	$conn->updateNewprofile( $id,$species_name,$sprofile,$location,$sub_location,$tree_height,$diameter,$merchantable_height,$volume, $latitude, $longitude, $tree_category, $planted,$discover,$holder,$treeheath,$code,$remark,$remother);




	

}


?>
    



