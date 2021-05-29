<?php

//Incluimos el archivo de  conexión
include('claseDB.php');
//Almacenamos los valores
$login = trim($_POST["login"]);
$conUsu = trim($_POST["conUsu"]);
$conUsu2 = trim($_POST["conUsu2"]);
$email_r = trim($_POST["email_r"]);
//Si hay algun campo vacio
if (empty($login) || empty($conUsu || empty($conUsu2) || empty($email_r))) {
    echo "vacio";
   
} else {

    //Se compueba el campo del email
    if (!filter_var($email_r, FILTER_VALIDATE_EMAIL)) {
        echo "email";
    } else {
        //Si las constraseñas son iguales y no estan los campos vacios
        if ($conUsu == $conUsu2  and !empty($conUsu) and !empty($conUsu2)) {
            echo DB::insertar_registro($login, $conUsu, $email_r);
  
        } else {

            echo "dif";
        }
    }
}




