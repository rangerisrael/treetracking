<?php
 require_once("db.php");

 $areas = $conn->getAreasList();



include_once 'mapfunction.php';


if(isset($_POST["insert"])) {  
 insert_marker();

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
    <style>
    
   #map{

    height: 130vh;
    width: 80vw;
margin:-121vh 36.5vw;
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
label{
  color:black;
  position:relative;
	left:15px;
}

input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
    </style>
    <title>TRACK YOUR MAP EASILY</title>
</head>
<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none;font-weight: bold;" id="mySidebar">
  <button class="w3-bar-item w3-button w3-green"
  onclick="w3_close()">Hide</button>
  <a href="editmarkerpoint.php" class="w3-bar-item w3-button">UPDATE TREE INFORMATION</a>
  <a href="deletemarkerpoint.php" class="w3-bar-item w3-button">DELETE SPECIES INFORMATION</a>
  <a href="showmap.php" class="w3-bar-item w3-button">BACK</a>
</div>
<div id="main">
<div class="w3-green">

  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
 
  

  <select name="basemaps" id="basemaps" onChange="changeBasemap(basemaps)">
    <option>Choose map template</option>
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
  <script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("profile").files[0]);
	oFReader.onload = function (oFREvent) {
	document.getElementById("uploadPreview").src = oFREvent.target.result;
	};
	};
</script>
  <div style="background:aqua;width:35vw;position:relative;left:1vw;top:2vw;">
  <form method="post" enctype="multipart/form-data">  

  <img id="uploadPreview" style="width:15vw; position:relative; left:10vw; border:outset  5px white"   src="../img/a.jpg" required="" />
  <label class="custom-file-upload" style="position:relative; top:10vh;left:-3vw; background:aqua;">
<input id="profile"   type="file" name="profile"  onchange="PreviewImage();"   accept="image/*" required=""oninvalid="this.setCustomValidity('PROFILE IS REQUIRED')" oninput="setCustomValidity('')">
Browse Image
</label><br><br><br>

<label for="areaname" id="arealabel">Species</label>

      <label for="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATE PLANTED</label><br>
	
<input type="text"  name="name" id="name" value="" placeholder="        TREE NAME" required="" oninvalid="this.setCustomValidity('Species is EMPTY')" oninput="this.setCustomValidity('')">


<input type="date" name="date" id="date" required="" oninvalid="this.setCustomValidity('date is missing')" oninput="this.setCustomValidity('')"><br><br>


  <label for="Location">Location</label>

  <label for="owner">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NAME OF HOLDER</label><br>
  
  <input type="text"  name="location" id="location" value="" placeholder="      Location" required="" oninvalid="this.setCustomValidity('Location is missing')" oninput="this.setCustomValidity('')">
  
  <input type="text" name="owner" id="owner" required="" oninvalid="this.setCustomValidity('Holder Is not set')" oninput="this.setCustomValidity('')">
  <br><br>

  <label for="theight" class="theight">Tree Height</label>
  
  <label for="thealth">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tree Health</label>
  
  <br>
  <input type="decimal" name="theight" id="theight" placeholder="       TREE HEIGHT" required="" oninvalid="this.setCustomValidity('tree height is not define')" oninput="this.setCustomValidity('')">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select name="thealth" id="thealth" required="" oninvalid="this.setCustomValidity('tree health is not set')" oninput="this.setCustomValidity('')">

<option value="GOOD">GOOD</option>
<option value="BAD">BAD</option>

</select>
  <br><br>
 
  <label for="dba" class="dba">Diameter/Breast Height</label>
  <label for="code">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STEM QUALITY CODE</label>
  
  <br>
  <input type="decimal" name="dba" id="dba" placeholder="   diameter height" required="" oninvalid="this.setCustomValidity('diameter of land is missing')" oninput="this.setCustomValidity('')">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="code" id="code" required="" oninvalid="this.setCustomValidity('code is not set')" oninput="this.setCustomValidity('')">
<option value="1">CODE 1</option>
<option value="2">CODE 2</option>
<option value="3">CODE 3</option>

</select>
  
  <br><br>



  <label for="mh" class="mh">Merchantable Height &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
  <label for="remark">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS</label>

  <br>

  <input type="decimal" name="mh" id="mh" placeholder=" Merchantable Height" required="" oninvalid="this.setCustomValidity('merchantable height is missing')" oninput="this.setCustomValidity('')">
  <input type="text" name="remark" id="remark" required="" oninvalid="this.setCustomValidity('cause is not define')" oninput="this.setCustomValidity('')"><br><br>

  <label for="vol">VOLUME HEIGHT</label><br>
  <input type="decimal" name="vol" id="vol" required="" oninvalid="this.setCustomValidity('Volume is empty')" oninput="this.setCustomValidity('')">
  
  
  <br><br>

<label for="lat">Latitude</label><br>
<input type="text" name="latitude" id="latitude" required="" oninvalid="this.setCustomValidity('Latitude is not define')" oninput="this.setCustomValidity('')"><br>


<label for="lat">Longitude</label><br>
<input type="text" name="longitude" id="longitude" required="" oninvalid="this.setCustomValidity('Longitude is not define')" oninput="this.setCustomValidity('')">

<br><br>
<label for="thdata">Tree Category:&nbsp;&nbsp;&nbsp;</label>
<select name="thcategory" id="thcategory" required="" oninvalid="this.setCustomValidity('Category is missing')" oninput="this.setCustomValidity('')"> 
<option value="PLANTED">PLANTED</option>
<option value="NATURAL">NATURAL</option>

</select>




<input type="submit" name="insert" id="insert" class="w3-red" style="position:relative;top:-25vh;left:5vw;" value="SAVE">
  </form>
  
  </div>
  <br><br><br>
  <a style="margin-left:15vw;"href="degreeconverter.php">VIEW CONVERTER</a>
<div id="map"  ></div>
	
</div>

</div>
<script>
$(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#profile').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#profile').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#profile').val('');  
                     return false;  
                }  
           }  
      });  
 });

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

  
  
 
  

  
</script>

<script>

  function putDraggable() {
   /* create a draggable marker in the center of the map */
   draggableMarker = L.marker([ map.getCenter().lat, map.getCenter().lng], {draggable:true, zIndexOffset:900}).addTo(map);
   
   /* collect Lat,Lng values */
   draggableMarker.on('dragend', function(e) {
    $("#latitude").val(this.getLatLng().lat);
    $("#longitude").val(this.getLatLng().lng);
   });
  }
   
  $( document ).ready(function() {
   putDraggable();
  });
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
	  
    var polygon = L.polygon( stringToGeoPoints(areas[i]['geopoint']), { color: ''}).addTo(map);
    polygon.bindPopup( "<b>" + areas[i]['area_name']+"<br>"+areas[i]['sizeofland']);   
	   
   }
  }
  
  
	
  

  var areas = JSON.parse( '<?php echo json_encode($areas) ?>' );
  
</script>


</body>
</html>