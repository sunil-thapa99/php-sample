<!-- 
	UN id: 17421492
 -->
 <?php 
	require 'adminLayout.php';
	require '../connectToDatabase.php';
	require 'checkauthority.php';
	if(isset($_GET['userid'])){
		//User table
		$table = $_GET['table'];
		unset($_GET['table']);
		//Get all info from url send value
		$getId = $pdo->prepare("SELECT * FROM $table WHERE user_id = :userid");
		$getId->execute($_GET);
		$getDetail = $getId->fetch();
	}
	if(isset($_POST['editChangeData'])){
		//Insert into queried user table
		$getId = $pdo->prepare("UPDATE $table SET 
								fname = :fname,
								lname = :lname,
								uname = :uname,
								email = :email,
								pNumber = :pNumber,
								gender = :gender
							WHERE
								user_id = :user_id");
		unset($_POST['editChangeData']);
		$setDetail = $getId->execute($_POST);
		if($setDetail == true){
			header('location:selectUSer.php?notice=Update Successful');
		}
		else{
			echo '<script type="text/javascript">alert("Unsuccessfully")</script>';
		}
	}
?>
<!--Update form with inserted fields-->
<h3>Edit User Profile:</h3>
<form method="POST" action="">
	<input type="hidden" name="user_id" value="<?php echo $_GET['userid'];?>"><br><br>
	<label>First Name: </label>
	<input type="text" name="fname" value="<?php if (isset($getDetail['fname'])) echo $getDetail['fname']?>"><br><br>
	<label>SurName: </label>
	<input type="text" name="lname" value="<?php if (isset($getDetail['lname'])) echo $getDetail['lname']?>"><br><br>
	<label>User Name: </label>
	<input type="text" name="uname" value="<?php if (isset($getDetail['uname'])) echo $getDetail['uname']?>"><br><br>
	<label>Email: </label>
	<input type="text" name="email" value="<?php if (isset($getDetail['email'])) echo $getDetail['email']?>"><br><br>
	<label>Phone Number: </label>
	<input type="text" name="pNumber" value="<?php if (isset($getDetail['pNumber'])) echo $getDetail['pNumber']?>"><br><br>
	<label>Gender</label>
	<input type="radio" name="gender" value="male" <?php if (isset($getDetail['gender'])) if($getDetail['gender'] == 'male') echo "checked"; ?>>Male
	<input type="radio" name="gender" value="female" <?php if (isset($getDetail['gender'])) if($getDetail['gender'] == 'female') echo "checked"; ?>>Female
	<br><br>
	<input type="submit" name="editChangeData" value="Edit">
</form>