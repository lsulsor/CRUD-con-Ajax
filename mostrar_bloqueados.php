<?php
//Incluimos el archivo de  conexión
include('claseDB.php');
//Llamamos al método
echo json_encode(DB::obtener_bloqueados());
