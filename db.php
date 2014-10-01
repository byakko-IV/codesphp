<?php
class DBConnector {
	protected static $conn; #obeto conector mysqli
	protected static $stmt; #preparaacion de consulta SQL
	protected static $reflection; #Objeto reflexivo de mysqli_stmt
	protected static $sql; #Sentencia SQL a ser preeparada
	protected static $data; #Array que contiene los datos a ser enlazados (parametro)
	public static $results; #coleccionde datos devueltos por una consulta de seleccion

	protected static function conectar() {
		self::$conn = new mysqli('localhost', 'root', '@4k475uk1', 'testing');
	}
	protected static function preparar() {
		self::$stmt = self::$conn->prepare(self::$sql);
		self::$reflection = new ReflectionClass('mysqli_stmt');
	}
	protected static function set_params() {
		$method = self::$reflection->getMethod('bind_param');
		$method->invokeArgs(self::$stmt, self::$data);
	}
	protected static function get_data($fields) {
		$method = self::$reflection->getMethod('bind_result');
		$method->invokeArgs(self::$stmt, $fields);
		while(self::$stmt->fetch()) {
			self::$results[] = unserialize(serialize($fields));
		}
	}	
	protected static function finalizar() {
		self::$stmt->close();
		self::$conn->close();
	}
	public static function ejecutar($sql, $data, $fields=False) {
		self::$sql = $sql;
		self::$data = $data;
		self::conectar();
		self::preparar();
		self::set_params();
		self::$stmt->execute();
		if($fields){
			self::get_data($fields);
		}else{
			if(strpos(self::$sql, strtoupper('INSERT')) === 0){
				return self::$stmt->insert_id;
			}
		}
		self::finalizar();
	}
}

?>