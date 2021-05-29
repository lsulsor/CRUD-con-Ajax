<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Okupa2</title>
    </head>
    <body>
        <?php
        //Recogemos el dato el campo
        $invitado = htmlentities(addslashes($_POST["invitado"]));
        //Iniciamos la sesión
        session_start();
        //Se almacena en la variable superglobal SESSION los datos de login
        //Dentro del corchete de session el nombre con el que queramos identificar
        $_SESSION["usuario"] = $_POST["invitado"];
        $_SESSION['hora'] = time();
        header("location:usuario.php");
        if (!isset($_SESSION["usuario"])) {
            //lo redirigimos al index.php
            header("Location:index.php");
        }
        ?>
    </body>
</html>
