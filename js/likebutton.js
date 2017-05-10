$(document).ready(function(){

//check for clicking like button
  $(".likeBtn").click(function(){
    event.preventDefault();
    //checking if already liked or not -> 1) need userID 2) need postID = PHP check
    var id = $(this).parents(".likes").siblings(".postId").html();
    alert(id);
    var liked;
    var heart = $(this).find("img");
    var counter = $(this).parents(".likes").find(".likeAmount");
    console.log(id);
  $.ajax({
    type:"POST",
    url:"./ajax/like.php",
    data:{"id" : id,"action":"toggle"},
    dataType:"html"
    })

  .done(function(res) {
      if (res=="1") {
        console.log(res);
        $(heart).attr("src", "./images/icons/heart_filled.svg");
      }
      else {
        console.log(res);
        $(heart).attr("src", "./images/icons/heart.svg");
      }

      $.post({
        url:"./ajax/like.php",
        data:{"id" : id,
              "action":"count"
      },
        dataType:"text"
      })
      .done(function(count){
        $(counter).html(count)
      });

  });
});


//End document.ready
});
