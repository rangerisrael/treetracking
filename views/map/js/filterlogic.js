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
  
  
  
  
  var companies = JSON.parse( '<?php echo json_encode($arr) ?>' );
  
  var areas = JSON.parse( '<?php echo json_encode($areas) ?>' );
  
  // group search

$('#btnfilter').click(function() {
    $.ajax({
    type: "GET",
    url: "areagroup.php?keyword="+$("#search2").val()
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
  alert("Data are not found");
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

