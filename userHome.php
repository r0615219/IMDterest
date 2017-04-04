<h1 class="h1">Your topics</h1>
    <div>
        <?php
        foreach ($_SESSION['topics'] as $t):?>
            <div class="userTopic" style="background-image: url(<?php echo $t->Image; ?>);">
                <h2><?php echo $t->Name; ?></h2>
            </div>
        <?php endforeach; ?>
    </div>