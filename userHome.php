<h1 class="h1">Your topics</h1>
    <div class="container">
        <?php
        //7. session uitlezen in doc = voorlopige test of het werkt
        foreach ($_SESSION['topics'] as $t):?>
            <div class="userTopic" style="background-image: url(<?php echo $t->image; ?>);">
                <h2><?php echo $t->name; ?></h2>
            </div>
        <?php endforeach; ?>
    </div>