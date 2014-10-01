<?php
	include('db.php');

	###insertar un  registro en la bd ###

	/*$nombre ="mariela";
	$pass = "marielita123";

	$sql = "INSERT INTO users (nombre, pass) VALUES (?, ?)";
	
	$data = array("ss","{$nombre}", "{$pass}");
	
	$insert_id = DBConnector::ejecutar($sql, $data);*/

	###Leer registros desde la bd mediante capa de abstraccion###
	$id = 6;

	$sql = "SELECT nombre, pass FROM  users WHERE id = ? ";

	$data = array("i", "{$id}");

	$fields = array("nombre" => "", "pass" => "");

	DBConnector::ejecutar($sql, $data, $fields);

	//print_r(DBConnector::$results);

	echo DBCOnnector::$results[0]['nombre'];
	echo DBConnector::$results[0]['pass'];
?>
