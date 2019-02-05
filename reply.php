<!-- 
	UN id: 17421492
 -->
 <?php 
	session_start();
	$title = "News";
	//Redirect after login 
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
	//Join comment table and user table on comment_id condition
	$queryComment = $pdo->query('SELECT comment, commentPublishDate, fname, lname, user_id
			FROM commenttable
			JOIN normalusertable 
			ON (userId = user_id) 
			WHERE (comment_id = '.$_GET['cmtId'].')
			AND (publish = "yes")
			ORDER BY commentPublishDate DESC');
	while ($getRow = $queryComment->fetch()) {
		//Display all comment
		echo $getRow["lname"].', '.$getRow["fname"].' ('.$getRow["commentPublishDate"].')-> '.$getRow["comment"];
	}
	echo "<h4>Reply:</h4>";
	//Use alias to connect nested comment for particular comment
	$queryNestComment = $pdo->query('SELECT replyCmt, fname, lname
			FROM normalusertable
			JOIN nestedcommentstoretable 
			ON (nestedcommentstoretable.user_id = normalusertable.user_id) 
			JOIN commenttable
			ON (cmt_id = comment_id)
			WHERE news_id = '.$_GET['newsId'].'
			AND (cmt_id = '.$_GET['cmtId'].')');
	echo '<ul style="margin:10px">';
	while ($getRow = $queryNestComment->fetch()) {
		echo "<li>";
		//Display comment reply
		echo $getRow["lname"].', '.$getRow["fname"].'-> '.$getRow["replyCmt"];
		echo "</li>";		
	}
?>
<!-- Reply comment form  -->
<form method="POST" action="">
	<textarea name="replyComment" rows="5" cols="77" placeholder="Write Comment"></textarea>
	<input type="submit" name="post" value="Post">
</form>
<?php 
	if(isset($_POST['post'])){
		unset($_POST['post']);
		//Insert reply comment on database
		$getQuery = $pdo->prepare('INSERT INTO nestedcommentstoretable(replyCmt, user_id, cmt_id, news_id)
			VALUES(:replyComment, '.$_GET['userId'].', '.$_GET['cmtId'].', '.$_GET['newsId'].')');
		$insertQuery = $getQuery->execute($_POST);
		//Reload page
		header("Refresh:0");
	}

	require 'indexFooter.php';
?>