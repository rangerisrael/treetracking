<?php
 require_once("db.php");

 $areas = $conn->getAreasList();
?>
<?php
function DecimalToDMS($decimal, &$degrees, &$minutes, &$seconds, &$direction, $type = true) {
	//set default values for variables passed by reference
	$degrees = 0;
	$minutes = 0;
	$seconds = 0;
	$direction = 'X';

	//decimal must be integer or float no larger than 180;
	//type must be Boolean
	if(!is_numeric($decimal) || abs($decimal) > 180 || !is_bool($type)) {
		return false;
	}
	
	//inputs OK, proceed
	//type is latitude when true, longitude when false
	
	//set direction; north assumed
	if($type && $decimal < 0) { 
		$direction = 'S';
	}
	elseif(!$type && $decimal < 0) {
		$direction = 'W';
	}
	elseif(!$type) {
		$direction = 'E';
	}
	else {
		$direction = 'N';
	}
	
	//get absolute value of decimal
	$d = abs($decimal);
	
	//get degrees
	$degrees = floor($d);
	
	//get seconds
	$seconds = ($d - $degrees) * 3600;
	
	//get minutes
	$minutes = floor($seconds / 60);
	
	//reset seconds
	$seconds = floor($seconds - ($minutes * 60));	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet"  href="../css/leaflet.css" />
    <link rel="stylesheet" href="../css/geocoder.css" />
    <link rel="stylesheet"  href="../css/dropdown.css"/>
	 <link rel="stylesheet"  href="../css/leaflet.draw.css"/>
   
  
  <script type='text/javascript' src='../js/jquery.min.js'></script>
  <script type='text/javascript' src='../js/leaflet.js'></script>
  <script type='text/javascript' src='../js/esri.js'></script>
  <script type='text/javascript' src='../js/geocoder.js'></script>
  
  <link rel="stylesheet" href="css/leaflet.css" />
 <script src="js/leaflet.js"></script>
   <link rel="stylesheet" href="css/leaf.css">
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
    integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
    crossorigin=""></script>


    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.2.4/dist/esri-leaflet.js"
    integrity="sha512-tyPum7h2h36X52O2gz+Pe8z/3l+Y9S1yEUscbVs5r5aEY5dFmP1WWRY/WLLElnFHa+k1JBQZSCDGwEAnm2IxAQ=="
    crossorigin=""></script>
	<link rel="stylesheet" type="text/css" href="../demo.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#decimal2dms').validate({
					rules: {
						decimal: {
							required: true,
							number: true,
							range: [-180, 180]
						}
					} //rules
				}); //validate
			}); //ready
		</script>
    <style>
    
   #map{

    height: 110.5vh;
    width: 80vw;
margin:-20vw 20vw;
}
input{
	position:relative;
	left:2vw;
}
textarea{
	position:relative;
	left:2vw;
}
#collect{
	width:7vw;
	height:4vh;
	position:relative;
	left:5vw;


}
#arealabel{
	color:black;
	position:relative;
	left:15px;
}
.geo{
	color:black;
	position:relative;
	left:1vw;
}
.hectare{
	color:black;
	position:relative;
	left:15px;
}
p{
	font-size:12px;
	color:black;
}
label{
	color:black;
}
    </style>
    <title>TRACK YOUR MAP EASILY</title>
</head>
<body bgcolor="#c1c1c1">

  

  <div class="container">
  <div class="w3-green"style="width:20vw; height:36vh;position:relative;left:46vw;top:29.5vh;">
    <center style="color: black;">DEGREE CONVERTER</center><br>
  <form id="decimal2dms" name="decimal2dms" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<label for="decimal">Decimal: <br><input type="text" id="decimal" name="decimal" size="10" maxlength="10" /></label><br>
			<label for="type">Coordinate type: <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<select name="type" id="type">
					<option value="lat">Latitude</option>
					<option value="lon">Longitude</option>
				</select>
			</label>
			<p>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="dec_submit" name="dec_submit" value="Submit" />
			</p>
		</form>
  
	<?php
			if(isset($_POST['dec_submit'])) {
				if($_POST['type'] == 'lon') {
					$type = false;
				}
				else {
					$type = true;
				}
				if(DecimalToDMS($_POST['decimal'], $degrees, $minutes, $seconds, $direction, $type) !== false) {
				
					echo "<p class=\"notice\" >&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;Decimal  to Degree <br>&nbsp&nbsp&nbsp;&nbsp&nbsp&nbsp;" . $_POST['decimal'] . " (" . $_POST['type'] . ")  is $degrees&deg; $minutes' $seconds\" $direction</p>\n";
				}
				else {
					echo "<p class=\"warning\">One or more form values are out of range.</p>\n";
				}
			}
		?>
		
  </div>
  

	
</div>
<br>
</div>


</body>
</html>