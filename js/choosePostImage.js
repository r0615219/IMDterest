$(document).ready(function(){

    $('.choosePostImage').on('click', function(){



        $.ajax({
            type:"POST",
            url:"./ajax/like.php",
            data:{"id" : id,"action":"toggle"},
            datatype:"html"
        })

            .done(function(res) {
                if (res=="1") {
                    console.log(res)
                    $(heart).attr("src", "./images/icons/heart_filled.svg");
                }
                else {
                    console.log(res)
                    $(heart).attr("src", "./images/icons/heart.svg");
                }

                $.post({
                    url:"./ajax/like.php",
                    data:{"id" : id,
                        "action":"count"
                    },
                    datatype:"text",
                })
                    .done(function(count){
                        $(counter).html(count)
                    });

            });
    })

});