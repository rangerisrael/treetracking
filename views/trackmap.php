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



    <style>
  
    
    </style>
    <script src="js/script.js"></script>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 15.8016, lng: 121.4595},
          zoom: 13
        });
      }
    </script>
    <script type='text/javascript' src='js/jquery.min.js'></script>
    


   
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsoDL4TLKp2tm_4vYdvM84iQlJrs4Dass&callback=initMap"
    async defer></script>
</body>
</html>