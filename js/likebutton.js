$(document).ready(function(){
  var liked;


//check for clicking like button
  $(".likeBtn").click(function(){
    //checking if already liked or not -> 1) need userID 2) need postID = PHP check
    var id = $(this).parents(".likes").siblings(".userInfo").children(".postId").html().substring(1);
    console.log(id)
    console.log("hi")

  $.ajax({
    type:"POST",
    url:"./ajax/like.php",
    data:{"id" : id},
    datatype:"json"

  })
    .done(function(response) {
      console.log(response)
       liked = true;

  });

    if (liked == true) {
      $("img", this).attr("src", "./images/icons/heart_filled.svg");

    }

  });


//End document.ready
});
