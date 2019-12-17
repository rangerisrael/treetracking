<?php


require_once("db.php"); 

   $areas = $conn->getAreasList();
    $arr = $conn->getAreasList();
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
    <style>
    
   #map{

    height: 126vh;
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
}
    </style>
    <title>TRACK YOUR MAP EASILY</title>
</head>
<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; font-weight: bold;" id="mySidebar">
  <button class="w3-bar-item w3-button w3-green"
  onclick="w3_close()">Hide</button>
  
  <a href="addarea.php" class="w3-bar-item w3-button">ADD PLANTATION AREA</a>
  <a href="updatearea.php" class="w3-bar-item w3-button">DELETE PLANTATION AREA</a>
  <a href="showmapping.php" class="w3-bar-item w3-button">BACK</a>
</div>
<div id="main">
<div class="w3-green">

  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
 
  

  <select name="basemaps" id="basemaps" onChange="changeBasemap(basemaps)">
    <option value="Topographic">Topographic</option>
    <option value="Streets">Streets</option>
    <option value="NationalGeographic">National Geographic</option>
    <option value="Oceans">Oceans</option>
    <option value="Gray">Gray</option>
    <option value="DarkGray">Dark Gray</option>
    <option value="Imagery">Imagery</option>
    <option value="ImageryClarity">Imagery (Clarity)</option>
    <option value="ImageryFirefly">Imagery (Firefly)</option>
    <option value="ShadedRelief">Shaded Relief</option>
    <option value="Physical">Physical</option>
  </select>
  
  <div style="background:green;width:18vw;position:relative;left:1vw;top:2vw;">
  <form action="deletingarea.php" method="post">
	<label for="areaname" id="arealabel">AREA NAME</label><br>
    <select name="areaname" id="area" style="position: relative; left:1vw;">
    <option value="0">Please choose a company</option>
    <?php for($i=0; $i < count($arr); $i++) { print '<option value="'.$arr[$i]['area_id'].'">'.$arr[$i]['area_name'].'</option>'; } ?>
    
    </select>
  <input type="submit" class="w3-red" style="position:relative; left:7vw;" value="DELETE">
  </form>
  
  </div>
  
<div id="map"  ></div>
	
</div>

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
<script> 
var map = L.map('map').setView([15.8016, 121.4595], 11);
 var polygon;
  var draggableAreaMarkers = new Array();

 
   var layer = L.esri.basemapLayer('Imagery').addTo(map);
    layer= L.esri.basemapLayer('ImageryLabels').addTo(map);
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
    var areaMarker = L.marker( [latLng.lat, latLng.lng], { draggable: true, zIndexOffset: 900}).addTo(map);
    
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
     if(draggableAreaMarkers[i] != "") {
      latLngAreas.push( L.latLng( draggableAreaMarkers[ i ].getLatLng().lat, draggableAreaMarkers[ i ].getLatLng().lng));
     }
    }
 
    if(latLngAreas.length > 1) {
     // create a blue polygon from an array of LatLng points
     polygon = L.polygon( latLngAreas, { color: 'red' }).addTo(map);
    }
 
    if(polygon != null) {
     // zoom the map to the polygon
     map.fitBounds( polygon.getBounds() );
    }
   }
   
   function getGeoPoints() {
    var points = new Array();
    for(var i=0; i <draggableAreaMarkers.length; i++) {
     if(draggableAreaMarkers[ i ] != "") {
      points[i] =  draggableAreaMarkers[ i ].getLatLng().lng + "," + draggableAreaMarkers[ i ].getLatLng().lat;
     }
    }
    $('#geo').val(points.join(','));
   }
   
   $( document ).ready(function() {   
    $("#area").change(function() {
     resetArea();
     for(var i=0;i<arr.length;i++) {
      if(arr[i]['area_id'] == $('#area').val()) {
       arrangePoints(arr[i]['geopoint']);
       drawArea();
       break;
      }
     }
    });
   });
   
   function arrangePoints( geo ) {
    var linesPin = geo.split(",");
 
    var linesLat = new Array();
    var linesLng = new Array();
 
    for(i=0; i < linesPin.length;i++) {
     if(i % 2) {
      linesLat.push(linesPin[i]);
     }else{
      linesLng.push(linesPin[i]);
     }
    }
 
    var latLngLine = new Array();
 
    for(i=0; i < linesLng.length; i++) {
     latLngLine.push( L.latLng( linesLat[i], linesLng[i]));
    }
 
    for(i=0; i < latLngLine.length;i++) {
     addMarkerAreaPoint( latLngLine[i]);
    }
   }
   
   var arr = JSON.parse( '<?php echo json_encode($arr) ?>' );
</script>
<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "10%";
  document.getElementById("mySidebar").style.width = "10%";
 document.getElementById("mySidebar").style.color = "white";
  document.getElementById("mySidebar").style.background = "url(../background/SIDE.png)";
  document.getElementById("mySidebar").style.backgroundSize = "cover";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>

    <script src="js/script.js"></script>
   
    <script type='text/javascript' src='js/jquery.min.js'></script>
    <script src="js/map.js"></script>

  <script type='text/javascript' src='js/leaflet.draw.js'></script>


   

</body>
</html>