$(document).ready(function(){
    var track_page = 1; //track user click as page number, right now page number is 1
    var query;
    switch (window.location.href){
        case 'http://localhost/IMDterest/home.php':
            query = "SELECT * FROM posts p INNER JOIN follows f ON p.user_ID = f.user WHERE f.follower = :usersession ORDER BY id DESC LIMIT :position, :limit";
            break;
        case 'http://localhost/IMDterest/home.php#':
            query = "SELECT * FROM posts p INNER JOIN follows f ON p.user_ID = f.user WHERE f.follower = :usersession ORDER BY id DESC LIMIT :position, :limit";
            break;

        case 'http://localhost/IMDterest/explore.php':
            query = "SELECT * FROM posts WHERE id not in (SELECT posts.id FROM posts INNER JOIN follows ON posts.user_ID = follows.user INNER JOIN users ON follows.user = users.id WHERE follows.follower = :usersession ) ORDER BY id DESC LIMIT :position, :limit";
            break;
        case 'http://localhost/IMDterest/explore.php#':
            query = "SELECT * FROM posts WHERE id not in (SELECT posts.id FROM posts INNER JOIN follows ON posts.user_ID = follows.user INNER JOIN users ON follows.user = users.id WHERE follows.follower = :usersession ) ORDER BY id DESC LIMIT :position, :limit";
            break;
    }
    load_contents(track_page, query); //load content

    $(".loadMoreBtn").on('click', function (e) { //user clicks on button
        track_page++; //page number increment everytime user clicks load button
        var query;
        if($(this).hasClass('loadMoreBtnHome')){
            query = "SELECT * FROM posts p INNER JOIN follows f ON p.user_ID = f.user WHERE f.follower = :usersession ORDER BY id DESC LIMIT :position, :limit";
        }else if($(this).hasClass('loadMoreBtnExplore')){
            query = "SELECT * FROM posts WHERE id not in (SELECT posts.id FROM posts INNER JOIN follows ON posts.user_ID = follows.user INNER JOIN users ON follows.user = users.id WHERE follows.follower = :usersession ) ORDER BY id DESC LIMIT :position, :limit";
        }
        load_contents(track_page, query); //load content
    });

//Ajax load function
    function load_contents(track_page, query){
        $.post( 'ajax/loadMore.php', {'page': track_page, 'query': query}, function(data){

            $("#results").append(data); //append data into #results element

        });
    }
});