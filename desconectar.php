<?php

//Para cerrar la sesion primero reanudamos la sesion
session_start();
//Finalizamos la conexión
session_destroy();
//Redirigimos al index.php
header("Location:index.php");




