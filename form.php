<?php

include 'classes/FormValidator.php';
include 'dumpr.php';

// Default Form Field Values
// -------------------------
$fields = array();
$fields['firstname'] = '';
$fields['surname'] = '';
$fields['emailadd'] = '';
$fields['password'] = '';
$fields['password2'] = '';
$fields['department'] = '';
$fields['interests'] = array();

// Default Error Array
//--------------------
$errors = false;

// Form Validation
//-----------------------------------------------------------
if(isset($_POST['frmName']) && $_POST['frmName']=='example'){

    $formVal = new FormValidator();
    $formVal->setMethod('POST');
    $formVal->registerFields();
    
    $formVal->validate('firstname')->clean()->isRequired();
    $formVal->validate('surname')->clean()->isRequired();
    $formVal->validate('emailadd')->clean()->isRequired()->isEmail();
    $formVal->validate('password')->passwordsMatch('password2')->isRequired(6)->isPassword();
    
    $formVal->validate('department')->clean()->isSelected();
    
    $formVal->validate('interests')->checkboxGroupRequired(2);
    
    $errors = $formVal->getErrors();
    $fields = $formVal->getFields();

}

dumpr($fields,'Form Fields',0,0);
dumpr($errors,'Errors',0,0);

?>

<form action="" method="post">
    
    <table class='table table-bordered'>
        
        <tr>
            <th>First Name</th>
            <td><input name="firstname" id='firstname' type="text" value="<?=$fields['firstname'] ?>" class='form-control'/></td>
        </tr>
        
        <tr>
            <th>Surname</th>
            <td><input name="surname" id='surname' type="text" value="<?=$fields['surname'] ?>" class='form-control'/></td>
        </tr>
        
        <tr>
            <th>Email</th>
            <td><input name="emailadd" id='emailadd' type="text" value="<?=$fields['emailadd'] ?>" class='form-control'/></td>
        </tr>
        
        <tr>
            <th>Password</th>
            <td><input name="password" id='password' type="password" value="<?=$fields['password'] ?>" class='form-control' /></td>
        </tr>
        
        <tr>
            <th>Password 2</th>
            <td><input name="password2" id='password2' type="password" value="<?=$fields['password2'] ?>" class='form-control' /></td>
        </tr>
        
        <tr>
            <th>Department</th>
            <td><select name='department' id='department' class='form-control'>
                    <option value=''>Select..</option>
                    <option value='HR'        <?=isset($fields['department']) && in_array('HR',        (array)$fields['department'])?'selected':''?>>HR</option>
                    <option value='IT'        <?=isset($fields['department']) && in_array('IT',        (array)$fields['department'])?'selected':''?>>IT</option>
                    <option value='Sales'     <?=isset($fields['department']) && in_array('Sales',     (array)$fields['department'])?'selected':''?>>Sales</option>
                    <option value='Marketing' <?=isset($fields['department']) && in_array('Marketing', (array)$fields['department'])?'selected':''?>>Marketing</option>
                </select>
            </td>
        </tr>

        <tr>
            <th>Interests</th>
            <td>
                <input type='checkbox' name='interests[]' value='PHP'   id='cb1' <?=isset($fields['interests']) && in_array('PHP',  (array)$fields['interests'])?'checked':''?> /> <label for='cb1'>PHP</label>
                <input type='checkbox' name='interests[]' value='MySQL' id='cb2' <?=isset($fields['interests']) && in_array('MySQL',(array)$fields['interests'])?'checked':''?> /> <label for='cb2'>MySQL</label>
                <input type='checkbox' name='interests[]' value='OOP'   id='cb3' <?=isset($fields['interests']) && in_array('OOP',  (array)$fields['interests'])?'checked':''?> /> <label for='cb3'>OOP</label>
                <span id='interests'><!-- ID for Error --></span>
            </td>
        </tr>
        
    </table>
    
    <input name="frmName" type="hidden" value="example"/>    
    <input name="" type="submit" value="Submit"/>    
    
</form>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
    <?php if($errors){ ?>
    <?php foreach($errors as $fieldName => $message){ ?>
    $("#<?=$fieldName ?>").after("<span style='color:red'><?=$message ?></span>");
    <?php } ?>
    <?php } ?>
});
</script>
