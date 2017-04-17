$(document).ready(function(){
  //var liked;


//check for clicking like button
  $(".likeBtn").click(function(){
    event.preventDefault();
    //checking if already liked or not -> 1) need userID 2) need postID = PHP check
    var id = $(this).parents(".likes").siblings(".userInfo").children(".postId").html().substring(1);
    var liked
    var heart =$(this).find("img");
  $.ajax({
    type:"POST",
    url:"./ajax/like.php",
    data:{"id" : id},
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
  });
});
  // $("img", this).attr("src", "./images/icons/heart_filled.svg");
//End document.ready
});
