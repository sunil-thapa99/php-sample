<!-- 
	UN id: 17421492
 -->
 <?php 
	require '../connectToDatabase.php';
	require 'adminLayout.php';
	require 'generateTableToDisplay.php';
	require 'checkauthority.php';
	//Generate table
	$table = new GenerateTableToDisplay();
	//Setting title to table
	$table->setTableSubTitle(['Category Id', 'Category Title', 'Number of News']);
	//Querying category from database
	$queryCategory = $pdo->query("SELECT cate_id, category_title, COUNT(category_id) FROM categories LEFT JOIN news ON (cate_id = category_id) GROUP BY cate_id");
	//Fetching query
	while($getRow = $queryCategory->fetch(PDO::FETCH_ASSOC)) {
        $table->setTableRows($getRow);
	}
	//Generate HTML
	echo $table->getRequiredHTML();
?>

<script type="text/javascript" src="../js/addEditDel.js"></script>
<!-- Display form on click -->
<button onclick="addFormOpen()">Add</button>
<button onclick="editFormOpen()">Edit</button>
<button onclick="deleteFormOpen()">Delete</button>
<form method="POST" action="" id="addform">
	<label>Category Title: </label>
	<input type="text" name="categoryName">
	<input type="submit" name="addCategory" value="Ok">
</form>
<!-- Selection form -->
<form method="POST" action="" id="selectEditform">
	<label>Select Category: </label>
	<select name="category_id">
		<?php 
		//Display all category from database
			$displayQuery = $pdo->query("SELECT * FROM categories");
			while($getCategory = $displayQuery->fetch()){
				echo '<option value="'.$getCategory['cate_id'].'">'.$getCategory['cate_id'].'</option>';
			}
		?>
	</select>
	<br><label>New Category Name: </label>
	<input type="text" name="newCategoryName"><br>
	<input type="submit" name="editCategory" value="Ok">
</form>
<!-- Delete Form -->
<form method="POST" action="" id="selectdeleteform">
	<label>Select Category Name: </label>
	<select name="category_id">
		<?php 
			$displayQuery = $pdo->query("SELECT * FROM categories");
			while($getCategory = $displayQuery->fetch()){
				echo '<option value="'.$getCategory['cate_id'].'">'.$getCategory['category_title'].'</option>';
			}
		?>
	</select>
	<input type="submit" name="deleteCategory" value="Delete">
</form>
<?php 
	if(isset($_POST['addCategory'])){
		unset($_POST['addCategory']);
		//Insert into category table
		$insertQuery = $pdo->prepare("INSERT INTO categories(category_title)
				VALUES(:categoryName)");
		$insertReturn = $insertQuery->execute($_POST);
		if($insertReturn){
			echo '<script type="text/javascript">alert("Insert Successfully")</script>';
		}
		else{
			echo '<script type="text/javascript">alert("Unsuccessfully")</script>';
		}
		//Refresh current page
		header("Refresh:0");
	}
	if(isset($_POST['editCategory'])){
		unset($_POST['editCategory']);
		//Updating category name
		$updateQuery = $pdo->prepare('UPDATE categories
				SET category_title = :newCategoryName 
				WHERE cate_id = :category_id');
		$setTitle = $updateQuery->execute($_POST);
		if($setTitle){
			echo '<script type="text/javascript">alert("Update Successfully")</script>';
		}else{
			echo '<script type="text/javascript">alert("Unsuccessfully")</script>';
		}
		header("Refresh:0");
	}
	if(isset($_POST['deleteCategory'])){
		unset($_POST['deleteCategory']);
		//Removing category from database
		$getDetail = $pdo->prepare("DELETE FROM categories WHERE cate_id = :category_id");
		$executeDelete = $getDetail->execute($_POST);
		if($executeDelete){
			echo '<script type="text/javascript">alert("Delete Successful")</script>';
		}
		else{
			echo '<script type="text/javascript">alert("Delete Unsuccessful")</script>';
		}
		header("Refresh:0");
	}
?>