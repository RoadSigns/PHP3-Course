<?php
    require ('classes/FileUpload.php');
    require ('dumpr.php');

// Detect form submission
if (isset($_POST['submit']) && ($_POST['submit'] == 'Upload')){
    $fileUpload = new FileUpload('fileUpload');
    
    $fileUpload->targetPath = $_SERVER['DOCUMENT_ROOT'].'/webstudent/sem6zl/php3/uploads/';
    
    if (!$fileUpload->validate()) {
        $error = $fileUpload->getError();
    } else {
        $uploadInformation = $fileUpload->process();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">     
    </head>

    <body>

        <h1>File Upload</h1>

        <?php 
            if ($uploadInformation){
               echo "Filename: " . $uploadInformation['filename'];
               echo "<br />";
               echo "File Extension: " . $uploadInformation['extension'];
               echo "<br />";
               echo "File Size: " . $uploadInformation['size'];
               echo "<hr />";
            }
        ?>
        
        <?php if($error){ ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error:</strong> <?=$error?>
        </div>
        <?php } ?>

        <form name='' action='' method='post' enctype='multipart/form-data' class="">
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type='file'   name='fileUpload' id="exampleInputFile" />
            </div>
            <input type='submit' name='submit' value='Upload' class="btn btn-default" />
        </form>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>

    </body>

</html>

