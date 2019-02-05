<!-- 
	UN id: 17421492
 -->
 <?php 
	session_start();
	session_unset();
	session_destroy();
	//Logout
	header('location:../login.php');
?>