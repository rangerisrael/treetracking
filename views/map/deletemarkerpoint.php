<?php
 require_once("db.php");
 $arr = $conn->getMarkerList();
 $areas = $conn->getAreasList();




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

    height: 128vh;
    width: 90vw;
margin:-6vw 16.2vw;
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
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none;font-weight:bold;" id="mySidebar">
  <button class="w3-bar-item w3-button w3-green"
  onclick="w3_close()">Hide</button>
  <a href="addmarkerpoint.php" class="w3-bar-item w3-button">ADD SPECIES INFORMATION</a>
  <a href="editmarkerpoint.php" class="w3-bar-item w3-button">UPDATE TREE INFORMATION</a>
  <a href="showmap.php" class="w3-bar-item w3-button">BACK</a>
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
  <script type="text/javascript">
	function PreviewImage() {
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("profile").files[0]);
	oFReader.onload = function (oFREvent) {
	document.getElementById("uploadPreview").src = oFREvent.target.result;
	};
	};
</script>
  <div style="background:aqua;width:15vw; height:15vh;position:relative;left:1vw;top:2vw;">
  <form action="deletingmarkerpoint.php" method="post" enctype="multipart/form-data">

<label for="areaname" id="arealabel">Species</label><br>

    	  <select name="area" id="area">
 
      <option value="0"> CHOOSE TREE NAME</option>
    <?php for($i=0; $i < count($arr); $i++) { print '<option value="'.$arr[$i]['point_id'].'">'.$arr[$i]['species_name'].'</option>'; } ?>
    </select>
    <input type="submit" class="w3-red" style="position:relative; top: 1vh; left:4vw;" value="DELETE">
  </form>
  
  </div>
  
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
  
  $("#area").change(function() {
     for(var i=0;i<arr.length;i++) {
      if(arr[i]['point_id'] == $('#area').val()) {
           
      
       $('#location').val(arr[i]['location']);
       $('#theight').val(arr[i]['tree_height']);
       $('#dba').val(arr[i]['diameter_breast_height']);
       $('#mh').val(arr[i]['merchantable_height']);
       $('#vol').val(arr[i]['volume_height']);
       $('#latitude').val(arr[i]['latitude']);
       $('#longitude').val(arr[i]['longitude']);
       $('#thcategory').val(arr[i]['tree_category']);
       $('#date').val(arr[i]['date_planted']);
       $('#owner').val(arr[i]['name_of_holder']);
       $('#thealth').val(arr[i]['tree_health']);
       $('#code').val(arr[i]['code']);
       $('#remark').val(arr[i]['remark']);

       
 
      
      }
     }
    });
	
    var arr = JSON.parse( '<?php echo json_encode($arr) ?>' );



  var areas = JSON.parse( '<?php echo json_encode($areas) ?>' );
   console.log(arr);
   console.log(areas);
</script>


</body>
</html>