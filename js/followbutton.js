$(document).ready(function(){
    $("#follow").click(function(){
        
        $.ajax({
            type:"POST",
            url:"./ajax/follow.php"
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
