<p><a href='<?=$url->urlRootPath?>add/' class='pull-right btn btn-default'>New Member</a></p>
<br>
<br>

<table class="table table-bordered table-striped table-condensed">
    
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    
    <?php if($allMembers){ ?>
    <?php foreach($allMembers as $member){?>
    <tr>
        <td>
            <?php if($member->profileImagePath != ''){ ?>
            <img src='<?=$member->profileImagePath?>' style='max-height:50px;max-width:50px;border-radius:15px 15px;' />
            <?php } ?>
        </td>
        <td>
            <strong><?=$member->fName?> <?=$member->sName?></strong><br>
            <small><?=$member->uName?></small>
        </td>
        <td><?=$member->telephone?></td>
        <td><a href='mailto:<?=$member->email?>'><?=$member->email?></a></td>
        <td><a href='<?=$url->urlRootPath?>view/<?=$member->memberID?>/' class='btn'><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></td>
        <td><a href='<?=$url->urlRootPath?>edit/<?=$member->memberID?>/' class='btn editBtn'><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
        <td><a href='?frmName=delete&memberID=<?=$member->memberID?>' class='btn btn-danger deleteBtn'><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
    </tr>
    <?php } ?>
    <?php } ?>
    
</table>