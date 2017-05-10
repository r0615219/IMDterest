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
                    <input type="file" name="img"/>
                    <hr>
                    <input type="text" id="title" name="title" placeholder=" Title"/>
                    <input type="text" id="data-image" name="location" value="" readonly/>
                    <textarea rows="3" name="imgDescription" id="imgDescription"
                              placeholder=" Add a description..."></textarea>

                    <div class="modal-topics">
                        <label for="imgTopic">Topic</label>
                        <select name="imgTopic" id="imgTopic">
                            <option value="none">Choose a topic</option>
                            <?php foreach ($_SESSION['topics'] as $t): ?>
                                <option value="<?php echo $t->id; ?>"><?php echo $t->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>or</p>
                        <label for="addTopic">add a new topic</label>
                        <input type="text" name="addTopic" id="addTopic">
                    </div>

                    <div class="modal-privacy">
                      <label for="privacy">Who can see this post?</label>
                      <input type="radio" name="privacy" value="0" checked> Everyone
                      <input type="radio" name="privacy" value="1"> Only my followers
                      <input type="radio" name="privacy" value="2"> Only me
                    </div>

                    <div class="modal-footer">
                        <input type="submit" name="imgSubmit" class="btn btn-default submitBtn" value="Save"/>
                    </div>
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
                    <input type="text" name="url" placeholder="https://"/>
                    <input type="text" id="data-link" name="location" value="" readonly/>
                    <hr>
                    <p id="data_link"></p>

                    <div class="modal-topics">
                        <label for="linkTopic">Topic</label>
                        <select name="linkTopic" id="linkTopic">
                            <option value="none">Choose a topic</option>
                            <?php foreach ($_SESSION['topics'] as $t): ?>
                                <option value="<?php echo $t->id; ?>"><?php echo $t->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p>or</p>
                        <label for="addTopic">add a new topic</label>
                        <input type="text" name="addTopic" id="addTopic">
                    </div>

                    <div class="modal-footer">
                        <input type="submit" name="linkSubmit" class="btn btn-default submitBtn" value="Save"/>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
