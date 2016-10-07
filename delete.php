<?php 
	require 'database.php';
	$id = 0;
	
	if ( !empty($_GET['Client_ID'])) {
		$id = $_REQUEST['Client_ID'];
	}
	
	if ( !empty($_POST)) {
		// setting the $id = post method, client id
		$id = $_POST['Client_ID'];
		
		// delete data , after send to index
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM client  WHERE Client_ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: index.php");
		
	} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="js/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <link   href="js/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Delete customer no. <?=$id?></h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="delete.php" method="post">
	    			  <input type="hidden" name="Client_ID" value="<?php echo $id;?>"/>
					  <p class="alert">Are you sure you want to delete ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn btn-success" href="index.php">No</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>