$(document).ready(function(){
  console.log("emailcheck loaded")
  $("#email-signup").blur(function(){


        event.preventDefault();
        var email= $(this).val();
        console.log(email)
        $.ajax
        ({
            type:"POST",
            url:"./ajax/emailcheck.php",
            data:{"email" : email}
        }).done(function(res){
            console.log(res)
            if(res==1){
                if ($("#email-exists").get()) {
                    $("#email-exists").remove();}
                $("<div class='error alert alert-danger'id='email-exists'> This email is already in use!</div>").insertBefore("#sign-up");

            }
            else{
                $("#email-exists").remove();
            }
        });
    });

})