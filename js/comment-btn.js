$(document).ready(function(){
  var commentBtn = $('#comment-form');
  var post_id = $('#post_id').val();

  //console.log(comment);

  commentBtn.submit(function(){
    var comment = $('#comment-text').val();
    event.preventDefault();
    console.log('before Ajax');
    console.log(comment);
    $.ajax({
      type:"POST",
      url:"./ajax/comments.php",
      data:{"postid":post_id,
            "comment":comment}
    })
    .done(function(res){
      console.log("ajax done");
      console.log(res);
      $('#comment-text').val(null);
      $('.comment-list').append("<div>"+res+"</div>");
    })

  })
})
