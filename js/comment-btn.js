$(document).ready(function(){
  var commentBtn = $(this).find('.comment-form');


  //console.log(comment);

  commentBtn.submit(function(){
    var post_id = $(this).find('#post_id').val();
    var comment = $(this).find('#comment-text').val();
    var c = $(this).find('#comment-text');
    var lijst = $(this).siblings('.comment-list')
    event.preventDefault();
    console.log('before Ajax');
    console.log(comment);
    console.log(post_id);
    $.ajax({
      type:"POST",
      url:"./ajax/comments.php",
      data:{"postid":post_id,
            "comment":comment}
    })
    .done(function(res){
      console.log("ajax done");
      //console.log(res);
      $(c).val(null);
      $(lijst).append("<div>"+res+"</div>");
    })

  })
})
