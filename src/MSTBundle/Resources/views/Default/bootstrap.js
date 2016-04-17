//Database




function printSchedule()
{
   var line = ["1 Asilomar-Monterey", "2 Pacific Grove-Carmel"];
   var schedule = ["Monterey Transit Plaza", "Tyler & Franklin", "Aquarium Foam & Irving", "Pacific Grove Lighthouse & Fountain", "Asilomar & Sinex", "Pacific Grove Golf Course", "0", "5:47", "--", "5:55", "6:00", "6:08", "6:14", "0", "7:02", "--", "7:10", "7:15", "7:23", "7:29", "0", "7:20", "--", "7:30", "7:35", "7:43", "--", "0", "8:00", "8:01", "8:10", "8:15", "8:23", "8:29", "0", "9:00", "--", "9:10", "9:15", "9:23", "9:29", "0", "10:00", "10:01", "10:10", "10:15", "10:23", "10:29", "0", "11:00", "--", "11:10", "11:15", "11:23", "11:29", "0", "12:00", "12:01", "12:10", "12:15", "12:23", "12:29", "0", "1:00", "--", "1:10", "1:15", "1:23", "1:29", "0", "2:00", "2:01", "2:10", "2:15", "2:23", "2:29", "0", "3:00", "--", "3:10", "3:15", "3:23", "3:29", "0", "4:00", "4:01", "4:10", "4:15", "4:23", "4:29", "0", "5:00", "--", "5:10", "5:15", "5:23", "5:29", "0", "6:00", "6:01", "6:10", "6:15", "6:23", "6:29", "0", "7:00", "--", "7:10", "7:15", "7:23", "7:29", "0", "0"];
   var place = [0];

   var nbLine = document.getElementById('line').value;
   var nb = nbLine.charCodeAt(0) - 49;
   nb = place[nb];
   var print = "<table class=\"table table-bordered\"><thead><tr>"/* + schedule[nb] + "</th></tr></thead><tbody><tr>"*/;
   while (schedule[nb] != "0")
   {
       print += "<th>" + schedule[nb] + "</th>";
       nb++;
   }
   print += "</tr></thead><tbody><tr>";
   nb++;
   while (schedule[nb] != "0" || schedule[nb+1] !="0")
   {
       if (schedule[nb] == "0")
           print += "</tr><tr>";
       else
           print = print + "<td>" + schedule[nb]+"</td>";
       nb++;
   }
   print = print + "</tr></tbody></table>";
   window.alert(print);
   document.querySelector('.print').innerHTML = print;
}

function initMap() 
{ 
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var map = new google.maps.Map(document.getElementById('map'), 
	{ 
	    zoom: 7, 
	    center: {lat: 41.85, lng: -87.65} 
	});
    directionsDisplay.setMap(map);
    var onChangeHandler = function() 
    {
        calculateAndDisplayRoute(directionsService, directionsDisplay);
    };
    document.getElementById('start').addEventListener('change', onChangeHandler);       
    document.getElementById('end').addEventListener('change', onChangeHandler);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) 
{   
    var Sta = document.getElementById('start').value;
    var En = document.getElementById('end').value;
    if ( Sta == "" || En == "")     
    { 
        return; 
    }
    directionsService.route(
    {
        origin: document.getElementById('start').value, 
        destination: document.getElementById('end').value, 
        travelMode: google.maps.TravelMode.TRANSIT, 
        transitOptions: {
        modes: [google.maps.TransitMode.BUS],
        //routingPreference: google.maps.TransitRoutePreference.FEWER_TRANSFERS
  }
    }, function(response, status) 
    { 
        if (status === google.maps.DirectionsStatus.OK)     
        { 
            printRouteInfo(response);
            //document.querySelector('.results').innerHTML = '';
            window.alert('Directions request  ' + status);
            directionsDisplay.setDirections(response);
            
        } 
        else 
        { 
        window.alert('Directions request failed due to ' + status); 
        } 
    });
 }

function printRouteInfo(response)
{
    var route = response.routes[0].legs[0];
    var step;
    var info = "";
    var info2 = "<p style=\"color: #000000; background-color: #ffffff\">";
    for (var i = 0; i < route.steps.length; i++)
    {
        if(route.steps[i].travel_mode == 'TRANSIT')
        {
            info = info + "....[Bus line: " + route.steps[i].transit.line.short_name;
            info = info + "....Bus departure: " + route.steps[i].transit.departure_stop.name;
            info = info + "....Nb Stop:  " + route.steps[i].transit.num_stops;
            info = info + "]....";

            info2 = info2 + "<font color=\"#FF0000\">BUS: " + route.steps[i].transit.line.short_name;
            info2 = info2 + "</font> at " + route.steps[i].transit.departure_stop.name;
            info2 = info2 + " " + route.steps[i].transit.num_stops;
            info2 = info2 + " stop to <font color=\"#2432df\">" + route.steps[i].transit.arrival_stop.name;
            info2 = info2 + "</font>. <br />";
        }
    }
    info2 = info2 + "</font> </p>";
    document.getElementById('Answer').value = info;
    document.querySelector('.results').innerHTML = info2;
}


