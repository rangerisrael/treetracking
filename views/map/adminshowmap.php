
<?php

 require_once("db.php");
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
  <a href="addmarkerpoint.php" class="w3-bar-item w3-button">MANAGE SPECIES INFORMATION</a>

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

$( document ).ready(function() {
	$('#btnsearchinfo').click(function() {
	  $.ajax({
		type: "GET",
		url: "searchmarker.php?keyword="+$("#search").val()
	  }).done(function( data )
	  {
		var jsonData = JSON.parse(data);
		var jsonLength = jsonData.results.length;
		
    for (var i = 0; i < jsonLength; i++) {
      var result = jsonData.results[i];
		  var result = L.marker([result.latitude,result.longitude] ).addTo(map)
      .bindPopup("<img   style='position:relative; left:-1vw;width:160px;height:100px;'src='marker/" + 
      result.species_profile + "' />"+
      "<br><br>"+  result.species_name + "<br />Tree Height: "+result.tree_height +"<br />Diameter: "+
      result.diameter_breast_height + "<br />Merchantable Height: " + result.merchantable_height + "<br />Tree Category: " + 
      result.tree_category + "<br />Tree Health: " + result.tree_health +  "<br />Owner: " + result.name_of_holder +
      "</b><br>GPS READING LAT LONG:" + result.latitude + "-" + result.longitude + "<br> YEAR: "+
        result.year + "<br> LOCATION:  "+ result.location + "<br> CODE: " + result.code + "<br> REMARKS: " + result.remark)
        .openPopup();
    
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
    url: "searchmarker.php?keyword="+$("#search").val()
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
      html += '<td><button style="height:5vh;   text-align:center;" year="' + result.year + '" remark="' + result.remark + '" code="' + result.code + '" health="' + result.tree_health + '" owner="' + result.name_of_holder + '" date="' + result.data_planted + '" category="' + result.tree_category + '" volume="' + result.volume_height + '"  meter="' + result.merchantable_height + '"  diameter="' + result.diameter_breast_height + '"  height="' + result.tree_height + '"     location="' + result.location + '"   image="' + result.species_profile + '" name="' + result.species_name + '"     data-lat="' + result.latitude + '" data-lng="' + result.longitude + '" class="searchResultspecies">'
       + result.species_name + "<br>" + result.location +
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
    $( 'button.searchResultSpecies' ).click( function() {
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
    
      marker.bindPopup("<img   style='position:relative; left:1vw;width:160px;height:100px;'src='marker/" + image + "' />"+"<br><br>TREE NAME " + name
      +"<br>LOCATION  " + locate +"<br>TREE HEIGHT  " + height +"<br> DIAMITER  " + dba +"<br> MERCHANTABLE HEIGHT  " + mh +"<br>VOLUME " + vol +"<br>TREE CATEGORY  " +tc +"<br>DATE PLANTED  " + date  
      +"<br>HOLDER  " + owner +"<br>CODE  " + code +"<br>REMARK " + remark +"<br>TREE HEALTH " + th +"<br>YEAR " + year
      
        ).openPopup();
    

      


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
    var marker = L.marker( [companies[i]['latitude'], companies[i]['longitude']]).addTo(map);
    
    marker.bindPopup( "<img   style='position:relative; left:5vw;width:160px;height:100px;'src='marker/" + companies[i]['species_profile'] + "' />"+
  
    "<br><br>"+companies[i]['point_id'] +"<b>  " + companies[i]['species_name']+
      "</b><br>Location:" + companies[i]['location'] + 
    "<br />Tree Height: " +companies[i]['tree_height']+
    "<br />Diameter: " +companies[i]['diameter_breast_height']+
    "<br />Merchantable Height: " +companies[i]['merchantable_height']+
    "<br />Tree Category: " +companies[i]['tree_category']+
    "<br>Date Planted "+ companies[i]['date_planted']+
    "<br />Tree Health: " +companies[i]['tree_health']+
    "<br />Owner: " +companies[i]['name_of_holder']+
    "</b><br>GPS READING LAT LONG:" + 
    companies[i]['latitude']+ "-" +companies[i]['longitude'] + 
    "<br />Year "+(companies[i]['year'])  
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
		url: "areagroup.php?keyword="+$("#search2").val()
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
		  html += '<td><button style="height:5vh;   text-align:center;" year="' + result.year + '" remark="' + result.remark + '" code="' + result.code + '" health="' + result.tree_health + '" owner="' + result.name_of_holder + '" date="' + result.data_planted + '" category="' + result.tree_category + '" volume="' + result.volume_height + '"  meter="' + result.merchantable_height + '"  diameter="' + result.diameter_breast_height + '"  height="' + result.tree_height + '"     location="' + result.location + '"   image="' + result.species_profile + '" name="' + result.species_name + '"     data-lat="' + result.latitude + '" data-lng="' + result.longitude + '" class="searchResultElement">'
       + result.species_name + "<br>" + result.location +
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
    
      marker.bindPopup("<img   style='position:relative; left:1vw;width:160px;height:100px;'src='marker/" + image + "' />"+"<br><br>TREE NAME " + name
      +"<br>LOCATION  " + locate +"<br>TREE HEIGHT  " + height +"<br> DIAMITER  " + dba +"<br> MERCHANTABLE HEIGHT  " + mh +"<br>VOLUME " + vol +"<br>TREE CATEGORY  " +tc +"<br>DATE PLANTED  " + date  
      +"<br>HOLDER  " + owner +"<br>CODE  " + code +"<br>REMARK " + remark +"<br>TREE HEALTH " + th +"<br>YEAR " + year
      
        ).openPopup();
    

      


		});
	  }); 
});


//this is for filtering owner

$('#btnowner').click(function() {
    $.ajax({
    type: "GET",
    url: "owner.php?keyword="+$("#searchowner").val()
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
      html += '<td><button style="height:5vh;   text-align:center;" year="' + result.year + '" remark="' + result.remark + '" code="' + result.code + '" health="' + result.tree_health + '" owner="' + result.name_of_holder + '" date="' + result.data_planted + '" category="' + result.tree_category + '" volume="' + result.volume_height + '"  meter="' + result.merchantable_height + '"  diameter="' + result.diameter_breast_height + '"  height="' + result.tree_height + '"     location="' + result.location + '"   image="' + result.species_profile + '" name="' + result.species_name + '"     data-lat="' + result.latitude + '" data-lng="' + result.longitude + '" class="searchResultElements">'
       + result.species_name + "<br>" + result.location + "<br>Owner is " + result.name_of_holder +
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
    
      marker.bindPopup("<img   style='position:relative; left:1vw;width:160px;height:100px;'src='marker/" + image + "' />"+"<br><br>TREE NAME " + name
      +"<br>LOCATION  " + locate +"<br>TREE HEIGHT  " + height +"<br> DIAMITER  " + dba +"<br> MERCHANTABLE HEIGHT  " + mh +"<br>VOLUME " + vol +"<br>TREE CATEGORY  " +tc +"<br>DATE PLANTED  " + date  
      +"<br>HOLDER  " + owner +"<br>CODE  " + code +"<br>REMARK " + remark +"<br>TREE HEALTH " + th +"<br>YEAR " + year
      
        ).openPopup();
    

      


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
      
    }

});


});



</script>

</body>
</html>