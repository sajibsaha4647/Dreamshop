<?php ob_start();
require_once('../classes/AdminLogin.php');

?>

<?php

$al = new AdminLogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$result = $al->AdminLoign($_POST);
}

?>

<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
	<div class="container">
		<section id="content">
			<form action="" method="POST">
				<h1>Admin Login</h1>
				<?php
				if (isset($result)) {
					echo $result;
				}
				?>
				<div>
					<input type="text" placeholder="Username" required="" name="adminUser" />
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="adminPass" />
				</div>
				<div>
					<input name="submit" type="submit" value="Log in" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="#">Training with live project</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>

</html>