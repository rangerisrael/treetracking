
<?php

require_once("database.php");
$arr=$conn->getMarkerList();
$areas = $conn->getAreasList();
?>
<?php
#
  
 session_start();
 
  // The sessions that you're seeing below are the sessions you created in login controller page
  // T
?>
<!DOCTYPE html>
<html>
<head>
<title>Track your map</title>
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="css/leaflet.css" />
<script src="js/leaflet.js"></script>
  <link rel="stylesheet" href="css/leaf.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  
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
   
  #map{

   height: 80vh;
   width: 100vw;
   margin-top: 6%;
   margin-left: 1%;
   padding: 20px;
   
}

#search{
 position:relative;
 top:-7vh;
 left:20vw;
}
.leaflet-interactive{
  fill-opacity:0.7;
}

   </style>
</head>
<body>

 <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; font-weight: bold;" id="mySidebar">
 <button class="w3-bar-item w3-button w3-green"
 onclick="w3_close()"><b>Hide</b></button>

        <?php include_once('side.php');?>
</div>

</div>

<img  src="../background/trees.png" style=" height:12vh;width: 100vw; position: fixed; z-index:1;">

<div id="main">

<div >


 <button id="openNav" class="w3-button w3-teal w3-xlarge" style="position: fixed;z-index: 1;" onclick="w3_open()">&#9776;</button>
 
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
 
</div>
<br>
<br>

<div id="filter" style="position: relative;top:5vh">
   <label for="searchingdata"><b style=" background:#c1c1c1;position:relative; left:35vw;font-size: 25px; ">TRACK TREE ACCORDING TO</b></label><br>
   <select  style="position:relative; top:0.5vh;left:42vw; background: #c1c1c1;"name="choose" id="choose">
   <option value="">Choose selected data</option>
   <option value="1" >SPECIES</option>
   <option value="2">HOLDER</option>
   <option value="3">PLANTATION</option>
   <option value="4">LOCATION</option>
   
   </select>

   <div style='display:none;' id='treespecies' >
<br>
  <!--for species  -->
   <input style="position:relative; text-align:center; top:1vh; left:32vw; width: 30vw; height: 5vh; font-weight: bold; border-radius: 5px;" type="text" name="search" id="search" placeholder="TREE NAME">
   <input type="button" style="position:relative; top: 1vh; left:32vw; "id="btnsearchinfo" class="bg-success" value="SEARCH">
<div id="searchspecies"></div>

   
   </div>

<!-- holder -->
 <div style='display:none;' id='treeholder' >
<br>

<input style="position:relative; text-align:center; top:1vh; left:32vw; width: 30vw; height: 5vh; font-weight: bold; border-radius: 5px;" type="text" name="search" id="searchowner" placeholder="Holder ">
   <input  type="button" id="btnowner" style="position:relative; top:1vh; left:32vw; " class="bg-success" " value="SEARCH">
   <div id="searchresults"></div>
   
   </div>











   <div style='display:none;' id='treearea'>
<br>
   
   <input style="position:relative; text-align:center; top:1vh; left:32vw; width: 30vw; height: 5vh; font-weight: bold; border-radius: 5px;" type="text" name="search" id="search1" placeholder="PLANTATION">
     <input style="position:relative; top:1vh; left:32vw;" type="button" id="btnsearchtree" " class="bg-success" value="SEARCH">

 
   </div>

   <div style='display:none;' id='treelocation'>
<br>
  
   <input  style="position:relative; text-align:center; top:1vh; left:32vw; width: 30vw; height: 5vh; font-weight: bold; border-radius: 5px;" type="text"  name="search" id="search2" placeholder="LOCATION " >
   <input  type="button" id="btnfilter" style="position:relative; top:1vh; left:32vw; " class="bg-success" " value="SEARCH">
   <div id="searchresult" ></div>
 
   </div>
 
</div><br>

<div id="map" style="height:80vh;z-index:0;" ></div>
<div style="position: relative; top:-5vh;">
    <a href="addarea.php" class="w3-bar-item w3-button">MaNAGE PLANTATION AREA</a>
 <a href="../addingdatatree.php" class="w3-bar-item w3-button">MANAGE SPECIES INFORMATION</a>

</div>

<!-- <a href="#" class="w3-bar-item w3-button">ADD ROUTE POINT</a>
 --> 







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
// species e2
$( document ).ready(function() {
 $('#btnsearchinfo').click(function() {
   $.ajax({
   type: "GET",
   url: "species.php?keyword="+$("#search").val()
   }).done(function( data )
   {
   var jsonData = JSON.parse(data);
   var jsonLength = jsonData.results.length;
   
   for (var i = 0; i < jsonLength; i++) {
     var result = jsonData.results[i];


position='';
     if(result.gps=="degrees"){
         position+= "<b>DEGREE COORDINATES</b><br>" +result.degreelat +"-" +result.degreelong
       }
       if(result.gps=="decimal"){
         position+= "<b>DECIMAL COORDINATES</b><br> " +result.latdecimal + "-" +result.longdecimal
       }


date_year='';
 
     if(result.tree_category=="planted"){
       date_year+= "DATE PLANTED " +result.date_planted
     }
     if(result.tree_category=="natural"){
       date_year+= "DATE DISCOVERED " +result.date_discover
     }

yearold='';

        if(result.tree_category=="planted"){
         yearold+= "<b>AGE</b> " +result.plant
       }
       if(result.tree_category=="natural"){
         yearold+= "<b>AGE</b> " +result.discover
       }

remarks=''; 
       if(result.remark=='others'){
           remarks+=  "<b>REMARK:</b> " +result.other_remark
       }

       else{
           remarks+=  "<b>REMARK:</b> " +result.remark
       }

pointlocation='';

     if(result.location=='others'){
       pointlocation+= "LOCATION:" +result.sub_location
     }
     else{
       pointlocation+= "LOCATION:" +result.location

     }













       if(result.gps=='degrees'){
        result += L.marker([result.degreelat,result.degreelong] ).addTo(map)
         .bindPopup("<img   style='position:relative; left:-1vw;width:250px;height:100px;'src='gps/" + 
     result.species_profile + "' />"+
     "<br><br>"+  result.species_name + "<br />Tree Height: "+result.tree_height +"<br />Diameter: "+
     result.dba + "<br />Merchantable Height: " + result.mh + "<br />Tree Category: " + 
     date_year+ "<br />Tree Health: " + result.tree_health +  "<br />Owner: " + result.holder +
     "</b><br>" + position + "<br>"+ year
        + "<br> LOCATION:  "+ pointlocation + "<br> CODES: " + result.code + "<br>" + remarks)
       .openPopup();
    
       }

     if(result.gps=='decimal'){
    
        result += L.marker([result.latdecimal,result.longdecimal] ).addTo(map)
         .bindPopup("<img   style='position:relative; left:-1vw;width:250px;height:100px;'src='gps/" + 
     result.species_profile + "' />"+
     "<br><br>"+  result.species_name + "<br />Tree Height: "+result.tree_height +"<br />Diameter: "+
     result.dba + "<br />Merchantable Height: " + result.mh + "<br />Tree Category: " + 
     date_year+ "<br />Tree Health: " + result.tree_health +  "<br />Owner: " + result.holder +
     "</b><br>" + position + "<br>"+ year
        + "<br> LOCATION:  "+ pointlocation + "<br> CODES: " + result.code + "<br>" + remarks)
       .openPopup();
    
      }

    
   
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
 
 $('#btnsearchtree').click(function() {

$.ajax({
type: "GET",
url: "areasearch.php?keyword="+$("#search1").val()
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
 alert("Plantion is not set");
} 






});
});

//species filter
$('#btnsearchinfo').click(function() {
   $.ajax({
   type: "GET",
   url: "species.php?keyword="+$("#search").val()
   }).done(function( data )
   {
   var jsonData = JSON.parse(data);
   var jsonLength = jsonData.results.length;
     var html = "<div >";
   html += "<div class='row'>"
  
    html += "<table   class='table table-bordered hover'style='width:20vw; height:5vh; font-weight:bold; background:trasparent; font-size:10px; '>";
  html +='<tr>'
  html +='<tr>'
   for (var i = 0; i < jsonLength; i++) {
     var result = jsonData.results[i];


position='';
     if(result.gps=="degrees"){
         position+= "<b>DEGREE COORDINATES</b><br>" +result.degreelat +"-" +result.degreelong
       }
       if(result.gps=="decimal"){
         position+= "<b>DECIMAL COORDINATES</b><br> " +result.latdecimal + "-" +result.longdecimal
       }


date_year='';
 
     if(result.tree_category=="planted"){
       date_year+= "DATE PLANTED " +result.date_planted
     }
     if(result.tree_category=="natural"){
       date_year+= "DATE DISCOVERED " +result.date_discover
     }

yearold='';

        if(result.tree_category=="planted"){
         yearold+= "<b>AGE</b> " +result.plant
       }
       if(result.tree_category=="natural"){
         yearold+= "<b>AGE</b> " +result.discover
       }

remarks=''; 
       if(result.remark=='others'){
           remarks+=  "<b>REMARK:</b> " +result.other_remark
       }

       else{
           remarks+=  "<b>REMARK:</b> " +result.remark
       }

pointlocation='';

     if(result.location=='others'){
       pointlocation+= "LOCATION:" +result.sub_location
     }
     else{
       pointlocation+= "LOCATION:" +result.location

     }

  html += '<td><button style="height:5vh;" location="'+pointlocation+'" rems="'+remarks+'" years="'+yearold+'" position="'+position+'" hold="'+result.holder+'" mh="'+result.mh+'" health="'+result.tree_health+'" dba="'+result.dba+'"   text-align:center;" height="'+result.tree_height+'"dateyear="'+date_year+'" name="'+result.species_name+'" id="'+result.gps_id+'"  gps="' + result.gps + '" profile="' + result.species_profile + '" deglat="' + result.degreelat + '" deglong="' + result.degreelong + '" lat="' + result.latdecimal + '" long="' + result.longdecimal + '" long="' + result.longdecimal + '"  class="searchResult">'
      + result.species_name + "<br>" + value +
      '</button></td>';
   }
  if(!result){
 alert("Species is not recognize");
}
   html += '</tr>'
   html += '</table>';
   
   html += '</div>';    
   html += '</div>';
  
   $('#searchspecies').html(html);      
   $( 'button.searchResult' ).click( function() {
   
       
var lat = $(this).attr( "lat" );
     var lng = $(this).attr( "long" );
   
     var deglat = $(this).attr( "deglat" );
     var deglng = $(this).attr( "deglong" );

      var coord= $(this).attr( "gps" );
   var year_old = $(this).attr( "years" );
   
   var profile = $(this).attr( "profile" );
   var ids = $(this).attr( "id" );
   var name = $(this).attr( "name" );

   var height=$(this).attr("height");

   var dba=$(this).attr("dba");

   var meter=$(this).attr("mh");

   var health=$(this).attr("health");

   var holder=$(this).attr("hold");

   var position=$(this).attr("position");
 
   var dated=$(this).attr("dateyear");

var rems=$(this).attr("rems");

var pointlocation=$(this).attr("location");

   if(coord=='degrees'){
     var degree= L.marker( [deglat, deglng]).addTo(map);
       degree.bindPopup("<img   style='position:relative; left:-1vw;width:250px;height:100px;'src='gps/" + profile + "' />"
+"<br/><b>  " + ids + "  "+name+"</b>" + "<br/>"+ "<b>TREE HEIGHT</b>: " + height + "<br/><b>DIAMETER</b>: " + dba + "<br/><b>MERCHANTABLE HEIGHT</b>: " + meter + "<br/>" +dated +"<br/>"+"<b>TREE HEALTH</b>:" +health +"<br/>" + "<b>HOLDER</b>:"  + holder +"<br/>" +position +"<br/>"+ year_old +"<br>"+ pointlocation +"<br/>" + rems 







       ).openPopup();
   
   }
    if(coord=='decimal'){
     var decimal = L.marker( [lat, lng]).addTo(map);
     decimal.bindPopup("<img   style='position:relative; left:-1vw;width:250px;height:100px;'src='gps/" + profile + "' />"
+"<br/><b>  " + ids + "  "+name+"</b>" + "<br/>"+ "<b>TREE HEIGHT</b>: " + height + "<br/><b>DIAMETER</b>: " + dba + "<br/><b>MERCHANTABLE HEIGHT</b>: " + meter + "<br/>" +dated +"<br/>"+"<b>TREE HEALTH</b>:" +health +"<br/>" + "<b>HOLDER</b>:"  + holder +"<br/>" +position +"<br/>"+ year_old +"<br>"+ pointlocation +"<br/>" + rems





       ).openPopup();
   
   }






   });
   }); 
});



//end species









//show area on map using geopoint

 function addAreas() {
  for(var i=0; i < areas.length; i++) {
    console.log(areas[i]['geopoint']);
   var polygon = L.polygon( stringToGeoPoints(areas[i]['geopoint']), { color: ''}).addTo(map);
   polygon.bindPopup( "<b>" + areas[i]['area_name']+"<br>"+"HECTARE  "+areas[i]['sizeofland']);   
    
  }
 }
 //show marker point
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





   marker.bindPopup( "<img   style='position:relative; left:-1vw;width:220px;height:100px;'src='gps/" + companies[i]['species_profile'] + "' />"+
 
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
 
 
 
 //this is the function to parse data from php mysql in db.php
 var companies = JSON.parse( '<?php echo json_encode($arr) ?>' );
 
 var areas = JSON.parse( '<?php echo json_encode($areas) ?>' );
 
 // location

$('#btnfilter').click(function() {
   $.ajax({
   type: "GET",
   url: "location.php?keyword="+$("#search2").val()
   }).done(function( data )
   {
   var jsonData = JSON.parse(data);
   var jsonLength = jsonData.results.length;
   var html = "<div >";
   html += "<div class='row'>"
  
    html += "<table   class='table table-bordered hover'style='width:20vw; height:5vh; font-weight:bold; background:trasparent; font-size:10px; '>";
  html +='<tr>'
   for (var i = 0; i < jsonLength; i++) {
     var result = jsonData.results[i];

position='';
     if(result.gps=="degrees"){
         position+= "<b>DEGREE COORDINATES</b><br>" +result.degreelat +"-" +result.degreelong
       }
       if(result.gps=="decimal"){
         position+= "<b>DECIMAL COORDINATES</b><br> " +result.latdecimal + "-" +result.longdecimal
       }


date_year='';
 
     if(result.tree_category=="planted"){
       date_year+= "DATE PLANTED " +result.date_planted
     }
     if(result.tree_category=="natural"){
       date_year+= "DATE DISCOVERED " +result.date_discover
     }

yearold='';

        if(result.tree_category=="planted"){
         yearold+= "<b>AGE</b> " +result.plant
       }
       if(result.tree_category=="natural"){
         yearold+= "<b>AGE</b> " +result.discover
       }

remarks=''; 
       if(result.remark=='others'){
           remarks+=  "<b>REMARK:</b> " +result.other_remark
       }

       else{
           remarks+=  "<b>REMARK:</b> " +result.remark
       }

pointlocation='';

     if(result.location=='others'){
       pointlocation+= "LOCATION:" +result.sub_location
     }
     else{
       pointlocation+= "LOCATION:" +result.location

     }



      html += '<td><button style="height:5vh;" location="'+pointlocation+'" rems="'+remarks+'" years="'+yearold+'" position="'+position+'" hold="'+result.holder+'" mh="'+result.mh+'" health="'+result.tree_health+'" dba="'+result.dba+'"   text-align:center;" height="'+result.tree_height+'"dateyear="'+date_year+'" name="'+result.species_name+'" id="'+result.gps_id+'"  gps="' + result.gps + '" profile="' + result.species_profile + '" deglat="' + result.degreelat + '" deglong="' + result.degreelong + '" lat="' + result.latdecimal + '" long="' + result.longdecimal + '" long="' + result.longdecimal + '"  class="searchResultElement">'
      + result.species_name + "<br>" + value +
      '</button></td>';
   }
  if(!result){
 alert("Location is not recognize");
}
   html += '</tr>'
   html += '</table>';
   
   html += '</div>';    
   html += '</div>';
  
   $('#searchresult').html(html);      
   $( 'button.searchResultElement' ).click( function() {
    
var lat = $(this).attr( "lat" );
     var lng = $(this).attr( "long" );
   
     var deglat = $(this).attr( "deglat" );
     var deglng = $(this).attr( "deglong" );

      var coord= $(this).attr( "gps" );
   var year_old = $(this).attr( "years" );
   
   var profile = $(this).attr( "profile" );
   var ids = $(this).attr( "id" );
   var name = $(this).attr( "name" );

   var height=$(this).attr("height");

   var dba=$(this).attr("dba");

   var meter=$(this).attr("mh");

   var health=$(this).attr("health");

   var holder=$(this).attr("hold");

   var position=$(this).attr("position");
 
   var dated=$(this).attr("dateyear");

var rems=$(this).attr("rems");

var pointlocation=$(this).attr("location");

   if(coord=='degrees'){
     var degree= L.marker( [deglat, deglng]).addTo(map);
       degree.bindPopup("<img   style='position:relative; left:-1vw;width:250px;height:100px;'src='gps/" + profile + "' />"
+"<br/><b>  " + ids + "  "+name+"</b>" + "<br/>"+ "<b>TREE HEIGHT</b>: " + height + "<br/><b>DIAMETER</b>: " + dba + "<br/><b>MERCHANTABLE HEIGHT</b>: " + meter + "<br/>" +dated +"<br/>"+"<b>TREE HEALTH</b>:" +health +"<br/>" + "<b>HOLDER</b>:"  + holder +"<br/>" +position +"<br/>"+ year_old +"<br>"+ pointlocation +"<br/>" + rems 







       ).openPopup();
   
   }
    if(coord=='decimal'){
     var decimal = L.marker( [lat, lng]).addTo(map);
     decimal.bindPopup("<img   style='position:relative; left:-1vw;width:250px;height:100px;'src='gps/" + profile + "' />"
+"<br/><b>  " + ids + "  "+name+"</b>" + "<br/>"+ "<b>TREE HEIGHT</b>: " + height + "<br/><b>DIAMETER</b>: " + dba + "<br/><b>MERCHANTABLE HEIGHT</b>: " + meter + "<br/>" +dated +"<br/>"+"<b>TREE HEALTH</b>:" +health +"<br/>" + "<b>HOLDER</b>:"  + holder +"<br/>" +position +"<br/>"+ year_old +"<br>"+ pointlocation +"<br/>" + rems





       ).openPopup();
   
   }


   });
   }); 
});


// this is for filtering owner

$('#btnowner').click(function() {
   $.ajax({
   type: "GET",
   url: "holder.php?keyword="+$("#searchowner").val()
   }).done(function( data )
   {
   var jsonData = JSON.parse(data);
   var jsonLength = jsonData.results.length;
     var html = "<div >";
   html += "<div class='row'>"
  
    html += "<table   class='table table-bordered hover'style='width:20vw; height:5vh; font-weight:bold; background:trasparent; font-size:10px; '>";
  html +='<tr>'
   for (var i = 0; i < jsonLength; i++) {
     var result = jsonData.results[i];




position='';
     if(result.gps=="degrees"){
         position+= "<b>DEGREE COORDINATES</b><br>" +result.degreelat +"-" +result.degreelong
       }
       if(result.gps=="decimal"){
         position+= "<b>DECIMAL COORDINATES</b><br> " +result.latdecimal + "-" +result.longdecimal
       }


date_year='';
 
     if(result.tree_category=="planted"){
       date_year+= "DATE PLANTED " +result.date_planted
     }
     if(result.tree_category=="natural"){
       date_year+= "DATE DISCOVERED " +result.date_discover
     }

yearold='';

        if(result.tree_category=="planted"){
         yearold+= "<b>AGE</b> " +result.plant
       }
       if(result.tree_category=="natural"){
         yearold+= "<b>AGE</b> " +result.discover
       }

remarks=''; 
       if(result.remark=='others'){
           remarks+=  "<b>REMARK:</b> " +result.other_remark
       }

       else{
           remarks+=  "<b>REMARK:</b> " +result.remark
       }

pointlocation='';

     if(result.location=='others'){
       pointlocation+= "LOCATION:" +result.sub_location
     }
     else{
       pointlocation+= "LOCATION:" +result.location

     }

      html += '<td><button style="height:5vh;" location="'+pointlocation+'" rems="'+remarks+'" years="'+yearold+'" position="'+position+'" hold="'+result.holder+'" mh="'+result.mh+'" health="'+result.tree_health+'" dba="'+result.dba+'"   text-align:center;" height="'+result.tree_height+'"dateyear="'+date_year+'" name="'+result.species_name+'" id="'+result.gps_id+'"  gps="' + result.gps + '" profile="' + result.species_profile + '" deglat="' + result.degreelat + '" deglong="' + result.degreelong + '" lat="' + result.latdecimal + '" long="' + result.longdecimal + '" long="' + result.longdecimal + '"  class="searchResultElements">'
      + result.species_name + "<br>" + value +
      '</button></td>';
   }
   
  if(!result){
 alert("Holder not recognize");
}
   html += '</tr>'
   html += '</table>';
   
   html += '</div>';    
   html += '</div>';
   $('#searchresults').html(html);      
   $( 'button.searchResultElements' ).click( function() {
   

         
var lat = $(this).attr( "lat" );
     var lng = $(this).attr( "long" );
   
     var deglat = $(this).attr( "deglat" );
     var deglng = $(this).attr( "deglong" );

      var coord= $(this).attr( "gps" );
   var year_old = $(this).attr( "years" );
   
   var profile = $(this).attr( "profile" );
   var ids = $(this).attr( "id" );
   var name = $(this).attr( "name" );

   var height=$(this).attr("height");

   var dba=$(this).attr("dba");

   var meter=$(this).attr("mh");

   var health=$(this).attr("health");

   var holder=$(this).attr("hold");

   var position=$(this).attr("position");
 
   var dated=$(this).attr("dateyear");

var rems=$(this).attr("rems");

var pointlocation=$(this).attr("location");

   if(coord=='degrees'){
     var degree= L.marker( [deglat, deglng]).addTo(map);
       degree.bindPopup("<img   style='position:relative; left:-1vw;width:250px;height:100px;'src='gps/" + profile + "' />"
+"<br/><b>  " + ids + "  "+name+"</b>" + "<br/>"+ "<b>TREE HEIGHT</b>: " + height + "<br/><b>DIAMETER</b>: " + dba + "<br/><b>MERCHANTABLE HEIGHT</b>: " + meter + "<br/>" +dated +"<br/>"+"<b>TREE HEALTH</b>:" +health +"<br/>" + "<b>HOLDER</b>:"  + holder +"<br/>" +position +"<br/>"+ year_old +"<br>"+ pointlocation +"<br/>" + rems 







       ).openPopup();
   
   }
    if(coord=='decimal'){
     var decimal = L.marker( [lat, lng]).addTo(map);
     decimal.bindPopup("<img   style='position:relative; left:-1vw;width:250px;height:100px;'src='gps/" + profile + "' />"
+"<br/><b>  " + ids + "  "+name+"</b>" + "<br/>"+ "<b>TREE HEIGHT</b>: " + height + "<br/><b>DIAMETER</b>: " + dba + "<br/><b>MERCHANTABLE HEIGHT</b>: " + meter + "<br/>" +dated +"<br/>"+"<b>TREE HEALTH</b>:" +health +"<br/>" + "<b>HOLDER</b>:"  + holder +"<br/>" +position +"<br/>"+ year_old +"<br>"+ pointlocation +"<br/>" + rems





       ).openPopup();
     
   }


   });
   }); 
});










// end for plantation

</script>
<script>
function w3_open() {
 document.getElementById("main").style.marginLeft = "20%";
 document.getElementById("filter").style.marginLeft = "-10%";
 document.getElementById("mySidebar").style.width = "20%";
 document.getElementById("mySidebar").style.color = "white";
document.getElementById("mySidebar").style.background = "#222222";
 document.getElementById("mySidebar").style.backgroundSize = "cover";
document.getElementById("map").style.marginTop = '7%';
document.getElementById("mySidebar").style.marginTop = '6%';
 document.getElementById("mySidebar").style.display = "block";
 document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
 document.getElementById("main").style.marginLeft = "0%";
 document.getElementById("mySidebar").style.display = "none";
 document.getElementById("map").style.marginTop = '5%';
  document.getElementById("filter").style.marginLeft = "2%";
 document.getElementById("openNav").style.display = "inline-block";
}
</script>


<script>
$(document).ready(function(){
 $('#choose').on('change',function(){

   if(this.value=='1'){

     $('#treearea').hide();
     $('#treeholder').hide();
     $('#treelocation').hide();      
     $('#treespecies').show();      
   }
   else if(this.value=='2'){
    $('#treearea').hide();
     $('#treeholder').show();
     $('#treelocation').hide();      
     $('#treespecies').hide();
     
   }
   else if(this.value=='3'){
     $('#treearea').show();
     $('#treeholder').hide();
     $('#treelocation').hide();      
     $('#treespecies').hide();
     
   }
   else if(this.value=='4'){
     $('#treearea').hide();
     $('#treeholder').hide();
     $('#treelocation').show();      
     $('#treespecies').hide();
     
   }
   else{
     $('#treeinfo').hide();
     $('#treedata').hide();
     $('#treegroup').hide();
     $('#search2').val="";
       $('#treearea').hide();
     $('#treeholder').hide();
     $('#treelocation').hide();      
     $('#treespecies').hide();
   }

});


});



</script>

</body>
</html>