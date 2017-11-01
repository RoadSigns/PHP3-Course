<!--<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>-->
<script type="text/javascript" src="/learn/phpcourse/js/jquery/jquery.1.12.4.min.js"></script>
<script>
$(document).ready(function() {    
    
<?php if($errors){ ?>
    // Flag errors with 'error' class
<?php foreach($errors as $field => $message){ ?>
    $('#<?=$field?>').addClass('error');
    $('#<?=$field?>').after("<span class='errorText'><?=$message?></span>");
<?php } ?>
<?php } ?>

    // Remove errors on click
    $('.error').each(function(index){
        $(this).on("click", function(){
            $(this).removeClass('error');
        });
    });

});
</script>
