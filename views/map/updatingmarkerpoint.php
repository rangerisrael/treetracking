<?php
 require_once("../../models/config.php");



?><?php




$id = intval($_POST['area']);

$stmt_eidt=$db_conn->prepare('SELECT species_profile from markerpoint where point_id=:id');
			$stmt_eidt->execute(array(':id' =>$id));
			$edit_row=$stmt_eidt->fetch(PDO::FETCH_ASSOC);
			extract($edit_row);





   
?>

<?php
require_once('db.php');

$images=PATHINFO($_FILES['profile']['name']);

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


if (empty($_FILES["profile"]["name"])){
	$profile=$edit_row['species_profile'];
	

	$conn->updateExistCompany( $id,$profile,$location,$tree_height,$diameter,$merchantable_height,$volume, $latitude, $longitude, $tree_category, $date,$holder,$treeheath,$code,$remark);





}



else{


	$images=$_FILES['profile']['name'];
				$tmp_dir=$_FILES['profile']['tmp_name'];
				$imageSize=$_FILES['profile']['size']; 
				$upload_dir='marker/';
				$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
				$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
				$species_profile=rand(1000, 1000000).".".$imgExt;
				unlink($upload_dir.$edit_row['species_profile']);
				move_uploaded_file($tmp_dir, $upload_dir.$species_profile);
	
	
	$conn->updateCompany( $id,$species_profile,$location,$tree_height,$diameter,$merchantable_height,$volume, $latitude, $longitude, $tree_category, $date,$holder,$treeheath,$code,$remark);
	

}


?>
    



