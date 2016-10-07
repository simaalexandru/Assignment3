<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['Client_ID'])) {
		$id = $_REQUEST['Client_ID'];
	}
	
	
	
	
	if ( !empty($_POST)) {
		//Validation errors
		$nameError = null;
		$adressError = null;
		$contactError = null;
		$telephoneError = null;
		$postcodeError = null;
		
		//Post values
		$name = $_POST['Client_Name'];
		$adress = $_POST['Client_Adress'];
		$contact = $_POST['Client_Contact_Person'];
		$telephone = $_POST['Client_Contact_Phone'];
		$postcode = $_POST['Postcode_Postcode_ID'];
		
		//Validate input,error message
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($adress)) {
			$adressError = 'Please enter Address';
			$valid = false;
	
		}
		
		if (empty($contact)) {
			$contactError = 'Please enter Contact Person';
			$valid = false;
		}
		if (empty($telephone)) {
			$telephoneError = 'Please enter Contact Telephone';
			$valid = false;
		}
		
		if (empty($postcode)) {
			$postcodeError = 'Please enter Postcode';
			$valid = false;
		}
		
		//if it's valid it's true, update data related to client id , send to index
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE client set Client_Name = ?, Client_Adress = ?, Client_Contact_Person = ?, Client_Contact_Phone = ?, Postcode_Postcode_ID =? WHERE Client_ID = ?";
			$q = $pdo->prepare($sql);
    		$q->execute(array($name, $adress, $contact, $telephone,$postcode, $id));
			Database::disconnect();
			header("Location: index.php");
			}
			
			//if not select all from client, related to client id 
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM client where Client_ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['Client_Name'];
		$adress = $data['Client_Adress'];
		$contact = $data['Client_Contact_Person'];
		$telephone = $data['Client_Contact_Phone'];
		$postcode = $data['Postcode_Postcode_ID'];
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
		    			<h3>Update customer no. <?=$id?></h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?Client_ID=<?php echo $id?>" method="post">
	    			    <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="Client_Name" type="text" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div> 
					  
					  <div class="control-group <?php echo !empty($adressError)?'error':'';?>">
					    <label class="control-label">Address</label>
					    <div class="controls">
					      	<input name="Client_Adress" type="text" value="<?php echo !empty($adress)?$adress:'';?>">
					      	<?php if (!empty($adressError)): ?>
					      		<span class="help-inline"><?php echo $adressError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($contactError)?'error':'';?>">
					    <label class="control-label">Contact Person</label>
					    <div class="controls">
					      	<input name="Client_Contact_Person" type="text" value="<?php echo !empty($contact)?$contact:'';?>">
					      	<?php if (!empty($contactError)): ?>
					      		<span class="help-inline"><?php echo $contactError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($telephoneError)?'error':'';?>">
					   <label class="control-label">Mobile Number</label>
					   <div class="controls">
					      	<input name="Client_Contact_Phone" type="text" value="<?php echo !empty($telephone)?$telephone:'';?>">
					      	<?php if (!empty($telephoneError)): ?>
					      		<span class="help-inline"><?php echo $telephoneError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($postcodeError)?'error':'';?>">
					   <label class="control-label">Postcode</label>
					   <div class="controls">
					      	<input name="Postcode_Postcode_ID" type="text" value="<?php echo !empty($postcode)?$postcode:'';?>">
					      	<?php if (!empty($postcodeError)): ?>
					      		<span class="help-inline"><?php echo $postcodeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn btn-info" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>