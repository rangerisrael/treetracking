<?php
function DMS2Decimal($degrees = 0, $minutes = 0, $seconds = 0, $direction = 'n') {
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
				$('#dms2decimal').validate({
					rules: {
						degrees: {
							required: true,
							digits: true,
							range: [0, 180]
						},
						minutes: {
							required: true,
							number: true,
							range: [0, 59]
						},
						seconds: {
							required: true,
							number: true,
							range: [0, 59]
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
<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button"
  onclick="w3_close()"></button>

  <a href="showmap.php" class="w3-bar-item w3-button">BACK</a>
</div>
<div id="main">
<div>

  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
<?php include('converter.php');?>
  
  
  <div  class="w3-green" style="width:20vw;position:relative;left:25vw;top:-10vh;">
<center style="color: black;">DECIMAL CONVERTER</center><br>
 <form id="dms2decimal" name="dms2decimal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<label for="degrees">Degrees: <input type="text" id="degrees" name="degrees" size="3" maxlength="10" /></label><br /><br />
			<label for="minutes">Minutes: <input style="margin-left: 0.3vw;"type="text" id="minutes" name="minutes" size="2" maxlength="10" /></label><br /><br />
			<label for="seconds">Seconds: <input type="text" id="seconds" name="seconds" size="2" maxlength="10" /></label><br /><br />
			<select id="direction" name="direction">
				<option value="N">N</option>
				<option value="S">S</option>
				<option value="E">E</option>
				<option value="W">W</option>
			</select>
			<p>
				<input type="submit" id="dms_submit" name="dms_submit" value="Submit" />
			</p>
		</form>
  
		<?php
			if(isset($_POST['dms_submit'])) {
				$decimal = DMS2Decimal($_POST['degrees'], $_POST['minutes'], $_POST['seconds'], $_POST['direction']);
				if($decimal !== false) {
					echo "<p class=\"notice\">The decimal value for " . $_POST['degrees'] . "&deg " . $_POST['minutes'] . "' " . $_POST['seconds'] . "\" " . $_POST['direction'] . " is $decimal</p>\n";
				}
				else {
					echo "<p class=\"warning\">One or more form values are out of range.</p>\n";
				}
			}
		?>
		
  </div>
  

</div>
<br>

<script> 
var map = L.map('map').setView([15.8016, 121.4595], 11);
 var polygon;
  var draggableAreaMarkers = new Array();

 
  var layer = L.esri.basemapLayer('Topographic').addTo(map);
  var layerLabels;

  function setBasemap(basemap) {
    if (layer) {
      map.removeLayer(layer);
    }

    layer = L.esri.basemapLayer(basemap);

    map.addLayer(layer);

    if (layerLabels) {
      map.removeLayer(layerLabels);
    }

    if (basemap === 'ShadedRelief'
     || basemap === 'Oceans'
     || basemap === 'Gray'
     || basemap === 'DarkGray'
     || basemap === 'Terrain'
   ) {
      layerLabels = L.esri.basemapLayer(basemap + 'Labels');
      map.addLayer(layerLabels);
    } else if (basemap.includes('Imagery')) {
      layerLabels = L.esri.basemapLayer('ImageryLabels');
      map.addLayer(layerLabels);
    }
  }

  function changeBasemap(basemaps){
    var basemap = basemaps.value;
    setBasemap(basemap);
  }

  
  
  function resetArea() {
   if(polygon != null) {
    map.removeLayer( polygon );
   }
   for(i=0; i < draggableAreaMarkers.length; i++) {
    map.removeLayer( draggableAreaMarkers[i] );
   }
   draggableAreaMarkers = new Array();
  }
  
  function addMarkerAreaPoint(latLng) {
   var areaMarker = L.marker( [latLng.lat, latLng.lng], { draggable: true, zIndexOffset: 1900 }).addTo(map);
   
   areaMarker.arrayId = draggableAreaMarkers.length;

   areaMarker.on('click', function() {
    map.removeLayer( draggableAreaMarkers[ this.arrayId ]);
    draggableAreaMarkers[ this.arrayId ] = "";
   });

   draggableAreaMarkers.push( areaMarker );
  }
  
  function drawArea() {
   if(polygon != null) {
    map.removeLayer( polygon );
   }

   var latLngAreas = new Array();

   for(i=0; i < draggableAreaMarkers.length; i++) {
    if(draggableAreaMarkers[ i ]!="") {
     latLngAreas.push( L.latLng( draggableAreaMarkers[ i ].getLatLng().lat, draggableAreaMarkers[ i ].getLatLng().lng));
    }
   }

   if(latLngAreas.length > 1) {
    // create a blue polygon from an array of LatLng points
    polygon  = L.polygon(latLngAreas, {color: 'red'}).addTo(map);
	
   }

   if(polygon != null) {
    // zoom the map to the polygon
    map.fitBounds( polygon.getBounds() );
   }
  }
  
  function getGeoPoints() {
   var points = new Array();
   for(var i=0; i < draggableAreaMarkers.length; i++) {
    if(draggableAreaMarkers[i] != "") {
     points[i] =  draggableAreaMarkers[ i ].getLatLng().lng + "," + draggableAreaMarkers[ i ].getLatLng().lat;
    }
	else{
		alert('field is already set');
	}
   }
   $('#geo').val(points.join(','));
  }
  
  $( document ).ready(function() {
   map.on('click', function(e) {
    addMarkerAreaPoint( e.latlng);
	
   });
  });
  
</script>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "10%";
  document.getElementById("mySidebar").style.width = "10%";
  document.getElementById("mySidebar").style.color = "red";
  document.getElementById("mySidebar").style.background = "teal";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>
<script>
  $( document ).ready(function() {
	$('#searchBtn').click(function() {
	  $.ajax({
		type: "GET",
		url: "ajax.php?keyword="+$("#search").val()
	  }).done(function( data )
	  {
		var jsonData = JSON.parse(data);
		var jsonLength = jsonData.results.length;
		var html = "<ul>";
		for (var i = 0; i < jsonLength; i++) {
		  var result = jsonData.results[i];
		  html += '<li data-lat="' + result.latitude + '" data-lng="' + result.longitude + '" class="searchResultElement">' + result.name + '</li>';
		}
		html += '</ul>';
		$('#searchresult').html(html);  		
		$( 'li.searchResultElement' ).click( function() {
		  var lat = $(this).attr( "data-lat" );
		  var lng = $(this).attr( "data-lng" );
		  map.panTo( [lat,lng] );
      
    
		});
	  });
	});
    
   addAreas();   
  });
 
  
  function stringToGeoPoints( geo ) {
   var linesPin = geo.split(",");

   var linesLat = new Array();
   var linesLng = new Array();

   for(i=0; i < linesPin.length; i++) {
    if(i % 2) {
     linesLat.push(linesPin[i]);
    }else{
     linesLng.push(linesPin[i]);
    }
   }

   var latLngLine = new Array();

   for(i=0; i<linesLng.length;i++) {
    latLngLine.push( L.latLng( linesLat[i], linesLng[i]));
   }
   
   return latLngLine;
  }
  
  function addAreas() {
   for(var i=0; i < areas.length; i++) {
	   console.log(areas[i]['geopoint']);
    var polygon = L.polygon( stringToGeoPoints(areas[i]['geopoint']), { color: ''}).addTo(map);
    polygon.bindPopup( "<b>" + areas[i]['area_name']+"<br>"+areas[i]['sizeofland']);   
	   
   }
  }
  
  
	
  

  var areas = JSON.parse( '<?php echo json_encode($areas) ?>' );
  
</script>
    <script src="js/script.js"></script>
   
    <script type='text/javascript' src='js/jquery.min.js'></script>
    <script src="js/map.js"></script>

  <script type='text/javascript' src='js/leaflet.draw.js'></script>


   

</body>
</html>