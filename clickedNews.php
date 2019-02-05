<!-- 
	UN id: 17421492
 -->
 <?php 
	session_start();
	$title = "News";
	//Send current page url to login form to redirect
	$_SESSION['directedFrom'] = $_SERVER['REQUEST_URI'];
	//Display login/logout on navbar 
	if(isset($_SESSION['verifiedUserType'])){
		$loginLogout = "Logout";
	}
	else{
		$loginLogout = "Login";
	}
	require 'connectToDatabase.php';
	require 'header.php';
	$newsId = $_GET['newsId'];
	if(isset($_GET['newsId'])){
		//Select all news of specific category
		$queryCategory = $pdo->prepare("SELECT newsTitle, articleAuthor, articleContent, articlePostDate FROM news 
			WHERE news_id = :newsId");
		$queryCategory->execute($_GET);
		while ($getRow = $queryCategory->fetch()) {
			//Display news title, date with article
		 	echo '<h2>'.$getRow["newsTitle"].'</h2>';
		 	echo '<p>'.$getRow["articleAuthor"].', '.$getRow["articlePostDate"].'</p>';
			echo '<p>'.$getRow["articleContent"].'</p><br>';
		}
		//Query image of repective news
		$queryImage = $pdo->prepare("SELECT imageFilePath FROM imagedatabase WHERE newsId = :newsId");
		$queryImage->execute($_GET);
		while ($getRow = $queryImage->fetch()){
			//Display image
			echo '<div><img src="'.$getRow["imageFilePath"].'"></div>';
		}
	}
?>
<!-- Comment form -->
<form method="POST" action="">
	<label>Comments:</label><br><br>
	<?php
	//Display comment of particular news
		$queryComment = $pdo->query('SELECT comment_id, comment, commentPublishDate, fname, lname, user_id
			FROM commenttable
			JOIN normalusertable 
			ON (userId = user_id) 
			WHERE (newsId = '.$newsId.')
			AND (publish = "yes")
			ORDER BY commentPublishDate DESC');
		?>
		<ul>
		<?php 
			while ($getRow = $queryComment->fetch()) {
				echo "<li>";
				//Fetch comment and provide reply link
			echo $getRow["lname"].', '.$getRow["fname"].' ('.$getRow["commentPublishDate"].')-> '.$getRow["comment"];
			if(isset($_SESSION['verifiedUserId'])){
				echo '<button><a href="reply.php?newsId='.$_GET['newsId'].'&cmtId='.$getRow['comment_id'].'&userId='.$_SESSION['verifiedUserId'].'">Reply</a></button>';
			}
			echo "</li>";
		}
		?>
		</ul>
	<textarea name="comment" rows="5" cols="77"></textarea>
	<input type="submit" name="post" value="POST">
</form>
<?php 
	if(isset($_POST['post'])){
		if(!isset($_SESSION['verifiedUserType'])){
			//Send current page url
			$_SESSION['directedFrom'] = $_SERVER['REQUEST_URI'];
			header('location:login.php');
		}
		else{
			unset($_POST['post']);
			$user = $_SESSION['verifiedUserId'];
			//Get system date
			$getSystemDate = date('Y-m-d H:i:s');
			$comment = $_POST['comment'];
			//Insert comment on database
			$getQuery = $pdo->prepare("INSERT INTO commenttable(comment, commentPublishDate, newsId, userId)
				VALUES('$comment', '$getSystemDate', '$newsId', 
				'$user')");
			$insertQuery = $getQuery->execute($_POST);
			if($insertQuery){
				echo '<script type="text/javascript">alert("Thanks for commenting, We will reach out to you after your comment gets approved!!")</script>';
				//Mail to ransin40@gmail.com email
				mail("ransin40@gmail.com", "Leaving a Comment", "Thanks for leaving your valuable comment", "From: info@northamptonNews.com");
			}
			else{
				echo '<script type="text/javascript">alert("Unsuccessfully")</script>';
			}
			//Reload the current page
			header("Refresh:0");
		}
	}
	require('indexFooter.php');
?>
