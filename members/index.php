<?php
/**
 * @author  CM
 * @date    September 2017
 * 
 * @project PHP3: Assignment 2 : Members
 * 
 */


/**
 * set error reporting level
 * set error display to 'on'
 */



/**
 * Define DB parameters as CONSTANTS
 * 
 */
//define('DBHOST','');
//define('DBUSER','');
//define('DBPASS','');
//define('DBNAME','');



/**
 * Include all required Classes
 * or an Autoloader
 */



/**
 * Instantiate the Members Class
 * - generate array of errors|false for use in JS validation
 * ---------------------------------------------------------
 * Errors : $errors
 */
$members = new Members;

$errors = $members->getErrors();



/**
 * Instantiate the URL Class
 * - pass the project path
 * - set variables for each URL segment that we need
 * -------------------
 * Segment 1 : $action
 * Segment 2 : $option
 */
$url = new Url('/path/to/your/project/');
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
} elseif(($action=='edit')||($action=='view')){ 
   
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
