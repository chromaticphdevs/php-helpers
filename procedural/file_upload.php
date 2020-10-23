<?php 
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);	
	//start session
	session_start();
	//load session and flash helpers
    require_once 'image_upload/autoload.php';
    
    if(isset($_POST['_multiple'])) {
        $uploads = upload_multiple('images', 'image_upload/uploads');
    }

    if(isset($_POST['_single'])) {
        $upload = upload('image', 'image_upload/uploads');
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Monster Thesis</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://bootswatch.com/4/pulse/bootstrap.css" rel="stylesheet">
  </head>

  <body>
    <?php include_once('nav.php')?>

    <main role="main" class="container">

      <div style="margin-top: 75px"></div>

      <div class="starter-template">
        <h1>Simple image uploader</h1>
        <div class="card">
            <div class="card-header">
                <h4>Multiple and single Image uploader</h4>
            </div>

            <div class="card-body">
                <h4>Multiple</h4>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="images[]"  multiple>

                    <input type="submit" name="_multiple" value=" Upload File ">
                </form>

                <hr>

                <h4>Single</h4>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="image"  multiple>

                    <input type="submit" name="_single" value=" Upload File ">
                </form>
            </div>

            <?php if(isset($uploads)) :?>
                <div class="card-footer">
                    <h4>Results</h4>

                    <!-- IF UPLOAD FAILED -->
                    <?php if(!$uploads['status']) :?>
                        <h5 class='text-danger'> Upload Failed <h5>
                        <ul>
                            <?php foreach($uploads['errors'] as $err): ?>
                                <li><?php echo $err?></li>
                            <?php endforeach?>
                        </ul>
                    <?php endif?>
                    <!-- END OF UPLOAD FAILED -->

                    <!-- IF UPLOAD SUCCESS -->
                    <?php if($uploads['status']) :?>
                        <h5 class='text-danger'> Uploaded Files (SUCCESS) <h5>
                        <ul>
                            <?php foreach($uploads['uploads'] as $row): ?>
                                <li><?php echo $row?></li>
                            <?php endforeach?>
                        </ul>
                        <ul>
                            <?php foreach($uploads['uploadsWithPath'] as $uploadWithPath): ?>
                                <li>
                                    <?php echo $uploadWithPath?>
                                    <img src="<?php echo $uploadWithPath?>" alt="Image uploaded" 
                                    style="width: 150px; height:150px">
                                </li>
                            <?php endforeach?>
                        </ul>
                    <?php endif?>
                    <!-- END OF UPLOAD FAILED -->

                    <h5>Files</h5>
                    <ul>
                        <?php foreach($uploads['files'] as $key => $file) : ?>
                            <li><?php echo $file?></li>
                        <?php endforeach?>
                        <li><strong>Base Path : <?php echo $uploads['path']?></strong></li>
                    </ul>

                </div>
            <?php endif?>

            <?php if(isset($upload)) :?>
                <div class="card-footer">
                    <?php if(!$upload['status']) :?>
                        <h4>Upload Failed</h4>
                        <ul>
                            <li>Error : <?php echo implode(',' , $upload['errors']) ?></li>
                            <li>File : <?php echo $upload['file']?></li>
                            <li>Path : <?php echo $upload['path']?></li>
                        </ul>
                    <?php endif?>

                    <?php if($upload['status']):?>
                        <h4>Upload Success</h4>
                        <ul>
                            <li>Upload : <?php echo $upload['upload']?></li>
                            <li>Upload With Path : <?php echo $upload['uploadWithPath']?></li>
                            <li>File : <?php echo $upload['file']?></li>
                            <li>Path : <?php echo $upload['path']?></li>
                        </ul>
                    <?php endif?>
                </div>
            <?php endif?>
        </div>
        
      </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


  </body>
</html>
