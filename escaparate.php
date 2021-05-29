<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Okupa2</title>
        <!--Incluimos el enlade de mapa-->
        <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=' async defer></script> 
        <!--Incluimos el enlade de Bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!--Incluimos el enlade de jquery-->
        <script src="include/jquery-3.4.1.min.js"></script>
        <!--Incluimos el archivo funciones.js-->
        <script src="include/funciones.js"></script>
        <style>
            html, body{
                padding:0;
                margin:0;
                height:100%;

            }

            .directionsContainer{
                width:380px;
                height:100%;
                overflow-y:auto;
                float:left;
            }

            #myMap{
                position:relative;
                width:calc(100% - 380px);
                height:100%;
                float:left;
            }
        </style>
        <?php
        //Inicio la sesión
        session_start();
        ?>
    </head>
    <body>

        <?php
        //Si  NO se ha almacenado algo en la vairable superglobal session usuarios
        if (!isset($_SESSION["usuario"])) {
            //lo redirigimos al index.php
            header("Location:index.php");
        }
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Okupa2</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            </div>
        </nav>
        <?php
        //Mostramos el nombre de usuario y la fecha de conexión
        echo "<p>Hola " . $_SESSION["usuario"] . ", se ha conectado a las " . date("H:i", $_SESSION['hora']) . "<br><br></p>";
        //Dependiendo si es usuario registrado o invitado mostramos un menu u otro
        if ($_SESSION["usuario"] != "Invitado") {
            include "menu.php";
        } else {

            include "menu_invitado.php";
        }
        ?>
        <div class="col-md-15">
            <!--Insertar anuncio-->
            <div id="task-insertar">

                <div class="form-group">
                    <input type="hidden" id="usu" value="<?php echo $_SESSION["usuario"] ?>" placeholder="Código" class="form-control">
                </div>
                <button type="submit" class="btn btn-success btn-block text-center" id="insertar"><svg class="bi bi-file-earmark-arrow-up" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 1h5v1H4a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V6h1v7a2 2 0 01-2 2H4a2 2 0 01-2-2V3a2 2 0 012-2z"/>
                    <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 019 4.5z"/>
                    <path fill-rule="evenodd" d="M5.646 8.854a.5.5 0 00.708 0L8 7.207l1.646 1.647a.5.5 0 00.708-.708l-2-2a.5.5 0 00-.708 0l-2 2a.5.5 0 000 .708z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M8 12a.5.5 0 00.5-.5v-4a.5.5 0 00-1 0v4a.5.5 0 00.5.5z" clip-rule="evenodd"/>
                    </svg>
                    Insertar anuncio
                </button>
                <ul id="container"></ul>

            </div>
            <!--Auncios-->
            <table class="table table-sm table-striped table-light table-borderless">
                <thead>
                    <tr class="p-3 mb-2 bg-dark text-white">
                        <td >Id_anuncio</td>
                        <td>Autor</td>
                        <td>Moroso</td>
                        <td>Localidad</td>
                        <td>Descripcion</td>
                        <td>Fecha</td>
                        <td>Eliminar</td>
                        <td>Modificar</td>
                        <td>Mapa</td>
                    </tr>
                </thead>
                <tbody id="tasks"></tbody>
            </table>
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <!--Borrar-->
                <form id="task-borrar">
                    <div class="form-group">
                        <input type="text" id="autor_u" value="<?php echo $_SESSION["usuario"] ?>" placeholder="Código" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="id_b" placeholder="Código" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="autor_b" placeholder="Nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="moroso_b" placeholder="Descripción" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="localidad_b" placeholder="PVP" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="descripcion_b" placeholder="Familia" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="fecha_b" placeholder="Stock" class="form-control">
                    </div>


                    <button type="submit" class="btn btn-danger btn-block text-center" id="conf_borrar">
                        Eliminar este anuncio
                    </button>
                    <button type="submit" class="btn btn-info btn-block text-center" id="cerrar"><svg class="bi bi-x-square-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2zm9.854 4.854a.5.5 0 00-.708-.708L8 7.293 4.854 4.146a.5.5 0 10-.708.708L7.293 8l-3.147 3.146a.5.5 0 00.708.708L8 8.707l3.146 3.147a.5.5 0 00.708-.708L8.707 8l3.147-3.146z" clip-rule="evenodd"/>
                        </svg>
                        Cerrar 
                    </button>
                </form>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <!--Modificar-->
                <form id="task-modificar">

                    <div class="form-group">
                        <input type="hidden" id="usuario_m" value="<?php echo $_SESSION["usuario"] ?>" placeholder="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="id_m" placeholder="Id" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="autor_m" placeholder="Autor" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="moroso_m" placeholder="Moroso" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="localidad_m" placeholder="Localidad" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="descripcion_m" placeholder="Descripcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" id="fecha_m" placeholder="fecha" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-warning btn-block text-center" id="conf_modificar">
                        Modificar 
                    </button>
                    <button type="submit" class="btn btn-info btn-block text-center" id="cerrar"><svg class="bi bi-x-square-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2zm9.854 4.854a.5.5 0 00-.708-.708L8 7.293 4.854 4.146a.5.5 0 10-.708.708L7.293 8l-3.147 3.146a.5.5 0 00.708.708L8 8.707l3.146 3.147a.5.5 0 00.708-.708L8.707 8l3.147-3.146z" clip-rule="evenodd"/>
                        </svg>
                        Cerrar 
                    </button>
                </form>

            </div>
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <!--Insertar anucio-->
                <form id="task-ins">

                    <div class="form-group">
                        <input type="text" id="autor_i" value="<?php echo $_SESSION["usuario"] ?>" readonly class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="moroso_i" placeholder="Moroso" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="localidad_i" placeholder="Localidad" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="descripcion_i" placeholder="Descripcion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="date" id="fecha_i" placeholder="Fecha" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block text-center" id="ins"><svg class="bi bi-check" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                        </svg>
                        Añadir anuncio
                    </button>
                </form>
                </form>
            </div>
        </div>
        <!--Mapa-->
        <div id='datos_map'>
            >
            From: <input id="fromTbx" type="text"/>
            <!--Cuando se le da al boton que cargue en value de la base de datos el destino--->
            To: <input id="toTbx" type="text"/>

        </div> 
        <button type="submit" class="btn btn-danger btn-block text-center" id="cerrar_mapa"><svg class="bi bi-x-square-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2zm9.854 4.854a.5.5 0 00-.708-.708L8 7.293 4.854 4.146a.5.5 0 10-.708.708L7.293 8l-3.147 3.146a.5.5 0 00.708.708L8 8.707l3.146 3.147a.5.5 0 00.708-.708L8.707 8l3.147-3.146z" clip-rule="evenodd"/>
            </svg>
            Cerrar Mapa
        </button>
        <div class="directionsContainer">

            <div id="directionsPanel"></div>
            <div id="directionsItinerary"></div>
        </div>
        <div id="myMap"></div>
        <fieldset style="width:800px;margin-top:10px;">
        </fieldset>
    </body>
</html>
