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
       
        <header>
            <div class="d-flex justify-content-center align-items-center container pt-lg-4 pb-4">
                <!--Formulario con las diferentes opciones-->
                <form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input class="btn btn-outline-dark btn-lg btn-block" type="submit" name="opcion" value="Lista de anuncios" /><br><br>
                    <input class="btn btn-outline-dark btn-lg btn-block" type="submit" name="opcion" value="Desconectar" /><br><br>
                    
                     <small id="passwordHelpInline" class="text-muted">Recuerde que como invitado solo puede ver los anuncios, para añadir su experiencia de otros inquilinos </br>
                         registrese en nuestra página.</small>
                    <input class="btn btn-outline-info btn-lg btn-block" type="submit" name="opcion" value="Volver a inicio para registrarse" /><br><br>

                    <?php
                    //Depende de la opción que se seleccione se realiza alguna de las siguientes acciones
                    if (isset($_REQUEST['opcion'])) {
                        $opcion = $_REQUEST['opcion'];
                        if ($opcion == "Lista de anuncios") {
                            header("Location:escaparate.php");
                        } elseif ($opcion == "Desconectar") {
                            header("Location:desconectar.php");
                        } elseif ($opcion == "Volver a inicio para registrarse") {
                            header("Location:desconectar.php");
                        }
                    }
                    ?>
                </form>

            </div>
        </header>

    </body>
</html>
