<!-- 
	UN id: 17421492
 -->
 <?php 
	$title = "Contact Us";
	session_start();
	//Display login/logout on navbar
	if(isset($_SESSION['verifiedUserType'])){
		$loginLogout = "Logout";
	}
	else{
		$loginLogout = "Login";
	}
	require('header.php');
 ?>
 <article>
 	<!-- Display Contact us form -->
 	<h2>Contact Us On:</h2>
	<p>You can contact us using this form: </p>		
	<form method="POST" action="">
		<label>Full Name:</label>
		<input type="text" name="name" placeholder="Enter Your Full Name" required><br>
		<label>Email:</label>
		<input type="email" name="email" placeholder="Enter Your Email" required><br>
		<label>Message:</label>
		<textarea name="msgContact" rows="7" cols="78"></textarea>
		<br>
		<input type="submit" name="send" value="Send">
	</form>
</article>
<?php 
	if(isset($_POST['send'])){
		//Send email on leaving contact message
		mail($_POST['email'], "Leaving a Comment", "Thanks for leaving your valuable comment", "From: info@northamptonNews.com");
		echo '<script type="text/javascript">alert("We will reach you via email!!!\nThanks for Contacting with us!!")</script>';
	}
 	require('indexFooter.php');
  ?>