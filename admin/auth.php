<?php
session_start();
include_once "../backend/params.php";
include_once "../backend/consultas.php";
error_reporting(0);
if ($_SERVER['HTTP_REFERER']) {

	if (isset($_POST['usuario']) && isset($_POST['password'])) {
		echo 'usuario';
		$db = new Consultas();
		$usuarios = $db->getUsuarios();
		$auth = false;
		foreach ($usuarios as $u) {
			if ($u['usuario'] === $_POST['usuario']) {
				$auth = true;
			}
		}
		if ($auth) {
			$_SESSION['usuario'] = 1;
			header("Location: upload.php");
			die();
		}
		else {
			unset($_SESSION['usuario']);
			header("Location: index.php");
			die();
		}
	}
}
