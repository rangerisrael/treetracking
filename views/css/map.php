<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="css/geocoder.css" />
    <script type='text/javascript' src='js/jquery.min.js'></script>
    <script type='text/javascript' src='js/leaflet.js'></script>
	  <script type='text/javascript' src='js/esri.js'></script>
	  <script type='text/javascript' src='js/geocoder.js'></script>
	  
</head>

<body>

    <h1>A basic map using leaflet</h1>
    <div id="map" style="width: 800px; height: 440px; border: 1px solid #AAA;"></div>
    <script src="basic-leaflet-map.js"></script>
</body>
<script>
var mylat = '15.7336';
var mylong = '121.5713';
var myzoom = '10';
var map = L.map('map').setView([mylat, mylong], myzoom);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 17,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
 

 var greenIcon = L.icon({
    iconUrl: 'tree.png',
    shadowUrl: 'leaf-shadow.png',

    iconSize:     [38, 95], // size of the icon
    shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});
 
L.marker([mylat, mylong], {icon: greenIcon}).addTo(map);
L.marker([mylat, mylong]).addTo(map).bindPopup("<b>Trees detected</b>").openPopup();
L.circle([mylat, mylong], 500, {
    color: 'red',
    fillColor: '#f2d5df',
    fillOpacity: 0.2
}).addTo(map).bindPopup("");
 
markers = [{
    "name": "Supermarket",
    "url": "",
    "lat": 50.54086,
    "lng": -3.60219
}, {
    "name": "Information Centre",
    "url": "http://www.dartmoor.gov.uk/",
    "lat": 50.58093,
    "lng": -3.7453
}];
for (var i = 0; i < markers.length; ++i) {
    L.marker([markers[i].lat, markers[i].lng], {
        icon: new L.DivIcon({
            className: 'my-div-icon',
            html: '<span class="my-map-label">' + markers[i].name + '</span>'
        })
    }).addTo(map);
 
    L.marker([markers[i].lat, markers[i].lng]).addTo(map).bindPopup(markers[i].name);
}
 var search=L.esri.Geocoding.geosearch().addTo(map);
 var result=L.layerGroup.addTo(map);
 search.on('result',function(data){
	 result.clearLayers();
	 
	 for(var i=data.result.length-1;i>=0;i--){
		
		 result.addLayer(L.marker(data.result[i].latlng));
	 }
 })

		

</script>
</html>