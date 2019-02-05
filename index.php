<!-- 
	UN id: 17421492
 -->
 <?php 
	$title = "Northampton News - Home";
	session_start();
	//Display login/logout on nav
	if(isset($_SESSION['verifiedUserType'])){
		$loginLogout = "Logout";
	}
	else{
		$loginLogout = "Login";
	}
	require('header.php');
 ?>
 		<article>
			<?php 
			//Display latest news on top of home page
				$queryCategory = $pdo->prepare("SELECT news_id, newsTitle, articleAuthor, articleContent, articlePostDate FROM news 
					ORDER BY articlePostDate DESC");
				$queryCategory->execute($_GET);
				while ($getRow = $queryCategory->fetch()) {
					//Display content
				 	echo '<h2>'.$getRow["newsTitle"].'</h2>';
				 	echo '<p>'.$getRow["articleAuthor"].', '.$getRow["articlePostDate"].'</p>';
					echo '<p id="newsContent">'.$getRow["articleContent"].'</p><br>';
					echo '<button><a href="clickedNews.php?newsId='.$getRow['news_id'].'">Read More</a></button><br><br>';
				}
			?>
		</article>
<?php 
	require('indexFooter.php');
 ?>