<h1 class="h1">Choose 5 topics to follow</h1>
<form action="" method="post">
    <div class="btn-group btn-block" data-toggle="buttons">
        <?php
        foreach ($topicArray as $t):?>
            <label class="btn topic-div" style="background-image: url(<?php echo $t->image; ?>);">
                <input type="checkbox" name="selectedTopics[]" value="<?php echo $t->name; ?>"> <?php echo $t->name; ?>
            </label>
        <?php endforeach; ?>
    </div>
    <button class="btn btn-success save" type="submit">Save topics</button>
</form>