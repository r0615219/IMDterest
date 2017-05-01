<h1 class="h1">Choose up to 5 topics to follow</h1>
<form action="" method="post">
    <div class="btn-group btn-block" data-toggle="buttons">
        <?php
        //4. topics laten uitlezen in doc als buttons -> id gebruiken als value!
        foreach ($topicArray as $t):?>
            <label class="btn topic-div" style="background-image: url(<?php echo $t->image; ?>);">
                <input type="checkbox" name="selectedTopics[]" value="<?php echo $t->id; ?>"> <?php echo $t->name; ?>
            </label>
        <?php endforeach; ?>
    </div>
    <button class="btn btn-success save" type="submit">Save topics</button>
</form>