<!-- 
	UN id: 17421492
 -->
 <?php 
	require '../connectToDatabase.php';
	require 'generateTableToDisplay.php';
	if(!isset($_SESSION['verifiedUserType'])){
		header('location:../login.php');
	}
	echo "<h2>User</h2>";
	//Display table dynamically 
	$table = new GenerateTableToDisplay();
	//Set title to table generated column
	$table->setTableSubTitle(['User_id', 'First Name', 'Surname', 'User Name', 'Email',
	 'Contact Number', 'Gender']);
	//Display all  info from normal user table
	$queryUser = $pdo->query("SELECT user_id, fname, lname, uname, email, pNumber, gender FROM normalusertable");
	while($getRow = $queryUser->fetch(PDO::FETCH_ASSOC)) {
        $table->setTableRows($getRow);
	}
	//Generate HTML code
	echo $table->getRequiredHTML();
?>
				<div>
					<!-- Add, Edit, Delete button -->
					<form method="POST" action="">
						<input type="submit" name="add" value="Add" id="button">
						<input type="submit" name="edit" value="Edit" id="button">
						<input type="submit" name="delete" value="Delete" id="button">
					</form>
				</div>
				<h2>Admin</h2>
<?php
	//Generate table
	$table1 = new GenerateTableToDisplay();
	//Set title to the table column
	$table1->setTableSubTitle(['User_id', 'First Name', 'Surname', 'User Name', 'Email',
	 'Contact Number', 'Gender']);
	//Display all info of admin
	$queryUser = $pdo->query("SELECT user_id, fname, lname, uname, email, pNumber, gender FROM admin");
	while($getRow = $queryUser->fetch(PDO::FETCH_ASSOC)) {
        $table1->setTableRows($getRow);
	}
	echo $table1->getRequiredHTML();
?>
			</article>
		</main>
	</body>
</html>
<?php 
	//Reload page to respective actions
	if(isset($_POST['add'])){
		header('location:../createAccount.php');
	}
	if(isset($_POST['edit'])){
		echo "<br>";
		header('location:selectUser.php');
	}
	if(isset($_POST['delete'])){
		echo "<br>";
		header('location:selectUser.php');
	}
?>
