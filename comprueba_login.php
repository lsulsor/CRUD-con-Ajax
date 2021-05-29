<?php
//Incluimos el archivo de  conexión
include('claseDB.php');
DB::conectar();
$contador = 0;
//Almacenamos las variables
$login = htmlentities(addslashes($_POST["login"]));
$password = htmlentities(addslashes($_POST["password"]));
$correctoLog = 'dwes';
$correctoPass = 'abc123.';
//Si los datos estan vacios se vuelve a mostrar el formulario
if (empty($login) OR empty($password)) {
    header('Location: index.php');
}
//Si coincide el login y la contraseña del administrador
if (strcmp($login, $correctoLog) === 0 and strcmp($password, $correctoPass) === 0) {
    //Iniciamos la sesion
    session_start();
    $_SESSION["usuario"] = $_POST["login"];
    $_SESSION['hora'] = time();
    //Redirigimos a la siguiente página
    header('Location: admin.php');
} else {

    //En caso contrario primero comprobamos que el login este bloqueado
    if (isset($_COOKIE["bloq" . $login])) {

        echo "<p>Su usuario, " . $login . " esta bloqueado. </p>";
        ?>

        <a href="index.php"><button>Volver a inicio</button></a>
        <?php
        //En el caso que el login no este bloqueado, compruebo que este en la base de datos
    } else {

//Almaceno la consulta preaparada con marcadores

        $sql = "SELECT * FROM anunciantes WHERE login= :login";

        $consulta = DB::conectar()->prepare($sql);

        $consulta->execute(array(":login" => $login));
//Recorro el array e incremento contador si existe un resultado coincidente
        while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
            //Como esta encriptado para saber si esta en la base de datos utilizo la funcion password_verify
            if ($login == $registro['login'] and password_verify($password, $registro['password'])) {
                //Si son iguales quiero que me incremente la variable contador
                $contador++;
            }
        }
        //Si existe alguna coincidencia
        if ($contador > 0) {

            try {
                //Borro la cookie
                setcookie("bloq" . $login, "Bloqueado", time() - 1);
                //Actualizo el campor bloqueado a cero
                $sql = "UPDATE anunciantes SET bloqueado=0 WHERE login=:miLog";
                $consulta = DB::conectar()->prepare($sql);
                $consulta->execute(array(":miLog" => $login));
                $consulta->execute();
            } catch (PDOException $e) {
                echo "<div><p>Se ha producido el siguiente error: " . $e->getMessage() . "</p></div>";
            }

            //Si el usuario se encuentra en la base de datos abre una sesion
            session_start();
            //Se almacena en la variable superglobal SESSION los datos de login
            //Dentro del corchete de session el nombre con el que queramos identificar
            $_SESSION["usuario"] = $_POST["login"];
            $_SESSION['hora'] = time();
            //En el caso que el usuario exita en la base datos se redirige a la pagian de ususairos registrados
            header("location:usuario.php");
        } else {
            //En caso contrario, incremento el campo bloqueado y si es el terer intento creo una coockie que bloquee
            //la entrada del usuario a la zona restringida
            $num = "SELECT * FROM anunciantes WHERE login= :login";
            $resultadoNum = DB::conectar()->prepare($num);
            $resultadoNum->execute(array(":login" => $login));
            while ($registroNum = $resultadoNum->fetch(PDO::FETCH_ASSOC)) {
                if ($registroNum["bloqueado"] >= 2) {

                    setcookie("bloq" . $login, "Bloqueado");
                    $bloq = $registroNum["bloqueado"] + 1;
                    $sqlBloq = "UPDATE anunciantes SET bloqueado=$bloq WHERE login=:miLog";
                    $resultadoBloq = DB::conectar()->prepare($sqlBloq);
                    $resultadoBloq->execute(array(":miLog" => $login));
                    header("location:index.php");
                } else {
                    $bloq = $registroNum["bloqueado"] + 1;
                    $sqlBloq = "UPDATE anunciantes SET bloqueado=$bloq WHERE login=:miLog";
                    $resultadoBloq = DB::conectar()->prepare($sqlBloq);
                    $resultadoBloq->execute(array(":miLog" => $login));
                    header("location:index.php");
                }
            }
            header("location:index.php");
        }
    }
}
