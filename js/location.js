$(document).ready(function () {

<<<<<<< HEAD
    var error = "";
    var url = "";
    const api = "AIzaSyAhxQ5kJzjss1GHBr_rGwKNbD6SyxNCIAI";
    var state = "";
=======
    var location = "ik ben een locatie";
    var error = "";
>>>>>>> a517b75b373d2f78e319cdbcfbe190f1d938e549

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(savePosition);
        } else {
            error = "Geolocation is not supported by this browser.";
        }
    }

    function savePosition(position) {
        location = "Latitude: " + position.coords.latitude +
<<<<<<< HEAD
            " Longitude: " + position.coords.longitude;

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

                        $("#data").append(data); //append data into #results element

                    });
                }
            }

        });

    }

    //API : AIzaSyAhxQ5kJzjss1GHBr_rGwKNbD6SyxNCIAI

=======
            "Longitude: " + position.coords.longitude;

        //alert(location);

        $.post( 'ajax/location.php', {'varLocation': location}, function(data){

            $("#data").append(data); //append data into #results element

        });
    }

>>>>>>> a517b75b373d2f78e319cdbcfbe190f1d938e549
    getLocation();
});