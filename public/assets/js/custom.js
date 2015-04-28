var CustomApp = function () {

    /*-----------------------------------------------------------------------------------*/
    /*  Bootstrap FileInput
    /*-----------------------------------------------------------------------------------*/
    var handleBootstrapFileInput = function() {
        try {
            $(".file-upload").fileinput({
                previewFileType: "image",
                browseClass: "btn btn-success",
                browseLabel: "Buscar foto",
                browseIcon: '<i class="fa fa-picture-o"></i>',
                removeClass: "btn btn-danger",
                removeLabel: "Eliminar",
                removeIcon: '<i class="fa fa-trash"></i>',
                uploadClass: "btn btn-info",
                uploadLabel: "Subir",
                uploadIcon: '<i class="fa fa-upload"></i>',
            });
        } catch(e) {
          alert('fileinput.js does not support older browsers!');
        }        
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Show and Hide Form New Player
    /*-----------------------------------------------------------------------------------*/
    var handleShowNewPlayerForm = function() {
        $("#new-player").on('click', function(){
            $("#player-form-div").show();
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Show and Hide Form New Team
    /*-----------------------------------------------------------------------------------*/
    var handleShowNewTeamForm = function() {
        $("#new-team").on('click', function(){
            $("#team-form-div").show();
        });
    }


    /*-----------------------------------------------------------------------------------*/
    /*  Bootbox
    /*-----------------------------------------------------------------------------------*/
    var cleanValidatorClasses = function(element) {
        if($(element).hasClass('has-error'))
            $(element).closest('.form-group').removeClass('has-error');
        if($(element).hasClass('has-success'))
            $(element).closest('.form-group').removeClass('has-success');
    }

    var addValidationRulesForms = function() 
    {
        $.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
        }, 'sólo letras, números y espacios.');

        $.validator.addMethod('customDateValidator', function(value, element) {
            try{
                jQuery.datepicker.parseDate('dd-mm-yy', value);return true;}
            catch(e){return false;}
        },'Por favor, Ingrese una fecha valida con el dormato dd-mm-yy.');

        jQuery.validator.addMethod('alturaDecimal', function(value, element) {
            return this.optional(element) || /^\d{0,10}(\.\d{0,2})?$/i.test(value);
        }, 'Por favor ingrese maximo'+ [10] +'digitos enteros'+' y maximo'+[2]+'digitos decimales');

        jQuery.validator.addMethod('pesoDecimal', function(value, element) {
            return this.optional(element) || /^\d{0,3}(\.\d{0,2})?$/i.test(value);
        }, 'Por favor ingrese maximo'+[3]+'digitos enteros'+'y maximo'+[2]+'digitos decimales');

        $.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
              return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, 'sólo letras, números y guiones.');
    }

    var updatePlayerForm = function() {
        $("#player-form")[0].reset();
       // $('.chosen-select').html("");
        loadFieldSelect($('#lista-paises').attr('href'),'#pais_id');
        loadFieldSelect($('#lista-posiciones').attr('href'),'#posicion_id');
        loadFieldSelect($('#lista-equipos').attr('href'),'#equipo_id_jugador');
        $('.chosen-select').trigger("chosen:updated");
    }


    var handleBootboxNewPlayer = function () {

        addValidationRulesForms();

        $('#player-form').validate({
            rules:{
                nombre:{
                    required:true,
                    rangelength: [2, 128],
                    onlyLettersNumbersAndSpaces: true
                },
                fecha_nacimiento:{
                    required:true,
                    customDateValidator: true
                },
                altura:{
                    required:true,
                    alturaDecimal:true
                },
                peso:{
                    required:true,
                    pesoDecimal:true
                },
                apodo:{
                    required:true,
                    rangelength: [2, 128],
                    onlyLettersNumbersAndSpaces: true
                },
                posicion_id:{
                    required:true,
                },
                pais_id:{
                    required:true,
                },
                numero:{
                    required:true,
                    number:true
                },
                fecha_inicio:{
                    required:true,
                    customDateValidator:true
                },
                fecha_fin:{
                    customDateValidator:true
                },
                equipo_id:{
                    required:true
                }
            },
            messages:{
                nombre:{
                    required:'Este campo es obligatorio.',
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                fecha_nacimiento:{
                    required:'Este campo es obligatorio.',
                },
                altura:{
                    required:'Este campo es obligatorio.',
                },
                peso:{
                    required:'Este campo es obligatorio.',
                },
                apodo:{
                    required:'Este campo es obligatorio.',
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                posicion_id:{
                    required:'Este campo es obligatorio.',
                },
                pais_id:{
                    required:'Este campo es obligatorio.',
                },
                numero:{
                    required:'Este campo es obligatorio.',
                    number:'Por favor ingrese un valor numerico.'
                },
                fecha_inicio:{
                    required:'Este campo es obligatorio.',
                },
                equipo_id:{
                   required:'Este campo es obligatorio.',
                }
            },
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error');
            },
            success:function(element){
                element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });

        // Mostrar formulario para agregar nuevo jugador
        $('#new-player').on('click', function() 
        {
            updatePlayerForm();
            bootbox
                .dialog(
                {
                    message: $('#player-form-div'),
                    buttons: 
                    {
                        success: 
                        {
                            label: "Guardar",
                            className: "btn-primary",
                            callback: function () 
                            {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#player-form').valid()) {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#player-form").submit(function(e){
                                        var formData = new FormData(this);

                                        $.ajax({
                                            type: 'POST',
                                            url: $('#agregar-jugador').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(responseServer) {
                                                //console.log(responseServer);
                                                if(responseServer.success == true) 
                                                {
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: responseServer.jugador.nombre + " ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    updatePlayerForm();
                                                }else{
                                                     bootbox.dialog({
                                                        message: responseServer.errores,
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Ok!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    //updatePlayerForm();
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                               bootbox.dialog({
                                                        message:" ¡Error al enviar datos al servidor!",
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    //updatePlayerForm();
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#player-form").submit();
                                } else {
                                    return false;
                                }
                                return false;
                            }
                        }
                    },
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#player-form-div')
                        .show();                             // Show the form
                })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                //$('#player-form-div').hide().appendTo('#new-player-form');
            })
            .modal('show');
        });               
    }

  
    var loadDataForEditPlayer = function(idPlayer) {
        $.ajax({
            type: 'GET',
            url: $('#datos-jugador').attr('href'),    
            data: {'jugadorId': idPlayer},
            dataType: "JSON",
            success: function(response) {
                if (response.success) {
                    //console.log(response);
                    $('#jugador_id').val(response.jugador.id);
                    $('#nombre').val(response.jugador.nombre);
                    $('#fecha_nacimiento').val(response.fechaNacimiento);
                    $('#altura').val(response.jugador.altura);
                    $('#peso_jugador').val(response.jugador.peso);
                    $('#apodo_jugador').val(response.jugador.apodo);
                    $('#posicion_id').val(response.jugador.posicion_id);
                    $('#pais_id').val(response.jugador.pais_id);
                    /*$('#numero').val(response.equipo.pivot.numero);
                    $('#fecha_inicio').val(response.fechaInicio);
                    if(response.equipo.pivot.fecha_fin != null){
                       $('#fecha_fin').val($.datepicker.formatDate('dd-mm-yy', new Date(
                        response.equipo.pivot.fecha_fin)));
                    }else{
                    $('#fecha_fin').val()
                    }
                    $('#equipo_id_jugador').val(response.equipo.pivot.equipo_id);*/
                    $('.chosen-select').trigger("chosen:updated");
                }
            }
        });
    }

    // Metodo para editar datos del jugador
    var editPlayer = function(idPlayer) {

        addValidationRulesForms();

        $('#player-form').validate({
            onkeyup: true,  
            onfocusout: false,
            rules:{
                nombre:{
                    required:true,
                    rangelength: [2, 128],
                    onlyLettersNumbersAndSpaces: true
                },
                fecha_nacimiento:{
                    required:true,
                    customDateValidator: true
                },
                altura:{
                    required:true,
                    alturaDecimal:true
                },
                peso:{
                    required:true,
                    pesoDecimal:true
                },
                apodo:{
                    required:true,
                    rangelength: [2, 128],
                    onlyLettersNumbersAndSpaces: true
                },
                posicion_id:{
                    required:true,
                },
                pais_id:{
                    required:true,
                },
                numero:{
                    required:true,
                    number:true,
                },
                fecha_inicio:{
                    required:true,
                    customDateValidator:true
                },
                fecha_fin:{
                    customDateValidator:true
                },
                equipo_id:{
                    required:true
                }
            },
            messages:{
                nombre:{
                    required:'Este campo es obligatorio.',
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                    onlyLettersNumbersAndSpaces: true
                },
                fecha_nacimiento:{
                    required:'Este campo es obligatorio.',
                },
                altura:{
                    required:'Este campo es obligatorio.',
                },
                peso:{
                    required:'Este campo es obligatorio.',
                },
                apodo:{
                    required:'Este campo es obligatorio.',
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                posicion_id:{
                    required:'Este campo es obligatorio.',
                },
                pais_id:{
                    required:'Este campo es obligatorio.',
                },
                numero:{
                    required:'Este campo es obligatorio.',
                    number:'Por favor ingrese un valor numerico.',
                    remote: jQuery.validator.format('Error')
                },
                fecha_inicio:{
                    required:'Este campo es obligatorio.',
                },
                equipo_id:{
                   required:'Este campo es obligatorio.',
                }
            },
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error');
            },
            success:function(element){
                element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });
    
        loadDataForEditPlayer(idPlayer);

        bootbox.dialog({
                    message: $('#player-form-div'),
                    buttons: {
                        success: {
                            label: "Actualizar",
                            className: "btn-primary",
                            callback: function () 
                            {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#player-form').valid()) 
                                {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#player-form").submit(function(e){
                                        var formData = new FormData(this);
                                        //var form = $('#player-form').serializeArray();

                                        $.ajax({
                                            type: 'POST',
                                            url: $('#editar-jugador').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(responseServer) {
                                                //console.log(responseServer);
                                                if(responseServer.success == true) 
                                                {
                                                    $('#player-form-div').show();
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message:  responseServer.jugador.nombre + " ha sido Actualizado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    //updatePlayerForm();
                                                }else{
                                                    $('#player-form-div').show();
                                                     bootbox.dialog({
                                                        message:responseServer.errores,
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Ok!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    //updatePlayerForm();
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                               bootbox.dialog({
                                                        message:" ¡Error al enviar datos al servidor!",
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                   //updatePlayerForm();
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#player-form").submit();
                                } else {
                                    return false;
                                }
                                return false;
                            }
                        }
                    },
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#player-form-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#player-form-div').hide().appendTo('#new-player-form');
            })
            .modal('show');
    }

    //Metodo para ver ficha del jugador
    var viewDataPlayer = function(idPlayer) {

         /*bootbox.dialog({
                    message: $('#player-form-view-div'),
                    buttons: {
                        /*success: {
                            label: "Actualizar",
                            className: "btn-primary",
                            callback: function (){
                            }
                        }
                    },
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#player-form-view-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#player-form-view-div').hide().appendTo('#new-player-form-view');
            })
            .modal('show');

          $.ajax({
            type: 'GET',
            url: $('#datos-jugador').attr('href'),    
            data: {'jugadorId': idPlayer},
            dataType: "JSON",
            success: function(response) {
                if (response.success == true) {
                    console.log(response);
                    console.log(response.jugador);
                    $('#imgen_vista').attr('src', response.urlImg);;
                    $('#nombre_vista').val(response.jugador.nombre);
                    $('#fecha_vista').val(response.jugador.fecha_nacimiento);
                    $('#altura_vista').val(response.jugador.altura);
                    $('#apodo_vista').val(response.jugador.abreviacion);
                    $('#posicion_vista').val(response.posicion.nombre);
                    $('#pais_vista').val(response.pais.nombre);

                    var form = $('#new-player-form-view');

                    var template = $('#player-form-view-div-tpl').html();
                    var jugador = {
                        title:'Ver Datos Jugador',
                        url: '',
                        name: response.jugador.nombre,
                        height: response.jugador.altura,
                        abbreviation: response.jugador.abreviacion,
                        position: response.jugador.posicion_id,
                        country: response.jugador.pais_id
                    };
                    var html = Mustache.to_html(template, jugador);
                    form.html(html);

                }
            }
        });*/
    }

    //Metodo para eliminar jugador de la BD.
    var deletePlayer = function (idPlayer) {
        
        bootbox.confirm("¿Esta seguro de eliminar al Jugador?", function(result) {
            //console.log("Confirm result: "+result);
            if (result == true){
               $.ajax({
                type: 'GET',
                url: $('#eliminar-jugador').attr('href'),
                data: {'idPlayer': idPlayer},
                dataType: "JSON",
                success: function(response) {
                    if (response.success == true) {
                        $('#eliminar_jugador_'+idPlayer).parent().parent().remove();
                        bootbox.dialog({
                            message:" ¡Jugador Eliminado!",
                            title: "Éxito",
                            buttons: {
                                success: {
                                    label: "Success!",
                                    className: "btn-success"
                                }
                            }
                        });
                    };
                }
            });
           };
       });
    }

    // Metodo para saber cual opcion(ver, editar, borrar) fue seleccionada de la lista de Jugadores
    var loadDataPlayer = function() 
    {
        $('.table').click(function(event)
        {
            var target = $( event.target );
            if (target.is('a')) 
            {
                console.log($(target).attr('id'));

                var id = $(target).attr('id');
                var type = id ? id.split('_')[0] : '';
                var view = id ? id.split('_')[1] : '';
                var numberId = id ? id.split('_')[2] : '';

                if (view == "jugador") 
                {
                    if (type == "editar") {
                        editPlayer(numberId);
                    }else if(type == "ver"){
                        //viewDataPlayer(numberId);
                    }else if(type == "eliminar"){
                        deletePlayer(numberId);
                    }
                }
            }           
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Fancybox New Player
    /*-----------------------------------------------------------------------------------*/
    var handleFancyboxNewPlayer = function () {
        //$("#new-player").on('click', function(){
            $("#new-player").fancybox({
                openEffect  : 'elastic',
                closeEffect : 'elastic',
                centerOnScroll: true,
                hideOnOverlayClick: true,
                autoDimensions: true,
                autoSize: true,
                width: 50
            });          
        //});            
    }

    var initChosen = function() {
        // Iniciar select chosen
        $('.chosen-select').chosen({width: "100%"});
    }

    /*
    *********************************FORMULARIOS DE EQUIPOS ********************************
    */

    updateTeamForm = function() {
        $("#team-form")[0].reset();
        loadFieldSelect($('#lista-paises').attr('href'),'#pais_equipo');
        loadFieldSelect($('#lista-jugadores').attr('href'),'#jugadores');
        $('.chosen-select').trigger("chosen:updated");
    }

      var handleBootboxNewTeam = function () {


       addValidationRulesForms();

        $('#team-form').validate({
              rules:{
                nombre:{
                    required:true,
                },
                apodo:{
                    required:true,
                },
                fecha_fundacion:{
                    required:true,
                    customDateValidator: true
                },
                tipo:{
                    required:true,
                },
                historia:{
                    required:true,
                    rangelength: [2,512]
                },
                ubicacion:{
                    required:true,
                    rangelength: [2,512]
                }
            },
            messages:{
                 nombre:{
                    required: 'Este campo es obligatorio',
                },
                apodo:{
                    required: 'Este campo es obligatorio',
                },
                fecha_fundacion:{
                    required:'Este campo es obligatorio',
                },
                tipo:{
                    required:'Este campo es obligatorio',
                },
                posicion:{
                    required:'Este campo es obligatorio',
                },
                historia:{
                    required:'Este campo es obligatorio',
                    rangelength: 'Debe ingresar minimo 2 y maximo 512 caracteres'
                },
                ubicacion:{
                    required:'Este campo es obligatorio',
                    rangelength: 'Debe ingresar minimo 2 y maximo 512 caracteres'
                }
            },
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error');
            },
            success:function(element){
                element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });

        // Mostrar formulario para agregar nuevo Equipo
        $('#new-team').on('click', function() {
            updateTeamForm();
            bootbox
                .dialog({
                    message: $('#team-form-div'),
                    buttons: {
                        success: {
                            label: "Guardar",
                            className: "btn-primary",
                            callback: function () 
                            {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#team-form').valid()) {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#team-form").submit(function(e){
                                        var formData = new FormData(this);
                                        //var form = $('#team-form').serializeArray();

                                        $.ajax({
                                            type: 'POST',
                                            url: $('#agregar-equipo').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(responseServer) {
                                                //console.log(responseServer);
                                                if(responseServer.success == true) 
                                                {
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: responseServer.equipo.nombre + " ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#team-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    updateTeamForm();
                                                }else{
                                                    console.log(responseServer);
                                                     bootbox.dialog({
                                                        message:responseServer.errores,
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#team-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                   // updateTeamForm();
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                               console.log(errorThrown);
                                               bootbox.dialog({
                                                        message:" ¡Error al enviar datos al servidor!",
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#team-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    // updateTeamForm();
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#team-form").submit();
                                } else {
                                    return false;
                                }
                                return false;
                            }
                        }
                    },
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#team-form-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#team-form-div').hide().appendTo('#new-team-form');
            })
            .modal('show');
        });               
    }

    loadDataForEditTeam = function(idTeam) {
         $.ajax({
            type: 'GET',
            url: $('#ver-equipo').attr('href'),    
            data: {'equipoId': idTeam},
            dataType: "JSON",
            success: function(response) 
            {
                if (response.success == true) {
                    console.log(response);
                    $('#equipo_id').val(response.equipo.id);
                    $('#nombre_equipo').val(response.equipo.nombre);
                    if(response.equipo.fecha_fundacion != "0000-00-00") {
                        $('#fecha_fundacion').val($.datepicker.formatDate('dd-mm-yy', new Date(
                        response.equipo.fecha_fundacion)));
                    }else{
                        $('#fecha_fundacion').val();
                    }
                    $('#apodo').val(response.equipo.apodo);
                    $("select#tipo_equipo option").each(function() { this.selected = (this.text == response.equipo.tipo); });
                    $('#info_url').val(response.equipo.info_url);
                    $('#historia').val(response.equipo.historia);
                    $('#ubicacion').val(response.equipo.ubicacion);
                    $('#jugadores').val(response.jugadores);
                    $('#jugadores').trigger("chosen:updated");
                    $('#pais_equipo').val(response.equipo.pais_id);
                    $('#pais_equipo').trigger("liszt:updated");
                    $('.chosen-select').trigger("chosen:updated");
                    validateSelectPlayers(response.equipo.tipo);
                }
            }
        });
    }

     // Metodo para editar datos del Equipo
    var editTeam = function(idTeam) {

        addValidationRulesForms();

        $('#team-form').validate({
            
            rules:{
                nombre:{
                    required:true,
                },
                apodo:{
                    required:true,
                },
                fecha_fundacion:{
                    required:true,
                    customDateValidator: true
                },
                tipo:{
                    required:true,
                },
                historia:{
                    required:true,
                    rangelength: [2,512]
                },
                ubicacion:{
                    required:true,
                    rangelength: [2,512]
                }
            },
            messages:{
                 nombre:{
                    required: 'Este campo es obligatorio',
                },
                apodo:{
                    required: 'Este campo es obligatorio',
                },
                fecha_fundacion:{
                    required:'Este campo es obligatorio',
                },
                tipo:{
                    required:'Este campo es obligatorio',
                },
                posicion:{
                    required:'Este campo es obligatorio',
                },
                historia:{
                    required:'Este campo es obligatorio',
                    rangelength: 'Debe ingresar minimo 2 y maximo 512 caracteres'
                },
                ubicacion:{
                    required:'Este campo es obligatorio',
                    rangelength: 'Debe ingresar minimo 2 y maximo 512 caracteres'
                }
            },
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error');
            },
            success:function(element){
                element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });
        updateTeamForm();
        loadDataForEditTeam(idTeam);

        bootbox.dialog({
                    message: $('#team-form-div'),
                    buttons: {
                        success: {
                            label: "Actualizar",
                            className: "btn-primary",
                            callback: function () {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#team-form').valid()) 
                                {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#team-form").submit(function(e){
                                        var formData = new FormData(this);
                                        //var form = $('#team-form').serializeArray();

                                        $.ajax({
                                            type: 'POST',
                                            url: $('#editar-equipo').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(responseServer) {
                                                //console.log(responseServer);
                                                if(responseServer.success == true) 
                                                {
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: responseServer.equipo.nombre + " ha sido Actualizado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#team-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    //updateTeamForm();
                                                }else{
                                                     bootbox.dialog({
                                                        message: responseServer.errores,
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#team-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                   //updateTeamForm();
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                               bootbox.dialog({
                                                        message:" ¡Error al enviar datos al servidor!",
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#team-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    //updateTeamForm();
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#team-form").submit();
                                } else {
                                    return false;
                                }
                                return false;
                            }
                        }
                    },
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#team-form-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#team-form-div').hide().appendTo('#new-team-form');
            })
            .modal('show');
    }

    var loadSelectForTeam = function() {
        $.ajax({
            type: 'GET',
            url: $('#ver-equipo').attr('href'),    
            data: {'equipoId': $('#equipo_id').val()},
            dataType: "JSON",
            success: function(response) {
                if (response.success == true) {
                    //console.log(response);
                    $('#pais_equipo').val(response.equipo.pais_id);
                    $('#jugadores').val(response.jugadores);
                    $('#pais_equipo').trigger("chosen:updated");
                    $('#jugadores').trigger("liszt:updated");
                    $('.chosen-select').trigger("chosen:updated");
                }
            }
        });
        $('.chosen-select').trigger("chosen:updated");
    }

    var loadSelectForPlayer = function() {
        $.ajax({
            type: 'GET',
            url: $('#datos-jugador').attr('href'),    
            data: {'jugadorId': $('#jugador_id').val()},
            dataType: "JSON",
            success: function(response) {
                console.log(response);
                if (response.success) {
                    $('#fecha_nacimiento').val(response.fechaNacimiento);
                    $('#posicion_id').val(response.jugador.posicion_id);
                    $('#pais_id').val(response.pais.id);
                    $('.chosen-select').trigger("chosen:updated");
                }
            }
        });
        $('.chosen-select').trigger("chosen:updated");
    }

        //Metodo para eliminar equipo de la BD.
    var deleteTeam = function (idTeam) {
        bootbox.confirm("¿Esta seguro de eliminar el Equipo?", function(result) {
            console.log("Confirm result: "+result);
            if (result == true){
               $.ajax({
                type: 'GET',
                url: $('#eliminar-equipo').attr('href'),
                data: {'idTeam': idTeam},
                dataType: "JSON",
                success: function(response) {
                    if (response.success == true) {
                        $('#eliminar_equipo_'+idTeam).parent().parent().remove();
                        bootbox.dialog({
                            message:" ¡Equipo Eliminado!",
                            title: "Éxito",
                            buttons: {
                                success: {
                                    label: "Success!",
                                    className: "btn-success"
                                }
                            }
                        });
                    };
                }
            });
           };
       });
    }


    //Metodo para cargar vista seleccionada en lista de equipos
    var loadDataTeam = function() 
    {
        $('.table').click(function(event)
        {
            var target = $( event.target );
            if (target.is('a')) 
            {
                console.log($(target).attr('id'));

                var id = $(target).attr('id');
                var type = id ? id.split('_')[0] : '';
                var view = id ? id.split('_')[1] : '';
                var numberId = id ? id.split('_')[2] : '';

                if (view == "equipo") 
                {
                    if (type == "editar") {
                        editTeam(numberId);
                    }else{
                        deleteTeam(numberId);
                    }
                }
            }           
        });
    }

    var validateSelectPlayers = function(typeOfTeam) 
    {
        //console.log(typeOfTeam);
        if(typeOfTeam == 'Selección'){
            $('#jugadores').attr('disabled', true);
            $('#jugadores').trigger("chosen:updated");
        }else{
            $('#jugadores').attr('disabled', false);
            $('#jugadores').trigger("chosen:updated");
        }
        $('#tipo_equipo').change(function() {
           console.log($(this).val());
            if($(this).val() == 0){
                $('#jugadores').attr('disabled', true);
                $('#jugadores').trigger("chosen:updated");
            }else{
                $('#jugadores').attr('disabled', false);
                $('#jugadores').trigger("chosen:updated");
            }
            $('.chosen-select').trigger("chosen:updated");
        });
        $('.chosen-select').trigger("chosen:updated");
    }


    /*
    *********************************FORMULARIOS DE PAISES ********************************
    */

        // Mostrar formulario para agregar nuevo país
        var handleBootboxNewCountry = function () {

        $.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
            }, 'sólo letras, números y espacios.');

        $.validator.addMethod('customDateValidator', function(value, element) {
            try{
                jQuery.datepicker.parseDate('dd-mm-yy', value);return true;}
            catch(e){return false;}
        },'Por favor, Ingrese una fecha valida con el dormato dd-mm-yy.');

        jQuery.validator.addMethod('decimalNumbers', function(value, element) {
            return this.optional(element) || /^\d{0,10}(\.\d{0,2})?$/i.test(value);
        }, 'Por favor ingrese maximo'+[10]+'digitos enteros'+'y maximo'+[2]+'digitos decimales');

        $.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
              return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, 'sólo letras, números y guiones.');

        $('#country-form').validate({
            rules:{
                nombre:{
                    required:true,
                    rangelength: [2, 128],
                    onlyLettersNumbersAndSpaces: true
                },
                 bandera:{
                    required:true,
                    rangelength: [2, 128],
                    onlyLettersNumbersAndSpaces: true
                }
            },
            messages:{
                nombre:{
                    required:'Este campo es obligatorio.',
                },
                bandera:{
                    required:'Este campo es obligatorio.',
                }
            },
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error');
            },
            success:function(element){
                element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });

        // Mostrar formulario para agregar nuevo jugador
        $('#new-country').on('click', function() {
            bootbox
                .dialog({
                    message: $('#country-form-div'),
                    buttons: {
                        success: {
                            label: "Guardar",
                            className: "btn-primary",
                            callback: function () {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#country-form').valid()) {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#country-form").submit(function(e)
                                    {
                                        var formData = new FormData(this);
                                        //var form = $('#player-form').serializeArray();

                                        $.ajax({
                                            type: 'POST',
                                            url: $('#agregar-pais').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(responseServer) {
                                                if(responseServer.success == true) 
                                                {
                                                    dataServer = responseServer;
                                                    //console.log(dataServer);
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: $('#nombre').val() + " ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#country-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#country-form")[0].reset();
                                                }else{
                                                     bootbox.dialog({
                                                        message:" ¡Error al agregar datos!",
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#country-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#country-form")[0].reset();
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                               bootbox.dialog({
                                                        message:" ¡Error al enviar datos al servidor!",
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#country-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#country-form")[0].reset();
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#country-form").submit();
                                } else {
                                    return false;
                                }

                            }
                        }
                    },
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#country-form-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#country-form-div').hide().appendTo('#new-country-form');
            })
            .modal('show');
        });               
    }

        
      //Metodo para ver datos por País
    var viewDataCountry = function(idCountry) {

         bootbox.dialog({
                    message: $('#country-form-view-div'),
                    buttons: {
                        /*success: {
                            label: "Actualizar",
                            className: "btn-primary",
                            callback: function (){
                            }
                        }*/
                    },
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#country-form-view-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#country-form-view-div').hide().appendTo('#new-country-form-view');
            })
            .modal('show');

          $.ajax({
            type: 'GET',
            url: $('#datos-pais').attr('href'),    
            data: {'countryId': idCountry},
            dataType: "JSON",
            success: function(response) {
                if (response.success == true) {
                    /*console.log(response);
                    console.log(response.pais);*/
                    $('#nombre_pais').val(response.pais.nombre);
                    $('#bandera_pais').val(response.pais.bandera);
                   /* var form = $('#new-country-form-view');*/

                    /*var template = $('#country-form-view-div-tpl').html();
                    var jugador = {
                        title:'Ver Datos Jugador',
                        url: '',
                        name: response.jugador.nombre,
                        height: response.jugador.altura,
                        abbreviation: response.jugador.abreviacion,
                        position: response.jugador.posicion_id,
                        country: response.jugador.pais_id
                    };
                    var html = Mustache.to_html(template, jugador);
                    form.html(html);*/
                }
            }
        });
    }

    // Metodo para editar datos del país
    var editCountry = function(idCountry) {

        $.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
            }, 'sólo letras, números y espacios.');

        $.validator.addMethod('customDateValidator', function(value, element) {
            try{
                jQuery.datepicker.parseDate('dd-mm-yy', value);return true;}
            catch(e){return false;}
        },'Por favor, Ingrese una fecha valida.');

        jQuery.validator.addMethod('decimalNumbers', function(value, element) {
            return this.optional(element) || /^\d{0,10}(\.\d{0,2})?$/i.test(value);
        }, 'Por favor ingrese maximo'+[10]+'digitos enteros'+'y maximo'+[2]+'digitos decimales');

        $.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
              return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, 'sólo letras, números y guiones.');

      $('#country-form').validate({
            rules:{
                nombre:{
                    required:true,
                    rangelength: [2, 128],
                    onlyLettersNumbersAndSpaces: true
                },
                 bandera:{
                    required:true,
                    rangelength: [2, 128],
                    onlyLettersNumbersAndSpaces: true
                }
            },
            messages:{
                nombre:{
                    required:'Este campo es obligatorio.',
                },
                bandera:{
                    required:'Este campo es obligatorio.',
                }
            },
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error');
            },
            success:function(element){
                element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });
    
        $.ajax({
            type: 'GET',
            url: $('#datos-pais').attr('href'),    
            data: {'countryId': idCountry},
            dataType: "JSON",
            success: function(response) {
                if (response.success == true) {
                    /*console.log(response);
                    console.log(response.pais);*/
                    $('#pais_id').val(response.pais.id);
                    $('#nombre').val(response.pais.nombre);
                    $('#bandera').val(response.pais.bandera);
                }
            }
        });
        
        bootbox.dialog({
                    message: $('#country-form-div'),
                    buttons: {
                        success: {
                            label: "Actualizar",
                            className: "btn-primary",
                            callback: function () {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#country-form').valid()) {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#country-form").submit(function(e){
                                        var formData = new FormData(this);
                                        //var form = $('#country-form').serializeArray();

                                        $.ajax({
                                            type: 'POST',
                                            url: $('#editar-pais').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(responseServer) {
                                                if(responseServer.success == true) 
                                                {
                                                    dataServer = responseServer;
                                                    //console.log(dataServer);
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: $('#nombre').val() + " ha sido Actualizado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#country-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#country-form")[0].reset();
                                                }else{
                                                     bootbox.dialog({
                                                        message:" ¡Error al agregar datos!",
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#country-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#country-form")[0].reset();
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                               bootbox.dialog({
                                                        message:" ¡Error al enviar datos al servidor!",
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#country-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#country-form")[0].reset();
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#country-form").submit();
                                } else {
                                    return false;
                                }

                            }
                        }
                    },
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#country-form-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#country-form-div').hide().appendTo('#new-country-form');
            })
            .modal('show');
    }

     //Metodo para eliminar país de la BD.
    var deleteCountry = function (idCountry) {
        bootbox.confirm("¿Esta seguro de eliminar el País?", function(result) {
            //console.log("Confirm result: "+result);
            if (result == true){
               $.ajax({
                type: 'GET',
                url: $('#eliminar-pais').attr('href'),
                data: {'countryId': idCountry},
                dataType: "JSON",
                success: function(response) {
                    if (response.success == true) {
                        $('#eliminar_pais_'+idCountry).parent().parent().remove();
                        bootbox.dialog({
                            message:" ¡País Eliminado!",
                            title: "Éxito",
                            buttons: {
                                success: {
                                    label: "Success!",
                                    className: "btn-success"
                                }
                            }
                        });
                    };
                }
            });
           };
       });
    }


    // Metodo para saber cual opcion(ver, editar, borrar) fue seleccionada de la lista de Paises
    var loadDataCountry = function() 
    {
        $('.table').click(function(event)
        {
            var target = $( event.target );
            if (target.is('a')) 
            {
                console.log($(target).attr('id'));

                var id = $(target).attr('id');
                var type = id ? id.split('_')[0] : '';
                var view = id ? id.split('_')[1] : '';
                var numberId = id ? id.split('_')[2] : '';

                if (view == "pais") 
                {
                    if (type == "editar") {
                        editCountry(numberId);
                    }else if(type == "ver"){
                        viewDataCountry(numberId);
                    }else if(type == "eliminar"){
                        deleteCountry(numberId);
                    }
                }
            }           
        });
    }


    /**
     * Metodos para CRUD POSICIONES 
    */

    var handleBootboxNewPosition = function () {


       addValidationRulesForms();

        $('#position-form').validate({
              rules:{
                nombre:{
                    required:true,
                    rangelength : [2,128]
                },
                abreviacion:{
                    required:true,
                    rangelength : [2,20]
                },
            },
            messages:{
                nombre:{
                    required: 'Este campo es obligatorio',
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                abreviacion:{
                    required: 'Este campo es obligatorio',
                    rangelength: 'Por favor ingrese entre [2, 20] caracteres',
                },
            },
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error');
            },
            success:function(element){
                element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });

        // Mostrar formulario para agregar nueva Posición
        $('#new-position').on('click', function() {
            $("#position-form").trigger("reset");;
            bootbox
                .dialog({
                    message: $('#position-form-div'),
                    buttons: {
                        success: {
                            label: "Guardar",
                            className: "btn-primary",
                            callback: function () 
                            {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!
                                /*$('.table').dataTable({
                                    bDestroy : true,  
                                    sPaginationType: "full_numbers"
                                });*/

                                //$('.table').DataTable().ajax.reload();

                                //ajax para el envío del formulario.
                                if($('#position-form').valid()) {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#position-form").submit(function(e){
                                        var formData = new FormData(this);

                                        $.ajax({
                                            type: 'POST',
                                            url: $('#agregar-posicion').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(responseServer) {
                                                console.log(responseServer);
                                                if(responseServer.success == true) 
                                                {
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: responseServer.posicion.nombre + " ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    $('.table').DataTable().ajax.reload();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#position-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#position-form")[0].reset();

                                                 

                                                }else{
                                                    console.log(responseServer);
                                                     bootbox.dialog({
                                                        message:responseServer.errores,
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#position-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                               console.log(errorThrown);
                                               bootbox.dialog({
                                                        message:" ¡Error al enviar datos al servidor!",
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#position-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#position-form").submit();
                                } else {
                                    return false;
                                }
                                return false;
                            }
                        }
                    },
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#position-form-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#position-form-div').hide().appendTo('#new-position-form');
            })
            .modal('show');
        });               
    }


    loadDataForEditPosition = function(idPosition) {
         $.ajax({
            type: 'GET',
            url: $('#ver-posicion').attr('href'),    
            data: {'positionId': idPosition},
            dataType: "JSON",
            success: function(response) 
            {
                if (response.success == true) {
                    console.log(response);
                    $('#position_id').val(response.posicion.id);
                    $('#nombre_posicion').val(response.posicion.nombre);
                    $('#abreviacion_posicion').val(response.posicion.abreviacion);
                }
            }
        });
    }


    // Metodo para editar datos de POSICIÓN
       
    var editPosition = function(idPosition) {

        addValidationRulesForms();

        $('#position-form').validate({
            
           rules:{
                nombre:{
                    required:true,
                    rangelength : [2,128]
                },
                abreviacion:{
                    required:true,
                    rangelength : [2,20]
                },
            },
            messages:{
                nombre:{
                    required: 'Este campo es obligatorio',
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                abreviacion:{
                    required: 'Este campo es obligatorio',
                    rangelength: 'Por favor ingrese entre [2, 20] caracteres',
                },
            },
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error');
            },
            success:function(element){
                element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });

        //$("#position-form")[0].reset();
        loadDataForEditPosition(idPosition);

        bootbox.dialog({
                    message: $('#position-form-div'),
                    buttons: {
                        success: {
                            label: "Actualizar",
                            className: "btn-primary",
                            callback: function () {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#position-form').valid()) 
                                {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#position-form").submit(function(e){
                                        var formData = new FormData(this);

                                        $.ajax({
                                            type: 'POST',
                                            url: $('#editar-posicion').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(responseServer) {
                                                //console.log(responseServer);
                                                if(responseServer.success == true) 
                                                {
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: responseServer.posicion.nombre + " ha sido Actualizado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                 callback: function () {
                                                                    $('.table').DataTable().ajax.reload();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#position-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                }else{
                                                     bootbox.dialog({
                                                        message: responseServer.errores,
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#position-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                   //updatepositionForm();
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                               bootbox.dialog({
                                                        message:" ¡Error al enviar datos al servidor!",
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#position-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#position-form").submit();
                                } else {
                                    return false;
                                }
                                return false;
                            }
                        }
                    },
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#position-form-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#position-form-div').hide().appendTo('#new-position-form');
            })
            .modal('show');
    }

       //Metodo para eliminar país de la BD.
    var deletePosition = function (idPosition) {
        bootbox.confirm("¿Esta seguro de eliminar la Posición?", function(result) {
            //console.log("Confirm result: "+result);
            if (result == true){
               $.ajax({
                type: 'GET',
                url: $('#eliminar-posicion').attr('href'),
                data: {'positionId': idPosition},
                dataType: "JSON",
                success: function(response) {
                    if (response.success == true) {
                        $('#eliminar_posicion_'+idPosition).parent().parent().remove();
                        bootbox.dialog({
                            message:" ¡Posición Eliminada!",
                            title: "Éxito",
                            buttons: {
                                success: {
                                    label: "Success!",
                                    className: "btn-success"
                                }
                            }
                        });
                    };
                }
            });
           };
       });
    }



    // Metodo para saber cual opcion(ver, editar, borrar) fue seleccionada de la lista de Paises
    var loadDataPosition = function() 
    {
        $('.table').click(function(event)
        {
            var target = $( event.target );
            if (target.is('a')) 
            {
                console.log($(target).attr('id'));

                var id = $(target).attr('id');
                var type = id ? id.split('_')[0] : '';
                var view = id ? id.split('_')[1] : '';
                var numberId = id ? id.split('_')[2] : '';

                if (view == "posicion") 
                {
                    if (type == "editar") {
                        editPosition(numberId);
                    }else if(type == "eliminar"){
                        deletePosition(numberId);
                    }
                }
            }           
        });
    }


    /**
     * 
    */

    var loadFieldSelect = function(url,idField) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                //console.log(response.data);
                if (response.success == true) {
                    jQuery(idField).html('');
                    jQuery(idField).append('<option value=\"\"></option>');
                    $.each(response.data,function (k,v){
                        jQuery(idField).append('<option value=\"'+k+'\">'+v+'</option>');
                        $(idField).trigger("chosen:updated");
                        $('.chosen-select').trigger("chosen:updated");
                    });
                }else{
                    jQuery(idField).html('');
                    jQuery(idField).append('<option value=\"\"></option>');
                }
            }
        });
    }

    return {
        init: function() {
            initChosen();
            loadFieldSelect($('#lista-posiciones').attr('href'),'#posicion_id');
            loadFieldSelect($('#lista-paises').attr('href'),'#pais_id');
            loadFieldSelect($('#lista-equipos').attr('href'),'#equipo_id');
            loadFieldSelect($('#lista-equipos').attr('href'),'#equipo_id_jugador');
            loadFieldSelect($('#lista-paises').attr('href'),'#pais_equipo');
            loadFieldSelect($('#lista-jugadores').attr('href'),'#jugadores');
            //initDataPicker();
            handleBootstrapFileInput();
            handleBootboxNewPlayer();
            handleBootboxNewTeam();
            handleBootboxNewCountry();
            handleBootboxNewPosition();

            loadDataPlayer();
            loadDataCountry();
            loadDataTeam();
            loadDataPosition();

            loadDataForEditTeam($('#equipo_id').val());
            loadSelectForTeam();
            loadSelectForPlayer();
            validateSelectPlayers($("#tipo_equipo option:selected" ).text());
            console.log($('#verificar-jugador-equipo').attr('href'));
        }
    }
}();