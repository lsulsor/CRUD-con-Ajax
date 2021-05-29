<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Okupa2</title>
        <!--Incluimos el enlade de Bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!--Incluimos el enlade de jquery-->
        <script src="include/jquery-3.4.1.min.js"></script>
        <!--Incluimos el archivo funciones.js-->
        <script src="include/funciones.js"></script>
    </head>
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Empresa Okupa2</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            </div>
        </nav>
        <?php
        //Se inicia la sesión
        session_start();
        //Si  NO se ha almacenado algo en la vairable superglobal session usuarios
        if (!isset($_SESSION["usuario"])) {
            //lo redirigimos al index.php
            header("Location:index.php");
        }

        //Mostramos el nombre de usuario y la fecha de conexión
        echo "<p>Hola " . $_SESSION["usuario"] . ", se ha conectado a las " . date("H:i", $_SESSION['hora']) . "</p>";
        ?>

        <div class="col-md-3">
            <div class="card-body">
                <!--Formualario para desbloquear-->
                <form id="task-desbloquear">

                    <div class="form-group">
                        <input type="text" id="log" placeholder="Login a desbloquear" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-danger btn-block text-center" id="desbloquear">
                        Desbloquear 
                    </button>
                </form>

            </div>
        </div>
        <div id="info_des"></div>
        <!--Login bloqueados-->
        <table id="most_des" class="table table table-striped table-dark table-sm col-md-5 table-borderless table-hover">

            <thead>
                <tr>
                    <td>Login</td>
                    <td>Email</td>
                </tr>
            </thead>
            <tbody id="task-bloqueados"></tbody>
        </table>

    </body>
</html>