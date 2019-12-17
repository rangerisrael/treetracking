<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet"  href="css/leaflet.css" />
    <link rel="stylesheet" href="css/geocoder.css" />
    <link rel="stylesheet"  href="css/dropdown.css"/>
	 <link rel="stylesheet"  href="css/leaflet.draw.css"/>
   
  
  <script type='text/javascript' src='js/jquery.min.js'></script>
  <script type='text/javascript' src='js/leaflet.js'></script>
  <script type='text/javascript' src='js/esri.js'></script>
  <script type='text/javascript' src='js/geocoder.js'></script>
  

    <style>
    
   #map{

    height: 92.5vh;
    width: 100vw;
}

    </style>
    <title>TRACK YOUR MAP EASILY</title>
</head>
<body>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button"
  onclick="w3_close()"></button>
  <a href="#" class="w3-bar-item w3-button">ADD TREE AREA</a>
  <a href="#" class="w3-bar-item w3-button">ADD MARKER POINT</a>
  <a href="#" class="w3-bar-item w3-button">ADD ROUTE POINT</a>
  <a href="admin.php" class="w3-bar-item w3-button">BACK</a>
</div>
<div id="main">
<div class="w3-green">

  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
 
  

  
<div id="map"  ></div>
	
</div>

</div>
<script> 
 var map = L.map('map').setView([15.8173, 121.4056], 18);
 var Esri_WorldTopoMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community'
  maxZoom: 17,
  minZoom: 9

}).addTo(map);
// bike lanes
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


    <script src="js/script.js"></script>
   
    <script type='text/javascript' src='js/jquery.min.js'></script>
    <script src="js/map.js"></script>

  <script type='text/javascript' src='js/leaflet.draw.js'></script>
	


   

</body>
</html>