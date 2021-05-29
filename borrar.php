<?php

//Incluimos el archivo de  conexión
include('claseDB.php');
//Almacenamos los valores
$id = trim($_POST['id']);
$autor = trim($_POST['autor']);
//Llamamos al método
echo DB::borrar_anuncio($id, $autor);

