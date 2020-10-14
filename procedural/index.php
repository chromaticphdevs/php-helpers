<?php 
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);	
	//start session
	session_start();
	//load session and flash helpers
	require_once 'session_flash/autoload.php';

	//actions
	if(isset($_POST['flash_success'])) 
		setFlash('Flash Success');

	if(isset($_POST['flash_danger'])) 
		setFlash('Flash Danger' , 'danger');

	if(isset($_POST['flash_primary'])) 
		setFlash($_POST['flash_value'] , 'primary');

	if ($_SERVER['REQUEST_METHOD'] === 'POST') 
	{
	   $punches = getSession('punches');

		if(!empty($punches)){
			$punches++;
		}else{
			$punches = 1;
		}

		setSession('punches' , $punches);
	}

	//reset punches

	if(isset($_GET['reset']) && $_GET['reset'] == 'punches'){
		destroySession('punches');

		header("Location: {$_SERVER['HTTP_REFERER']}");
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

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="https://monsterthesis.com">Home</a>
    </nav>

    <main role="main" class="container">

      <div style="margin-top: 75px"></div>

      <div class="starter-template">
        <h1>Commands</h1>
        <div class="card">
        	<div class="card-header">
        		<h4>Flash Messages</h4>
        	</div>

        	<div class="card-body">
        		<form method="post">
		        	<input type="submit" name="flash_success"
		        		class="btn btn-success btn-sm" value="Success Alert Message">

		    		<input type="submit" name="flash_danger"
		    		class="btn btn-danger btn-sm" value="Danger Alert Message">
		        </form>
		        <hr>

		        <form method="post">
		         	<div class="form-group">
		         		<input type="text" name="flash_value" required="" placeholder="Input your alert message"
		         		class="form-control">
		         	</div>

		        	<input type="submit" name="flash_primary"
		        		class="btn btn-primary btn-sm" value="Primary Alert Message">
		        </form>
        	</div>

        	<div class="card-footer">
        		<h4>Flash Result</h4>

        		<!-- DISPLAY THE FLASH RESULT -->
        		<?php flash()?>

        		<?php 
        			$punches = (int) empty(getSession('punches')) ? 0 : getSession('punches');
        			echo "Flash run {$punches} times";

        			if($punches > 1)
	        			echo "<a href='?reset=punches'> Reset </a>";
        		?>
        	</div>
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
