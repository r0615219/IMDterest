$(document).ready(function(){

    $("#follow").click(function(){

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
                console.log("something went wrong");
            }
            if( response.code == 200){
                if(response.followers != 0){
                    console.log("You now follow this user.");
                    $("#follow").removeClass("follow");
                    $("#follow").addClass("following");
                    $("#follow").text("following");
                }
                else{
                    console.log("You stopped following this user.");
                    $("#follow").removeClass("following");
                    $("#follow").addClass("follow");
                    $("#follow").text("follow");
                }
                console.log(response.followers);
                $("#followers").text(response.followers + " followers");
            }
        });

    });
});
