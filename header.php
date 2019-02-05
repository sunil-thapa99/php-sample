<!-- 
	UN id: 17421492
 -->
 <?php 
	require 'connectToDatabase.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css"/>
		<title><?php 
		//Set dynamical title
			echo $title;
		 ?></title>
	</head>
	<body>
		<!-- Share button developers code -->
		<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11';
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
			<form method="POST">
				<input type="text" name="searchNews" placeholder="Search">
				<button id="btnSearch" name="srch">Search</button>
			</form>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Select Category</a>
					<ul>
						<?php 
						//Display category dynamically
							$category = $pdo->query("SELECT * FROM categories");
							foreach ($category as $categoryValue) {
								echo '<li><a href="news.php?categ_id='.
								$categoryValue['cate_id'].'">'.$categoryValue['category_title'].
								'</a></li><br>';
							}
						 ?>
					</ul>
				</li>
				<li><a href="contact.php">Contact us</a></li>
				<li><a href="<?php 
				//Send current page url to login form to redirect
					$_SESSION['directedFrom'] = $_SERVER['REQUEST_URI'];
					echo "login.php";
				?>"><?php echo $loginLogout ?></a></li>
			</ul>
		</nav>
		<img src="images/banners/randombanner.php" alt="Image" >
		<main>
			
<?php 
	if (isset($_POST['srch'])) {
		//Reload to search php file
		header('location:search.php?srch='.$_POST['searchNews'].'');
	}
?>