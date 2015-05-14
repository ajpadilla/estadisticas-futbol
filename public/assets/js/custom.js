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
        $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });

        $.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
        }, 'sólo letras, números y espacios.');

        $.validator.addMethod('customDateValidator', function(value, element) {
            try{
                jQuery.datepicker.parseDate('yy-mm-dd', value);return true;}
            catch(e){return false;}
        },'Por favor, Ingrese una fecha válida con el formato yy-mm-dd.');

        jQuery.validator.addMethod('decimalNumbers', function(value, element) {
            return this.optional(element) || /^\d{0,10}(\.\d{0,2})?$/i.test(value);
        }, 'Por favor ingrese maximo'+[10]+'digitos enteros'+'y maximo'+[2]+'digitos decimales');

        $.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
              return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, 'sólo letras, números y guiones.');
    }

    var updatePlayerForm = function() {
        loadFieldSelect($('#lista-posiciones').attr('href'),'#posiciones_id_jugador');
        loadFieldSelect($('#lista-paises').attr('href'),'#pais_id_jugador');
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
                    customDateValidator:true
                },
                lugar_nacimiento:{
                    rangelength: [2, 512],
                },
                altura:{
                    number: true
                },
                peso:{
                    number: true
                },
                apodo:{
                    rangelength: [2, 128],
                },
                posicion_id:{
                    required:true,
                },
                pais_id:{
                    required:true,
                },
                info_url:{
                     //url: true
                },
                historia:{
                    rangelength: [2, 512],
                },
                facebook_url:{
                    // url: true
                },
                twitter_url:{
                    // url: true
                }
            },
            messages:{
                nombre:{
                    required:'Este campo es obligatorio.',
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                lugar_nacimiento:{
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                altura:{
                    number: 'Ingrese un valor numerico'
                },
                peso:{
                    number: 'Ingrese un valor numerico'
                },
                apodo:{
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                posicion_id:{
                    required:'Este campo es obligatorio.',
                },
                pais_id:{
                   required:'Este campo es obligatorio.',
                },
                info_url:{
                     url: 'Por favor ingrese una url valida'
                },
                historia:{
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                facebook_url:{
                     url: 'Por favor ingrese una url valida'
                },
                twitter_url:{
                     url: 'Por favor ingrese una url valida'
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
            $("#player-form").trigger("reset");
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
                                            url: $('#add-player').attr('href'), 
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
                                                        message: responseServer.jugador.nombre + " Ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                 callback: function () {
                                                                    reloadDatatable();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#player-form")[0].reset();
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
        });               
    }

  
    var loadDataForEditPlayer = function(idPlayer) {
        $.ajax({
            type: 'GET',
            url: $('#data-player').attr('href'),    
            data: {'jugadorId': idPlayer},
            dataType: "JSON",
            success: function(response) {
                if (response.success) {
                    console.log(response);
                    $('#jugador_id').val(response.jugador.id);
                    $('#nombre_jugador').val(response.jugador.nombre);
                    $('#fecha_nacimiento').val(response.fechaNacimiento);
                    $('#lugar_nacimiento_jugador').val(response.jugador.lugar_nacimiento);
                    $('#altura').val(response.jugador.altura);
                    $('#peso_jugador').val(response.jugador.peso);
                    $('#apodo_jugador').val(response.jugador.apodo);
                    //$('#pais_id_jugador').val(response.jugador.pais_id);
                    $('.pais-jugador').val(response.pais.id);
                    /*$('#posicion_id').val(response.jugador.posicion_id);
                    $('#posicion_id').val(response.posicion.id);*/
                    $('#info_url_jugador').val(response.jugador.info_url);
                    $('#historia_jugador').val(response.jugador.historia);
                    $('#facebook_url_jugador').val(response.jugador.facebook_url);
                    $('#twitter_url_jugador').val(response.jugador.twitter_url);
                    $('#posicion_id').trigger("chosen:updated");
                    $('.pais-jugador').trigger("chosen:updated");
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
                            label: "Guardar",
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
                                            url: $('#update-player').attr('href'), 
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
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
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


    //Metodo para eliminar jugador de la BD.
    var deletePlayer = function (idPlayer) {
        bootbox.confirm("¿Esta seguro de eliminar al Jugador?", function(result) {
            //console.log("Confirm result: "+result);
            if (result == true){
               $.ajax({
                type: 'GET',
                url: $('#delete-player').attr('href'),
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
                                    className: "btn-success",
                                    callback: function () {
                                        reloadDatatable();
                                    }
                                }
                            }
                        });
                    };
                }
            });
           };
       });
    }

    // Metodo para ejecutar opciones(ver, editar, borrar) de la lista de Jugadores
    var implementActionsToPlayer = function() 
    {
        $(".table").delegate(".delete-player", "click", function() {
             action = getAttributeIdActionSelect($(this).attr('id'));
             deletePlayer(action.number);
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
        loadFieldSelect($('#lista-paises').attr('href'),'#pais_equipo');
       // $('.chosen-select').trigger("chosen:updated");
    }

      var handleBootboxNewTeam = function () {


       addValidationRulesForms();

        $('#team-form').validate({
              rules:{
                nombre:{
                    required:true,
                },
                apodo:{
                },
                fecha_fundacion:{
                    customDateValidator: true
                },
                tipo:{
                    required:true,
                },
                historia:{
                    rangelength: [2,512]
                },
                ubicacion:{
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
            $('#team-form').trigger('reset');
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
                                                console.log(responseServer);
                                                if(responseServer.success == true) 
                                                {
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: responseServer.equipo.nombre + " Ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#team-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#team-form")[0].reset();
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
                    //console.log(response);
                    $('#equipo_id').val(response.equipo.id);
                    $('#nombre_equipo').val(response.equipo.nombre);
                    $('#fecha_fundacion').val(response.equipo.fecha_fundacion)
                    $('#apodo').val(response.equipo.apodo);
                    $("select#tipo_equipo option").each(function() { this.selected = (this.text == response.equipo.tipo); });
                    $('#info_url').val(response.equipo.info_url);
                    $('#historia').val(response.equipo.historia);
                    $('#ubicacion').val(response.equipo.ubicacion);
                    $('#facebook_url_equipo').val(response.equipo.facebook_url);
                    $('#twitter_url_equipo').val(response.equipo.twitter_url);
                    $('select#pais_equipo').val(response.equipo.pais_id);
                    $('select#pais_equipo').trigger("chosen:updated");
                    $('.chosen-select').trigger("chosen:updated");
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
                },
                fecha_fundacion:{
                    customDateValidator: true
                },
                tipo:{
                    required:true,
                },
                historia:{
                    rangelength: [2,512]
                },
                ubicacion:{
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
       
        loadDataForEditTeam(idTeam);

        bootbox.dialog({
                    message: $('#team-form-div'),
                    buttons: {
                        success: {
                            label: "Guardar",
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
                                        //console.log($(this).serialize());
                                        $.ajax({
                                            type: 'POST',
                                            url: $('#editar-equipo').attr('href'), 
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
                                                        message: responseServer.equipo.nombre + " ha sido Actualizado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#team-form div').each(function(){
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
                                                    $('#team-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
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
                                    className: "btn-success",
                                    callback: function () {
                                        reloadDatatable();
                                    }
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
    var implementActionsToTeam = function() 
    {
        $(".table").delegate(".edit-team", "click", function() {
           action = getAttributeIdActionSelect($(this).attr('id'));
           editTeam(action.number);
        });

        $(".table").delegate(".delete-team", "click", function() {
           action = getAttributeIdActionSelect($(this).attr('id'));
           deleteTeam(action.number);
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
            $('#country-form').trigger('reset');
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
                                                        message: $('#nombre').val() + " Ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable();
                                                                }
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
                            label: "Guardar",
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
                            label: "Guardar",
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
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable();
                                                                }
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
                                    className: "btn-success",
                                    callback: function () {
                                        reloadDatatable();
                                    }
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
    var implementActionsToCountry = function() 
    {

        $(".table").delegate(".show-country", "click", function() {
           action = getAttributeIdActionSelect($(this).attr('id'));
           viewDataCountry(action.number);
        });

        $(".table").delegate(".edit-country", "click", function() {
           action = getAttributeIdActionSelect($(this).attr('id'));
           editCountry(action.number);
        });

        $(".table").delegate(".delete-country", "click", function() {
           action = getAttributeIdActionSelect($(this).attr('id'));
           deleteCountry(action.number);
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
            $("#position-form").trigger("reset");
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

                                //reloadDatatable();

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
                                                        message: responseServer.posicion.nombre + " Ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable();
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

        loadDataForEditPosition(idPosition);

        bootbox.dialog({
                    message: $('#position-form-div'),
                    buttons: {
                        success: {
                            label: "Guardar",
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
                                                                    reloadDatatable();
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
                                    className: "btn-success",
                                    callback: function () {
                                        reloadDatatable();
                                    }
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
    var implementActionsToPosition = function() {
        
        $(".table").delegate(".edit-position", "click", function() {
           action = getAttributeIdActionSelect($(this).attr('id'));
           editPosition(action.number);
        });

        $(".table").delegate(".delete-position", "click", function() {
           action = getAttributeIdActionSelect($(this).attr('id'));
           deletePosition(action.number);
        });
    }

/**
 ************************ ADD NEW JUGADOR TO EQUIPO *********************** 
*/    
var handleBootboxAddJugadorToEquipo = function () {

        //addValidationRulesForms();

        $('#equipo-add-jugador-form').validate({
            rules:{              
                numero:{
                    required:true,
                    number:true,
                    range: [1, 99],
                    remote: {
                        url: "/equipos/api-existe-numero",
                        type: "post",
                        data: {
                            id: function() {
                                return $("#equipo-add-jugador-form #id").val();
                            },
                            numero: function() {
                                return $( "#numero" ).val();
                            }
                        }
                    }                    
                },
                jugador_id:{
                    required:true,
                    remote: {
                        url: "/jugadores/api-existe",
                        type: "post",
                        data: {
                            jugador_id: function() {
                                return $("#equipo-add-jugador-form .chosen-select").val();
                            }
                        }
                    }                    
                }
            },
            messages:{          
                numero:{                    
                    remote: 'Este numero ya esta en uso!'
                },
                jugador_id:{
                   remote: 'Este jugador ya esta registrado para este equipo, para la fecha seleccionada!'
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
        $('#add-jugador').on('click', function() 
        {
            bootbox
                .dialog(
                {
                    message: $('#equipo-add-jugador-div-box'),
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
                                if($('#equipo-add-jugador-form').valid()) {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#equipo-add-jugador-form").submit(function(e){
                                        var formData = new FormData(this);
                                        $.ajax({
                                            type: 'POST',
                                            url: $('#add-jugador').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(response) {
                                                //console.log(responseServer);
                                                if(response.success) 
                                                {
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: " Ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Correcto!",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#equipo-add-jugador-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    //updatePlayerForm();
                                                }else{
                                                     bootbox.dialog({
                                                        message: response.errores,
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Ok!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#equipo-add-jugador-form div').each(function(){
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
                                                                label: "Mal!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#equipo-add-jugador-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    //updatePlayerForm();
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#equipo-add-jugador-form").submit();
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
                    $('#equipo-add-jugador-div-box')
                        .show();                             // Show the form
                })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#equipo-add-jugador-div-box').hide().appendTo('#equipo-add-jugador-div');
            })
            .modal('show');
        });               
    }


/**
 ************************ ADD NEW EQUIPO TO JUGADOR *********************** 
*/
var handleBootboxAddEquipoToJugador = function () {

        //addValidationRulesForms();

        $('#jugador-add-equipo-form').validate({
            rules:{              
                numero:{
                    required:true,
                    number:true,
                    range: [1, 99],
                    remote: {
                        url: "/equipos/api-existe-numero",
                        type: "post",
                        data: {
                            id: function() {
                                return $("#jugador-add-equipo-form .chosen-select").val()
                            },
                            numero: function() {
                                return $( "#numero" ).val();
                            }
                        }
                    }                    
                },
                equipo_id:{
                    required:true,
                    remote: {
                        url: "/equipos/api-existe",
                        type: "post",
                        data: {
                            equipo_id: function() {
                                return $("#equipo-add-jugador-form .chosen-select").val();
                            }
                        }
                    }                    
                }
            },
            messages:{          
                numero:{                    
                    remote: 'Este numero ya esta en uso!'
                },
                equipo_id:{
                   remote: 'Este equipo ya esta registrado para este jugador, para la fecha seleccionada!'
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
        $('#add-equipo').on('click', function() 
        {
            bootbox
                .dialog(
                {
                    message: $('#jugador-add-equipo-div-box'),
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
                                if($('#jugador-add-equipo-form').valid()) {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#jugador-add-equipo-form").submit(function(e){
                                        var formData = new FormData(this);
                                        $.ajax({
                                            type: 'POST',
                                            url: $('#add-equipo').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(response) {
                                                //console.log(responseServer);
                                                if(response.success) 
                                                {
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: " Ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Correcto!",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#jugador-add-equipo-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    //updatePlayerForm();
                                                }else{
                                                     bootbox.dialog({
                                                        message: response.errores,
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Ok!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#jugador-add-equipo-form div').each(function(){
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
                                                                label: "Mal!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#jugador-add-equipo-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    //updatePlayerForm();
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#jugador-add-equipo-form").submit();
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
                    $('#jugador-add-equipo-div-box')
                        .show();                             // Show the form
                })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#jugador-add-equipo-div-box').hide().appendTo('#jugador-add-equipo-div');
            })
            .modal('show');
        });               
    }



    /**
     * Funciones para CRUD TIPO DE COMPETENCIA
     */

    var handleBootboxNewTypeOfCompetition= function () {


       addValidationRulesForms();

        $('#type-of-competition-form').validate({
              rules:{
                nombre:{
                    required: true,
                    rangelength : [2,128]
                },
                grupos:{
                    digits: true,
                    rangelength: [1,6]
                },
                fases_eliminatorias:{
                    digits: true,
                    rangelength: [1,6]
                },
                ida_vuelta:{

                },
                pre_clasificacion:{

                },
                equipos_por_grupo:{
                    digits: true,
                    rangelength: [1,6]
                },
                ascenso:{
                    digits: true,
                    rangelength: [1,6]
                },
                descenso:{
                    digits: true,
                    rangelength: [1,6]
                },
                clasificados_por_grupo:{
                    digits: true,
                    rangelength: [1,6]
                }
            },
            messages:{
                nombre:{
                    required: 'Este campo es obligatorio',
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                grupos:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros'
                },
                fases_eliminatorias:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros'
                },
                ida_vuelta:{
                },
                pre_clasificacion:{
                },
                equipos_por_grupo:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros'
                },
                ascenso:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros' 
                },
                descenso:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros'
                },
                clasificados_por_grupo:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros'
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

        // Mostrar formulario para agregar nueva Posición
        $('#new-type-of-competition').on('click', function() {
            $("#type-of-competition-form").trigger("reset");
            bootbox
                .dialog({
                    message: $('#type-of-competition-form-div'),
                    buttons: {
                        success: {
                            label: "Guardar",
                            className: "btn-primary",
                            callback: function () 
                            {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#type-of-competition-form').valid()) {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#type-of-competition-form").submit(function(e){
                                        var formData = new FormData(this);
                                        $.ajax({
                                            type: 'POST',
                                            url: $('#agregar-tipo-competencia').attr('href'), 
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
                                                        message: responseServer.tipoCompetencia.nombre + " Ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#type-of-competition-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#type-of-competition-form")[0].reset();
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
                                                    $('#type-of-competition-form div').each(function(){
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
                                                    $('#type-of-competition-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#type-of-competition-form").submit();
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
                    $('#type-of-competition-form-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#type-of-competition-form-div').hide().appendTo('#new-type-of-competition-form');
            })
            .modal('show');
        });               
    }


    loadDataForTypeCompetition = function(idTypeCompetition) {
         $.ajax({
            type: 'GET',
            url: $('#ver-tipo-competencia').attr('href'),    
            data: {'typeCompetitionId': idTypeCompetition},
            dataType: "JSON",
            success: function(response) 
            {
                if (response.success == true) {
                    console.log(response);
                    $('#tipo_competencia_id').val(response.tipoCompetencia.id);
                    $('#nombre-tipo-competicion').val(response.tipoCompetencia.nombre);
                    $('#grupos-tipo-competicion').val(response.tipoCompetencia.grupos);
                    $('#fases-eliminatorias-tipo-competicion').val(response.tipoCompetencia.fases_eliminatorias);
                    $('input[name="ida_vuelta"]').prop('checked', response.tipoCompetencia.ida_vuelta);
                    $('input[name="pre_clasificacion"]').prop('checked', response.tipoCompetencia.pre_clasificacion);
                    $('#equipos-por-grupo-tipo-competicion').val(response.tipoCompetencia.equipos_por_grupo);
                    $('#ascenso-tipo-competicion').val(response.tipoCompetencia.ascenso);
                    $('#descenso-tipo-competicion').val(response.tipoCompetencia.descenso);
                    $('#clasificados-por-grupo-tipo-competicion').val(response.tipoCompetencia.clasificados_por_grupo);
                }
            }
        });
    }

     // Metodo para editar datos de TIPO DE COMPETENCIA
       
    var editTypeOfCompetition = function(idTypeCompetition) {

        addValidationRulesForms();

        $('#type-of-competition-form').validate({
            
           rules:{
                nombre:{
                    required: true,
                    rangelength : [2,128]
                },
                grupos:{
                    digits: true,
                    rangelength: [1,6]
                },
                fases_eliminatorias:{
                    digits: true,
                    rangelength: [1,6]
                },
                ida_vuelta:{
                },
                pre_clasificacion:{
                },
                equipos_por_grupo:{
                    digits: true,
                    rangelength: [1,6]
                },
                ascenso:{
                    digits: true,
                    rangelength: [1,6]
                },
                descenso:{
                    digits: true,
                    rangelength: [1,6]
                },
                clasificados_por_grupo:{
                    digits: true,
                    rangelength: [1,6]
                }
            },
            messages:{
                nombre:{
                    required: 'Este campo es obligatorio',
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                grupos:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros'
                },
                fases_eliminatorias:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros'
                },
                ida_vuelta:{
                },
                pre_clasificacion:{

                },
                equipos_por_grupo:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros'
                },
                ascenso:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros' 
                },
                descenso:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros'
                },
                clasificados_por_grupo:{
                    digits: 'Por vafor ingrese un valor entero',
                    rangelength: 'Por favor ingrese entre [1, 6] digitos enteros'
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

        loadDataForTypeCompetition(idTypeCompetition);

        bootbox.dialog({
                    message: $('#type-of-competition-form-div'),
                    buttons: {
                        success: {
                            label: "Guardar",
                            className: "btn-primary",
                            callback: function () {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#type-of-competition-form').valid()) 
                                {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#type-of-competition-form").submit(function(e){
                                        var formData = new FormData(this);
                                        $.ajax({
                                            type: 'POST',
                                            url: $('#editar-tipo-competencia').attr('href'), 
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
                                                        message: responseServer.tipoCompetencia.nombre + " ha sido Actualizado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                 callback: function () {
                                                                    reloadDatatable();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#type-of-competition-form div').each(function(){
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
                                                    $('#type-of-competition-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
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
                                                    $('#type-of-competition-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#type-of-competition-form").submit();
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
                    $('#type-of-competition-form-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#type-of-competition-form-div').hide().appendTo('#new-type-of-competition-form');
            })
            .modal('show');
    }


    //Metodo para eliminar Tipo de competencía de la BD.
    var deleteTypeOfCompetition= function (idTypeCompetition) {
        
        bootbox.confirm("¿Esta seguro de eliminar el tipo de competencía?", function(result) {
            //console.log("Confirm result: "+result);
            if (result == true){
               $.ajax({
                type: 'GET',
                url: $('#eliminar-tipo-competencia').attr('href'),
                data: {'typeCompetitionId': idTypeCompetition},
                dataType: "JSON",
                success: function(response) {
                    if (response.success == true) {
                        $('#eliminar_jugador_'+idTypeCompetition).parent().parent().remove();
                        bootbox.dialog({
                            message:" ¡Tipo competencía Eliminada!",
                            title: "Éxito",
                            buttons: {
                                success: {
                                    label: "Success!",
                                    className: "btn-success",
                                    callback: function () {
                                        reloadDatatable();
                                    }
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
    var implementActionsToTypeCompetition = function() 
    {
        $(".table").delegate(".edit-type-competition", "click", function() {
            action = getAttributeIdActionSelect($(this).attr('id'));
            editTypeOfCompetition(action.number);
        });

        $(".table").delegate(".delete-type-competition", "click", function() {
           action = getAttributeIdActionSelect($(this).attr('id'));
           deleteTypeOfCompetition(action.number);
        });
    }

    /**
      * 
    */
   

    /**
     * Funciones para CRUD COMPETENCIAS
     */

    var handleBootboxNewCompetition= function () {


       addValidationRulesForms();

        $('#competition-form').validate({
              rules:{
                nombre:{
                    required: true,
                    rangelength : [2,128]
                },
                desde:{
                    required:true,
                    customDateValidator:true,
                },
                hasta:{
                    required:true,
                    customDateValidator:true,
                },
                tipo_competencia_id:{
                    required:true
                }
            },
            messages:{
                nombre:{
                    required: 'Este campo es obligatorio',
                    rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                },
                desde:{
                    required: 'Este campo es obligatorio',
                },
                hasta:{
                     required: 'Este campo es obligatorio',
                },
                tipo_competencia_id:{
                     required: 'Este campo es obligatorio',
                }
            },
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                 $(element).closest('.control-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error');
                $(element).closest('.control-group').removeClass('has-error');
            },
            success:function(element){
                element.addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
                element.addClass('valid').closest('.control-group').removeClass('has-error').addClass('has-success');
            }
        });

        var updateCompetitionForm = function() {
            $("#competition-form").trigger("reset");
            loadFieldSelect($('#lista-tipos-competencias').attr('href'),'#tipos-competencias');
        }

        // Mostrar formulario para agregar nueva Posición
        $('#new-competition').on('click', function() {
            updateCompetitionForm();
            bootbox
                .dialog({
                    message: $('#competition-form-div'),
                    buttons: {
                        success: {
                            label: "Guardar",
                            className: "btn-primary",
                            callback: function () 
                            {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#competition-form').valid()) {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#competition-form").submit(function(e){
                                        var formData = new FormData(this);
                                        $.ajax({
                                            type: 'POST',
                                            url: $('#agregar-competencia').attr('href'), 
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
                                                        message: responseServer.competencia.nombre + " Ha sido agregado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable();
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#competition-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#competition-form")[0].reset();
                                                    updateCompetitionForm();
                                                    enableCountryToCompetition();
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
                                                    $('#competition-form div').each(function(){
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
                                                    $('#competition-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#competition-form").submit();
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
                    $('#competition-form-div')
                        .show();                             // Show the form
            })
            .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#competition-form-div').hide().appendTo('#new-competition-form');
            })
            .modal('show');
        });               
    }

     //Metodo para eliminar Tipo de competencía de la BD.
    var deleteCompetition= function (idCompetition) {
        
        bootbox.confirm("¿Esta seguro de eliminar competencía?", function(result) {
            //console.log("Confirm result: "+result);
            if (result == true){
               $.ajax({
                type: 'GET',
                url: $('#eliminar-competencia').attr('href'),
                data: {'competitionId': idCompetition},
                dataType: "JSON",
                success: function(response) {
                    if (response.success == true) {
                        $('#eliminar_competencia_'+idCompetition).parent().parent().remove();
                        bootbox.dialog({
                            message:" ¡Competencía Eliminada!",
                            title: "Éxito",
                            buttons: {
                                success: {
                                    label: "Success!",
                                    className: "btn-success",
                                    callback: function () {
                                        reloadDatatable();
                                    }
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
    var implementActionsToCompetitions = function() 
    {
        $(".table").delegate(".delete-competition", "click", function() {
             action = getAttributeIdActionSelect($(this).attr('id'));
             deleteCompetition(action.number);
        });
    }


    var getAttributeIdActionSelect = function (id) {
        var action = new Object(); 
        action.typeAction = id ? id.split('_')[0] : '';
        action.view = id ? id.split('_')[1] : '';
        action.number = id ? id.split('_')[2] : '';
        return action;
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
                        $(idField).trigger("chosen:updated");
                    });
                }else{
                    jQuery(idField).html('');
                    jQuery(idField).append('<option value=\"\"></option>');
                }
            }
        });
    }

    var loadFieldSelectPaises = function(url,idField) {
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
                        $(idField).trigger("chosen:updated");
                    });
                }else{
                    jQuery(idField).html('');
                    jQuery(idField).append('<option value=\"\"></option>');
                }
            }
        });
    }

    /*
    ********************* PLUGINS ***********************************
    */
    /*-----------------------------------------------------------------------------------*/
    /*  Date Range Picker
    /*-----------------------------------------------------------------------------------*/
    var handleDatePicker = function () {
        $(".datepicker").datetimepicker({
            lang: 'es',
            timepicker: false,
            format: 'Y-m-d',
            yearStart: '1850',
            todayButton: true,
            mask: true,
            closeOnDateSelect: true
        });
    }

    var handleFechaDateTimePicker = function () {

        /*$('#fecha').daterangepicker();
        {
               ranges: {
                  'Ayer': [moment().subtract('days', 1), moment().subtract('days', 1)],
                  'Últimos 30 días': [moment().subtract('days', 29), moment()],
                  'Este mes': [moment().startOf('month'), moment().endOf('month')]
               },
               buttonClasses: ['btn btn-default'],
               applyClass: 'btn-small btn-primary',
               cancelClass: 'btn-small',
               format: 'YYYY-MM-DD',
               separator: '<->',
               locale: {
                   applyLabel: 'Seleccionar',
                   fromLabel: 'Desde',
                   toLabel: 'Hasta',
                   customRangeLabel: 'Personalizado',
                   daysOfWeek: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes','Sábado'],
                   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                   firstDay: 1
               }
            },
            function(start, end) {
             //console.log("Callback has been called!");
             $('#fecha span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
         );
         //Set the initial state of the picker label
         $('#fecha span').html('Custom');*/
    }    

    var reloadDatatable = function (table) {
        var table = typeof table !== 'undefined' ? table : 'datatable';
        if($(table).length) {
            var table = $(table).DataTable();
            table.search('').draw();
        }
    }

    var loadSelectForPlayer = function(idPlayer) {
        $.ajax({
            type: 'GET',
            url: $('#data-player').attr('href'),    
            data: {'jugadorId': idPlayer},
            dataType: "JSON",
            success: function(response) {
                console.log(response);
                if (response.success) 
                {
                    $('select#posicion_id_jugador_edit').html('');
                    $('select#posicion_id_jugador_edit').append('<option value=\"\"></option>');
                    $('#fecha_nacimiento_edit').val(response.jugador.fecha_nacimiento);
                    $('#posiciones_id_jugador_edit').val(response.posiciones);
                    $.each(response.posicionesSelect,function (k,v){
                        $('select#posicion_id_jugador_edit').append('<option value=\"'+v.id+'\">'+v.nombre+'</option>');
                        $('select#posicion_id_jugador_edit').trigger("chosen:updated");
                        $('#posiciones_id_jugador_edit').trigger("chosen:updated");
                        console.log(v.id);
                        console.log(v.nombre)
                    });
                    $('select#posicion_id_jugador_edit').val(response.posicion.id);
                    $('#pais_id_jugador_edit').val(response.pais.id);
                    $('select#pais_id_jugador_edit').trigger("chosen:updated");
                    $('select#posicion_id_jugador_edit').trigger("chosen:updated");
                }
            }
        });
    }

    var loadPositionSelectPlayerCreate = function() 
    {
        $('.posiciones-jugador').change(function() {
            $('select#posicion_id_jugador').html('');
            $('select#posicion_id_jugador').append('<option value=\"\"></option>');
            $("select#posiciones_id_jugador option:selected" ).each(function() {
                /*console.log($(this).text());
                console.log($(this).val());*/
                $('select#posicion_id_jugador').append('<option value=\"'+$(this).val()+'\">'+$(this).text()+'</option>');
                $('select#posicion_id_jugador').trigger("chosen:updated");
            });
        });
     }
    
     var loadPositionSelectPlayerEdit = function() 
    {
        $('.posiciones-jugador').change(function() {
            $('select#posicion_id_jugador_edit').html('');
            $('select#posicion_id_jugador_edit').append('<option value=\"\"></option>');
            $("select#posiciones_id_jugador_edit option:selected" ).each(function() {
                /*console.log($(this).text());
                console.log($(this).val());*/
                $('select#posicion_id_jugador_edit').append('<option value=\"'+$(this).val()+'\">'+$(this).text()+'</option>');
                $('select#posicion_id_jugador_edit').trigger("chosen:updated");
            });
        });
     }
    

     var enableCountryToCompetition = function () {
        $("select#pais-competencias").prop('disabled', false);
        $('select#pais-competencias').trigger("chosen:updated");
        $('input[name="internacional"]').click(function() {  
            if($('input[name="internacional"]').is(':checked')) { 
                console.log('entro');
                $("select#pais-competencias").prop('disabled', true);  
                $('select#pais-competencias').trigger("chosen:updated"); 
            } else {  
                console.log('salio');
                $("select#pais-competencias").prop('disabled', false);
                $('select#pais-competencias').trigger("chosen:updated");   
            }  
        }); 
     }

    loadDataForBladeEditTeam = function(idTeam) {
         $.ajax({
            type: 'GET',
            url: $('#ver-equipo').attr('href'),    
            data: {'equipoId': idTeam},
            dataType: "JSON",
            success: function(response) 
            {
                
                if (response.success == true) {
                    /*console.log(response);
                    console.log(idTeam);*/
                    $("select#tipo_equipo_edit option").each(function() { this.selected = (this.text == response.equipo.tipo); });
                    $('#pais_id_equipo_edit').val(response.equipo.pais_id);
                    $('#pais_id_equipo_edit').trigger("chosen:updated");
                    $("#tipo_equipo_edit").trigger("chosen:updated");
                    $('.chosen-select').trigger("chosen:updated");
                }
            }
        });
    }


    var loadFilter = function () {
        $("#autocomplete-select-1").select2({
            containerCssClass: 'tpx-select2-container select2-container-lg',
            dropdownCssClass: 'tpx-select2-drop',
            placeholder: "Select an option",
            minimumInputLength: 1,
            language: "en",
            //multiple: true,
            ajax: {
                url: "filterAjax",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                        term: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, page) {
                    //return { results: data.items };
                    return {
                        results: $.map(data.items , function (item) {
                            return {
                                text: item.nombre,
                                id: item.id
                            }
                        })
                    };
                },
                success: function (results) {
                    console.log(results);
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            formatResult: function (data) {
                return  data.items;
            },
            formatSelection: function (data) {
                return data.items;
            }
        });

        $( "#select-autocomplete" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "filterAjax/"+request.term+"/",
                    dataType: "json",
                    beforeSend: function(){$('ul.chzn-results').empty();},
                    success: function( data ) {
                        response( $.map( data, function( item ) {
                            $('ul.chzn-results').append('<li class="active-result">' + item.name + '</li>');
                        }));
                        console.log(data);
                    }
                });
            },
            minLength: 2,
            select: function( event, ui ) {
                console.log(ui);
                log( ui.item ?
                "Selected: " + ui.item.value + " aka " + ui.item.id :
                "Nothing selected, input was " + this.value );
            }
        });
    }


    var showTipeComptetitionInfo = function (url, idTypeCompetition) {
        $.ajax({
            type: 'GET',
            url: url,    
            data: {'typeCompetitionId': idTypeCompetition},
            dataType: "JSON",
            success: function(response) {
                if (response.success) {
                    console.log(response);
                    $('#type-competition-name-show').html('<strong>'+ response.tipoCompetencia.nombre +'</strong>');
                    $('#type-competition-group-show').html('<strong>'+ response.tipoCompetencia.grupos +'</strong>');
                    $('#type-competition-phases-show').html('<strong>'+ response.tipoCompetencia.fases_eliminatorias +'</strong>');
                    $('#type-competition-round-trip-show').html('<strong>'+ response.tipoCompetencia.ida_vuelta +'</strong>');
                    $('#type-competition-pre-classification-show').html('<strong>'+ response.tipoCompetencia.pre_clasificacion +'</strong>');
                    $('#type-competition-teams-group-show').html('<strong>'+ response.tipoCompetencia.equipos_por_grupo +'</strong>');
                    $('#type-competition-ascent-show').html('<strong>'+ response.tipoCompetencia.ascenso +'</strong>');
                    $('#type-competition-descent-show').html('<strong>'+ response.tipoCompetencia.descenso +'</strong>');
                    $('#type-competition-classified-group-show').html('<strong>'+ response.tipoCompetencia.clasificados_por_grupo +'</strong>');
                    showPopUpDataForTypeCompetition();
                }              
            }
        });
    }

    var showPopUpDataForTypeCompetition = function () {
        bootbox.dialog({
            message: $('#show-type-of-competition-form-div'),
            buttons: {
                success: {
                    label: "Ok",
                    className: "btn-primary",
                    callback: function () {

                    }
                }
            },
                    show: false // We will show it manually later
                })
        .on('shown.bs.modal', function() {
            $('#show-type-of-competition-form-div')
                        .show();                             // Show the form
                    })
        .on('hide.bs.modal', function(e) {
                // Bootbox will remove the modal (including the body which contains the form)
                // after hiding the modal
                // Therefor, we need to backup the form
                $('#show-type-of-competition-form-div').hide().appendTo('#view-type-of-competition-form');
            })
        .modal('show');
    }   

    var loadTypeComptetitionInfo = function () {
        $('a#show-competition-type').click(function (event) {
            /*console.log('id:'+$(this).attr('href'));
            console.log('idNumber:'+$(this).attr('href').split('?')[1]);*/
            var url = $(this).attr('href').split('?')[0];
            var id = $(this).attr('href').split('?')[1];
            showTipeComptetitionInfo(url, id);
            event.preventDefault();
        });
    }


    var selectTeamsForCompetition = function(idCompetition) {
        //console.log($(this).val());
            $.ajax({
                type: 'GET',
                url: $('#list-of-teams-for-competition').attr('href'),
                data: {'competitionId': idCompetition},
                dataType:'json',
                success: function(response) {
                    console.log(response.teams);
                    if (response.success == true) {
                        jQuery('#competition-new-teams-ids').html('');
                        jQuery('#competition-new-teams-ids').append('<option value=\"\"></option>');
                        $.each(response.teams,function (k,v){
                            $('#competition-new-teams-ids').append('<option value=\"'+k+'\">'+v+'</option>');
                            $('#competition-new-teams-ids').trigger("chosen:updated");
                        });
                    }else{
                        jQuery('#competition-new-teams-ids').html('');
                        jQuery('#competition-new-teams-ids').append('<option value=\"\"></option>');
                    }
                }
            });
    }

    var showPopUpToAddNewGroup = function () {
        $('button#add-group').click(function () {

            addValidationRulesForms();
            selectTeamsForCompetition($(this).attr('value'));
            $('#add-group-to-competition-form').validate({
                rules:{
                    name:{
                        required:true,
                        rangelength: [2, 128],
                        onlyLettersNumbersAndSpaces: true
                    },
                    competition_id:{
                        required: true
                    },
                    'teams_ids[]':{
                        required: true
                    }
                },
                messages:{
                    nombre:{
                        required:'Este campo es obligatorio.',
                        rangelength: 'Por favor ingrese entre [2, 128] caracteres',
                    },
                    competition_id:{
                        required:'Este campo es obligatorio.',
                    },
                    teams_ids:{
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
                },
                submitHandler: function(form) {
                    // do other things for a valid form
                    form.submit();
                }
            });

            bootbox.dialog({
                    message: $('#add-group-to-competition-form-div'),
                    buttons: {
                        success: {
                            label: "Agregar",
                            className: "btn-primary",
                            callback: function () {
                                if($('#add-group-to-competition-form').valid()) {
                                    $('#add-group-to-competition-form').submit();
                                }else{
                                    return false;
                                }
                                return false;
                            }
                        }
                    },
                        show: false // We will show it manually later
                    })
                .on('shown.bs.modal', function() {
                    $('#add-group-to-competition-form-div')
                            .show();                             // Show the form
                        })
                .on('hide.bs.modal', function(e) {
                    // Bootbox will remove the modal (including the body which contains the form)
                    // after hiding the modal
                    // Therefor, we need to backup the form
                    $('#add-group-to-competition-form-div').hide().appendTo('#add-group-to-competition');
                })
                .modal('show');
        });
    }



     var selectTeamsForGroup = function(idCompetition) {
        //console.log($(this).val());
            $.ajax({
                type: 'GET',
                url: $('#list-of-teams-for-competition').attr('href'),
                data: {'competitionId': idCompetition},
                dataType:'json',
                success: function(response) {
                    console.log(response.teams);
                    if (response.success == true) {
                        jQuery('#new-teams-for-groups-ids').html('');
                        jQuery('#new-teams-for-groups-ids').append('<option value=\"\"></option>');
                        $.each(response.teams,function (k,v){
                            $('#new-teams-for-groups-ids').append('<option value=\"'+k+'\">'+v+'</option>');
                            $('#new-teams-for-groups-ids').trigger("chosen:updated");
                        });
                    }else{
                        jQuery('#new-teams-for-groups-ids').html('');
                        jQuery('#new-teams-for-groups-ids').append('<option value=\"\"></option>');
                    }
                }
            });
    }

    var showPopUpToAddTeamToGroupCompetition = function () {
        /*$('button.teams').click(function() {
            console.log('competitionId:' + $(this).attr('value'));
            console.log('gruposId:' + $(this).attr('grupo'));
            $('#group_id').val($(this).attr('grupo'));
            addValidationRulesForms();
            popUpDataForTypeCompetition();
            selectTeamsForGroup($(this).attr('value'));
        });*/

        $(".box-body.big").delegate(".teams", "click", function() {
            console.log('competitionId:' + $(this).attr('value'));
            console.log('gruposId:' + $(this).attr('data-group-id'));

            $('#group_id').val($(this).attr('data-group-id'));
            popUpDataForTypeCompetition($(this).attr('data-group-id'));
            selectTeamsForGroup($(this).attr('value'));
        });

    }

    var popUpDataForTypeCompetition = function (groupId) {
        addValidationRulesForms();
        $('#add-team-to-group-form').validate({
                rules:{
                    'teams_ids[]':{
                        required: true
                    }
                },
                messages:{
                    'teams_ids[]':{
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
                },
            });

            
            bootbox.dialog({
                    message: $('#add-teams-to-group-form-div'),
                    buttons: {
                        success: {
                            label: "Agregar",
                            className: "btn-primary",
                            callback: function () {
                                if($('#add-team-to-group-form').valid()) {
                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#add-team-to-group-form").submit(function(e){
                                        var formData = new FormData(this);
                                        $.ajax({
                                            type: 'POST',
                                            url: $('#add-new-teams-to-group').attr('href'), 
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
                                                        message: responseServer.group.name + " Ha sido actualizado correctamente!",
                                                        title: "Éxito",
                                                        buttons: {
                                                            success: {
                                                                label: "Success!",
                                                                className: "btn-success",
                                                                callback: function () {
                                                                    reloadDatatable('#datatable-'+groupId);
                                                                }
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#add-team-to-group-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#add-team-to-group-form")[0].reset();
                                                    enableCountryToCompetition();
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
                                                    $('#add-team-to-group-form div').each(function(){
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
                                                    $('#add-team-to-group-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#add-team-to-group-form").submit();
                                }else{
                                    return false;
                                }
                                return false;
                            }
                        }
                    },
                        show: false // We will show it manually later
                    })
                .on('shown.bs.modal', function() {
                    $('#add-teams-to-group-form-div')
                            .show();                             // Show the form
                        })
                .on('hide.bs.modal', function(e) {
                    // Bootbox will remove the modal (including the body which contains the form)
                    // after hiding the modal
                    // Therefor, we need to backup the form
                    $('#add-teams-to-group-form-div').hide().appendTo('#add-teams-to-group');
                })
                .modal('show');
    }

    return {
        init: function() {
            initChosen();

            loadFieldSelect($('#lista-posiciones').attr('href'),'#posiciones_id_jugador_edit');
            loadFieldSelect($('#lista-paises').attr('href'),'#pais_id_jugador_edit');
            
            $('a#edit-player').click(function () {
                console.log('edit-player');
                loadSelectForPlayer($('#jugador_id_edit').val());
            });

            if($('#equipo_id_edit').val() != null){
                loadFieldSelect($('#lista-paises').attr('href'),'#pais_id_equipo_edit');
                loadDataForBladeEditTeam($('#equipo_id_edit').val());
            }
                
                
            loadFieldSelect($('#lista-equipos').attr('href'),'#equipo_id');
            loadFieldSelect($('#lista-equipos').attr('href'),'#equipo_id_jugador');

            loadFieldSelect($('#lista-paises').attr('href'),'#pais_equipo');
            //loadFieldSelect($('#list-players').attr('href'),'#jugadores');
            loadFieldSelect($('#lista-tipos-competencias').attr('href'),'#tipos-competencias');
            loadFieldSelect($('#lista-paises').attr('href'),'#pais-competencias');

            //initDataPicker();
            
            handleBootstrapFileInput();
            handleBootboxNewPlayer();
            handleBootboxNewTeam();
            handleBootboxNewCountry();
            handleBootboxNewPosition();
            handleBootboxNewTypeOfCompetition();
            handleBootboxAddEquipoToJugador();
            handleBootboxAddJugadorToEquipo();
            handleBootboxNewCompetition();

            //Plugins init
            //handleFechaDateTimePicker();
            handleDatePicker();

            //Methods to perform actions on each model
            implementActionsToPlayer();
            implementActionsToTeam();
            implementActionsToCountry();
            implementActionsToPosition();
            implementActionsToTypeCompetition();
            implementActionsToCompetitions();


            loadPositionSelectPlayerCreate();
            loadPositionSelectPlayerEdit();

            enableCountryToCompetition();

            loadFilter();
            loadTypeComptetitionInfo();
            showPopUpToAddNewGroup();
            showPopUpToAddTeamToGroupCompetition();
        }
    }
}();