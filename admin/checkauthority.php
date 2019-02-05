<!-- 
	UN id: 17421492
 -->
 <?php 
	session_start();
	//Check admin or normal user
	if(!isset($_SESSION['verifiedUserType'])){
		header('location:../login.php');
	}
	if(isset($_SESSION['verifiedUserType'])){
		if($_SESSION['verifiedUserType'] == "normal")
			header('location:../index.php');
	}
?>