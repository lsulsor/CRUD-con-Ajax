<?php
//Incluimos el archivo de  conexión
include('claseDB.php');
//Almacenamos el valor
$cod = trim($_POST['cod']);
//Llamamos al método
echo json_encode(DB::mostrar_borrar($cod));

