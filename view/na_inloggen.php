<!DOCTYPE html>
<html lang="nl">
	<head>
		<title>Homepage Online Tutorials / na het inloggen</title>
		<meta charset="utf-8">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/vormgeving.css">
	</head>
	<body>
		<div class="container">
			<h1>Syntra Online Tutorials</h1>
			<nav class="main-nav">
				<ul class="cf">
					<li><a href="#">Home</a></li>
					<li><a href="#">Tutorials</a><!-- Opgelet!!! -->
						<ul>
							<li><a href="#">Photoshop</a></li>
							<li><a href="#">Illustrator</a></li>
							<li><a href="#">Web Design</a><!-- Opgelet!!! -->
								<ul>
									<li><a href="#">HTML</a></li>
									<li><a href="#">CSS</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><a href="#">Blogartikelen</a><!-- Opgelet!!! -->
						<ul>
							<li><a href="#">Web Design</a></li>
							<li><a href="#">User Experience</a></li>
						</ul>
					</li>
					<li><a href="#">Contacteer ons</a></li>
					<li id="login"><a href="./index.php?action=logout">Uitloggen</a></li>
				</ul>
			</nav>
			<section>
				<?php
					if($_SESSION['bezitter_gegevens_ingelogd'] === true) {
						$user = json_decode($_SESSION['userinfo']);
					    echo '<h1>Welkom!!!</h1>';
					    echo '<h2>Uw naam: ' . $user->name . '</h2>';
					    echo '<h2>Uw Facebook ID: ' . $user->id . '</h2>';
					}
				?>
			</section>
		</div>
		<footer>
			<div class="container">
				<p>Backend II Opdracht 1: Login via Facebook</p>
			</div>
		</footer>
	</body>
</html>