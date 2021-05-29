<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <?php
        //Se inicia la sesión
        session_start();
        ?>
        <title>Okupa2</title>
         <!--Incluimos el enlade de Bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Empresa Okupa2</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            </div>
        </nav>
        <?php
        //Si  NO se ha almacenado algo en la vairable superglobal session usuarios
        if (!isset($_SESSION["usuario"])) {
            //lo redirigimos al index.php
            header("Location:index.php");
        }
        ?>
       
        <?php
        //Mostramos el nombre de usuario y la fecha de conexión
        echo "<p>Hola " . $_SESSION["usuario"] . ", se ha conectado a las " . date("H:i", $_SESSION['hora']) . "<br><br></p>";
        if ($_SESSION["usuario"] != "Invitado") {
            include "menu.php";
        } else {

            include "menu_invitado.php";
        }
        ?>
       
    </body>
</html>
