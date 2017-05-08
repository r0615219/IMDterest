$(document).ready(function(){
    $("#delete").click(function(){
        console.log("the profile will be deleted.");
        
        $.ajax({
            type:"POST",
            url:"./ajax/deleteProfile.php"
        }).done(function(response){
            if( response.code == 500){
                console.log("something went wrong");
            }
            if( response.code == 200){
                console.log("all went well");
            }
        });
        
    });
});