/**
 * Created by ADMAZLUM on 18.11.2016.
 */

var map,
    infoWindow,
    markers = [];

function initMap() {

    var lat = $("#location_lat").val();
    var lng = $("#location_lng").val();

    var nlat = Number(lat);
    var nlng = Number(lng);

    if (lat == '' && lng == '') {
        nlat = 39.130;
        nlng = 34.804;
    }

    var mapOptions = {
        streetViewControl: false,
        mapTypeId: 'roadmap'
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // creates the new Info Window with reference to the variable infowindow
    infoWindow = new google.maps.InfoWindow();

    // event to close the infowindow with a click on the map
    google.maps.event.addListener(map, 'click', function () {
        infoWindow.close();
    });

    // submit event
    document.getElementById('submit').addEventListener('click', function () {
        relocateMap();
    });

    // Define Degree Inputs
    dd2dms(nlat, nlng);

    // displayMarkers() function is called to begin the markers creation
    displayMarkers(nlat, nlng);
}

function displayMarkers(lat, lng) {

    // this variable sets the map bounds according to markers position
    var bounds = new google.maps.LatLngBounds();

    // for loop traverses markersData array calling createMarker function for each marker

    var latlng = new google.maps.LatLng(lat, lng);

    createMarker(latlng);

    // marker position is added to bounds variable
    bounds.extend(latlng);

    // Finally the bounds variable is used to set the map bounds
    // with fitBounds() function
    map.fitBounds(bounds);
}

function createMarker(latlng) {

    var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        draggable: true
    });

    // This event expects a click on a marker
    // When this event is fired the Info Window content is created
    // and the Info Window is opened.
    google.maps.event.addListener(marker, 'click', function () {

        // Call ddToDms(lat, lng) function to construct the coordinates string.
        // The returned value will be stored in dmsCoords variable.
        var dmsCoords = ddToDms(latlng.lat(), latlng.lng());

        // iwContent sets HML structure to insert into the Info Window.
        var iwContent = '<div id="iw_container">' +
            'GPS: ' + dmsCoords + '</div>'; // Incluir as coordenadas na Info Window.

        // Including content to the Info Window.
        infoWindow.setContent(iwContent);

        // Opening the Info Window.
        infoWindow.open(map, marker);
    });

    // Update Position
    google.maps.event.addListener(marker, 'dragend', function (event) {

        //var new_location = marker.getPosition();
        infoWindow.setContent(event.latLng.lat().toFixed(3) + " - " + event.latLng.lng().toFixed(3));
        infoWindow.open(map, marker);
        dd2dms(event.latLng.lat().toFixed(3), event.latLng.lng().toFixed(3));

        $("#location_lat").val(event.latLng.lat().toFixed(3));
        $("#location_lng").val(event.latLng.lng().toFixed(3));
    });

    markers.push(marker);
}

// This function returns the coordinate
// conversion string in DD to DMS.
function ddToDms(lats, lngs) {

    var lat = lats;
    var lng = lngs;
    var latResult, lngResult, dmsResult;

    // Make sure that you are working with numbers.
    // This is important in case you are working with values
    // from input text in HTML.
    lat = parseFloat(lat);
    lng = parseFloat(lng);

    // Check the correspondence of the coordinates for latitude: North or South.
    latResult = (lat >= 0) ? 'N' : 'S';

    // Call to getDms(lat) function for the coordinates of Latitude in DMS.
    // The result is stored in latResult variable.
    latResult += getDms(lat);

    // Check the correspondence of the coordinates for longitude: East or West.
    lngResult = (lng >= 0) ? 'E' : 'W';

    // Call to getDms(lng) function for the coordinates of Longitude in DMS.
    // The result is stored in lngResult variable.
    lngResult += getDms(lng);

    // Joining both variables and separate them with a space.
    dmsResult = latResult + ' ' + lngResult;

    // Return the resultant string.
    return dmsResult;
}

// Function that converts DMS to DD.
// Taking as example the value -40.601203.
function getDms(val) {

    // Required variables
    var valDeg, valMin, valSec, result;

    val = Math.abs(val); // -40.601203 = 40.601203

    // ---- Degrees ----
    // Stores the integer of DD for the Degrees value in DMS
    valDeg = Math.floor(val); // 40.601203 = 40

    // Add the degrees value to the result by adding the degrees symbol "º".
    result = valDeg + "º"; // 40º

    // ---- Minutes ----
    valMin = Math.floor((val - valDeg) * 60); // 36.07218 = 36

    // Add minutes to the result, adding the symbol minutes "'".
    result += valMin + "'"; // 40º36'

    // ---- Seconds ----
    valSec = Math.round((val - valDeg - valMin / 60) * 3600 * 1000) / 1000; // 40.601203 = 4.331

    // Add the seconds value to the result,
    // adding the seconds symbol " " ".
    result += valSec + '"'; // 40º36'4.331"

    // Returns the resulting string.
    return result;
}

// Change Lat - Lng to DMS Type
function dd2dms(LatVal, LngVal) {

    // degrees = degrees
    var LatVals = LatVal.toString().split('.');
    $("#lat_deg").val(LatVals[0]);

    var LongVals = LngVal.toString().split('.');
    $("#lng_deg").val(LongVals[0]);

    // * 60 = mins
    var ddLatRemainder = ("0." + LatVals[1]) * 60;
    var dmsLatMinVals = ddLatRemainder.toString().split(".");
    $("#lat_min").val(dmsLatMinVals[0]);

    var ddLongRemainder = ("0." + LongVals[1]) * 60;
    var dmsLongMinVals = ddLongRemainder.toString().split(".");
    $("#lng_min").val(dmsLongMinVals[0]);

    // * 60 again = secs
    var ddLatMinRemainder = ("0." + dmsLatMinVals[1]) * 60;
    $("#lat_sec").val(Math.round(ddLatMinRemainder));

    var ddLongMinRemainder = ("0." + dmsLongMinVals[1]) * 60;
    $("#lng_sec").val(Math.round(ddLongMinRemainder));

}

function relocateMap() {

    map.setZoom(3);

    // Get Values
    var dmsLatDeg = $("#lat_deg").val();
    var dmsLatMin = $("#lat_min").val();
    var dmsLatSec = $("#lat_sec").val();
    var dmsLongDeg = $("#lng_deg").val();
    var dmsLongMin = $("#lng_min").val();
    var dmsLongSec = $("#lng_sec").val();

    // find decimal latitude
    var ddLatVal = parseInt(dmsLatDeg) * 1 + parseInt(dmsLatMin) / 60 + parseInt(dmsLatSec) / 3600;
    ddLatVal.toFixed(3);

    // find decimal longitude
    var ddLongVal = parseInt(dmsLongDeg) * 1 + parseInt(dmsLongMin) / 60 + parseInt(dmsLongSec) / 3600;
    ddLongVal.toFixed(3);

    var latlng = {lat: parseFloat(ddLatVal), lng: parseFloat(ddLongVal)};

    // Clear other markers
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }

    // Set Location Hidden Value
    $("#location_lat").val(latlng.lat.toFixed(3));
    $("#location_lng").val(latlng.lng.toFixed(3));

    displayMarkers(latlng.lat, latlng.lng);
}