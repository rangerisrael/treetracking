<?php

 require_once("map/database.php");
$arr=$conn->getMarkerList();
 $areas = $conn->getAreasList();
 ?>

<?php
#
   include_once 'layout/staff.php';
  session_start();
 

 if(!$_SESSION['user']['id']){
    header('location: forbidden.php?failed');
  }


     if($_SESSION['user']['role_type']=="ADMIN"){

        echo "<script>
        alert('ACCESS DENIED');
        window.location.href=('adminpage.php?=access denied');
      </script>";
        }

  
  
   // The sessions that you're seeing below are the sessions you created in login controller page
   // T }
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script>
   
function speak(t){
    
    var synth = window.speechSynthesis;
 var voices = synth.getVoices();

 var u = new SpeechSynthesisUtterance(t);
 u.onend = function () { console.log("on end!"); }
 u.onerror = function () { console.log("on error!"); }
 u.onpause = function () { console.log("on pause"); }
 u.onresume = function () { console.log("on resume"); }
 u.onstart = function () { console.log("on start"); }
 synth.cancel();
 synth.speak(u);
 setInterval(function () {
     console.log("paused:" + synth.paused + " pending:" + synth.pending + " speak:" + synth.speaking);

 }, 100);
}

speak('<?php echo  strtolower($_SESSION['user']['name']).'Welcome to tree tracking system  ';?>');


  </script>
    <link rel="stylesheet" href="css/w3.css">
   
	 <link rel="stylesheet"  href="css/leaflet.draw.css"/>
   
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
    
 <script src="js/jquery.min.js"></script>
<script src="js/leaflet-search.js"></script>
<style>
    
select{
  position:absolute;
  top:9.5vh;
  left:87vw;
  
}
#search{
  position:relative;
  top:-7vh;
  left:20vw;
}
body { font-family: Helvetica, Arial, sans-serif; }

    </style>
    <title>TRACK YOUR MAP EASILY</title>
</head>
<body>
<div class="headertest try w3-light-green" style="position: fixed;z-index: 1;">
 

 <img  src="background/trees.png" style="height:15vh;width: 100vw;">

 
</div>

<div class=" w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; position:fixed;background:#222222; background-size:cover; z-index: 0;   border-radius: 15px 50px;  font-weight:bold;" id="mySidebar">
  <button class="test w3-bar-item w3-button w3-green" style="position: relative;top:3vh;" 
  onclick="w3_close()"><p style="font-family: "Times New Roman", Times, serif;"> BACK </p></button>

 <div> <?php include('side.php');?></div>
 
</div>
<div id="main">
<div class="">

  <button id="openNav" style="position:fixed; top:11.2vh; opacity: 0.8; z-index: 1;" class="w3-button w3-green w3-sm" onclick="w3_open()">&#9776;</button>
 
   
<br>
  <select style="position:fixed;z-index: 1; left: 80vw;" name="basemaps" id="basemaps" onChange="changeBasemap(basemaps)">
    <option>CHOOSE MAP TEMPLATE</option>
<option value="ImageryFirefly">Imagery (Firefly)</option>
    <option value="Topographic">Topographic</option>
    <option value="Streets">Streets</option>
    <option value="NationalGeographic">National Geographic</option>
    <option value="Oceans">Oceans</option>
    <option value="Gray">Gray</option>
    <option value="DarkGray">Dark Gray</option>
    <option value="Imagery">Imagery</option>
    <option value="ImageryClarity">Imagery (Clarity)</option>
  <option value="ShadedRelief">Shaded Relief</option>
    <option value="Physical">Physical</option>
  </select>
  <br>
  <div id="map" style="width:97.9vw; height: 85vh; margin-top: 15vh; z-index:0; "  >
  
  
  
  </div>
<div>

</div>


<script>
           

function w3_open() {
  document.getElementById("main").style.marginLeft = "20%";
  document.getElementById("mySidebar").style.marginTop = "6%";
  document.getElementById("mySidebar").style.width = "20%";
  document.getElementById("mySidebar").style.color = "red";
  document.getElementById("mySidebar").style.background = "light-green";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("map").style.width = '100%';
  document.getElementById("map").style.marginTop = '10%';
   document.getElementByClassName("searchResultElement").style.marginLeft = '15%';
    document.getElementById("drop").style.margin = '1%';
     document.getElementById("drop").style.marginLeft = '10%';
  document.getElementById("openNav").style.display = 'none';


}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  
  document.getElementById("map").style.marginTop = '5%';
  document.getElementByClassName("searchResultElement").style.marginLeft = '5%';
  document.getElementById("map").style.width = '100%';
  document.getElementById("drop").style.margin = '-2%';
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";

}
</script>





  
    
   
    <script type='text/javascript' src='js/jquery.min.js'></script>
    

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
</script>
  <script>

//marker search
  $( document ).ready(function() {
	$('#btnsearchinfo').click(function() {
	  $.ajax({
		type: "GET",
		url: "map/searchmarker.php?keyword="+$("#search").val()
	  }).done(function( data )
	  {
		var jsonData = JSON.parse(data);
		var jsonLength = jsonData.results.length;
		
    for (var i = 0; i < jsonLength; i++) {
      var result = jsonData.results[i];
		  var result = L.marker([result.latitude,result.longitude] ).addTo(map)
      .bindPopup("<img   style='position:relative; left:-1vw;width:160px;height:100px;'src='map/marker/" + 
      result.species_profile + "' />"+
      "<br><br>"+  result.species_name + "<br />Tree Height: "+result.tree_height +"<br />Diameter: "+
      result.diameter_breast_height + "<br />Merchantable Height: " + result.merchantable_height + "<br />Tree Category: " + 
      result.tree_category + "<br />Tree Health: " + result.tree_health +  "<br />Owner: " + result.name_of_holder +
      "</b><br>GPS READING LAT LONG:" + result.latitude + "-" + result.longitude + "<br> YEAR: "+
        result.year + "<br> LOCATION:  "+ result.location + "<br> CODE: " + result.code + "<br> REMARKS: " + result.remark)
        .openPopup();
    
		}

    if(!result){
      alert("Data not found");
    }

      
    

	  });
	});
  addCompanies();
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
  
//area search
  $('#btnsearchtree').click(function() {

$.ajax({
type: "GET",
url: "map/areasearch.php?keyword="+$("#search1").val()
}).done(function( data )
{
var jsonData = JSON.parse(data);
var jsonLength = jsonData.results.length;
for (var i = 0; i < jsonLength; i++) {
  var result = jsonData.results[i];

  
  var result = L.polygon( stringToGeoPoints(result.geopoint), { color: ''}).addTo(map).
bindPopup(result.area_name + "<br> SIZE OF LAND:  "+ result.sizeofland + "  hectares" ).openPopup();

}
if(!result){
  alert("Area are not found");
}






});
});
 

  function addAreas() {
   for(var i=0; i < areas.length; i++) {
	   console.log(areas[i]['geopoint']);
    var polygon = L.polygon( stringToGeoPoints(areas[i]['geopoint']), { color: ''}).addTo(map);
    polygon.bindPopup( "<b>" + areas[i]['area_name']+"<br>"+"HECTARE  "+areas[i]['sizeofland']);   
	   
   }
  }
  
  function addCompanies() {
    
    for(var i=0; i<companies.length; i++) {
         if(companies[i]['gps']=='degrees'){
            var marker = L.marker( [companies[i]['degreelat'], companies[i]['degreelong']]).addTo(map);
         }
         if(companies[i]['gps']=='decimal'){
            var marker = L.marker( [companies[i]['latdecimal'], companies[i]['longdecimal']]).addTo(map);
         }
     value=''; 
         if(companies[i]['location']=='others'){
             value+=  companies[i]['sub_location']
         }
 
         else{
             value+=  companies[i]['location']
         }
 
     year='';
 
         if(companies[i]['tree_category']=="planted"){
           year+= "<b>AGE</b> " +companies[i]['date_plant']
         }
         if(companies[i]['tree_category']=="natural"){
           year+= "<b>AGE</b> " +companies[i]['discover']
         }
 
 date='';
 
    if(companies[i]['tree_category']=="planted"){
           date+= "<b>DATE PLANTED</b> " +companies[i]['date_planted']
         }
         if(companies[i]['tree_category']=="natural"){
           date+= "<b>DATE DISCOVERED</b> " +companies[i]['date_discover']
         }
 
 remark=''; 
         if(companies[i]['remark']=='others'){
             remark+=  "<b>REMARK:</b> " +companies[i]['other_remark']
         }
 
         else{
             remark+=  "<b>REMARK:</b> " +companies[i]['remark']
         }
 
 coordinates='';
       if(companies[i]['gps']=="degrees"){
           coordinates+= "<b>DEGREE COORDINATES</b><br>" +companies[i]['degreelat'] +"-" +companies[i]['degreelong']
         }
         if(companies[i]['gps']=="decimal"){
           coordinates+= "<b>DECIMAL COORDINATES</b><br> " +companies[i]['latdecimal'] + "-" +companies[i]['longdecimal']
         }
 
 
 
 
 
     marker.bindPopup( "<img   style='position:relative; left:-1vw;width:220px;height:100px;'src='map/gps/" + companies[i]['species_profile'] + "' />"+
   
     "<br><br>"+companies[i]['gps_id'] +"<b>  " + companies[i]['species_name']+
       "</b><br>Location:" +
 
 
        value
 
        + 
     "<br />Tree Height: " +companies[i]['tree_height']+
     "<br />Diameter: " +companies[i]['dba']+
     "<br />Merchantable Height: " +companies[i]['mh']+
     "<br />Tree Category: " +companies[i]['tree_category']+
     "<br>"+ date +
     "<br />Tree Health: " +companies[i]['tree_health']+
     "<br />Owner: " +companies[i]['holder']+
     "</b><br> " + 
     coordinates +
     "<br /> "+ year + "<br/>"+
       remark
     
      );
     // '<br><img src='" + imageURLs[j] + "' width="50" height="50"/>');
    }
   }
  
	
  var companies = JSON.parse( '<?php echo json_encode($arr) ?>' );
  
  var areas = JSON.parse( '<?php echo json_encode($areas) ?>' );
  
// group search

$('#btnfilter').click(function() {
	  $.ajax({
		type: "GET",
		url: "map/areagroup.php?keyword="+$("#search2").val()
	  }).done(function( data )
	  {
		var jsonData = JSON.parse(data);
		var jsonLength = jsonData.results.length;
		var html = "<div class='container-fluid'>";
    html += "<div class='row'>"
   
     html += "<table   class='table table-bordered hover'>";
   html +='<tr>'
		for (var i = 0; i < jsonLength; i++) {
		  var result = jsonData.results[i];
		  html += '<td><button style="" year="' + result.year + '" remark="' + result.remark + '" code="' + result.code + '" health="' + result.tree_health + '" owner="' + result.name_of_holder + '" date="' + result.data_planted + '" category="' + result.tree_category + '" volume="' + result.volume_height + '"  meter="' + result.merchantable_height + '"  diameter="' + result.diameter_breast_height + '"  height="' + result.tree_height + '"     location="' + result.location + '"   image="' + result.species_profile + '" name="' + result.species_name + '"     data-lat="' + result.latitude + '" data-lng="' + result.longitude + '" class="searchResultElement">'
       + result.species_name + "<br>" + result.location +
       '</button></td>';
		}
         if(!result){
      alert("Data not found");
    }


		html += '</tr>'
    html += '</table>';
    
    html += '</div>';    
    html += '</div>';
		$('#searchresult').html(html);  		
		$( 'button.searchResultElement' ).click( function() {
		  var lat = $(this).attr( "data-lat" );
		  var lng = $(this).attr( "data-lng" );
		  var name = $(this).attr( "name" );
		  var image=$(this).attr( "image" );
		  var locate=$(this).attr( "location" );
		  var height=$(this).attr( "height" );
		  var dba=$(this).attr( "diameter" );
		  var mh=$(this).attr( "meter" );
		  var vol=$(this).attr( "volume" );
		  var tc=$(this).attr( "category" );
		  var date=$(this).attr( "date" );
		  var owner=$(this).attr( "owner" );
		  var code=$(this).attr( "code" );
		  var remark=$(this).attr( "remark" );
		  var year=$(this).attr( "year" );
		  var th=$(this).attr( "health" );
	
      
    
      
      var marker = L.marker( [lat,lng]).addTo(map);
    
      marker.bindPopup("<img   style='position:relative; left:1vw;width:160px;height:100px;'src='map/marker/" + image + "' />"+"<br><br>TREE NAME " + name
      +"<br>LOCATION  " + locate +"<br>TREE HEIGHT  " + height +"<br> DIAMITER  " + dba +"<br> MERCHANTABLE HEIGHT  " + mh +"<br>VOLUME " + vol +"<br>TREE CATEGORY  " +tc +"<br>DATE PLANTED  " + date  
      +"<br>HOLDER  " + owner +"<br>CODE  " + code +"<br>REMARK " + remark +"<br>TREE HEALTH " + th +"<br>YEAR " + year
      
        ).openPopup();
    





		});
	  }); 
});














 </script>


<script>
$(document).ready(function(){

$('#choose').on('change',function(){

    if(this.value=='1'){

      $('#treedata').hide();
      $('#treegroup').hide();      
      $('#treeinfo').show();      
    }
    else if(this.value=='2'){
      $('#treeinfo').hide();
      $('#treedata').show();
      $('#treegroup').hide();
      
    }
    else if(this.value=='3'){
      $('#treeinfo').hide();
      $('#treedata').hide();
      $('#treegroup').show();
      
    }
    else{
      $('#treeinfo').hide();
      $('#treedata').hide();
      $('#treegroup').hide();
      $('#search2').val="";
      
    }

});


});


</script>

   

</body>
</html>