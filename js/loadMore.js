$(document).ready(function(){
    var track_page = 1; //track user click as page number, right now page number is 1
    var query = "SELECT * FROM posts WHERE topics_ID in (SELECT topics_ID FROM users_topics WHERE users_ID IN (SELECT id FROM users WHERE email = :email)) ORDER BY id DESC LIMIT :position, :limit";
    load_contents(track_page, query); //load content

    $(".LoadMoreBtn").on('click', function (e) { //user clicks on button
        track_page++; //page number increment everytime user clicks load button
        if($(this).hasClass('loadMoreBtnHome')){
            var query = "SELECT * FROM posts WHERE topics_ID in (SELECT topics_ID FROM users_topics WHERE users_ID IN (SELECT id FROM users WHERE email = :email)) ORDER BY id DESC LIMIT :position, :limit";
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