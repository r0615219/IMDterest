$(document).ready(function () {

    var location = "ik ben een locatie";
    var error = "";

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(savePosition);
        } else {
            error = "Geolocation is not supported by this browser.";
        }
    }

    function savePosition(position) {
        location = "Latitude: " + position.coords.latitude +
            "Longitude: " + position.coords.longitude;

        //alert(location);

        $.post( 'ajax/location.php', {'varLocation': location}, function(data){

            $("#data").append(data); //append data into #results element

        });
    }

    getLocation();
});