<!-- HIER KOMEN ALLE POSTS DAT TE MAKEN HEBBEN MET DE TOPICS GEKOZEN DOOR DE USER -->

        <!--<h1 class="h1">Your topics</h1>
        <div style="width: 100%; display: flex;">
            <?php
            //7. session uitlezen in doc = voorlopige test of het werkt
            foreach ($_SESSION['topics'] as $t):?>
                <div class="userTopic" style="background-image: url(<?php echo $t->image; ?>);">
                    <h2><?php echo $t->name; ?></h2>
                </div>
            <?php endforeach; ?>
        </div>
        -->

<?php
if(isset( $_SESSION['posts'])){?>
<?php foreach ($_SESSION['posts'] as $p):?>
        <div class="userPost">
            <div class="userPostImg" style="background-image: url(images/uploads/postImages/<?php echo $p->image; ?>);"></div>
            <div class="userPostTopic">
                <h3>
                    <a href="#">
                    <?php
                    $topic = new Topics();
                    $topic->id = $p->topics_ID;
                    $topic->getTopic();
                    echo $topic->name;
                    ?>
                    </a>
                </h3>
            </div>
            <div class="userPostDescription"><h4><?php echo $p->description; ?></h4></div>
            <hr>
            <div class="userPostInfo">

                <div class="userInfo">
                    <a href="#">
                        <img class="media-object profile-pic" src="images/uploads/userImages/<?php
                        $user = new User;
                        $user->id = $p->user_ID;
                        $user->getUserInfo();
                        echo $user->Image;
                        ?>" alt="post">
                    </a>
                    <a href="#">
                        <?php
                        echo $user->Firstname . " " . $user->Lastname;
                        ?>
                    </a>
                </div>

                <div class="likeBtn">
                    <a href="#">
                        <img class="media-object" src="images/icons/heart.svg" alt="heart">
                    </a>
                </div>

            </div>
        </div>
    <?php endforeach; }?>


        <div class="add">
            <button type="button" class="btn btn-success addBtn" id="addBtn">+</button>

            <button type="button" class="btn btn-success addBtn" id="imageBtn" data-toggle="modal"
                    data-target="#newImage"><img src="images/icons/image.svg" alt="image"></button>

            <button type="button" class="btn btn-success addBtn" id="linkBtn" data-toggle="modal"
                    data-target="#newLink"><img src="images/icons/link.svg" alt="image"></button>
        </div>

        <div class="modal fade" id="newImage" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create new post</h4>
                    </div>
                    <div class="modal-body">

                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="file" name="img" />

                            <textarea rows="3" name="imgDescription" id="imgDescription" placeholder="Geef een beschrijving van je post"></textarea>

                            <label for="imgTopic">Topic</label>
                            <select name="imgTopic" id="imgTopic">
                                <option value="none">Kies een topic</option>
                                <?php foreach ($_SESSION['topics'] as $t):?>
                                    <option value="<?php echo $t->id; ?>"><?php echo $t->name; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <input type="submit" name="imgSubmit" class="btn btn-default submitBtn" value="Opslaan" />


                        </form>

                    </div>

                </div>

            </div>
        </div>

        <div class="modal fade" id="newLink" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create new post</h4>
                    </div>
                    <div class="modal-body">

                        <form action="" method="post" enctype="multipart/form-data">

                            <input type="url" name="link" placeholder="http://"/>

                            <textarea rows="3" name="linkDescription" placeholder="Geef een beschrijving van je post"></textarea>

                            <label for="linkTopic">Topic</label>
                            <select name="linkTopic" id="linkTopic">
                                <option value="none">Kies een topic</option>
                                <?php foreach ($_SESSION['topics'] as $t):?>
                                    <option value="<?php echo $t->id; ?>"><?php echo $t->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="modal-footer">
                                <input type="submit" name="linkSubmit" class="btn btn-default submitBtn" value="Opslaan" />
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>


<script>
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
</script>