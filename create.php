<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// errors
		$nameError = null;
		$adressError = null;
		$contactError = null;
		$telephoneError = null;
		$postcodeError = null;
		
		// Post values
		$name = $_POST['Client_Name'];
		$adress = $_POST['Client_Adress'];
		$contact = $_POST['Client_Contact_Person'];
		$telephone = $_POST['Client_Contact_Phone'];
		$postcode = $_POST['Postcode_Postcode_ID'];
		
		// validate input , message error
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
			$contactError = 'Please enter Contact';
			$valid = false;
		}
		
		if (empty($telephone)) {
			$telephoneError = 'Please enter Telephone';
			$valid = false;
		}
		
		if (empty($postcode)) {
			$postcodeError = 'Please enter Postcode';
			$valid = false;
		}
		
		// insert data into client table ,after send to index
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO client (Client_Name, Client_Adress, Client_Contact_Person, Client_Contact_Phone, Postcode_Postcode_ID) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$adress,$contact,$telephone,$postcode));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="js/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <link href="js/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create a Customer</h3>
		    		</div>
    		         
	    			<form class="form-horizontal" action="create.php" method="POST">
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
					    <label class="control-label">Telephone</label>
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
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn btn-info" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>