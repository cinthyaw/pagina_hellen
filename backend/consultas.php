<?php


if (!function_exists('mysql_fetch_all'))
{
	function mysqli_fetch_all($result, $mode) {

		$list = [];
		while($item = mysqli_fetch_array($result)) {
			array_push($list, $item);
		}

		return $list;

	}
}

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

			$query = "SELECT p.*, c.descripcion AS categoria
					  FROM productos AS p
					  JOIN categorias AS c
					  ON p.categoria_id = c.id
					  LIMIT $from, ".($pageSize);

			$result = mysqli_query($this->link, $query);

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

			$query = "SELECT p.*, c.descripcion AS categoria
					  FROM productos AS p
					  JOIN categorias AS c
					  ON p.categoria_id = c.id
					  WHERE p.categoria_id = $catId
					  LIMIT $from, ".($pageSize);

			$result = mysqli_query($this->link, $query);

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

			$query = "SELECT p.*, c.descripcion AS categoria
					  FROM productos AS p
					  JOIN categorias AS c
					  ON p.categoria_id = c.id
					  WHERE p.id = $id";
			$result = mysqli_query($this->link, $query);

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

	public function getDetallesProducto($prodId) {

		if (is_numeric($prodId)) {

			$query = "SELECT * FROM productos_detalles WHERE producto_id = $prodId";

			$result = mysqli_query($this->link, $query);

			return mysqli_fetch_all($result, MYSQLI_ASSOC);

		}

		return null;
	}

	public function getUsuarios() {

		$query = "SELECT * FROM usuarios";

		$result = mysqli_query($this->link, $query);

		return mysqli_fetch_all($result, MYSQLI_ASSOC);

	}

	public function getAllProductosYCategoria() {

		$query = "SELECT p.*, c.descripcion AS categoria, not isnull(d.id_producto) as checked
				  FROM productos AS p
				  JOIN categorias as c
				  ON p.categoria_id = c.id
				  LEFT JOIN destacados as d
				  ON d.id_producto = p.id";

		$result = mysqli_query($this->link, $query);

		return mysqli_fetch_all($result, MYSQLI_ASSOC);

	}

	public function getProductosDestacados() {

		$query = "SELECT p.*, c.descripcion AS categoria, not isnull(d.id_producto) as checked
				  FROM productos AS p
				  JOIN categorias as c
				  ON p.categoria_id = c.id
				  JOIN destacados as d
				  ON d.id_producto = p.id";

		$result = mysqli_query($this->link, $query);

		return mysqli_fetch_all($result, MYSQLI_ASSOC);

	}

	public function insertCategoria($descripcion) {

		$query = "SELECT COUNT(*) AS total FROM categorias WHERE descripcion='$descripcion'";

		$result = mysqli_query($this->link, $query);
		
		$qty = mysqli_fetch_assoc($result);

		if ($qty['total'] == 0) {
			$insertQuery = "INSERT INTO categorias(descripcion) VALUES('$descripcion')";
			mysqli_query($this->link, $insertQuery);
		}

	}

	public function deleteProductos() {
		$query = "TRUNCATE TABLE productos";
		mysqli_query($this->link, $query);

		$query = "TRUNCATE TABLE destacados";
		mysqli_query($this->link, $query);
	}

	public function insertProducto($nombre, $descripcion, $categoria, $imagen) {

		$query = "SELECT * FROM categorias WHERE descripcion='$categoria'";

		$result = mysqli_query($this->link, $query);

		$categoriaSeleccionada = mysqli_fetch_assoc($result);

		$categoriaId = $categoriaSeleccionada['id'];

		if ($categoriaId) {

			$queryProducto = "INSERT INTO productos(categoria_id, nombre, descripcion, imagen)
						  	  VALUES ($categoriaId, '$nombre', '$descripcion', '$imagen')";
			mysqli_query($this->link, $queryProducto);
		}
	}

	public function guardarDestacados($lista) {
		$query = "TRUNCATE TABLE destacados";
		mysqli_query($this->link, $query);
		foreach ($lista as $item) {
			$query = "INSERT INTO destacados(id_producto) VALUES($item)";
			mysqli_query($this->link, $query);
		}
		

	}

	function __destruct() {
		mysqli_close($this->link);
	}

}

