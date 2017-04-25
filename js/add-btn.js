$(document).ready(function(){
    var addBtn = $('#addBtn');
    var imageBtn = $('#imageBtn');
    var linkBtn = $('#linkBtn');
    var open = false;
    var submitBtn = $(".submitBtn");
    imageBtn.hide();
    linkBtn.hide();


    addBtn.on('click', function(){
        if (open) {

            imageBtn.animate({
                marginBottom: "0px"
            }, 200);
            linkBtn.animate({
                marginRight: "0px"
            }, 200);
            imageBtn.hide(0);
            linkBtn.hide(0);
        }
        else {
            imageBtn.show(0);
            linkBtn.show(0);
            imageBtn.animate({
                marginBottom: "100px"
            }, 200);
            linkBtn.animate({
                marginRight: "100px"
            }, 200);

        }

        open = !open;
    });

    submitBtn.on('click', function(){
        imageBtn.animate({
            marginBottom: "0px"
        }, 200);
        linkBtn.animate({
            marginRight: "0px"
        }, 200);
        imageBtn.hide(0);
        linkBtn.hide(0);

        open = !open;
    });


    var track_page = 1; //track user click as page number, right now page number is 1
    load_contents(track_page); //load content

    $(".LoadMoreBtn").on('click', function (e) { //user clicks on button
        track_page++; //page number increment everytime user clicks load button
        load_contents(track_page); //load content
    });

//Ajax load function
    function load_contents(track_page){
        $.post( 'ajax/loadMore.php', {'page': track_page}, function(data){

            $("#results").append(data); //append data into #results element

        });
    }

});