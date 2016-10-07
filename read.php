<?php 
	require 'database.php';
	$id = null;
	if ( !empty($_GET['Client_ID'])) {
		$id = $_REQUEST['Client_ID'];
	}
	
	
	//if id is null send to index , if not connect to db and select all from client related to client id
	if ( null==$id ) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM client where Client_ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
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
		    			<h3>Read client no. <?=$id?></h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
					         <label class="checkbox">
						        <p class="h5">
						     	<?php echo $data['Client_Name'];?>
						     	</p>
						    </label>
					    </div>
					  </div>
					  <br>
					  <div class="control-group">
					    <label class="control-label">Email Addres</label>
					    <div class="controls">
					      	<label class="checkbox">
					      	    <p class="h5">
						     	<?php echo $data['Client_Adress'];?>
						     	</p>
						    </label>
					    </div>
					  </div>
					  <br>
					  <div class="control-group">
					    <label class="control-label">Contact Person</label>
					    <div class="controls">
					      	<label class="checkbox">
					      	    <p class="h5">
						     	<?php echo $data['Client_Contact_Person'];?>
						     	</p>
						    </label>
					    </div>
					  </div>
					  <br>
					  <div class="control-group">
					    <label class="control-label">Contact Phone</label>
					    <div class="controls">
					      	<label class="checkbox">
					      	    <p class="h5">
						     	<?php echo $data['Client_Contact_Phone'];?>
						     	</p>
						    </label>
					    </div>
					  </div>
					  <br>
					  <div class="control-group">
					    <label class="control-label">Postcode</label>
					    <div class="controls">
					      	<label class="checkbox">
					      	    <p class="h5">
						     	<?php echo $data['Postcode_Postcode_ID'];?>
						     	</p>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
						  <a class="btn btn-info" href="index.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>