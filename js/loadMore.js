$(document).ready(function(){



    var track_page = 0; //track user click as page number, right now page number is 1

    var query;



    switch ($(document).find("title").text()){



        case 'IMDterest | Home':



        /// ALLEEN POSTS VAN GEVOLGDE TOPICS DIE PUBLIC ZIJN////

            query = "select p.id, p.user_ID, p.title, p.image, p.description, p.link, p.topics_ID, p.time, p.reports, p.location, p.privacy from posts p inner join users_topics ut on p.topics_ID = ut.topics_ID where ut.users_ID = :userid AND p.privacy = 0 ORDER BY p.id DESC LIMIT :position, :limit";



            break;



        case 'IMDterest | Explore':

        //// POSTS VAN MENSEN DIE JE FOLLOWT -> HERWERKEN NAAR FEED///

            query = "SELECT * FROM posts where user_ID in (select user from follows where follower = :userid) AND privacy != 2 ORDER BY id DESC LIMIT :position, :limit";

            break;

    }



    load_contents(track_page, query); //load content



    $(".loadMoreBtn").on('click', function (e) { //user clicks on button



        track_page++; //page number increment everytime user clicks load button

        var query;



        if($(this).hasClass('loadMoreBtnHome')){

            query = "select p.id, p.user_ID, p.title, p.image, p.description, p.link, p.topics_ID, p.time, p.reports, p.location, p.privacy from posts p inner join users_topics ut on p.topics_ID = ut.topics_ID where ut.users_ID = :userid ORDER BY p.id DESC LIMIT :position, :limit";



        }else if($(this).hasClass('loadMoreBtnExplore')){

            query = "SELECT * FROM posts where user_ID = :userid OR user_ID in (select user from follows where follower = :userid) ORDER BY id DESC LIMIT :position, :limit";

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

