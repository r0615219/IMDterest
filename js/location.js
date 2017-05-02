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

        alert(location);

        $.ajax({
            type:"POST",
            url:"./ajax/location.php",
            data: {varLocation : location}
        }).done(function(response){
            if( response.code == 500){
                console.log("Boo");
            }
            if( response.code == 200){
                console.log("Check!");
            }
        })
    }

    getLocation();



});