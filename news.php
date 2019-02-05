<!-- 
	UN id: 17421492
 -->
 <?php 
	$title = "News";
	session_start();
	$_SESSION['directedFrom'] = $_SERVER['REQUEST_URI'];
	//Display login/logout on navigation
	if(isset($_SESSION['verifiedUserType'])){
		$loginLogout = "Logout";
	}
	else{
		$loginLogout = "Login";
	}
	require 'connectToDatabase.php';
	require 'header.php';
	if(isset($_GET['categ_id'])){
		//Select news from database of particular category
		$queryCategory = $pdo->prepare("SELECT news_id, newsTitle, articleAuthor, articleContent, articlePostDate FROM news WHERE category_id = :categ_id
			ORDER BY articlePostDate DESC");
		$queryCategory->execute($_GET);
		while ($getRow = $queryCategory->fetch()) {
			//Display queried content
		 	echo '<h2>'.$getRow["newsTitle"].'</h2>';
		 	echo '<p>'.$getRow["articleAuthor"].', '.$getRow["articlePostDate"].'</p>';
			echo '<p id="newsContent">'.$getRow["articleContent"].'</p><br>';
			//Redirected when Read More button is clicked
			echo '<button><a href="clickedNews.php?newsId='.$getRow['news_id'].'">Read More</a></button><br><br>';
		}
	}
	require('indexFooter.php');
?>