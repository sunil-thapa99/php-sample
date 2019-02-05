<!-- 
	UN id: 17421492
	For admin
	Username: admin
	Password: sunil
	For normal user
	Username: sunil43thapa
	Password: sunil
 -->
<?php 
	session_start();
	require 'connectToDatabase.php';
	if(isset($_SESSION['verifiedUserType'])){
		if($_SESSION['verifiedUserType'] == "normal")
			//Logout user
			header('location:logout.php');
		else
			//if admin load to backend
			header('location:admin/adminIndex.php');
	}
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Northampton - Login</title>
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/checkLogin.css">
		<script type="text/javascript" src="js/validate.js"></script>
	</head>
	<body>
		<!-- Redirected URL -->
		<a href="<?php 
			echo $_SESSION['directedFrom'];
		?>" id="goBack"><h4>Go Back</h4></a>
		<div class="loginBox">
			<!-- login page input fields -->
			<h2 id="loginTitle">Login</h2>
			<form method="POST" action="">
				<label>Username:</label><br>
				<input type="text" name="uname" placeholder="Enter Username: " id="username" required>
				<br>
				<label>Password:</label><br>
				<input type="password" name="password" placeholder="Enter Password:" id="password" required>
				<br>
				<a href="#" id="forgetPass">Forget Password?</a><br>
				<input type="radio" name="radio" value="normalUser" checked="checked">Normal User
				<input type="radio" name="radio" value="admin">Admin
				<input type="submit" name="submit" value="Submit" id="submit" onclick="validateEmpty()">
			</form>
			<a href="createAccount.php">Create account</a>
		</div>	
<?php 
	if(isset($_POST['submit'])){
		$errorUsername = false;
		if($_POST['radio'] == "normalUser"){
			//Get all info from normal user database
			$getData = $pdo->prepare("SELECT * FROM normalusertable
				WHERE uname = :uname");
		}
		else if($_POST['radio'] == "admin"){
			//Get all info from admin database
			$getData = $pdo->prepare("SELECT * FROM admin
				WHERE uname = :uname");
		}
		$checkingCriteria = [
			'uname' => $_POST['uname']
		];
		$getData->execute($checkingCriteria);
		if($getData->rowCount() > 0){
			//Queried returned result
			$referenceUsername = $getData->fetch();
			//Password entered matches on database
			if(password_verify($_POST['password'], $referenceUsername['password'])){
				//Send account type on SESSION
				$_SESSION['verifiedUserType'] = $referenceUsername['account_type'];
				//Send id of admin/user on SESSION
				$_SESSION['verifiedUserId'] = $referenceUsername['user_id'];
				if($_POST['radio'] == "normalUser"){
					//Previous page url
					$prevURL = $_SESSION['directedFrom'];
					header('location:'.$prevURL.'');
				}
				else if($_POST['radio'] == "admin"){
					$_SESSION['userType'] = $_POST['radio'];
					header('location:admin/adminIndex.php');
				}
			}
			else{
				$errorTitle = "Password donot match.";
				$errorUsername = true;
			}
		}
		else{
			$errorTitle = "Username doesnot exists.";
			$errorUsername = true;
		}
		if($errorUsername == true){
			echo '<script type="text/javascript">alert("'.$errorTitle.'Login Failed!!!")</script>';
		}
	}
 ?>
	</body>
</html>

