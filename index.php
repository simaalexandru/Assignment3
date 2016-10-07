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
    		<div class="row">
    			<h3>Client CRUD</h3>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Register a new client</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead class="unu">
		                <tr>
		                  <th>Name</th>
		                  <th>Address</th>
		                  <th>Contact Person</th>
		                  <th>Telephone Number</th>
		                  <th>Postcode</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM client ORDER BY Client_ID ASC';
	 				   foreach ( $pdo->query($sql) as $row) {   
						   		echo '<tr>';
							   	echo '<td>'. $row['Client_Name'] . '</td>';
							   	echo '<td>'. $row['Client_Adress'] . '</td>';
							   	echo '<td>'. $row['Client_Contact_Person'] . '</td>';
							   	echo '<td>'. $row['Client_Contact_Phone'] . '</td>';
							   	echo '<td>'. $row['Postcode_Postcode_ID'] . '</td>';
							   	echo '<td width=310>';
							   	echo '<a class="btn btn-primary" href="read.php?Client_ID='.$row['Client_ID'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="update.php?Client_ID='.$row['Client_ID'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-info" href="projects.php?Client_ID='.$row['Client_ID'].'">Projects</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="delete.php?Client_ID='.$row['Client_ID'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>