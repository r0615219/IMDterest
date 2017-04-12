<!-- HIER KOMEN ALLE POSTS DAT TE MAKEN HEBBEN MET DE TOPICS GEKOZEN DOOR DE USER -->
    <div class="container">
        <h1 class="h1">Your topics</h1>
        <div style="width: 100%; display: flex;">
            <?php
            //7. session uitlezen in doc = voorlopige test of het werkt
            foreach ($_SESSION['topics'] as $t):?>
                <div class="userTopic" style="background-image: url(<?php echo $t->image; ?>);">
                    <h2><?php echo $t->name; ?></h2>
                </div>
            <?php endforeach; ?>
        </div>

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

                        <form action="" method="post" name="imgPost" enctype="multipart/form-data">
                            <input type="file" name="img" />

                            <textarea rows="3" name="imgDescription" id="imgDescription" placeholder="Geef een beschrijving van je post"></textarea>

                            <label for="imgTopic">Topic</label>
                            <select name="imgTopic" id="imgTopic">
                                <option value="none">Kies een topic</option>
                                <?php foreach ($_SESSION['topics'] as $t):?>
                                    <option value="<?php echo $t->id; ?>"><?php echo $t->name; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <input type="submit" name="imgSubmit" class="btn btn-default" value="Opslaan" />


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

                        <form action="" method="post" name="urlPost">

                            <input type="url" name="url" placeholder="http://"/>

                            <textarea rows="3" name="urlDescription" placeholder="Geef een beschrijving van je post"></textarea>

                            <label for="urlTopic">Topic</label>
                            <select name="urlTopic" id="urlTopic">
                                <option value="none">Kies een topic</option>
                                <?php foreach ($_SESSION['topics'] as $t):?>
                                    <option value="<?php echo $t->id; ?>"><?php echo $t->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal">Save</button>
                    </div>
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

        addBtn.on('click', function(){
            if (open) {
                imageBtn.animate({
                    marginBottom: "0px"
                }, 200);
                linkBtn.animate({
                    marginRight: "0px"
                }, 200)
            }
            else {
                imageBtn.animate({
                    marginBottom: "100px"
                }, 200);
                linkBtn.animate({
                    marginRight: "100px"
                }, 200);
            }

            open = !open;
        });

    });
</script>