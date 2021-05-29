//Se declaran las variables
var map;
var directionsManager;
//Cuando el documento este listo
$(document).ready(function () {
    //Se ocultan los elementos
    $('#reg').hide();
    $('#volver').hide();
    $('#task-modificar').hide();
    $('#task-borrar').hide();
    $('#task-ins').hide();
    $('#datos_map').hide();
    $('#cerrar_mapa').hide();
    //Se llama a la función
    mostrar_bloqueados();

    //Se llama a la función
    mostrar_anuncios();
    /**
     * Muestra los anuncios de la 
     * base dee datos
     */
    function mostrar_anuncios() {
        //Enviamos la petición por ajax
        $.ajax({
            url: 'mostrar_anuncios.php',
            type: 'GET',
            //Si es correcto
            success: function (response) {

                var tasks = JSON.parse(response);
                console.log(tasks);
                //Mostramos los anuncios
                var template = '';
                tasks.forEach(task => {
                    template += `
                <tr taskCod="${task.id_anuncio}">
                    <td>${task.id_anuncio}</td>
                    <td>${task.autor}</td>
                    <td>${task.moroso}</td>
                    <td>${task.localidad}</td>
                    <td>${task.descripcion}</td>
                    <td>${task.fecha}</td>
                    <td>
                    <button class= "task-delete btn btn-danger"><svg class="bi bi-archive-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM6 7a.5.5 0 000 1h4a.5.5 0 000-1H6zM.8 1a.8.8 0 00-.8.8V3a.8.8 0 00.8.8h14.4A.8.8 0 0016 3V1.8a.8.8 0 00-.8-.8H.8z" clip-rule="evenodd"/>
                    </svg>
                    Eliminar
                    </button>
                    </td>
                     <td>
                    <button class= "task-item btn btn-warning"><svg class="bi bi-arrow-counterclockwise" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.83 6.706a5 5 0 00-7.103-3.16.5.5 0 11-.454-.892A6 6 0 112.545 5.5a.5.5 0 11.91.417 5 5 0 109.375.789z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M7.854.146a.5.5 0 00-.708 0l-2.5 2.5a.5.5 0 000 .708l2.5 2.5a.5.5 0 10.708-.708L5.707 3 7.854.854a.5.5 0 000-.708z" clip-rule="evenodd"/>
                    </svg>
                      Actualizar
                    </button>
                   
                    </td>
                        <td>
                    <button class= "task-map btn btn-warning"><svg class="bi bi-geo-alt" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 16s6-5.686 6-10A6 6 0 002 6c0 4.314 6 10 6 10zm0-7a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                    </svg>
                      Mostar mapa
                    </button>
                   
                    </td>
                    
                </tr>
              
            `

                });
                //Indicamos en index donde se muestran
                $('#tasks').html(template);

            }

        });

    }


    /**
     * Selecciona un anunsio y muestra los datos
     * sin que puedan modificarse
     */
    $(document).on('click', '.task-delete', function () {
        //Mostramos el formulario 
        $('#task-borrar').show();
        //Almacenmos el código del anuncio
        var element = $(this)[0].parentElement.parentElement;
        var cod = $(element).attr('taskCod');
        console.log(cod)
        //Enviamos el dato
        $.post('mostrar_borrar.php', {cod}, function (response) {
            const task = JSON.parse(response);
            //Mostramos los datos en el formulario sin que se puedan modificar
            $('#id_b').val(task.id_anuncio).attr('disabled', true);
            $('#autor_b').val(task.autor).attr('disabled', true);
            $('#moroso_b').val(task.moroso).attr('disabled', true);
            $('#localidad_b').val(task.localidad).attr('disabled', true);
            $('#descripcion_b').val(task.descripcion).attr('disabled', true);
            $('#fecha_b').val(task.fecha).attr('disabled', true);

        });

    });

    /**
     * Borrar un anuncio de la base de datos que ha sido mostrado
     * en el formulario
     */
    $(document).on('click', '#conf_borrar', function (e) {
        //Evitamos que envie los datos de forma predeterminada
        e.preventDefault();
        //Cofirmación del anunsio a eliminar
        if (confirm('¿Quiere eliminar este producto?')) {
            //Guardamos los datos
            const postData = {
                id: $('#id_b').val(),
                autor: $('#autor_u').val()


            };

            //Enviamos los datos
            $.post('borrar.php', postData, function (response) {
                //Informamos
                window.alert(response);
                //Mostramos el formulatio con los datos actualzidos
                mostrar_anuncios();
                //Ocultamos el formulario
                $('#task-borrar').hide();


            });
        }
    });


    /**
     * Captura el anuncio y los mostramos en  el 
     * formulario
     */
    $(document).on('click', '.task-item', function () {
        //Mostramos el formulario
        $('#task-modificar').show();
        //Capturamos el id del anunsio
        var element = $(this)[0].parentElement.parentElement;
        var id = $(element).attr('taskCod');
        //Enviamos el dato
        $.post('mostrar_modificar.php', {id}, function (response) {
            const task = JSON.parse(response);
            console.log(task);
            //Mostramos los valores en el formulario
            $('#id_m').val(task.id_anuncio).attr('disabled', true);
            $('#autor_m').val(task.autor).attr('disabled', true);
            $('#moroso_m').val(task.moroso);
            $('#localidad_m').val(task.localidad);
            $('#descripcion_m').val(task.descripcion);
            $('#fecha_m').val(task.fecha);

        });


    });

    /**
     * Borrar un anunsio de la base de datos que ha sido mostrado
     * en el formulario
     */
    $(document).on('click', '#conf_modificar', function (e) {
        //Evitamos que envie los datos de forma predeterminada
        e.preventDefault();
        //Cofirmación del anunsio a eliminar
        if (confirm('¿Quiere modificar este producto?')) {
            //Guardamos los datos
            const postData = {
                usuario: $('#usuario_m').val(),
                id: $('#id_m').val(),
                autor: $('#autor_m').val(),
                moroso: $('#moroso_m').val(),
                localidad: $('#localidad_m').val(),
                descripcion: $('#descripcion_m').val(),
                fecha: $('#fecha_m').val()
            };

            //Enviamos los datos
            $.post('modificar.php', postData, function (response) {
                //Informamos
                window.alert(response);
                //Mostramos el formulatio con los datos actualizados
                mostrar_anuncios();
                //Ocultamos el formulario
                $('#task-modificar').hide();


            });
        }
    });


    /**
     * Ocultar el formulario al hace click
     */
    $(document).on('click', '#cerrar', function () {
        $('#task-form').hide();
    });

    /**
     * Mostramos la ruta hacia la dirección del anuncio
     */
    $(document).on('click', '.task-map', function () {
        //Mostramos el mapa
        $('#cerrar_mapa').show();
        //Capturamos el id
        var element = $(this)[0].parentElement.parentElement;
        var id = $(element).attr('taskCod');
        //Enviamos el dato
        $.post('mostrar_datos.php', {id}, function (response) {
            const task = JSON.parse(response);

            //Mostramos los valores en el formulario
            $('#fromTbx').val(" ");
            $('#toTbx').val(task.localidad);
            //Creamos una instancia de Microsoft
            map = new Microsoft.Maps.Map('#myMap', {});
            //Cargamos la dirección del modulo
            Microsoft.Maps.loadModule('Microsoft.Maps.Directions', function () {
                //Creamos una instacia de directionsManagers
                directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);

                //Especificamos donde se muestra la ruta
                directionsManager.setRenderOptions({itineraryContainer: '#directionsItinerary'});
                //Almacenamos los puntos de ruta
                var start = new Microsoft.Maps.Directions.Waypoint({address: document.getElementById('fromTbx').value});
                directionsManager.addWaypoint(start);
                var end = new Microsoft.Maps.Directions.Waypoint({address: document.getElementById('toTbx').value});
                directionsManager.addWaypoint(end);
                //Especificamos donde se muestra el panel
                directionsManager.showInputPanel('directionsPanel');
            });
        });
    });

    /**
     * Se oculta el mapa al hacer click
     */
    $(document).on('click', '#cerrar_mapa', function () {
        $('#myMap').hide();
        $('#directionsContainer').hide();
        $('#directionsPanel').hide();
        $('#directionsItinerary').hide();
        $('#cerrar_mapa').hide();
    });


    /**
     * Mostrar el formulario de insertar
     * un nuevo anunsio solo si estas registrado
     */

    $(document).on('click', '#insertar', function (e) {
        //Evitamos que envie los datos de forma predeterminada
        e.preventDefault();
        //Almacenamos el login
        var $usuario = $('#usu').val();
        //Si la persona es invitida
        if ($usuario == "Invitado") {
            //Se informa
            window.alert("Debe estar registrado para poder insertar un anuncio");
            //Se redirige para que se registre

            window.location.href = "registro.php";

        } else {

            //En caso que la persona este registrada se muestra el formulario para insertar un anuncio
            $('#task-ins').show();

        }

    });

    /**
     * Añadir un nuevo anuncio en la base de datos
     */
    $('#task-ins').submit(function (e) {
        //Evitamos que envie los datos de forma predeterminada
        e.preventDefault();
        //Almacenamos los datos en una constante
        const postData = {

            autor: $('#autor_i').val(),
            moroso: $('#moroso_i').val(),
            localidad: $('#localidad_i').val(),
            descripcion: $('#descripcion_i').val(),
            fecha: $('#fecha_i').val()

        };
        //Enviamos los datos
        $.post('insertar.php', postData, function () {
            //Mostramos la tabla de los anuncios actulizadas
            mostrar_anuncios();
            //Vaciamos el formulario
            $('#task-ins').trigger('reset');
            //Ocultamos el formulario
            $('#task-ins').hide();

        });

    });
    /**
     * Muestra los login bloqueados
     */
    function mostrar_bloqueados() {
        //Enviamos la petición por ajax
        $.ajax({
            url: 'mostrar_bloqueados.php',
            type: 'GET',
            //Si es correcto
            success: function (response) {

                var tasks_bloq = JSON.parse(response);

                //Mostramos los login
                var template = '';
                tasks_bloq.forEach(task => {
                    template += `
                <tr>
                    <td>${task.login}</td>
                    <td>${task.email}</td>              
                </tr>
              
            `

                });
                //Indicamos en index donde se muestran
                $('#task-bloqueados').html(template);

            }

        });

    }

    /**
     * Muestra el formulario de regsitro
     */
    $(document).on('click', '#registro', function () {
        $('#reg').show();
        $('#registro').hide();

    });

    /**
     * Añade un nuevo registro en la base de datos
     */
    $(document).on('click', '#enviarRegistro', function (e) {
        //Evitamos que envie los datos de forma predeterminada
        e.preventDefault();
        //Almacenamos los datos en una constante

        const postData = {
            login: $('#login').val(),
            conUsu: $('#conUsu').val(),
            conUsu2: $('#conUsu2').val(),
            email_r: $('#email_r').val()

        };

        //Enviamos los datos
        $.post('insertar_registro.php', postData, function (response) {

            //Evaluamos cada una de las opciones para el control en la inserción de datos
            if (response == "vacio") {

                $('#reg').show();
                $('#info').html("No puede haber ningun campo vacio");

            } else if (response == "dif") {

                $('#reg').show();
                $('#info').html("Las contraseñas no coinciden");
            } else if (response == "email") {
                $('#reg').show();
                $('#info').html("El formato del email no es correcto");

            } else {

                $('#reg').trigger('reset');
                $('#reg').hide();
                $('#volver').show();
                $('#info').html(" ");
            }
        });

    });

    /**
     * Desbloquear un login
     */
    $(document).on('click', '#desbloquear', function (e) {
        //Evitamos que envie los datos de forma predeterminada
        e.preventDefault();
        //Cofirmación el login a desbloquear
        if (confirm('¿Quiere desbloquear este login?')) {
            //Almacenamos el valos del login
            var log = $('#log').val();

            //Enviamos los datos
            $.post('desbloquear.php', {log}, function (response) {

                //Informamamos
                window.alert(response);
                //Reseteamos el formulario
                $('#task-desbloquear').trigger('reset');
                //Mostramos la lista de login actualizada
                mostrar_bloqueados();

            });
        }
    });

});
