<!-- 
	UN id: 17421492
 -->
<?php 
	$title = "Northampton News - Home";
	session_start();
	//Display login/logout on navigation
	if(isset($_SESSION['verifiedUserType'])){
		$loginLogout = "Logout";
	}
	else{
		$loginLogout = "Login";
	}
	require 'header.php';
	//Get search keyword from  user
	$srchKeyword = $_GET['srch'];
	//Match keyword with news title and article author
		$querySearch = $pdo->query("SELECT * FROM news 
			WHERE newsTitle LIKE '%$srchKeyword%'
			OR articleAuthor LIKE '%$srchKeyword%'");
		while ($getRow = $querySearch->fetch()) {
			//Display matched keyword from news database
		 	echo '<h2>'.$getRow["newsTitle"].'</h2>';
		 	echo '<p>'.$getRow["articleAuthor"].', '.$getRow["articlePostDate"].'</p>';
			echo '<p>'.$getRow["articleContent"].'</p><br>';
		}
	require 'indexFooter.php';
 ?>