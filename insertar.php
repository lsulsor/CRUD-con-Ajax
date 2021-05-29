<?php
//Incluimos el archivo de  conexión
include('claseDB.php');
//Almacenamos los valores
$autor = trim($_POST["autor"]);
$moroso = trim($_POST["moroso"]);
$localidad = trim($_POST["localidad"]);
$descripcion = trim($_POST["descripcion"]);
$fecha = trim($_POST["fecha"]);

//Llamamos al método
echo DB::insertar($autor, $moroso, $localidad, $descripcion, $fecha);