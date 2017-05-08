$(document).ready(function(){
    $("#delete").click(function(){
        console.log("the profile will be deleted.");
        
        $("#delete-text").text("Deleting...");
        $("#delete-text2").html("<p> <strong>Your profile is now being removed from existence... </strong> </p><p> You will be logged out soon. </p>");
        $("#delete-text3").html("");
        
        $.ajax({
            type:"POST",
            url:"./ajax/deleteProfile.php"
        }).done(function(response){
            if( response.code == 500){
                console.log("something went wrong");
                $("#delete-text").text("Internal error");
                $("#delete-text2").html("<p> <strong>Something went wrong... </strong> </p><p> The system was unable to delete your profile at this moment, try again later. </p>");
                $("#delete-text3").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Ok</button>");
            }
            if( response.code == 200){
                console.log("all went well");
                window.location.replace("logout.php")
            }
        });
        
    });
});