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

        <button type="button" class="btn btn-success add">+</button>
    </div>