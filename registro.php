<!--<!DOCTYPE html>-->

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
                        <a class="navbar-brand" href="index.php">Okupa2</a>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        </div>
                    </nav>
                    <button type="submit" class="btn btn-info btn-block text-center" id="registro"><svg class="bi bi-file-text" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4 1h8a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V3a2 2 0 012-2zm0 1a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V3a1 1 0 00-1-1H4z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 015 10h3a.5.5 0 010 1H5a.5.5 0 01-.5-.5zm0-2A.5.5 0 015 8h6a.5.5 0 010 1H5a.5.5 0 01-.5-.5zm0-2A.5.5 0 015 6h6a.5.5 0 010 1H5a.5.5 0 01-.5-.5zm0-2A.5.5 0 015 4h6a.5.5 0 010 1H5a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                        </svg>
                        Comenzar registro
                    </button>

                    
                    <div class="d-flex justify-content-center align-items-center container">
                        <!--Formulario de registro-->
                        <form id="reg">
                            <table>
                                <tr><td><label for="login" class="col-lg-4 col-form-label">Login</label></td></tr>  
                                <tr><td><input type="text" class="form-control" name="login" id="login" placeholder="Tu login"></td></tr>
                                <tr><td><label for="conUsu" class="col-lg-4 col-form-label ">Contraseña</label></td></tr> 
                                <tr><td><input type="password" class="form-control" name="conUsu" id="conUsu" placeholder="Tu contraseña"></td></tr>
                                <tr><td><label for="conUsu2" class="col-lg-20 col-form-label">Repita su contraseña</label></td></tr> 
                                <tr><td><input type="password" class="form-control" name="conUsu2" id="conUsu2" placeholder="Repita contraseña"></td></tr>
                                <tr><td><label for="email" class="col-lg-4 col-form-label">Email</label></td></tr>  
                                <tr><td><input type="text" class="form-control" name="email" id="email_r" placeholder="Email"></td></tr>
                                
                            </table>

                            <button type="submit" class="btn btn-success btn-block text-center mb-2 mt-3" id="enviarRegistro"> <svg class="bi bi-check" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                                </svg>
                                Enviar registro
                            </button>
                        </form>
                    </div>
                    <div id="info" >

                    </div>

                    <input type="button" id="volver" onclick="location.href = 'index.php';" value="Regsitro realizado correctamente" class="btn btn-success btn-block text-center"/>
                </body>
                </html>
