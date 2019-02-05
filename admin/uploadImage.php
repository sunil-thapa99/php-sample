<!-- 
	UN id: 17421492
 -->
 <!-- File upload input type -->
<form method="POST" action="" enctype="multipart/form-data">
	<label>Select Image To Upload</label>
	<input type="file" name="uploadImageToDatabase">
	<input type="submit" name="imageSubmit" value="Upload">
</form>
<?php
	if(isset($_POST["imageSubmit"])) {
		unset($_POST['imageSubmit']);
		//File path 
		$imageUploadDirectory = "../images/newsImage/";
		$imageNewsId = $_GET['newsid'];
		//Concatenate image name with directory
		$fileTargetName = $imageUploadDirectory . basename($_FILES["uploadImageToDatabase"]["name"]);
		$imageQueryDirectory = "images/newsImage/".basename($_FILES["uploadImageToDatabase"]["name"]);
		//Copy into newImage folder 
	    copy(($_FILES["uploadImageToDatabase"]["tmp_name"]), $fileTargetName);
	    //Insert file name into database
	    $imageQuery = $pdo->prepare("INSERT INTO imagedatabase(imageFilePath, newsId) VALUES ('$imageQueryDirectory', '$imageNewsId')");
	 	$insert = $imageQuery->execute($_POST);
	}
?>