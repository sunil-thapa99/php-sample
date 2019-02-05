<!-- 
	UN id: 17421492
 -->
 <?php 
	require 'adminLayout.php';
	require '../connectToDatabase.php';
	require 'checkauthority.php';
	if(isset($_GET['notice'])){
		echo '<script type="text/javascript">alert("'.$_GET['notice'].'")</script>';
	}
	if(isset($_GET['delUserid'])){
		$table = $_GET['table'];
		unset($_GET['table']);
		//Get user from required table and delete on request
		$getDetail = $pdo->prepare("DELETE FROM $table WHERE user_id = :delUserid");
		$executeDelete = $getDetail->execute($_GET);
		if($executeDelete){
			echo '<script type="text/javascript">alert("Delete Successful")</script>';
		}
		else{
			echo '<script type="text/javascript">alert("Delete Unsuccessful")</script>';
		}
	}
?>
<!-- Select table name with searching initial forum -->
<form method="POST" action="">
	<label>Select User field</label>
	<input type="radio" name="type" value="admin" required>Admin
	<input type="radio" name="type" value="normalusertable">Normal User
	<select name="selectUserName">
		<option value="user_id">User Id</option>
		<option value="fname">User Firstname</option>
		<option value="lname">User Lastname</option>
		<option value="email">User Email</option>
		<option value="gender">User gender</option>
	</select>
	<input type="text" name="searchTypedby">
	<input type="submit" name="getUser" value="Search User">
</form>
<?php 
	if(isset($_POST['getUser'])){
		$userHint = $_POST['selectUserName'];
		$searchTypedby = $_POST['searchTypedby'];
		$usertable = $_POST['type'];
		//Query table where search keyword
		$userRecord = $pdo->query("SELECT user_id, fname, lname, uname, email, pNumber, gender, account_type FROM $usertable WHERE $userHint like '%$searchTypedby%'");
		echo "<ul>";
		foreach ($userRecord as $pointUser) {
			//Display details with edit and delete link
			echo '<li>'.$pointUser['lname'].', '.$pointUser['fname'].' has user id '.$pointUser['user_id'].'<br>User name is: '.$pointUser['uname'].'<br>Email id is: '.$pointUser['email'].'<br>Phone Number: '.$pointUser['pNumber'].'<br>Gender: '.$pointUser['gender'].'<br><a href="editUser.php?userid='.$pointUser['user_id'].'&table='.$usertable.'" style="color: #eee; text-decoration: underline;">Edit</a><br><a href="selectUser.php?delUserid='.$pointUser['user_id'].'&table='.$usertable.'" style="color: #eee; text-decoration: underline;">Delete</a></li>';
		}
		echo "</ul>";
	}
?>
