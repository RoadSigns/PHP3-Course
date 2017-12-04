<?php
    /**
     * set error reporting level
     * set error display to 'on'
     */
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    define('DBHOST','localhost');
    define('DBUSER','php_user01');
    define('DBPASS','password');
    define('DBNAME','php_db01');

    /**
     * Include all required Classes
     * or an Autoloader
     */
    require 'classes/Url.php';
    require 'classes/MyPDO.php';
    require 'classes/FormValidator.php';
    require 'classes/FileUpload.php';
    require 'classes/Members.php';



    /**
     * Instantiate the Members Class
     * - generate array of errors|false for use in JS validation
     * ---------------------------------------------------------
     * Errors : $errors
     */
    $link       = new MyPDO();
    $validate   = new FormValidator();

    $members = new Members($link, $validate);

    $errors = $members->getErrors();


    /**
     * Instantiate the URL Class
     * - pass the project path
     * - set variables for each URL segment that we need
     * -------------------
     * Segment 1 : $action
     * Segment 2 : $option
     */
    $url = new Url('/webstudent/sem6zl/members/');
    $action = $url->getSegment(1);
    $option = $url->getSegment(2);



    /**
     * Set default parameters and variables based on $action
     * --------------------------------------------------------------
     * Remember: the same form code is used for both 'add' and 'edit'
     */

    /* Add user ------------------------------------------------------------------- */
    if($action=='add') {

        // Set default field values blank
        $fName      = isset($_POST['fName'])     ? $_POST['fName']      : '';
        $sName      = isset($_POST['sName'])     ? $_POST['sName']      : '';
        $telephone  = isset($_POST['telephone']) ? $_POST['telephone']  : '';
        $email      = isset($_POST['email'])     ? $_POST['email']      : '';

        $memberID  = false;
        $imagePath = false;


    /* Edit user ------------------------------------------------------------------ */
    } elseif(($action=='edit')||($action=='view')) {

        // Get the member Object record based on $option
        $member = $members->getMember($option);
        if($member){

            // Set default field values to member details
            $fName      = isset($_POST['fName'])     ? $_POST['fName']      : $member->fName;
            $sName      = isset($_POST['sName'])     ? $_POST['sName']      : $member->sName;
            $telephone  = isset($_POST['telephone']) ? $_POST['telephone']  : $member->telephone;
            $email      = isset($_POST['email'])     ? $_POST['email']      : $member->email;

            $memberID  = $member->memberID;
            $imagePath = $member->profileImagePath;

        } else {
            // Or redirect if $option is invalid
            $members->redirect();
        }


    /* List users ---------------------------------------------------------------- */
    } else {
         // get all user records for display
        $allMembers = $members->getMembers();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">     
    </head>
    <body>
        <div class="container">
            <h1>Members</h1>
                <?php
                    /* Add / Edit form */
                    if(($action=='add')||($action=='edit')) {

                        include 'includes/member-form.php';

                    } elseif ($action == 'view') {

                        include 'includes/member-view.php';

                    } else {

                        include 'includes/member-list.php';

                    }

                    include 'includes/javascript.php'
                ?>
        </div>
    </body>
</html>
