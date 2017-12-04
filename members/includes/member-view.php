
<div class="row">
    
    <div class="col-sm-6 col-sm-offset-3 center">
    
        <h2><small>Member ID:<?=str_pad($memberID,6,'0',STR_PAD_LEFT)?></small></h2>

        <?php if($imagePath) { ?>

        <div class="center">
            <img src='<?=$imagePath?>' style='max-height:200px; max-width:200px; border-radius: 15px 15px;' />
        </div>

        <?php } ?>

        <h2><?=$fName?> <?=$sName?></h2>

        <p><?=$telephone?></p>
        
        <p><?=$email?></p>

    </div>
</div>

<hr>

<a href='<?=$url->urlRootPath?>' class='btn pull-right cancelBtn'>&laquo; Back</a>
    



