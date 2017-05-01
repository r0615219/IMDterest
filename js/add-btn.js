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
});