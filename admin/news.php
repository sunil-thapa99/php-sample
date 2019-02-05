<!-- 
	UN id: 17421492
 -->
 <?php 
	require '../connectToDatabase.php';
	require 'adminLayout.php';
	require 'checkauthority.php';
	require 'generateTableToDisplay.php';
	//Verify admin or normal user
	if(!isset($_SESSION['verifiedUserType'])){
		header('location:../login.php');
	}
	if(isset($_GET['notice'])){
		echo '<script type="text/javascript">alert("'.$_GET['notice'].'")</script>';
	}
	?>
<nav  id="topNav">
	<ul>
		<?php 
		//Send category id on clikcing category title
			$getAllCategory = $pdo->query("SELECT cate_id, category_title FROM categories");
			while($getRow = $getAllCategory->fetch(PDO::FETCH_ASSOC)){
				echo '<li><a  href="news.php?catId='.$getRow['cate_id'].'">'.$getRow['category_title'].'</a></li>';
			}
		?>
	</ul>
</nav>
	<?php
	//Generate table
	$table = new GenerateTableToDisplay();
	//Set title to the table column
	$table->setTableSubTitle(['News Id', 'News Title', 'News Author', 'News Content', 'Post Date']);
	//Display all news where category id = url value 
	$queryCategory = $pdo->query('SELECT news_id, newsTitle, articleAuthor, articleContent, articlePostDate FROM news
		WHERE category_id = '.$_GET['catId'].' ORDER BY articlePostDate DESC');
	while($getRow = $queryCategory->fetch(PDO::FETCH_ASSOC)) {
        $table->setTableRows($getRow);
	}
	//Generate table
	echo $table->getRequiredHTML();
?>

<script type="text/javascript" src="../js/addEditDel.js"></script>
<!-- Display form on click -->
<button onclick="addFormOpen()">Add</button>
<button onclick="editFormOpen()">Edit</button>
<button onclick="editFormOpen()">Delete</button>
<!-- Add form -->
<form method="POST" action="" id="addform">
	<label>Article Title: </label>
	<input type="text" name="newsTitle" required><br><br>
	<label>Article Author</label>
	<input type="text" name="articleAuthor" required><br><br>
	<label>Article Content</label><br>
	<textarea name="articleContent" rows="10" cols="76" required></textarea><br><br>
	<label>Category: </label>
	<select name="category_id">
		<?php 
		//Display all from category as drop down
			$displayQuery = $pdo->query("SELECT * FROM categories");
			while($getCategory = $displayQuery->fetch()){
				echo '<option value="'.$getCategory['cate_id'].'">'.$getCategory['category_title'].'</option>';
			}
		?>
	</select><br><br>
	<input type="submit" name="addNews" value="OK" ">
</form>
<!-- Edit form display -->
<form method="POST" action="" id="selectEditform">
	<label>Select News field</label>
	<select name="selectNewsName">
		<option value="news_id">News Id</option>
		<option value="newsTitle">Title  of Article</option>
		<option value="articleAuthor">Article Author Name</option>
		<option value="articlePostDate">Article Post Date</option>
	</select>
	<input type="text" name="searchTyped">
	<input type="submit" name="editNews" value="Search News">
</form>

<?php 
	if(isset($_POST['addNews'])){
		unset($_POST['addNews']);
		//System date
		$getSystemDate = date('Y-m-d H:i:s');
		//Insert news from database
		$insertQuery = $pdo->prepare("INSERT INTO news(newsTitle, articleAuthor, articleContent, articlePostDate, category_id)
			VALUES (:newsTitle, :articleAuthor, :articleContent, '$getSystemDate', :category_id)");
		$insertReturn = $insertQuery->execute($_POST);
		if($insertReturn){
			echo '<script type="text/javascript">alert("Insert Successfully")</script>';
		}
		else{
			echo '<script type="text/javascript">alert("Unsuccessfully")</script>';
		}
		echo '<script type="text/javascript">alert("Refersh Page to see the change!!")</script>';
	}
	if(isset($_POST['editNews'])){
		$newsHint = $_POST['selectNewsName'];
		$searchTyped = $_POST['searchTyped'];
		//Search news from database from selected drop down 
		$newsRecord = $pdo->query("SELECT news_id, newsTitle, articleAuthor, articleContent, articlePostDate, category_id FROM news WHERE $newsHint like '%$searchTyped%'");
		echo "<ul>";
		foreach ($newsRecord as $point) {
			//Display queried value with edit and delete option
			echo '<li>'.$point['articleAuthor'].', has wrote "'.$point['newsTitle'].'"<br><a href="editNews.php?newsid='.$point['news_id'].'" style="color: #eee; text-decoration: underline;">Edit</a><br><a href="news.php?newsid='.$point['news_id'].'&catId='.$point['category_id'].'" style="color: #eee; text-decoration: underline;">Delete</a></li>';
		}
		echo "</ul>";
	}
	if(isset($_GET['newsid'])){
		unset($_GET['catId']);
		//Delete news of selected news id
		$getDetail = $pdo->prepare("DELETE FROM news 
			WHERE news_id = :newsid");
		$executeDelete = $getDetail->execute($_GET);
		if($executeDelete){
			echo '<script type="text/javascript">alert("Delete Successful")</script>';
		}
		else{
			echo '<script type="text/javascript">alert("Delete Unsuccessful")</script>';
		}
	}
?>