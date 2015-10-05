<?php
session_start();
if (isset($_SESSION['usuario'])) {
	header("Location: upload.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<form class="form-signin" action="auth.php" method="post">
					<h2 class="form-signin-heading">Login</h2>
					<label for="usuario" class="sr-only">Usuario</label>
					<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required autofocus>
					<br>
					<label for="password" class="sr-only">Password</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesi&oacute;n</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>