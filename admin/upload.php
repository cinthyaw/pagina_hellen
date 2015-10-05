<?php
session_start();
include_once "../backend/params.php";
include_once "../backend/consultas.php";
if (!isset($_SESSION['usuario'])) {
	header("Location: index.php");
	die();
}
$db = new Consultas();
$productos = $db->getAllProductosYCategoria();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload</title>
	<link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
	<link href="styles.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row header">
			<div class="col-sm-4">
			<form method="post" enctype="multipart/form-data" action="add.php">
				<label>Seleccione el archivo:</label>
				<input type="file" name="csv"><br>
				<input type="submit" name="upload" value="Cargar">
			</form>
			</div>
			<div class="col-sm-8">
				<strong>Ejemplo de formato de archivo</strong>
				<table class="table table-bordered ejemplo">
					<tr><td>Nombre del producto</td>
					<td>Descripci&oacute;n del producto</td>
					<td>Categor&iacute;a</td>
					<td>Imagen</td></tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 table productos">
				<h2>Lista de productos</h2>
				<table class="table table-bordered">
					<tr>
						<th>Nombre</th>
						<th>Descripci&oacute;n</th>
						<th>Categor&iacute;a</th>
						<th>Imagen</th></tr>
					<?php
					foreach ($productos as $p) {
					?>
						<tr>
							<td><?=$p['nombre']?></td>
							<td><?=$p['descripcion']?></td>
							<td><?=$p['categoria']?></td>
							<td><img src="<?=IMAGE_BASE.'75/'.$p['imagen']?>" width="50"></td>
						</tr>
					<?php
					}
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>