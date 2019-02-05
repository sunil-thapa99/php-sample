<!-- 
	UN id: 17421492
 -->
<?php 
	require 'adminLayout.php';
	require '../connectToDatabase.php';
	require 'generateTableToDisplay.php';
	require 'checkauthority.php';
	echo "<h2>Published Comment:</h2>";
	//Generate table
	$table = new GenerateTableToDisplay();
	//Table title
	$row = ['Comment Id', 'Comment', 'Commented Date', 'New Type', 'News Name', 'User First Name', 'User Last Name'];
	//Querying fields using  join
	$query = 'SELECT comment_id, comment, commentPublishDate, category_title, newsTitle, fname, lname 
		FROM commenttable
		LEFT JOIN news ON (newsId = news_id)
		LEFT JOIN categories ON (category_id = cate_id)
		LEFT JOIN normalusertable ON (userId = user_id)';
	//Setting table title
	$table->setTableSubTitle($row);
	//Concatinating query with condition
	$queryCategory = $pdo->query($query.' WHERE (publish = "yes")
				ORDER BY commentPublishDate');
	//Fetching queried data
	while($getRow = $queryCategory->fetch(PDO::FETCH_ASSOC)) {
        $table->setTableRows($getRow);
	}
	echo $table->getRequiredHTML();

	echo "<br><h2>Pending Comment:</h2>";
	//Generating table for pending comments
	$table1 = new GenerateTableToDisplay();
	$table1->setTableSubTitle($row);
	//Concatinating query with condition
	$queryCategory1 = $pdo->query($query.' WHERE (publish = "no")
				ORDER BY commentPublishDate');
	while($getRow = $queryCategory1->fetch(PDO::FETCH_ASSOC)) {
        $table1->setTableRows($getRow);
	}
	//Getting HTML tag
	echo $table1->getRequiredHTML();
?>
<!-- publish form -->
<form method="POST" action="">
	<label>Enter pending comment ID: </label>
	<input type="text" name="comment_id"><br>
	<label>Publish: </label>
	<input type="radio" name="publish" value="yes" required>Yes
	<input type="radio" name="publish" value="no">No
	<br><input type="submit" name="change" value="Change">
</form>
<?php 
	if(isset($_POST['change'])){
		unset($_POST['change']);
		//unset submit and querying update
		$queryCommentPublish = $pdo->prepare('UPDATE commenttable 
			SET publish = :publish
			WHERE comment_id = :comment_id');
		//Execute query
		$queryExecute = $queryCommentPublish->execute($_POST);
		if ($queryExecute) {
			echo '<script type="text/javascript">alert("Field Changed")</script>';
			header('Refresh:0');
		}
		else{
			echo '<script type="text/javascript">alert("Try Again")</script>';
		}
	}
?>
<!-- Search comment via name -->
<form method="POST" action="">
	<label>Search User's Comment:</label>
	<input type="text" name="userNameToSearch" placeholder="Enter User Name">
	<input type="submit" name="search" value="Search">
</form>
<?php 
	if (isset($_POST['search'])) {
		$searchTypedby = $_POST['userNameToSearch'];
		//search name by letters of user
		$userUserRecord = $pdo->query("SELECT user_id, fname, lname
		 	FROM normalusertable 
		 	WHERE fname like '%$searchTypedby%'");
		echo "<ul>";
		foreach ($userUserRecord as $pointUser) {
			//Display user name
			echo '<li><h3>'.$pointUser['lname'].', '.$pointUser['fname'].' has user id '.$pointUser['user_id'].'</h3></li>';
			echo '<h4 style="text-align:center;">Result:</h4>';
			//Display comment of searched user
			$userCommentRecord = $pdo->query('SELECT comment, commentPublishDate FROM commenttable 
		 	WHERE userId = '.$pointUser['user_id'].'');
		 	echo '<ul style="color:#F2F2F2;">';
			foreach ($userCommentRecord as $pointComment){
				echo '<li>'.$pointComment['comment'].'</li>';
			}
			echo "</ul>";
		}
		echo "</ul>";
	}
?>