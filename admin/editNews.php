<!-- 
	UN id: 17421492
 -->
 <?php 
	require '../connectToDatabase.php';
	require 'adminLayout.php';
	require 'checkauthority.php';
	if(isset($_GET['newsid'])){
		//Display all news
		$getId = $pdo->prepare("SELECT * FROM news WHERE news_id = :newsid");
		$getId->execute($_GET);
		$getDetail = $getId->fetch();
	}
	if(isset($_POST['editChangeData'])){
		//Update news table
		$getId = $pdo->prepare("UPDATE news SET 
								newsTitle = :newsTitle,
								articleAuthor = :articleAuthor,
								articleContent = :articleContent
							WHERE
								news_id = :news_id");
		unset($_POST['editChangeData']);
		$setDetail = $getId->execute($_POST);
		if($setDetail){
			header('location:news.php?notice=Update Successful&catId='.
				$_GET['newsid'].'');
		}
		else{
			echo '<script type="text/javascript">alert("Unsuccessfully")</script>';
		}
	}
?>
<!--Update form with inserted fields-->
<h3>Edit User Profile:</h3>
<form method="POST" action="">
	<input type="hidden" name="news_id" value="<?php echo $_GET['newsid'];?>"><br><br>
	<label>Article Title: </label>
	<input type="text" name="newsTitle" value="<?php if (isset($getDetail['newsTitle'])) echo $getDetail['newsTitle']?>"><br><br>
	<label>Article Author: </label>
	<input type="text" name="articleAuthor" value="<?php if (isset($getDetail['articleAuthor'])) echo $getDetail['articleAuthor']?>"><br><br>
	<label>Article Content: </label><br>
	<textarea name="articleContent" rows="10" cols="76">
		<?php if (isset($getDetail['articleContent'])) echo $getDetail['articleContent']?>
	</textarea><br><br>
	<input type="submit" name="editChangeData" value="Edit">
</form>
<?php  
	require 'uploadImage.php';
?>