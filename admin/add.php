<?php
session_start();
include_once "../backend/params.php";
include_once "../backend/consultas.php";
if (!isset($_SESSION['usuario'])) {
	header("Location: index.php");
	die();
}

if (isset($_FILES['csv'])) {
	$db = new Consultas();
	if (($handle = fopen($_FILES['csv']['tmp_name'], "r")) !== FALSE) {
		$i = 0;
		while ($data = fgetcsv($handle, 0, ",")) {
			if ($data[2] != '' && $i > 0) {
				$db->insertCategoria($data[2]);
			}
			$i++;
		}
		
		
	}
	if (($handle = fopen($_FILES['csv']['tmp_name'], "r")) !== FALSE) {
		$db->deleteProductos();
		$i = 0;
		while ($data = fgetcsv($handle, 0, ",")) {
			
			if ($data[0] != '' && $data[2] != '' && $i > 0) {
				//print_r($data);
				$db->insertProducto($data[0], $data[1], $data[2], $data[3]);
			}
			$i++;
		}
	}
}

