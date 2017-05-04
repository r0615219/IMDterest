$(document).ready(function(){
    
    $("#follow").click(function(){
        
        $("#follow").hasClass("follow", function() {
            $(".follow").addClass("following");
            $(".follow").removeClass("follow");
            alert("A");
        });
        $("#follow").hasClass("following", function() {
            $(".following").addClass("follow");
            $(".following").removeClass("following");
            alert("B");
        });
        
        //javascript functie die de url leest en variabelen er uit haalt
        function leesUrl(parameter)
        {
            var URL = window.location.search.substring(1);
            var Variabelen = URL.split('&');
            for (var i = 0; i < Variabelen.length; i++)
            {
                var parameterNaam = Variabelen[i].split('=');
                if (parameterNaam[0] == parameter)
                {
                    return decodeURIComponent(parameterNaam[1]);
                }
            }
        }

        var user_ID = leesUrl('userId');
        
        $.ajax({
            type:"POST",
            url:"./ajax/follow.php",
            data: {user_ID : user_ID}
        }).done(function(response){
            if( response.code == 500){
                console.log("ALLES IS VERKEERD");
            }
            if( response.code == 200){
                console.log("update!");
            }
        });
        
    });
});