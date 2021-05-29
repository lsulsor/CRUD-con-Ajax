<?php

//Incluimos el archivo de  conexión
include('claseDB.php');
//Almacenamos el valor
$log = trim($_POST['log']);
//Llamamos al método
echo DB::desbloquear($log);

