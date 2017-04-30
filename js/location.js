$(document).ready(function(){

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

        //$('p.alert.alert-success').html(location);

        $.ajax({
            method: "POST",
            url: "./ajax/location.php",
            data: { 'varLocation' : location }
        })
            .done(function() {
                //alert( "Data Saved" );
                console.log("Ajax done");
            })
    }

    getLocation();



});