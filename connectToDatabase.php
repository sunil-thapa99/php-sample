<!-- 
	UN id: 17421492
 -->
 <?php
	//Connect to database name assignment 
	$host = 'localhost'; $assignmentDatabaseName = 'assignment'; $assignmentUser ='root'; $assignmentPass = '';
	$pdo = new PDO('mysql:dbname='.$assignmentDatabaseName.';host='.$host, $assignmentUser, $assignmentPass);
 ?>