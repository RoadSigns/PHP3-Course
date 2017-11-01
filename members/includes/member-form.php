<?php if($action=='add') { ?>

<h2>Add a new Member</h2>

<?php } elseif($action=='edit') { ?>
    
<h2>Edit a Member</h2>
    
<?php } ?>

<form action="" name="" method="post" enctype="multipart/form-data">
    <table class='table noborder'>
        <tr>
            <td colspan="2">
                <input type="text" class="form-control" name="fName" id='fName' value="<?=$fName?>" placeholder='First name' />
            </td>
            <td>
                <input type="text" class="form-control" name="sName" id='sName' value="<?=$sName?>" placeholder='Surname' />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="tel" class="form-control" name="telephone" id='telephone' value="<?=$telephone?>" placeholder='Telephone' />
            </td>
            <td>
                <input type="email" class="form-control" name="email" id='email' value="<?=$email?>" placeholder='Email' />
            </td>
        </tr>
        <tr>
            <?php if($imagePath) { ?>
            <td>
                <img src='<?=$imagePath?>' style='max-height:50px; max-width:50px;border-radius: 15px 15px;' />
            </td>
            <td>
            <?php } else { ?>
            <td colspan="2">
            <?php } ?>
                <input class="btn"  type="file" name='upload' id='upload' />
            </td>
            <td>
                <input name='submit' class='btn btn-primary pull-right' type='submit' value='Save' /> 
            </td>
        </tr>
    </table>
    
    <input type="hidden" name="frmName" value="<?=$action?>" />
    
    <?php if($memberID) { ?>
    <input type="hidden" name="memberID" value="<?=$memberID?>" />
    <?php } ?>
    
</form>

<hr>

<a href='<?=$url->urlRootPath?>' class='btn btn-default pull-right'>&laquo; Back</a>
