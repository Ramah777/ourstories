/*
	file: 	js/myapp.js
	desc:	Code for app.
*/
$(document).ready(function(){
	
	$(function() {
    $("#map").googleMap({
      zoom: 10, // Initial zoom level (optional)
      coords: [65.848663, 24.151954], // Map center (optional)
      type: "ROADMAP" // Map type (optional)
    });
	addMarkers();
	$("#search").submit(function(event){
		addSearch();
		return false;  //no page refresh after submit
	});
  })
});

function addMarkers(){
	$("#map").addMarker({
    	address: "Kauppakatu 58, Tornio", 
		title: 'Lapland UAS',
    	url: 'http://www.lapinamk.fi' 
    });
	var url="getCompanyAddress.php";
	Markers(url);
}
function addSearch(){
	//clear the map from previous state by initializing it
	$("#map").googleMap({
      zoom: 10, // Initial zoom level (optional)
      coords: [65.848663, 24.151954], // Map center (optional)
      type: "ROADMAP" // Map type (optional)
    });
	//take city name from select choise (area)
	var area=$("#area").val();
	var url="getCompanyAddress.php?area="+area;
	Markers(url);
}

function Markers(url){
	$.getJSON(url,function(result){
		$.each(result.companies,function(key,company){
			address=company.Street + ', '+company.City;
			$("#map").addMarker({
				address: address, 
				title: company.Companyname,
				url: company.Web 
			});
		});
	});
}

