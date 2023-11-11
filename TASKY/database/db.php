<?php
$server = 'localhost';
$db = 'id21502063_bdtasky';
$user = 'id21502063_juanjose';
$password = 'Juanjo123.';

try {
	$connection = new PDO("mysql:host=$server;dbname=$db", $user, $password);
	//echo 'Conexión establecida';
} catch (Exception $e) {
	echo 'Excepcion capturada: ', $e->getMessage();
}