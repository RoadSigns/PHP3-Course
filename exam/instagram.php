<?php

session_start();

// ERRORS 
//-----------------------------
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);

// Loading Debugging tools
include 'dumpr.php';

// Loading Helpers
include 'helpers/InstagramUrlGenerator.php';
include 'helpers/StringSantizer.php';

// Loading Main Classes
include 'classes/Instagram.php';
include 'classes/InstagramWall.php';


$search = isset($_POST['search'])     ? $_POST['search']     : '';
$type   = isset($_POST['searchType']) ? $_POST['searchType'] : '';

$instagramWall = new InstagramWall;

//dumpr($instagramWall);
$results = $instagramWall->getResults();

//dumpr($results);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/learn/phpcourse/css/bootstrap.min.css">
        <link rel="stylesheet" href="/learn/phpcourse/css/instagram.css">
    </head>
    <body>

    <div class="overlay"></div>
        
    <div class="container" style="max-width:800px;">
        
        <h1>Instagram Search</h2>
        
        <div class='row header'>

            <form name="" action="" method="post" class="form-inline" id="instaForm">
                <input name="search" type="text" value='<?=$search ?>' placeholder="@username or keyword" required class="form-control" style="width:300px" />
                <select name="searchType" class="form-control">
                    <option value="username" <?=$type=='username'?'selected':''?>>Instgram user</option>
                    <option value="keyword" <?=$type=='keyword'?'selected':''?>>Instgram keyword</option>
                </select>
                <button class="button">Go</button>
                <input type="hidden" name="frmName" value="instagram" />
            </form>

        </div>
    
<?php if($results){ ?>
<?php foreach($results as $result){ //dumpr($result); ?>
    
    <div class="outer">
    
        <div class='profile'>
            <img src='<?=$result->userimage ?>' /><br>
            <span class="name">
                <strong><?=$result->name ?></strong><br>
                <?=$result->username ?>
            </span>
        </div>
        
        <a href="<?=$result->link?>" target="_blank">
            <?php if($result->isVideo){ ?>
            <video class="video" autoplay loop muted>
                <source src='<?=$result->video?>' type='video/mp4'>
                <!-- fall back for older browsers -->
                <img src='<?=$result->thumb?>'/>
            </video>            
            <?php } else { ?>
            <div class="image" style="background-image: url('<?=$result->thumb?>')"></div>
            <?php }?>
        </a>
    
    </div>
    
<?php } ?>
<?php } ?>

    </div>
        
    <script type="text/javascript" src="/learn/phpcourse/js/jquery/jquery.1.12.4.min.js"></script>
    <script>
    $(document).ready(function() {    
        $('#instaForm').on('submit',function(){
            $('.overlay').show();
        });
    });
    </script>
    </body>
</html>  