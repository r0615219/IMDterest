<<<<<<< HEAD
<h1 class="h1">Choose 5 topics to follow</h1>
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
=======
<h1 class="h1">Choose 5 topics to follow</h1>
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
>>>>>>> 3586aba3db2f61bb830649441f7e3e38f3479017
</form>