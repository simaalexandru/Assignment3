<?php
require 'database.php';
$id = null;
//setting the client_id=$id
if ( !empty($_GET['Client_ID'])) {
$id = $_REQUEST['Client_ID'];
}

//first check if the id is null,if it is send to index, if not, connect to db, select all from project and fetch
if ( null==$id ) {
header("Location: index.php");
} else {
$pdo = Database::connect();
$sql = "SELECT * FROM project where Client_Client_ID = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetchAll();
Database::disconnect();
}
?>


<html>
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
     <h3>Project/s of client no. <?=$id?></h3>
   </div>

  <table class="table table-striped table-bordered">
   <thead class="doi">
    <tr>
     <th>Project</th>
     <th>Start Date</th>
     <th>End Date</th>
     <th>Details</th>
    </tr>
   </thead>
 
  <tbody>
   <?php
   foreach($data as $key => $value){
   echo '<tr>';
   echo '<td>'. $value['Project_Name'] . '</td>';
   echo '<td>'. $value['Project_Startdate'] . '</td>';
   echo '<td>'. $value['Project_Enddate'] . '</td>'; 
   echo '<td>'. $value['Project_Detail'] . '</td>';
   echo '</tr>';
   }
   ?>
  </tbody>
 </table>

   <div class="form-actions">
    <a class="btn btn-info" href="index.php">Back</a>
   </div>
  </div>
 </div> 
</body>
</html>