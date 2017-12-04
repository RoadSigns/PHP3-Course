<?php

include '../dumpr.php';

include $_SERVER['DOCUMENT_ROOT'].'/learn/phpcourse/php3/8_urlparse/classes/Url.php';
include $_SERVER['DOCUMENT_ROOT'].'/learn/phpcourse/php3/8_urlparse/classes/Blog.php';

/**
 * 
 */
$url  = new Url('/webstudent/sem6zl/php3/blog/'); // Add project path
$firstSegment  = $url->getSegment(1); 
$secondSegment = $url->getSegment(2);

/**
 * 
 */
$blog = new Blog();
//$blog->getBlog();      - requires URL segment passed in
//$blog->getCategory();  - requires URL segment passed in   
//$blog->getLatestPost();
//$blog->getCategorys();


if($firstSegment == "add"){
    
    $include = 'addpost.php';

} else
    
if($firstSegment == "edit"){

    $blogPost = $blog->getBlog($secondSegment);
  
    $include = 'editpost.php';
    
} else
        
if($firstSegment && $secondSegment){
    
    $blogPost = $blog->getBlog($secondSegment);
            
    $include = 'post.php';
    
} else
    
if($firstSegment && !$secondSegment){
    
    $blogCategory = $blog->getCategory($firstSegment);
            
    $include = 'category.php';
    
} else {
   
    $latestPost = $blog->getLatestPost();
    $categorys  = $blog->getCategorys();
    
    $include = 'home.php';
    
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

            <?php include $_SERVER['DOCUMENT_ROOT']."/learn/phpcourse/php3/8_urlparse/includes/$include"; ?>

        </div>
        
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
        
    </body>
    
</html> 