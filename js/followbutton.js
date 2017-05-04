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
        function readUrl(parameter)
        {
            var URL = window.location.search.substring(1);
            var variables = URL.split('&');
            for (var i = 0; i < variables.length; i++)
            {
                var parameterName = variables[i].split('=');
                if (parameterName[0] == parameter)
                {
                    return decodeURIComponent(parameterName[1]);
                }
            }
        }
        
        var user_ID = readUrl('userId');
        
        $.ajax({
            type:"POST",
            url:"./ajax/follow.php",
            data: {user_ID : user_ID}
        }).done(function(response){
            if( response.code == 500){
                console.log("ALLES IS VERKEERD");
            }
            if( response.code == 200){
                console.log("succes!");
            }
        });
        
    });
});