<!-- 
	UN id: 17421492
 -->
 <?php 
	require 'connectToDatabase.php';
	$title = "Register";
	session_start();
	if(isset($_SESSION['verifiedUserType'])){
		$loginLogout = "Logout";
		//Define user of admin or normal type
		if($_SESSION['verifiedUserType'] == "admin"){
			$usertable = "admin";
		}
		else {
			$usertable = "normalusertable";
		}
	}
	else{
		$loginLogout = "Login";
		$usertable = "normalusertable";
	}
	require 'header.php';	
?>
<?php 
	if(isset($_POST['sign_up'])){
		//Password and confirm password check match
		if($_POST['password'] != $_POST['cnpassword']){
			echo '<script type="text/javascript">alert("Password donot match!!")</script>';
		}
		else{
			//Create user and adding to database with secure password
			//stored using password hashing technique
			$storeData = $pdo->prepare("INSERT INTO $usertable(fname, lname, uname, password, email, pNumber, gender)
			VALUES (:fname, :lname, :uname, :password, :email, :pNumber, :gender)");
			$checkingCriteria = [
				'fname' => $_POST['fname'],
				'lname' => $_POST['lname'],
				'uname' => $_POST['uname'],
				'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
				'email' => $_POST['email'],
				'pNumber' => $_POST['pNumber'],
				'gender' => $_POST['gender']
	
			];
			$insertion = $storeData->execute($checkingCriteria);
			if($insertion){
				echo '<script type="text/javascript">alert("Inserted Successfully and we will reach you via email!!")</script>';
				mail("ransin40@gmail.com", "Leaving a Comment", "Thanks for leaving your valuable comment", "From: info@northamptonNews.com");
			}
			else{
				echo '<script type="text/javascript">alert("Retry again")</script>';
			}
			$_SESSION['directedFrom'] = "index.php";
			header('location:login.php');
		}
	}
 ?>
 <!-- Contact form -->
<h4  id="signText">Sign Up:</h4>
<form name="register" method="POST" action="">
	<label>First Name:</label>
	<input type="text" name="fname" placeholder="Enter Your first name" id="field1" required><br><br>
	<label>Last Name:</label>
	<input type="text" name="lname" placeholder="Enter Your last name" id="field2" required><br><br>
	<label>UserName:</label>
	<input type="text" name="uname" placeholder="Choose username" id="field3" required><br><br>
	<label>Password:</label>
	<input type="password" name="password" placeholder="Enter Password" id="field4" required><br><br>
	<label>Confirm Password:</label>
	<input type="password" name="cnpassword" placeholder="Re-enter Password" id="field5" required><br><br>
	<label>Email:</label>
	<input type="email" name="email" placeholder="Enter Email" id="field6" required><br><br>
	<label>Phone number:</label>
	<input type="text" name="pNumber" placeholder="Enter phone number"><br><br>
	<label>Gender:</label>
	<select name="gender">
		<option value="male">Male</option>
		<option value="female">Female</option>
	</select>
	<label id="terms">I accept Terms and Condition</label>
	<input type="checkbox" name="termsAndCondition" id="checkBox" required>
	<input type="submit" name="sign_up" value="Create Account">
</form>
<?php 
	require 'indexFooter.php';
?>
