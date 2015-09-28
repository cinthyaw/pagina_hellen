<?php

class Consultas {

	private $link;

	function __construct() {
		$this->link = mysqli_connect(HOST, USER, PASS, DB);
		if (!$this->link) {
			die('DB Error');
		}
	}



	public function getCategorias() {

		$result = mysqli_query($this->link, "SELECT * FROM categorias");

		return mysqli_fetch_all($result, MYSQLI_ASSOC);

	}

	public function getAllProductos() {

		$result = mysqli_query($this->link, "SELECT * FROM productos");

		return mysqli_fetch_all($result, MYSQLI_ASSOC);

	}

	public function getProductos($from, $pageSize) {

		if (is_numeric($from)) {

			$result = mysqli_query($this->link, "SELECT * FROM productos LIMIT $from, ".($pageSize));

			return mysqli_fetch_all($result, MYSQLI_ASSOC);

		}

		return null;

	}

	public function getProductosCount() {


		$result = mysqli_query($this->link, "SELECT * FROM productos");

		return mysqli_num_rows($result);


		return 0;

	}

	public function getProductosByCategoria($catId, $from, $pageSize) {

		

		if (is_numeric($from) && is_numeric($catId)) {

			$result = mysqli_query($this->link, "SELECT * FROM productos WHERE categoria_id = $catId LIMIT $from, ".($pageSize));

			return mysqli_fetch_all($result, MYSQLI_ASSOC);

		}

		return null;

	}

	public function getProductosByCategoriaCount($catId) {

		

		if (is_numeric($catId)) {

			$result = mysqli_query($this->link, "SELECT * FROM productos WHERE categoria_id = $catId");

			return mysqli_num_rows($result);

		}

		return 0;

	}

	public function getProductoById($id) {

		if (is_numeric($id)) {
			$result = mysqli_query($this->link, "SELECT * FROM productos WHERE id = $id");

			return mysqli_fetch_assoc($result);
		}
		else {
			return null;
		}

	}

	public function getCategoriaById($id) {

		if (is_numeric($id)) {
			$result = mysqli_query($this->link, "SELECT * FROM categorias WHERE id = $id");

			return mysqli_fetch_assoc($result);
		}
		else {
			return null;
		}

	}

	function __destruct() {
		mysqli_close($this->link);
	}

}

