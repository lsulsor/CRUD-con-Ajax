<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Okupa2</title>
        <!--Incluimos el enlade de Bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Okupa2</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            </div>
        </nav>

        <div class="d-flex justify-content-center align-items-center container pt-lg-5 pb-5 ">
            <div class="col-lg-4 col-lg-offset-4">
                 <!--Formuario de loguin-->
                <form  class="col-md-20" action="comprueba_login.php" method="POST">
                    <TABLE class="table table-light table-hover">
                        <tr><td class="text-secondary"><svg class="bi bi-person" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM8 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg> Login</td><td><input class="border border-secondary rounded form-control form-control-sm" type="text" name="login" id="login" required autofocus></td></tr>
                                <tr><td class="text-secondary"><svg class="bi bi-lock" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 00-1 1v5a1 1 0 001 1h7a1 1 0 001-1V9a1 1 0 00-1-1zm-7-1a2 2 0 00-2 2v5a2 2 0 002 2h7a2 2 0 002-2V9a2 2 0 00-2-2h-7zm0-3a3.5 3.5 0 117 0v3h-1V4a2.5 2.5 0 00-5 0v3h-1V4z" clip-rule="evenodd"/>
                                </svg> Contraseña</td><td><input class="border border-secondary rounded form-control form-control-sm" type="password" name="password" id="password" requ nameired></td></tr>
                        <small id="passwordHelpInline" class="text-muted">
                            Escribe tu usuario y contraseña para acceder
                        </small>
                    </TABLE>
                    <input  class="btn btn-dark d-flex justify-content-center align-items-center container" type="submit" name="enviar" value="Enviar">
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center container pt-lg-4 pb-4">
            <form action="invitado.php" method="POST">
                <TABLE>
                    <tr><td><input type="hidden" name="invitado" value="Invitado"></td></tr>
                    <tr><td><input class="btn btn-dark" type="submit" name="enviarInvitado" value="Acceder como invitado"></td></tr>
                </TABLE>
            </form> 
        </div>

        <div class="d-flex justify-content-center align-items-center container pt-lg-1 pb-3 ">
            <a href="registro.php"><button class="btn btn-dark"><svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                    </svg> Registrarse</button></a>
        </div>
        <?php
        include('claseDB.php');
        DB::conectar();
        ?>
    </body>
</html>
