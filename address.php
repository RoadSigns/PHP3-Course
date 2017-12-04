 <?php
 
include 'classes/AddressBook.php';
require 'classes/MyPDO.php';
include 'dumpr.php';

define('DBHOST', 'localhost' );
define('DBUSER', 'php_user01');
define('DBPASS', 'password'  );
define('DBNAME', 'php_db01'  );

$addressBook = new AddressBook;
$addresses = $addressBook->getAddresses();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">     
    </head>

    <body>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <?php if($addresses){ ?>
            <?php foreach($addresses as $address){ ?>

            <tr class='record' id="row<?=$address->addressID?>">
                <td><?=$address->fName?></td>
                <td><?=$address->sName?></td>
                <td><?=$address->telephone?></td>
                <td><?=$address->email?></td>
                <td><span class='btn editBtn' data-id='<?=$address->addressID?>'>Edit</span></td>
            </tr>

            <tr class='formrow' id="form<?=$address->addressID?>" style="display:none">
                <td colspan="5">
                    <form action="" name="" method="post">
                        <table class='table'>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="fName" value="<?=$address->fName?>" placeholder='First name' required />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="sName" value="<?=$address->sName?>" placeholder='Surname' required />
                                </td>
                                <td>
                                    <input type="telephone" class="form-control" name="telephone" value="<?=$address->telephone?>" placeholder='Telephone' required />
                                </td>
                                <td>
                                    <input type="email" class="form-control" name="email" value="<?=$address->email?>" placeholder='Email' required />
                                </td>
                                <td nowrap>
                                    <input name='submit' class='btn btn-success' type='submit' value='Update' />
                                    <span class='btn            cancelBtn' data-id='<?=$address->addressID?>'>Cancel</span>
                                    <a href='?frmName=delete&id=<?=$address->addressID?>' class='btn btn-danger deleteBtn'><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" name="addressID" value="<?=$address->addressID?>" />
                        <input type="hidden" name="frmName" value="update" />
                    </form>
                </td>
            </tr>
            <?php } ?>
            <?php } ?>

            <tr>
                <td colspan="5">
                    <form action="" name="" method="post">
                        <table class='table'>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="fName" value="" placeholder='First name' required />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="sName" value="" placeholder='Surname' required />
                                </td>
                                <td>
                                    <input type="telephone" class="form-control" name="telephone" value="" placeholder='Telephone' required />
                                </td>
                                <td>
                                    <input type="email" class="form-control" name="email" value="" placeholder='Email' required />
                                </td>
                                <td>
                                    <input name='submit' class='btn' type='submit' value='Add' />
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" name="frmName" value="add" />
                    </form>
                </td>
            </tr>

        </table>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>

        <script>
        $(document).ready(function() {    

            $('.editBtn').on('click',function(){
                $('.formrow').hide();
                $id = $(this).data('id');
                $('#row'+$id).hide();
                $('#form'+$id).show();
            });
            $('.cancelBtn').on('click',function(){
                $id = $(this).data('id');
                $('#row'+$id).show();
                $('#form'+$id).hide();
            });

        });
        </script>

    </body>

</html>
