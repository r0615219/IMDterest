$(document).ready(function () {
  
    var error = "";
    var url = "";
    const api = "AIzaSyAhxQ5kJzjss1GHBr_rGwKNbD6SyxNCIAI";
    var state = "";


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(savePosition);
        } else {
            error = "Geolocation is not supported by this browser.";
        }
    }

    function savePosition(position) {
        location = "Latitude: " + position.coords.latitude + " Longitude: " + position.coords.longitude;

        url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude +"," + position.coords.longitude + "&key=" + api + "";

        //console.log(url);

        $.getJSON(url, function (json) {
            if (json.status == "OK") {
                var result = json.results[0];
                for (var i = 0, len = result.address_components.length; i < len; i++) {
                    var ac = result.address_components[i];
                    if (ac.types.indexOf("locality") >= 0) {
                        state = ac.long_name;
                    }
                }
                if (state != '') {
                    console.log("Hello to you out there in " + state + " !");
                    $.post( 'ajax/location.php', {'varLocation': state}, function(data){
                        $("#data-image").val(data);
                        $("#data-link").val(data);
                    });
                }
            }

        });

    }

    //API : AIzaSyAhxQ5kJzjss1GHBr_rGwKNbD6SyxNCIAI

    getLocation();

});