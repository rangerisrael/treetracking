<?php

 class connectToDB
 {
	private $conn;
	public function __construct()
	{
		$config = include 'config.php';
		$this->conn = new mysqli( $config['db']['server'], $config['db']['user'], $config['db']['pass'], $config['db']['dbname']);
		// var_dump($config, $this->conn);
	}
	

	public function addCompany( $company, $details, $latitude, $longitude, $telephone, $keywords)
	{
		  $statement = $this->conn->prepare("INSERT INTO companies( company, details, latitude, longitude, telephone, keywords) VALUES( ?, ?, ?, ?, ?, ?)");
		  $statement->bind_param('ssssss', $company, $details, $latitude, $longitude, $telephone, $keywords);
		  $statement->execute();
		  
		 
	}
	public function getYear(){
		$arr = array();
		$statement = $this->conn->prepare('select timestampdiff(YEAR,date_planted,NOW()) as year  from markerpoint');
		$statement->bind_result( $year);
		$statement->execute();
			while ($statement->fetch()) {
			
				$arr[] = [ "year" => $year];
			}
			return $arr;
	}
	public function getMarkerList()
	{
		  $arr = array();
		  $statement = $this->conn->prepare( "SELECT point_id,species_profile,species_name,location,tree_height, diameter_breast_height,merchantable_height,volume_height,latitude,longitude,tree_category, date_planted,name_of_holder,tree_health,code,remark,YEAR(CURDATE())-YEAR(date_planted) as year from markerpoint order by species_name ASC");
		  $statement->bind_result( $id,$species_profile, $species_name,$location,$tree_height,$diameter,$merchantable_height,$volume, $latitude, $longitude, $tree_category, $date,$holder,$treeheath,$code,$remark,$year);
		  $statement->execute();
		  while ($statement->fetch()) {
			$arr[] = [ "point_id" => $id,
			 "species_profile" => $species_profile, 
			 "species_name" => $species_name,
			  "location" => $location, 
			  "tree_height" => $tree_height, 
			  "diameter_breast_height" => $diameter,
			  "merchantable_height" => $merchantable_height,
			  "volume_height" => $volume,
			  "latitude" => $latitude,
			  "longitude" => $longitude, 
			  "tree_category" => $tree_category,
			   "date_planted" => $date, 
			   "name_of_holder" => $holder,
			   "tree_health" => $treeheath,
			   "code" => $code,
			   "remark" => $remark,
				"year" =>$year
			];
		  }
		 
		  
		  return $arr;
	}
	public function updateCompany( $id,$species_profile,$location,$tree_height,$diameter,$merchantable_height,$volume, $latitude, $longitude, $tree_category, $date,$holder,$treeheath,$code,$remark)
	{
		  $statement = $this->conn->prepare("UPDATE markerpoint SET species_profile = ?, location= ?,tree_height= ?, diameter_breast_height = ?,merchantable_height = ?, volume_height= ?, latitude=? , longitude = ?,tree_category = ?,date_planted = ?, name_of_holder= ?, tree_health= ?, code=?, remark= ? where point_id = ?");
		  $statement->bind_param( 'ssssssssssssssi',$species_profile,$location,$tree_height,$diameter,$merchantable_height,$volume, $latitude, $longitude, $tree_category, $date,$holder,$treeheath,$code,$remark,$id);
		  $statement->execute();
		  if($statement->execute())
          {
              ?>
              <script type="text/javascript">
                  alert('Successfully Updated');
                  window.location.href="showmap.php";
              </script>
              <?php 
          }else 
    
          ?>
          <script type="text/javascript">
              alert('Error updating  data');
              window.location.href="editmarkerpoint.php";
          </script>
          <?php 
    
		  
	}

// get the use field
public function getUserfield()
	{
		
		  $arr = array();
		
		  $statement = $this->conn->prepare( "SELECT point_id,species_profile,species_name,user_role,location,tree_height, diameter_breast_height,merchantable_height,volume_height,latitude,longitude,tree_category, date_planted,name_of_holder,tree_health,code,remark,YEAR(CURDATE())-YEAR(date_planted) as year from markerpoint   order by species_name ASC ");
		  $statement->bind_result( $id,$species_profile, $species_name,$user_role,$location,$tree_height,$diameter,$merchantable_height,$volume, $latitude, $longitude, $tree_category, $date,$holder,$treeheath,$code,$remark,$year);
		  $statement->execute();
		  while ($statement->fetch()) {
			$arr[] = [ "point_id" => $id,
			 "species_profile" => $species_profile, 
			 "species_name" => $species_name,
			 "user_role" =>$user_role,
			  "location" => $location, 
			  "tree_height" => $tree_height, 
			  "diameter_breast_height" => $diameter,
			  "merchantable_height" => $merchantable_height,
			  "volume_height" => $volume,
			  "latitude" => $latitude,
			  "longitude" => $longitude, 
			  "tree_category" => $tree_category,
			   "date_planted" => $date, 
			   "name_of_holder" => $holder,
			   "tree_health" => $treeheath,
			   "code" => $code,
			   "remark" => $remark,
				"year" =>$year
			];
		  }
		 
		  
		  return $arr;
	}


	// 

















	public function updateExistCompany( $id,$profile,$location,$tree_height,$diameter,$merchantable_height,$volume, $latitude, $longitude, $tree_category, $date,$holder,$treeheath,$code,$remark)
	{
		  $statement = $this->conn->prepare("UPDATE markerpoint SET species_profile = ?, location= ?,tree_height= ?, diameter_breast_height = ?,merchantable_height = ?, volume_height= ?, latitude=? , longitude = ?,tree_category = ?,date_planted = ?, name_of_holder= ?, tree_health= ?, code=?, remark= ? where point_id = ?");
		  $statement->bind_param( 'ssssssssssssssi',$profile,$location,$tree_height,$diameter,$merchantable_height,$volume, $latitude, $longitude, $tree_category, $date,$holder,$treeheath,$code,$remark,$id);
		  $statement->execute();
		  if($statement->execute())
          {
              ?>
              <script type="text/javascript">
                  alert('Successfully Updated');
                  window.location.href="showmap.php";
              </script>
              <?php 
          }else 
    
          ?>
          <script type="text/javascript">
              alert('Error updating  data');
              window.location.href="editmarkerpoint.php";
          </script>
          <?php 
    
		  
	}




















	public function deleteCompany($id)
	{
		 $statement = $this->conn->prepare("Delete from markerpoint where point_id = ?");
		 $statement->bind_param('i', $id);
		 $statement->execute();
		 if($statement->execute())
		 {
			 ?>
			 <script type="text/javascript">
				 alert('Successfully Deleted');
				 window.location.href="showmap.php";
			 </script>
			 <?php 
		 }else 
   
		 ?>
		 <script type="text/javascript">
			 alert('Error deleting  data');
			 window.location.href="deletmarkerpoint.php";
		 </script>
		 <?php 
		 
	}
	// public function addStreet( $street, $geo, $keywords)
	// {
	// 	 $statement = $this->conn->prepare("INSERT INTO streets( name, geolocations, keywords) VALUES( ?, ?, ?)");
	// 	 $statement->bind_param( 'sss', $street, $geo, $keywords);
	// 	 $statement->execute();
		
		 
	// }
	// public function getStreetsList()
	// {
	// 	$arr = array();
	// 	$statement = $this->conn->prepare( "SELECT id, name, geolocations, keywords from streets order by name ASC");
	// 	$statement->bind_result( $id, $name, $geolocations, $keywords);
	// 	$statement->execute();
	// 	while ($statement->fetch()) {
	// 	$arr[] = [ "id" => $id, "name" => $name, "geolocations" => $geolocations, "keywords" => $keywords];
	// 	}
		
		
	// 	return $arr;
	// }
	// public function updateStreet( $id, $geo, $keywords)
	// {
	// 	  $statement = $this->conn->prepare( "UPDATE streets SET geolocations = ?, keywords = ? where id = ?");
	// 	  $statement->bind_param( 'ssi', $geo, $keywords, $id);
	// 	  $statement->execute();
		
		  
	// }
	// public function deleteStreet($id)
	// {
	// 	 $statement = $this->conn->prepare("Delete from streets where id = ?");
	// 	 $statement->bind_param('i', $id);
	// 	 $statement->execute();
		
		 
	// }
	public function addArea( $area, $geo, $hectare)
	{
		  $statement = $this->conn->prepare( "INSERT INTO treemap_area( area_name, geopoint, sizeofland ) VALUES(?,?,?)");
		  $statement->bind_param( 'sss', $area, $geo,$hectare);
		  $statement->execute();
		  
		  
	}
	public function getAreasList()
	{
		  $arr = array();
		  $statement = $this->conn->prepare( "SELECT area_id, area_name, geopoint, sizeofland from treemap_area order by area_name ASC");
		  $statement->bind_result( $id, $area_name, $geopoint, $hectares);
		  $statement->execute();
		  while ($statement->fetch()) {
			$arr[] = [ "area_id" => $id, 
			"area_name" => $area_name, 
			"geopoint" => $geopoint, 
			"sizeofland" => $hectares];
		  }
		
		  
		  return $arr;
	}
	public function updateArea( $id, $geo, $hectare)
	{
		  $statement = $this->conn->prepare("UPDATE treemap_area SET geopoint = ?, sizeofland= ? where area_id = ?");
		  $statement->bind_param( 'ssi', $geo, $hectare, $id);
		  $statement->execute();
          if($statement->execute())
          {
              ?>
              <script type="text/javascript">
                  alert('Successfully Updated');
                  window.location.href="showmapping.php";
              </script>
              <?php 
          }else 
    
          ?>
          <script type="text/javascript">
              alert('Error updating  data');
              window.location.href="updateArea.php";
          </script>
          <?php 
    
		  
	}
	public function deleteArea($id)
	{
		 $statement = $this->conn->prepare("Delete from treemap_area where area_id = ?");
		 $statement->bind_param('i', $id);
		 $statement->execute();
         
         if($statement->execute())
         {
             ?>
             <script type="text/javascript">
                 alert('Successfully DELETED');
                 window.location.href="showmapping.php";
             </script>
             <?php 
         }else 
   
         ?>
         <script type="text/javascript">
             alert('Error deleting data');
             window.location.href="deletearea.php";
         </script>
         <?php 
   
     
         
   
		 
	}

//for species data
	public function fetchmarkerinfo($keyword)
	{
		  $arr = array();
		  $jsonData = '{"results":[';
		  $this->conn->query( "SET NAMES 'UTF8'" );
		  $statement = $this->conn->prepare("SELECT species_profile, species_name,location,tree_height,diameter_breast_height,merchantable_height,volume_height, latitude, longitude, tree_category,date_planted,name_of_holder,tree_health,code,remark,YEAR(CURDATE())-YEAR(date_planted) as year  FROM markerpoint where species_name REGEXP ? ");
		  $statement->bind_param( 's',  $keyword);
		  $statement->execute();
		  $statement->bind_result( $species_profile,$species_name,$location,$tree_height,$diameter,$merchantable_height,$volume,$latitude,$longitude,$tree_category,$date,$owner,$treeheath,$code,$remark,$year);
		  while ($statement->fetch()) {
			$arr[] = '{"species_profile":"' . $species_profile. '","species_name":"' . $species_name. '","location":"' . $location. '","tree_height":"' . $tree_height. '","diameter_breast_height":"' . $diameter. '","merchantable_height":"' . $merchantable_height. '","volume_height":"' . $volume. '", "latitude":"' . $latitude. '", "longitude":"' . $longitude. '","tree_category":"' . $tree_category. '","data_planted":"' . $date. '","name_of_holder":"' . $owner. '","tree_health":"' . $treeheath. '","code":"' . $code. '","remark":"' . $remark. '","year":"' . $year. '"}';
		  }
		

		  
		  $jsonData .= implode(",", $arr);
		  $jsonData .= ']}';
		  return $jsonData;
	}
 

	public function areasearch($keyword)
	{
		  $arr = array();
		  $jsonData = '{"results":[';
		  $this->conn->query( "SET NAMES 'UTF8'" );
		  $statement = $this->conn->prepare( "SELECT area_name, geopoint,sizeofland FROM treemap_area where area_name REGEXP ?");
		  $statement->bind_param( 's', $keyword);
		  $statement->execute();
		  $statement->bind_result( $name, $geopoint,$sizeofland);
		  while ($statement->fetch()) {
			$arr[] = '{"area_name": "' . $name. '","geopoint": "' . $geopoint. '","sizeofland": "' . $sizeofland. '"}';
		  }
		 

		  
		  $jsonData .= implode(",", $arr);
		  $jsonData .= ']}';
		  return $jsonData;
	}


//for location
	public function getSearchResults($keyword)
	{
		  $arr = array();
		  $jsonData = '{"results":[';
		 
			$this->conn->query( "SET NAMES 'UTF8'" );
			$statement = $this->conn->prepare("SELECT species_profile, species_name,location,tree_height,diameter_breast_height,merchantable_height,volume_height, latitude, longitude, tree_category,date_planted,name_of_holder,tree_health,code,remark,YEAR(CURDATE())-YEAR(date_planted) as year  FROM markerpoint where species_name REGEXP ? or location REGEXP ? or name_of_holder REGEXP ? ");
			$statement->bind_param( 'sss',  $keyword , $keyword, $keyword);
			$statement->execute();
			$statement->bind_result( $species_profile,$species_name,$location,$tree_height,$diameter,$merchantable_height,$volume,$latitude,$longitude,$tree_category,$date,$owner,$treeheath,$code,$remark,$year);
			while ($statement->fetch()) {
			  $arr[] = '{"species_profile":"' . $species_profile. '","species_name":"' . $species_name. '","location":"' . $location. '","tree_height":"' . $tree_height. '","diameter_breast_height":"' . $diameter. '","merchantable_height":"' . $merchantable_height. '","volume_height":"' . $volume. '", "latitude":"' . $latitude. '", "longitude":"' . $longitude. '","tree_category":"' . $tree_category. '","data_planted":"' . $date. '","name_of_holder":"' . $owner. '","tree_health":"' . $treeheath. '","code":"' . $code. '","remark":"' . $remark. '","year":"' . $year. '"}';
			}
			
		
		 

		
		  
		  $jsonData .= implode(",", $arr);
		  $jsonData .= ']}';
		  return $jsonData;
	}
	//ending for location

//filter owner
	public function getownerresult($keyword){

		$arr = array();
		  $jsonData = '{"results":[';
		 
			$this->conn->query( "SET NAMES 'UTF8'" );
			$statement = $this->conn->prepare("SELECT species_profile, species_name,location,tree_height,diameter_breast_height,merchantable_height,volume_height, latitude, longitude, tree_category,date_planted,name_of_holder,tree_health,code,remark,YEAR(CURDATE())-YEAR(date_planted) as year  FROM markerpoint where  name_of_holder REGEXP ? ");
			$statement->bind_param( 's',  $keyword );
			$statement->execute();
			$statement->bind_result( $species_profile,$species_name,$location,$tree_height,$diameter,$merchantable_height,$volume,$latitude,$longitude,$tree_category,$date,$owner,$treeheath,$code,$remark,$year);
			while ($statement->fetch()) {
			  $arr[] = '{"species_profile":"' . $species_profile. '","species_name":"' . $species_name. '","location":"' . $location. '","tree_height":"' . $tree_height. '","diameter_breast_height":"' . $diameter. '","merchantable_height":"' . $merchantable_height. '","volume_height":"' . $volume. '", "latitude":"' . $latitude. '", "longitude":"' . $longitude. '","tree_category":"' . $tree_category. '","data_planted":"' . $date. '","name_of_holder":"' . $owner. '","tree_health":"' . $treeheath. '","code":"' . $code. '","remark":"' . $remark. '","year":"' . $year. '"}';
			}
			
		
		 

		
		  
		  $jsonData .= implode(",", $arr);
		  $jsonData .= ']}';
		  return $jsonData;


	}



public function getSpecies($keyword)
	{
		  $arr = array();
		  $jsonData = '{"results":[';
		 
			$this->conn->query( "SET NAMES 'UTF8'" );
			$statement = $this->conn->prepare("SELECT species_profile, species_name,location,tree_height,diameter_breast_height,merchantable_height,volume_height, latitude, longitude, tree_category,date_planted,name_of_holder,tree_health,code,remark,YEAR(CURDATE())-YEAR(date_planted) as year  FROM markerpoint where species_name REGEXP ?  ");
			$statement->bind_param( 'sss',  $keyword , $keyword, $keyword);
			$statement->execute();
			$statement->bind_result( $species_profile,$species_name,$location,$tree_height,$diameter,$merchantable_height,$volume,$latitude,$longitude,$tree_category,$date,$owner,$treeheath,$code,$remark,$year);
			while ($statement->fetch()) {
			  $arr[] = '{"species_profile":"' . $species_profile. '","species_name":"' . $species_name. '","location":"' . $location. '","tree_height":"' . $tree_height. '","diameter_breast_height":"' . $diameter. '","merchantable_height":"' . $merchantable_height. '","volume_height":"' . $volume. '", "latitude":"' . $latitude. '", "longitude":"' . $longitude. '","tree_category":"' . $tree_category. '","data_planted":"' . $date. '","name_of_holder":"' . $owner. '","tree_health":"' . $treeheath. '","code":"' . $code. '","remark":"' . $remark. '","year":"' . $year. '"}';
			}
			
		
		 

		
		  
		  $jsonData .= implode(",", $arr);
		  $jsonData .= ']}';
		  return $jsonData;
	}

























 }


// 	public function getSearchResults($keyword)
// 	{
// 		  $arr = array();
// 		  $jsonData = '{"results":[';
// 		  $this->conn->query( "SET NAMES 'UTF8'" );
// 		  $statement = $this->conn->prepare("SELECT company, latitude, longitude FROM `companies` where keywords REGEXP ? or company REGEXP ?");
// 		  $statement->bind_param( 'ss', $keyword, $keyword);
// 		  $statement->execute();
// 		  $statement->bind_result( $name, $lat, $lng);
// 		  while ($statement->fetch()) {
// 			$arr[] = '{"name":"' . $name. '","latitude":"' . $lat. '","longitude":"' . $lng. '"}';
// 		  }
		

// 		  $statement = $this->conn->prepare( "SELECT name, geolocations FROM `streets` where keywords REGEXP ? or name REGEXP ?");
// 		  $statement->bind_param( 'ss', $keyword, $keyword);
// 		  $statement->execute();
// 		  $statement->bind_result( $name, $geolocations);
// 		  while ($statement->fetch()) {
// 			$temp = explode(",",$geolocations);
// 			$arr[] = '{"name":"' . $name. '","latitude":"' . $temp[1]. '","longitude":"' . $temp[0]. '"}';
// 		  }
		 

// 		  $statement = $this->conn->prepare( "SELECT name, geolocations FROM `areas` where keywords REGEXP ? or name REGEXP ?");
// 		  $statement->bind_param( 'ss', $keyword, $keyword);
// 		  $statement->execute();
// 		  $statement->bind_result( $name, $geolocations);
// 		  while ($statement->fetch()) {
// 			$temp = explode(",",$geolocations);
// 			$arr[] = '{"name": "' . $name. '", "latitude": "' . $temp[1]. '","longitude":"' . $temp[0]. '"}';
// 		  }
		 

		  
// 		  $jsonData .= implode(",", $arr);
// 		  $jsonData .= ']}';
// 		  return $jsonData;
// 	}
//  }
 
 $conn = new connectToDB();