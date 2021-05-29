<?php

//Incluimos el archivo de  conexión
include('claseDB.php');
//Almacenamos el valor
$usuario = trim($_POST['usuario']);
$id = trim($_POST['id']);
$autor = trim($_POST['autor']);
$moroso = trim($_POST['moroso']);
$localidad = trim($_POST['localidad']);
$descripcion = trim($_POST['descripcion']);
$fecha = trim($_POST['fecha']);

//Llamamos al método
echo DB::modificar_anuncio($usuario, $id, $autor, $moroso, $localidad, $descripcion, $fecha);

