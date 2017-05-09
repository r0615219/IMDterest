<?php include_once('emptyStates.php');
shuffle($emptyStates); ?>
<h1 class="emptyState">
    <?php echo $emptyStates[0] ;?>
</h1>

<h1 class="emptyStateTxt">Oops, no posts found!</h1>

<script>
    $(".loadMoreBtn").text("No more records!").prop("disabled", true);
</script>