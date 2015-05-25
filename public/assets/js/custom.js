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
        },'Por favor, Ingrese una fecha válida con el formato yy-mm-dd .');


        $.validator.addMethod('customDateTimeValidator', function(value, element) {
            try{
                jQuery.datepicker.parseDate('yy-mm-dd h:i', value);return true;}
            catch(e){return false;}
        },'Por favor, Ingrese una fecha válida con el formato yy-mm-dd h:m:s.');


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
                                                        message: responseServer.errors,
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
                                        $(this).unbind('submit');
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
                                                        message:responseServer.errors,
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
                                                        message:responseServer.errors,
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
                                        $(this).unbind('submit');
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
                                                        message: responseServer.errors,
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
                                        $(this).unbind('submit'); 
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
                                                        message:responseServer.errors,
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
                                        $(this).unbind('submit');
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
                                                        message: responseServer.errors,
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
                                                        message: response.errors,
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
                                        $(this).unbind('submit');
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
                                                        message: response.errors,
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
                                        $(this).unbind('submit');
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
                                                        message:responseServer.errors,
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
                                        $(this).unbind('submit'); 
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
                                                        message: responseServer.errors,
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
                                                        message:responseServer.errors,
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
                                        $(this).unbind('submit'); 
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

        $(".datepicker-time").datetimepicker({
            lang: 'es',
            timepicker: true,
            step: 5,
            format: 'Y-m-d H:i',
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
        $('input[name="international"]').click(function() {  
            if($('input[name="international"]').is(':checked')) { 
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


    var selectTeamsForCompetition = function(id,url) {
        //console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                dataType:'json',
                success: function(response) {
                    if (response.success == true) {
                        jQuery(id).html('');
                        jQuery(id).append('<option value=\"\"></option>');
                        $.each(response.data, function (k, team){
                            $(id).append('<option value=\"'+team.id+'\">'+team.name+'</option>');
                            $(id).trigger("chosen:updated");
                        });
                    }else{
                        jQuery(id).html('');
                        jQuery(id).append('<option value=\"\"></option>');
                    }
                }
            });
    }

    var handleBootboxAddNewGroupToPhase = function () {
        $('button.group').click(function () {

            var phaseId = $(this).attr('data-phase-id');
            //console.log(phaseId);
            var url = $('#list-teams-phase-competition').attr('href').split('%')[0]+phaseId;
            selectTeamsForCompetition('#phase-new-teams-ids',url);
            addValidationRulesForms();
            $('#add-group-to-phase-form').validate({
                rules:{
                    name:{
                        required:true,
                        rangelength: [2, 128],
                    }
                },
                messages:{
                    nombre:{
                        required:'Este campo es obligatorio.',
                        rangelength: 'Por favor ingrese entre [2, 128] caracteres',
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
                    message: $('#add-group-to-phase-form-div'),
                    buttons: {
                        success: {
                            label: "Agregar",
                            className: "btn-primary",
                            callback: function () 
                            {
                                if($('#add-group-to-phase-form').valid()) 
                                {
                                    $("#add-group-to-phase-form").submit(function(e){
                                        var formData = {
                                            name: $('#name-new-group-to-phase').val(),
                                            phase_id: phaseId,
                                            teams_ids: $('#phase-new-teams-ids').val()
                                        }
                                        $.ajax({
                                            type: 'POST',
                                            url: $('#add-new-group-to-phase').attr('href'), 
                                            data: formData,
                                            dataType: "JSON",
                                            success: function(responseServer) {
                                                console.log(responseServer);
                                                if(responseServer.success == true) 
                                                {
                                                    // Muestro otro dialog con información de éxito
                                                    bootbox.dialog({
                                                        message: responseServer.group.name + " ha sido agregado correctamente!",
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
                                                    $('#add-group-to-phase-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#add-group-to-phase-form")[0].reset();
                                                    location.reload();
                                                }else{
                                                    console.log(responseServer);
                                                     bootbox.dialog({
                                                        message:responseServer.errors,
                                                        title: "Error",
                                                        buttons: {
                                                            danger: {
                                                                label: "Danger!",
                                                                className: "btn-danger"
                                                            }
                                                        }
                                                    });
                                                    // Limpio cada elemento de las clases añadidas por el validator
                                                    $('#add-group-to-phase-form div').each(function(){
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
                                                    $('#add-group-to-phase-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                        $(this).unbind('submit');
                                    }); 
                                    $("#add-group-to-phase-form").submit();
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
                    $('#add-group-to-phase-form-div')
                            .show();                             // Show the form
                        })
                .on('hide.bs.modal', function(e) {
                    // Bootbox will remove the modal (including the body which contains the form)
                    // after hiding the modal
                    // Therefor, we need to backup the form
                    $('#add-group-to-phase-form-div').hide().appendTo('#add-group-to-phase');
                })
                .modal('show');
        });
    }


    var handleBootboxAddTeamToGroupCompetition = function () {

        $("button.teams").on("click", function() {

            var groupId = $(this).attr('data-group-id');
            var phaseId = $(this).attr('data-phase-id');
            var url = $('#list-teams-phase-competition').attr('href').split('%')[0]+phaseId;
            /*console.log('group:'+groupId);
            console.log('phaseId:'+phaseId);*/
            selectTeamsForCompetition('#new-teams-for-groups-ids',url);
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
                        message: $('#add-teams-to-group-form-div-box'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#add-team-to-group-form').valid()) 
                                    {
                                        $("#add-team-to-group-form").submit(function(e){
                                            var formData = {
                                                group_id: groupId,
                                                teams_ids: $('#new-teams-for-groups-ids').val(),
                                            };
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#add-new-teams-to-group').attr('href'), 
                                                data: formData,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    console.log(responseServer);
                                                    if(responseServer.success == true) 
                                                    {
                                                        // Muestro otro dialog con información de éxito
                                                        bootbox.dialog({
                                                            message: responseServer.data.name + " Ha sido actualizado correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        reloadDatatable('#datatable-' + groupId);
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
                                                            message:responseServer.errors,
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
                                            $(this).unbind('submit');
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
                        $('#add-teams-to-group-form-div-box')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#add-teams-to-group-form-div-box').hide().appendTo('#add-teams-to-group');
                    })
                    .modal('show');
            });
    }

    var handleBootboxAddGameToGroupCompetition = function () {
        $("button.games").on("click", function() {

            var groupId = $(this).attr('data-group-id');
            //console.log(groupId);
            var url = $('#teams-available-for-games').attr('href').split('%')[0]+groupId;
            getAvailableTeamsForGame('#local-team-for-game',url);
            getAvailableTeamsForGame('#away-team-for-game',url);
            $('#add-game-to-group-form').trigger('reset');
            addValidationRulesForms();
            $('#add-game-to-group-form').validate({
                    rules:{
                        date:{
                            required: true,
                            //customDateTimeValidator: true
                        },
                        local_team_id:{
                             required: true,
                        },
                        away_team_id:{
                             required: true,
                        },   
                    },
                    messages:{
                         local_team_id:{
                             required: 'Este campo es obligatorio',
                        },
                        away_team_id:{
                              required: 'Este campo es obligatorio',
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
                    },
                });

                
                bootbox.dialog({
                        message: $('#add-game-to-group-div-box'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#add-game-to-group-form').valid()) 
                                    {
                                        $("#add-game-to-group-form").submit(function(e){
                                            var formData = {
                                                group_id: groupId,
                                                date: $('#date-for-game').val(),
                                                local_team_id: $('#local-team-for-game').val(),
                                                away_team_id: $('#away-team-for-game').val(),
                                                type_id: $('#type_id-for-game').val(),
                                                stadium: $('#stadium-for-game').val(),
                                                main_referee: $('#main_referee-for-game').val(),
                                                line_referee: $('#line_referee-for-game').val()
                                            };
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#add-new-game-to-group').attr('href'), 
                                                data: formData,
                                                async: true,
                                                cache: false,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    console.log(responseServer);
                                                    if(responseServer.success) 
                                                    {
                                                        // Muestro otro dialog con información de éxito
                                                        bootbox.dialog({
                                                            message:"EL partido ha sido agregado correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        //reloadDatatable('#datatable-' + $('button#add-game').attr('data-group-id'));
                                                                    }
                                                                }
                                                            }
                                                        });
                                                        // Limpio cada elemento de las clases añadidas por el validator
                                                        $('#add-game-to-group-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                        $("#add-game-to-group-form")[0].reset();
                                                    }else{
                                                        var response = responseServer.errors ? responseServer.errors : 'Juego repetido'
                                                        bootbox.dialog({
                                                            message: response,
                                                            title: "Error",
                                                            buttons: {
                                                                danger: {
                                                                    label: "Danger!",
                                                                    className: "btn-danger"
                                                                }
                                                            }
                                                        });
                                                        $('#add-game-to-group-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
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
                                                        $('#add-game-to-group-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                }
                                            });
                                            e.preventDefault(); //Prevent Default action.
                                            $(this).unbind('submit');
                                        }); 
                                        $("#add-game-to-group-form").submit();
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
                        $('#add-game-to-group-div-box')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#add-game-to-group-div-box').hide().appendTo('#add-game-to-group-div');
                    })
                    .modal('show');
        });
    }

     var checkIfGameExist = function () {
        $('#local-team-for-game, #away-team-for-game').change(function (argument) {
            if($("#local-team-for-game option:selected").length > 0 && $("#away-team-for-game option:selected").length > 0){
                var url = $('#exist-game-to-group').attr('href').split('%')[0]+$('button#add-game').attr('data-group-id')+'/'+$("#local-team-for-game").val()+'/'+$("#away-team-for-game").val();
                /*console.log('local-team-for-game:'+$("#local-team-for-game").val());
                console.log('away-team-for-game:'+$("#away-team-for-game").val());
                console.log('Url:' + url);*/
                $.ajax({
                    type: 'GET',
                    url: url,
                    /*data: {
                        'group_id': $('button#add-game').attr('data-group-id'),
                        'local_team_id': $("#local-team-for-game").val(), 
                        'away_team_id': $("#away-team-for-game").val()
                    },*/
                    dataType:'json',
                    success: function(response) {
                        //console.log(response);
                    }
                });
            }
        });
     }

     var getAvailableTeamsForGame = function (id,url) {
        //console.log(url);
        $.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                var option = '<option value=\"\"></option>';
                if (response.success == true) {
                    $(id).html('');
                    $(id).append(option);
                    $.each(response.data,function (k,v){
                        option = '<option value=\"'+v.id+'\">'+v.nombre+'</option>';
                        var chosenUpdate = 'chosen:updated';
                        $(id).append(option);
                        $(id).trigger(chosenUpdate);
                    });
                }else{
                    $(id).html('');
                    $(id).append(option);
                }
            }
        });
     }


     var handleBootboxAddPhaseToCompetition = function () {
        $('button#add-phase').click(function () {

            $('#add-phase-to-competition-form').trigger('reset');

            addValidationRulesForms();
            $('#add-phase-to-competition-form').validate({
                rules:{
                    name:{
                        required: true
                    },
                    format_id:{
                        required: true
                    }
                },
                messages:{
                    name:{
                        required: 'Este campo es obligatorio'
                    },
                    format_id:{
                         required: 'Este campo es obligatorio'
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
                        message: $('#add-phase-to-competition-form-div'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#add-phase-to-competition-form').valid()) 
                                    {
                                        $("#add-phase-to-competition-form").submit(function(e){
                                            var formData = {
                                                name: $('#name-new-phase-to-competition').val(),
                                                from: $('#from-new-phase-to-competition').val(),
                                                to: $('#to-new-phase-to-competition').val(),
                                                competition_id: $('button#add-phase').attr('data-competition-id'),
                                                format_id: $('#competition-new-format-id').val()
                                            };
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#add-new-phase-competition').attr('href'), 
                                                data: formData,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    console.log(responseServer);
                                                    if(responseServer.success) 
                                                    {
                                                        // Muestro otro dialog con información de éxito
                                                        bootbox.dialog({
                                                            message:responseServer.phase.name+" agregada correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        location.reload();
                                                                        //reloadDatatable('#datatable-' + $('button#add-game').attr('data-group-id'));
                                                                    }
                                                                }
                                                            }
                                                        });
                                                        // Limpio cada elemento de las clases añadidas por el validator
                                                        $('#add-phase-to-competition-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                        $("#add-phase-to-competition-form")[0].reset();
                                                    }else{
                                                        bootbox.dialog({
                                                            message: responseServer.errors,
                                                            title: "Error",
                                                            buttons: {
                                                                danger: {
                                                                    label: "Danger!",
                                                                    className: "btn-danger"
                                                                }
                                                            }
                                                        });
                                                        $('#add-phase-to-competition-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
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
                                                        $('#add-phase-to-competition-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario*/
                                                }
                                            });
                                            e.preventDefault(); //Prevent Default action.
                                            $(this).unbind('submit');
                                        }); 
                                        $("#add-phase-to-competition-form").submit();
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
                        $('#add-phase-to-competition-form-div')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#add-phase-to-competition-form-div').hide().appendTo('#add-phase-to-competition');
                    })
                    .modal('show');
            });
     }


     var getTeamsForGames = function (idField, url) 
     {
        /*console.log(url);
        console.log(idField);*/
         $.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                console.log(response.teams);
                 if (response.success == true) {
                        $(idField).html('');
                        $(idField).append('<option value=\"\"></option>');
                        $.each(response.teams, function (index, team){
                            $(idField).append('<option value=\"'+team.id+'\">'+team.nombre+'</option>');
                            $(idField).trigger("chosen:updated");
                        });
                    }else{
                        $(idField).html('');
                        $(idField).append('<option value=\"\"></option>');
                        $(idField).trigger("chosen:updated");
                    }
            }
        });
     }

     var getAvailablePlayersForGameGoal = function (idField,gameId) {
        $('#teams-for-games-id').change(function () {
            var teamId = $(this).val();
            var url = $('#players-for-games').attr('href').split('%')[0]+gameId+'/'+teamId;
            //console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                dataType:'json',
                success: function(response) {
                    //console.log(response);
                    var option = '<option value=\"\"></option>';
                    var chosenUpdate = 'chosen:updated';
                    if (response.success == true) {
                        $(idField).html('');
                        $(idField).append(option);
                        $.each(response.players,function (index,object){
                            option = '<option value=\"'+index+'\">'+object+'</option>';
                            $(idField).append(option);
                            $(idField).trigger(chosenUpdate);
                        });
                    }else{
                        $(idField).html('');
                        $(idField).append(option);
                        $(idField).trigger(chosenUpdate);
                    }
                }
            });
        });
     }

     var bootboxAddGoal = function  (gameId) {

            var url = $('#teams-for-games').attr('href').split('%')[0]+gameId;
            getTeamsForGames('#teams-for-games-id',url);
            getAvailablePlayersForGameGoal('#player-for-game-id', gameId);
            getAvailablePlayersForGameGoal('#assistance-for-game-id', gameId);

            loadFieldSelect($('#list-of-goal-types').attr('href'),'#goal-types-for-games-id');
            addValidationRulesForms();
            $('#add-goals-to-game-form').trigger('reset');
            $('#add-goals-to-game-form').validate({
                rules:{
                    observations:{
                        rangelength:[1,256],
                    },
                    minute:{
                        required: true,
                        rangelength:[1,3],
                    },
                    second:{
                        required: true,
                        rangelength:[1,2],
                    },
                    type_id:{
                        required: true,
                        digits: true
                    },
                    team_id:{
                        required: true,
                        digits: true
                    },
                    player_id:{
                        required: true,
                        digits: true
                    },
                    assistance_id:{
                        required: true,
                        digits: true
                    }
                },
                messages:{
                    observations:{
                        rangelength: 'Por favor ingrese entre [2, 256] caracteres',
                    },
                    minute:{
                        required: 'Este campo es obligatorio',
                        rangelength:'Por favor ingrese entre [1, 3] caracteres',
                    },
                    second:{
                        required: 'Este campo es obligatorio',
                        rangelength: 'Por favor ingrese entre [1, 2] caracteres',
                    },
                    type_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    team_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    player_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    assistance_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
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
                        message: $('#add-goals-to-game-form-div-box'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#add-goals-to-game-form').valid()) 
                                    {
                                        $("#add-goals-to-game-form").submit(function(e){
                                            var formData = {
                                                observations: $('#observations-game').val(),
                                                minute: $('#minute-game').val(),
                                                second: $('#second-game').val(),
                                                type_id: $('#goal-types-for-games-id').val(),
                                                game_id: gameId,
                                                team_id: $('#teams-for-games-id').val(),
                                                player_id: $('#player-for-game-id').val(),
                                                assistance_id: $('#assistance-for-game-id').val()
                                            };
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#add-new-goal-for-game').attr('href'), 
                                                data: formData,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    console.log(responseServer);
                                                    if(responseServer.success) 
                                                    {
                                                        // Muestro otro dialog con información de éxito
                                                        bootbox.dialog({
                                                            message:"Gol agregado correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        reloadDatatable('#datatable-goals')
                                                                    }
                                                                }
                                                            }
                                                        });
                                                        // Limpio cada elemento de las clases añadidas por el validator
                                                        $('#add-goals-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                        $("#add-goals-to-game-form")[0].reset();
                                                    }else{
                                                        bootbox.dialog({
                                                            message: responseServer.errors,
                                                            title: "Error",
                                                            buttons: {
                                                                danger: {
                                                                    label: "Danger!",
                                                                    className: "btn-danger"
                                                                }
                                                            }
                                                        });
                                                        $('#add-goals-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
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
                                                        $('#add-goals-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario*/
                                                }
                                            });
                                            e.preventDefault(); //Prevent Default action.
                                            $(this).unbind('submit');
                                        }); 
                                        $("#add-goals-to-game-form").submit();
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
                        $('#add-goals-to-game-form-div-box')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#add-goals-to-game-form-div-box').hide().appendTo('#add-goals-to-game');
                    })
                    .modal('show');
     }

     var handleBootboxAddGoalToGame = function () {

         $(".table").delegate(".add-goal", "click", function() {
            /*console.log('Gol');
            console.log($(this).attr('id'));
            console.log($(this).attr('id').split('-')[2]);*/
            var gameId = $(this).attr('id').split('-')[2];
            bootboxAddGoal(gameId);
            
        });

        $('button.add-goal').click(function () {
            var gameId = $(this).attr('id').split('-')[2];
            bootboxAddGoal(gameId);
        });
     }


       var getAvailablePlayersForGameSanction = function (gameId) {
        //console.log(gameId);
        $('select#teams-for-game-sanction-id').change(function () {
            var teamId = $(this).val();
            var url = $('#players-for-games').attr('href').split('%')[0]+gameId+'/'+teamId;
            $.ajax({
                type: 'GET',
                url: url,
                dataType:'json',
                success: function(response) {
                    //console.log(response);
                    if (response.success == true) {
                        $('select#player-for-sanction-id').html('');
                        $('select#player-for-sanction-id').append('<option value=\"\"></option>');
                        $.each(response.players, function (index, player){
                            $('select#player-for-sanction-id').append('<option value=\"'+index+'\">'+player+'</option>');
                            $('select#player-for-sanction-id').trigger("chosen:updated");
                        });
                    }else{
                        $('select#player-for-sanction-id').html('');
                        $('select#player-for-sanction-id').append('<option value=\"\"></option>');
                        $('select#player-for-sanction-id').trigger("chosen:updated");
                    }
                }
            });
        });
     }

     var getTeamsForGamesSanction = function (url) 
     {
        //console.log(url);
         $.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                 //console.log(response);
                    if (response.success == true) 
                    {
                        $('select#teams-for-game-sanction-id').html('');
                        $('select#teams-for-game-sanction-id').append('<option value=\"\"></option>');
                        $.each(response.teams,function (index,object){
                            option = '<option value=\"'+object.id+'\">'+object.nombre+'</option>';
                            //console.log(option);
                            $('select#teams-for-game-sanction-id').append('<option value=\"'+object.id+'\">'+object.nombre+'</option>');
                            $('select#teams-for-game-sanction-id').trigger('chosen:updated');
                        });
                    }else{
                        $('select#teams-for-game-sanction-id').html('');
                        $('select#teams-for-game-sanction-id').append(option);
                        $('select#teams-for-game-sanction-id').trigger('chosen:updated');
                    }
            }
        });
     }

     var bootboxAddSanction = function (gameId) {

            var url = $('#teams-for-games').attr('href').split('%')[0]+gameId;
            getTeamsForGamesSanction(url);
            getAvailablePlayersForGameSanction(gameId);

            loadFieldSelect($('#list-of-sanction-types').attr('href'),'select#sanction-types-id');
            addValidationRulesForms();
            $('#add-sanction-to-game-form').trigger('reset');
            $('#add-sanction-to-game-form').validate({
                rules:{
                    observations:{
                        rangelength:[1,256],
                    },
                    minute:{
                        required: true,
                        rangelength:[1,3],
                    },
                    second:{
                        required: true,
                        rangelength:[1,2],
                    },
                    type_id:{
                        required: true,
                        digits: true
                    },
                    team_id:{
                        required: true,
                        digits: true
                    },
                    player_id:{
                        required: true,
                        digits: true
                    },
                },
                messages:{
                    observations:{
                        rangelength: 'Por favor ingrese entre [2, 256] caracteres',
                    },
                    minute:{
                        required: 'Este campo es obligatorio',
                        rangelength:'Por favor ingrese entre [1, 3] caracteres',
                    },
                    second:{
                        required: 'Este campo es obligatorio',
                        rangelength: 'Por favor ingrese entre [1, 2] caracteres',
                    },
                    type_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    team_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    player_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
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
                },
            });

                
            bootbox.dialog({
                        message: $('#add-sanction-to-game-form-div-box'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#add-sanction-to-game-form').valid()) 
                                    {
                                        $("#add-sanction-to-game-form").submit(function(e){
                                            var formData = {
                                                observations: jQuery('#observations-sanction').val() ? jQuery("input[name='observations_sanction']").val() : jQuery('.observations').val(),
                                                minute: jQuery('#minute-sanction').val(),
                                                second: jQuery('#second-sanction').val(),
                                                type_id: jQuery('select#sanction-types-id').val(),
                                                game_id: gameId,
                                                team_id: jQuery('select#teams-for-game-sanction-id').val(),
                                                player_id: jQuery('select#player-for-sanction-id').val(),
                                            };
                                            //console.log(formData);
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#add-new-sanction').attr('href'), 
                                                data: formData,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    //console.log(responseServer);
                                                    if(responseServer.success) 
                                                    {
                                                        bootbox.dialog({
                                                            message:"Sanción agregada correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        reloadDatatable('#datatable-sanctions')
                                                                    }
                                                                }
                                                            }
                                                        });
                                                        $('#add-sanction-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        $("#add-sanction-to-game-form")[0].reset();
                                                    }else{
                                                        bootbox.dialog({
                                                            message: responseServer.errors,
                                                            title: "Error",
                                                            buttons: {
                                                                danger: {
                                                                    label: "Danger!",
                                                                    className: "btn-danger"
                                                                }
                                                            }
                                                        });
                                                        $('#add-sanction-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
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
                                                        $('#add-sanction-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                }
                                            });
                                            e.preventDefault(); //Prevent Default action.
                                            $(this).unbind('submit');
                                        }); 
                                        $("#add-sanction-to-game-form").submit();
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
                        $('#add-sanction-to-game-form-div-box')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#add-sanction-to-game-form-div-box').hide().appendTo('#add-sanction-to-game');
                    })
                    .modal('show');
     }

     var handleBootboxAddSanctionsToGame = function () {

         $(".table").delegate(".add-santion", "click", function() {
            var gameId = $(this).attr('id').split('-')[2];
            bootboxAddSanction(gameId);
        });

        $('button.add-new-sanction').click( function() {
            var gameId = $(this).attr('id').split('-')[2];
            bootboxAddSanction(gameId);
        });
     }

     var getAvailablePlayersForGameChange = function (idField,gameId) {
        $('#teams-for-game-change-id').change(function () {
            var teamId = $(this).val();
            var url = $('#players-for-games').attr('href').split('%')[0]+gameId+'/'+teamId;
            //console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                dataType:'json',
                success: function(response) {
                    //console.log(response);
                    var option = '<option value=\"\"></option>';
                    var chosenUpdate = 'chosen:updated';
                    if (response.success == true) {
                        $(idField).html('');
                        $(idField).append(option);
                        $.each(response.players,function (index,object){
                            option = '<option value=\"'+index+'\">'+object+'</option>';
                            $(idField).append(option);
                            $(idField).trigger(chosenUpdate);
                        });
                    }else{
                        $(idField).html('');
                        $(idField).append(option);
                        $(idField).trigger(chosenUpdate);
                    }
                }
            });
        });
    }


    var handleBootboxAddChangeToGame = function () {

         $(".table").delegate(".add-change ", "click", function() {
            var gameId = $(this).attr('id').split('-')[2];
            bootboxAddChange(gameId);
        });

        $('button.add-change').click( function() {
            var gameId = $(this).attr('id').split('-')[2];
            bootboxAddChange(gameId);
        });
     
     }


     var bootboxAddChange = function  (gameId) {

            var url = $('#teams-for-games').attr('href').split('%')[0]+gameId;
            getTeamsForGames('#teams-for-game-change-id',url);
            getAvailablePlayersForGameChange('#player-out-for-change-id', gameId);
            getAvailablePlayersForGameChange('#player-in-for-change-id', gameId);

            addValidationRulesForms();
            $('#add-change-to-game-form').trigger('reset');
            $('#add-change-to-game-form').validate({
                rules:{
                    observations:{
                        rangelength:[1,256],
                    },
                    minute:{
                        required: true,
                        rangelength:[1,3],
                    },
                    second:{
                        required: true,
                        rangelength:[1,2],
                    },
                    team_id:{
                        required: true,
                        digits: true
                    },
                    player_out_id:{
                        required: true,
                        digits: true
                    },
                    player_in_id:{
                        required: true,
                        digits: true
                    },
                },
                messages:{
                    observations:{
                        rangelength: 'Por favor ingrese entre [2, 256] caracteres',
                    },
                    minute:{
                        required: 'Este campo es obligatorio',
                        rangelength:'Por favor ingrese entre [1, 3] caracteres',
                    },
                    second:{
                        required: 'Este campo es obligatorio',
                        rangelength: 'Por favor ingrese entre [1, 2] caracteres',
                    },
                    type_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    team_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    player_out_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    player_in_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
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
                },
            });

                
            bootbox.dialog({
                        message: $('#add-change-to-game-form-div-box'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#add-change-to-game-form').valid()) 
                                    {
                                        $("#add-change-to-game-form").submit(function(e){
                                            var formData = {
                                                observations: $('#observations-change').val(),
                                                minute: $('#minute-change').val(),
                                                second: $('#second-change').val(),
                                                game_id: gameId,
                                                team_id: $('#teams-for-game-change-id').val(),
                                                player_out_id: $('#player-out-for-change-id').val(),
                                                player_in_id: $('#player-in-for-change-id').val(),
                                            };
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#add-new-change').attr('href'), 
                                                data: formData,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    console.log(responseServer);
                                                    if(responseServer.success) 
                                                    {
                                                        // Muestro otro dialog con información de éxito
                                                        bootbox.dialog({
                                                            message:"Cambio realizado correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        reloadDatatable('#datatable-changes');
                                                                    }
                                                                }
                                                            }
                                                        });
                                                        // Limpio cada elemento de las clases añadidas por el validator
                                                        $('#add-change-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                        $("#add-change-to-game-form")[0].reset();
                                                    }else{
                                                        bootbox.dialog({
                                                            message: responseServer.errors,
                                                            title: "Error",
                                                            buttons: {
                                                                danger: {
                                                                    label: "Danger!",
                                                                    className: "btn-danger"
                                                                }
                                                            }
                                                        });
                                                        $('#add-change-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
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
                                                        $('#add-change-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario*/
                                                }
                                            });
                                            e.preventDefault(); //Prevent Default action.
                                            $(this).unbind('submit');
                                        }); 
                                        $("#add-change-to-game-form").submit();
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
                        $('#add-change-to-game-form-div-box')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#add-change-to-game-form-div-box').hide().appendTo('#add-change-to-game');
                    })
                    .modal('show');
     }

    
    var deleteGoal = function(idGoal) 
    {
        bootbox.confirm("¿Esta seguro de eliminar el Gol?", function(result) 
        {
            //console.log("Confirm result: "+result);
            if (result == true)
            {
                $.ajax({
                    type: 'GET',
                    url: $('#delete-goal-game').attr('href'),
                    data: {'goalId': idGoal},
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success == true) {
                            $('#delete_goal_'+idGoal).parent().parent().remove();
                            bootbox.dialog({
                                message:" ¡Gol Eliminado!",
                                title: "Éxito",
                                buttons: {
                                    success: {
                                        label: "Success!",
                                        className: "btn-success",
                                        callback: function () {
                                            reloadDatatable('#datatable-goals')
                                        }
                                    }
                                }
                            });
                        }
                    }
                });
            }
        });
    }

    var loadDataForEditGoal = function(idGoal) {
        $.ajax({
            type: 'GET',
            url: $('#data-goal').attr('href'),    
            data: {'goalId': idGoal},
            dataType: "JSON",
            success: function(response) {
                //console.log(response);
                 if (response != null) 
                 {
                    if (response.success) {
                        var gameId = response.goal.game_id;
                        var url = $('#teams-for-games').attr('href').split('%')[0]+gameId;

                        var goal = $('#edit-goals-to-game-form-div-box');
                        var data = {
                            title: "Editar Gol",
                            observations_game: response.goal.observations,
                            minute_game: response.goal.minute,
                            second_game: response.goal.second,
                            type_goal_id: response.goal.type_id,
                            type_goal: response.goal.type.name,
                            team_goal_id: response.goal.team_id,
                            team_goal: response.goal.team.nombre,
                            player_goal_id: response.goal.player_id,
                            player_goal: response.goal.player.nombre,
                            assistance_goal_id: response.goal.assistance_id,
                            assistance_goal: response.goal.assistance.nombre,

                        };
                        var template = $('#edit-goal-tpl').html();
                        var html = Mustache.to_html(template, data);
                        goal.html(html);
                        initChosen();
                        getTeamsForGames('#team-for-game-edit',url);
                        bootboxAddGoalEdit(response.goal.id,response.goal.game_id);

                        $('select#team-for-game-edit').val(response.goal.team_id);
                        $('select#team-for-game-edit').trigger("chosen:updated");
                        $('select#team-for-game-edit').on('chosen:updated', function(event){
                            $('select#team-for-game-edit').val(response.goal.team_id);
                        });
                        $('select#goal-types-for-games-id-edit').val(response.goal.type_id);
                        $('select#goal-types-for-games-id-edit').trigger("chosen:updated");
                        $('select#goal-types-for-games-id-edit').on('chosen:updated', function(event){
                            $('select#goal-types-for-games-id-edit').val(response.goal.type_id);
                        });
                        /*$('#observations-game-edit').val(response.goal.observations);
                        $('#minute-game-edit').val(response.goal.minute);
                        $('#second-game-edit').val(response.goal.second);
                        $('select#player-for-game-id-edit').html('<option value=\"'+response.goal.player.id+'\">'+response.goal.player.nombre+'</option>');
                        $('select#player-for-game-id-edit').trigger("chosen:updated");
                        $('select#assistance-for-game-id-edit').html('<option value=\"'+response.goal.assistance.id+'\">'+response.goal.assistance.nombre+'</option>');
                        $('select#assistance-for-game-id-edit').trigger("chosen:updated");*/
                    }
                } 
            }
        });
    }

    var getAvailablePlayersForEditGoal = function (idField,gameId) {
        $('select#team-for-game-edit').change(function () {
            var teamId = $(this).val();
            var url = $('#players-for-games').attr('href').split('%')[0]+gameId+'/'+teamId;
            //console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                dataType:'json',
                success: function(response) {
                    //console.log(response);
                    var option = '<option value=\"\"></option>';
                    var chosenUpdate = 'chosen:updated';
                    if (response.success == true) {
                        $(idField).html('');
                        $(idField).append(option);
                        $.each(response.players,function (index,object){
                            option = '<option value=\"'+index+'\">'+object+'</option>';
                            $(idField).append(option);
                            $(idField).trigger(chosenUpdate);
                        });
                    }else{
                        $(idField).html('');
                        $(idField).append(option);
                        $(idField).trigger(chosenUpdate);
                    }
                }
            });
        });
     }


     var getTeamsForGoalGame = function (url) 
     {
        //console.log(url);
         $.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                 //console.log(response);
                    if (response.success == true) 
                    {
                        $('select##team-for-game-edit').html('');
                        $('select##team-for-game-edit').append('<option value=\"\"></option>');
                        $.each(response.teams,function (index,object){
                            option = '<option value=\"'+object.id+'\">'+object.nombre+'</option>';
                            //console.log(option);
                            $('select##team-for-game-edit').append('<option value=\"'+object.id+'\">'+object.nombre+'</option>');
                            $('select##team-for-game-edit').trigger('chosen:updated');
                        });
                    }else{
                        $('select##team-for-game-edit').html('');
                        $('select##team-for-game-edit').append(option);
                        $('select##team-for-game-edit').trigger('chosen:updated');
                    }
            }
        });
     }

     var bootboxAddGoalEdit = function  (goalId, gameId) {

            getAvailablePlayersForEditGoal('select#player-for-game-id-edit', gameId);
            getAvailablePlayersForEditGoal('select#assistance-for-game-id-edit', gameId);
            loadFieldSelect($('#list-of-goal-types').attr('href'),'select#goal-types-for-games-id-edit');

            addValidationRulesForms();
            $('#edit-goals-to-game-form').validate({
                rules:{
                    observations:{
                        rangelength:[1,256],
                    },
                    minute:{
                        required: true,
                        rangelength:[1,3],
                    },
                    second:{
                        required: true,
                        rangelength:[1,2],
                    },
                    type_id:{
                        required: true,
                        digits: true
                    },
                    team_id:{
                        required: true,
                        digits: true
                    },
                    player_id:{
                        required: true,
                        digits: true
                    },
                    assistance_id:{
                        required: true,
                        digits: true
                    }
                },
                messages:{
                    observations:{
                        rangelength: 'Por favor ingrese entre [2, 256] caracteres',
                    },
                    minute:{
                        required: 'Este campo es obligatorio',
                        rangelength:'Por favor ingrese entre [1, 3] caracteres',
                    },
                    second:{
                        required: 'Este campo es obligatorio',
                        rangelength: 'Por favor ingrese entre [1, 2] caracteres',
                    },
                    type_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    team_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    player_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    assistance_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
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
                        message: $('#edit-goals-to-game-form-div-box'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#edit-goals-to-game-form').valid()) 
                                    {
                                        $("#edit-goals-to-game-form").submit(function(e){
                                            var formData = {
                                                goal_id: goalId,
                                                observations: $('#observations-game-edit').val(),
                                                minute: $('#minute-game-edit').val(),
                                                second: $('#second-game-edit').val(),
                                                type_id: $('#goal-types-for-games-id-edit').val(),
                                                game_id: gameId,
                                                team_id: $('#team-for-game-edit').val(),
                                                player_id: $('#player-for-game-id-edit').val(),
                                                assistance_id: $('#assistance-for-game-id-edit').val()
                                            };
                                            //console.log(formData);
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#update-data-goal').attr('href'), 
                                                data: formData,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    //console.log(responseServer);
                                                    if(responseServer.success) 
                                                    {
                                                        $('#observations-game-edit').val(responseServer.goal.observations);
                                                        $('#minute-game-edit').val(responseServer.goal.minute);
                                                        $('#second-game-edit').val(responseServer.goal.second);
                                                        // Muestro otro dialog con información de éxito
                                                        bootbox.dialog({
                                                            message:"Gol agregado correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        reloadDatatable('#datatable-goals')
                                                                    }
                                                                }
                                                            }
                                                        });
                                                        // Limpio cada elemento de las clases añadidas por el validator
                                                        $('#edit-goals-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                        $("#edit-goals-to-game-form")[0].reset();
                                                    }else{
                                                        bootbox.dialog({
                                                            message: responseServer.errors,
                                                            title: "Error",
                                                            buttons: {
                                                                danger: {
                                                                    label: "Danger!",
                                                                    className: "btn-danger"
                                                                }
                                                            }
                                                        });
                                                        $('#edit-goals-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
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
                                                        $('#edit-goals-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                }
                                            });
                                            e.preventDefault(); //Prevent Default action.
                                            $(this).unbind('submit');
                                        }); 
                                        $("#edit-goals-to-game-form").submit();
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
                        $('#edit-goals-to-game-form-div-box')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#edit-goals-to-game-form-div-box').hide().appendTo('#edit-goals-to-game');
                    })
                    .modal('show');
     }

    var implementActionsToGoal = function() 
    {
        $(".table").delegate(".delete-goal", "click", function() {
             action = getAttributeIdActionSelect($(this).attr('id'));
             //console.log(action.number);
             deleteGoal(action.number);
        });

        $(".table").delegate(".edit-goal", "click", function() {
            action = getAttributeIdActionSelect($(this).attr('id'));
            //console.log($(this).attr('data-goal-game-id'));
            loadDataForEditGoal(action.number);
        });


    }


    var deleteSanction = function(idSanction) 
    {
        bootbox.confirm("¿Esta seguro de eliminar la sanción?", function(result) 
        {
            //console.log("Confirm result: "+result);
            if (result == true)
            {
                $.ajax({
                    type: 'GET',
                    url: $('#delete-sanction-game').attr('href'),
                    data: {'sanctionId': idSanction},
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success == true) {
                            $('#delete_sanction_'+idSanction).parent().parent().remove();
                            bootbox.dialog({
                                message:" ¡Sanción Eliminada!",
                                title: "Éxito",
                                buttons: {
                                    success: {
                                        label: "Success!",
                                        className: "btn-success",
                                        callback: function () {
                                            reloadDatatable('#datatable-sanctions')
                                        }
                                    }
                                }
                            });
                        }
                    }
                });
            }
        });
    }


     var loadDataForEditSanction = function(idSanction) {
        $.ajax({
            type: 'GET',
            url: $('#data-sanction').attr('href'),    
            data: {'sanctionId': idSanction},
            dataType: "JSON",
            success: function(response) 
            {
                //console.log(response);
                 if (response != null) 
                 {
                    if (response.success) {
                        var gameId = response.sanction.game_id;
                        var url = $('#teams-for-games').attr('href').split('%')[0]+gameId;
                    
                        var sanction = $('#edit-sanction-to-game-form-div-box');
                        var data = {
                            title: "Editar Sanción",
                            observations_sanction: response.sanction.observations,
                            minute_sanction: response.sanction.minute,
                            second_sanction: response.sanction.second,
                            type_sanction_id: response.sanction.type_id,
                            type_sanction: response.sanction.type.name,
                            team_sanction_id: response.sanction.team_id,
                            team_sanction: response.sanction.team.nombre,
                            player_sanction_id: response.sanction.player_id,
                            player_sanction: response.sanction.player.nombre,
                        };
                        var template = $('#edit-sanction-tpl').html();
                        var html = Mustache.to_html(template, data);
                        sanction.html(html);
                        initChosen();

                        getTeamsForGamesEditSanction(url);
                        getAvailablePlayersForGameSanctionEdit(gameId);
                        loadFieldSelect($('#list-of-sanction-types').attr('href'),'select#sanction-type-for-game-id-edit');

                        $('select#team-for-sanction-edit').val(response.sanction.team_id);
                        $('select#team-for-sanction-edit').trigger("chosen:updated");
                        $('select#team-for-sanction-edit').on('chosen:updated', function(event){
                            $('select#team-for-sanction-edit').val(response.sanction.team_id);
                        });
                        $('select#sanction-type-for-game-id-edit').val(response.sanction.type_id);
                        $('select#sanction-type-for-game-id-edit').trigger("chosen:updated");
                        $('select#sanction-type-for-game-id-edit').on('chosen:updated', function(event){
                            $('select#sanction-type-for-game-id-edit').val(response.sanction.type_id);
                        });
                    }
                } 
            }
        });
    }


     var getTeamsForGamesEditSanction = function (url) 
     {
        //console.log(url);
         $.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                 //console.log(response);
                    if (response.success == true) 
                    {
                        $('select#team-for-sanction-edit').html('');
                        $('select#team-for-sanction-edit').append('<option value=\"\"></option>');
                        $.each(response.teams,function (index,object){
                            option = '<option value=\"'+object.id+'\">'+object.nombre+'</option>';
                            //console.log(option);
                            $('select#team-for-sanction-edit').append('<option value=\"'+object.id+'\">'+object.nombre+'</option>');
                            $('select#team-for-sanction-edit').trigger('chosen:updated');
                        });
                    }else{
                        $('select#team-for-sanction-edit').html('');
                        $('select#team-for-sanction-edit').append(option);
                        $('select#team-for-sanction-edit').trigger('chosen:updated');
                    }
            }
        });
     }


       var getAvailablePlayersForGameSanctionEdit = function (gameId) {
        //console.log(gameId);
        $('select#team-for-sanction-edit').change(function () {
            var teamId = $(this).val();
            var url = $('#players-for-games').attr('href').split('%')[0]+gameId+'/'+teamId;
            $.ajax({
                type: 'GET',
                url: url,
                dataType:'json',
                success: function(response) {
                    //console.log(response);
                    if (response.success == true) {
                        $('select#player-for-sanction-id-edit').html('');
                        $('select#player-for-sanction-id-edit').append('<option value=\"\"></option>');
                        $.each(response.players, function (index, player){
                            $('select#player-for-sanction-id-edit').append('<option value=\"'+index+'\">'+player+'</option>');
                            $('select#player-for-sanction-id-edit').trigger("chosen:updated");
                        });
                    }else{
                        $('select#player-for-sanction-id-edit').html('');
                        $('select#player-for-sanction-id-edit').append('<option value=\"\"></option>');
                        $('select#player-for-sanction-id-edit').trigger("chosen:updated");
                    }
                }
            });
        });
     }

    var bootboxEditSanction = function (gameId, sanctionId) {

            addValidationRulesForms();
            $('#edit-sanction-to-game-form').trigger('reset');
            $('#edit-sanction-to-game-form').validate({
                rules:{
                    observations:{
                        rangelength:[1,256],
                    },
                    minute:{
                        required: true,
                        rangelength:[1,3],
                    },
                    second:{
                        required: true,
                        rangelength:[1,2],
                    },
                    type_id:{
                        required: true,
                        digits: true
                    },
                    team_id:{
                        required: true,
                        digits: true
                    },
                    player_id:{
                        required: true,
                        digits: true
                    },
                },
                messages:{
                    observations:{
                        rangelength: 'Por favor ingrese entre [2, 256] caracteres',
                    },
                    minute:{
                        required: 'Este campo es obligatorio',
                        rangelength:'Por favor ingrese entre [1, 3] caracteres',
                    },
                    second:{
                        required: 'Este campo es obligatorio',
                        rangelength: 'Por favor ingrese entre [1, 2] caracteres',
                    },
                    type_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    team_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    player_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
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
                },
            });

                
            bootbox.dialog({
                        message: $('#edit-sanction-to-game-form-div-box'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#edit-sanction-to-game-form').valid()) 
                                    {
                                        $("#edit-sanction-to-game-form").submit(function(e){
                                            var formData = {
                                                sanction_id: sanctionId,
                                                observations: $('#observations-sanction-edit').val(),
                                                minute: $('#minute-sanction-edit').val(),
                                                second: $('#second-sanction-edit').val(),
                                                type_id: $('select#sanction-type-for-game-id-edit').val(),
                                                game_id: gameId,
                                                team_id: $('select#team-for-sanction-edit').val(),
                                                player_id: $('select#player-for-sanction-id-edit').val(),
                                            };
                                            //console.log(formData);
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#update-sanction').attr('href'), 
                                                data: formData,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    //console.log(responseServer);
                                                    if(responseServer.success) 
                                                    {
                                                        bootbox.dialog({
                                                            message:"Sanción actualizada correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        reloadDatatable('#datatable-sanctions')
                                                                    }
                                                                }
                                                            }
                                                        });
                                                        $('#edit-sanction-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        $("#edit-sanction-to-game-form")[0].reset();
                                                    }else{
                                                        bootbox.dialog({
                                                            message: responseServer.errors,
                                                            title: "Error",
                                                            buttons: {
                                                                danger: {
                                                                    label: "Danger!",
                                                                    className: "btn-danger"
                                                                }
                                                            }
                                                        });
                                                        $('#edit-sanction-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
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
                                                        $('#edit-sanction-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                }
                                            });
                                            e.preventDefault(); //Prevent Default action.
                                            $(this).unbind('submit');
                                        }); 
                                        $("#edit-sanction-to-game-form").submit();
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
                        $('#edit-sanction-to-game-form-div-box')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#edit-sanction-to-game-form-div-box').hide().appendTo('#edit-sanction-to-game');
                    })
                    .modal('show');
     }

    var implementActionsToSanction = function() 
    {
        $(".table").delegate(".delete-sanction", "click", function() {
             action = getAttributeIdActionSelect($(this).attr('id'));
             //console.log(action.number);
             deleteSanction(action.number);
        });

        $(".table").delegate(".edit-sanction", "click", function() {
             action = getAttributeIdActionSelect($(this).attr('id'));
             var sanctionId = action.number;
             var gameId = $(this).attr('data-game-id');
             loadDataForEditSanction(sanctionId);
             bootboxEditSanction(gameId, sanctionId);
             //console.log(action.number);
        });
    }


    var deleteChange = function(idChange) 
    {
        bootbox.confirm("¿Esta seguro de eliminar el cambio?", function(result) 
        {
            //console.log("Confirm result: "+result);
            if (result == true)
            {
                $.ajax({
                    type: 'GET',
                    url: $('#delete-change-game').attr('href'),
                    data: {'changeId': idChange},
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success == true) {
                            $('#delete_change_'+idChange).parent().parent().remove();
                            bootbox.dialog({
                                message:" ¡Cambio Eliminado!",
                                title: "Éxito",
                                buttons: {
                                    success: {
                                        label: "Success!",
                                        className: "btn-success",
                                        callback: function () {
                                            reloadDatatable('#datatable-changes')
                                        }
                                    }
                                }
                            });
                        }
                    }
                });
            }
        });
    }

    var getAvailablePlayersForGameChangeEdit = function (idField,gameId) {
        $('select#team-for-change-edit').change(function () {
            var teamId = $(this).val();
            var url = $('#players-for-games').attr('href').split('%')[0]+gameId+'/'+teamId;
            //console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                dataType:'json',
                success: function(response) {
                    //console.log(response);
                    var option = '<option value=\"\"></option>';
                    var chosenUpdate = 'chosen:updated';
                    if (response.success == true) {
                        $(idField).html('');
                        $(idField).append(option);
                        $.each(response.players,function (index,object){
                            option = '<option value=\"'+index+'\">'+object+'</option>';
                            $(idField).append(option);
                            $(idField).trigger(chosenUpdate);
                        });
                    }else{
                        $(idField).html('');
                        $(idField).append(option);
                        $(idField).trigger(chosenUpdate);
                    }
                }
            });
        });
    }


     var loadDataForEditChange = function(idChange) {
        $.ajax({
            type: 'GET',
            url: $('#data-change').attr('href'),    
            data: {'changeId': idChange},
            dataType: "JSON",
            success: function(response) 
            {
                //console.log(response);
                 if (response != null) 
                 {
                    if (response.success) {
                        var gameId = response.change.game_id;
                        var url = $('#teams-for-games').attr('href').split('%')[0]+gameId;
                    
                        var change = $('#edit-change-to-game-form-div-box');
                        var data = {
                            title: "Editar Cambio",
                            observations_change: response.change.observations,
                            minute_change: response.change.minute,
                            second_change: response.change.second,
                            team_change_id: response.change.team_id,
                            team_change: response.change.team.nombre,
                            player_change_out_id: response.change.player_out_id,
                            player_out_name: response.change.player_out.nombre,
                            player_change_in_id: response.change.player_in_id,
                            player_in_name: response.change.player_in.nombre,
                        };
                        var template = $('#edit-change-tpl').html();
                        var html = Mustache.to_html(template, data);
                        change.html(html);
                        //console.log(html)
                        initChosen();

                        getTeamsForGames('#team-for-change-edit',url);
                        getAvailablePlayersForGameChangeEdit('select#player-change-out-id-edit', gameId);
                        getAvailablePlayersForGameChangeEdit('select#player-change-in-id-edit', gameId);

                        $('select#team-for-change-edit').val(response.change.team_id);
                        $('select#team-for-change-edit').trigger("chosen:updated");
                        $('select#team-for-change-edit').on('chosen:updated', function(event){
                            $('select#team-for-change-edit').val(response.change.team_id);
                        });
                    }
                }
            }
        });
    }

    var bootboxEditChange = function  (gameId, changeId) {

            addValidationRulesForms();
            $('#edit-change-to-game-form').validate({
                rules:{
                    observations:{
                        rangelength:[1,256],
                    },
                    minute:{
                        required: true,
                        rangelength:[1,3],
                    },
                    second:{
                        required: true,
                        rangelength:[1,2],
                    },
                    team_id:{
                        required: true,
                        digits: true
                    },
                    player_out_id:{
                        required: true,
                        digits: true
                    },
                    player_in_id:{
                        required: true,
                        digits: true
                    },
                },
                messages:{
                    observations:{
                        rangelength: 'Por favor ingrese entre [2, 256] caracteres',
                    },
                    minute:{
                        required: 'Este campo es obligatorio',
                        rangelength:'Por favor ingrese entre [1, 3] caracteres',
                    },
                    second:{
                        required: 'Este campo es obligatorio',
                        rangelength: 'Por favor ingrese entre [1, 2] caracteres',
                    },
                    type_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    team_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    player_out_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    player_in_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
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
                },
            });

                
            bootbox.dialog({
                        message: $('#edit-change-to-game-form-div-box'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#edit-change-to-game-form').valid()) 
                                    {
                                        $("#edit-change-to-game-form").submit(function(e){
                                            var formData = {
                                                change_id: changeId,
                                                observations: $('#observations-change-edit').val(),
                                                minute: $('#minute-change-edit').val(),
                                                second: $('#second-change-edit').val(),
                                                game_id: gameId,
                                                team_id: $('select#team-for-change-edit').val(),
                                                player_out_id: $('select#player-change-out-id-edit').val(),
                                                player_in_id: $('select#player-change-in-id-edit').val(),
                                            };
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#update-change').attr('href'), 
                                                data: formData,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    console.log(responseServer);
                                                    if(responseServer.success) 
                                                    {
                                                        // Muestro otro dialog con información de éxito
                                                        bootbox.dialog({
                                                            message:"Cambio actualizado correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        reloadDatatable('#datatable-changes');
                                                                    }
                                                                }
                                                            }
                                                        });
                                                        // Limpio cada elemento de las clases añadidas por el validator
                                                        $('#edit-change-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                        $("#edit-change-to-game-form")[0].reset();
                                                    }else{
                                                        bootbox.dialog({
                                                            message: responseServer.errors,
                                                            title: "Error",
                                                            buttons: {
                                                                danger: {
                                                                    label: "Danger!",
                                                                    className: "btn-danger"
                                                                }
                                                            }
                                                        });
                                                        $('#edit-change-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
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
                                                        $('#edit-change-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario*/
                                                }
                                            });
                                            e.preventDefault(); //Prevent Default action.
                                            $(this).unbind('submit');
                                        }); 
                                        $("#edit-change-to-game-form").submit();
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
                        $('#edit-change-to-game-form-div-box')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#edit-change-to-game-form-div-box').hide().appendTo('#edit-change-to-game');
                    })
                    .modal('show');
     }

    var implementActionsToChange = function() 
    {
        $(".table").delegate(".delete-change", "click", function() {
             action = getAttributeIdActionSelect($(this).attr('id'));
             //console.log(action.number);
             deleteChange(action.number);
        });

        $(".table").delegate(".edit-change", "click", function() {
             action = getAttributeIdActionSelect($(this).attr('id'));
             var changeId = action.number;
             var gameId = $(this).attr('data-game-id');
             loadDataForEditChange(changeId);
             bootboxEditChange(gameId, changeId);
             //console.log(action.number);
        });
    }


    var getAvailablePlayersForAlignmentGame = function (idSelect,idField,gameId) {
        $(idSelect).change(function () {
            var teamId = $(this).val();
            var url = $('#players-for-games').attr('href').split('%')[0]+gameId+'/'+teamId;
            //console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                dataType:'json',
                success: function(response) {
                    //console.log(response);
                    var option = '<option value=\"\"></option>';
                    var chosenUpdate = 'chosen:updated';
                    if (response.success == true) {
                        $(idField).html('');
                        $(idField).append(option);
                        $.each(response.players,function (index,object){
                            option = '<option value=\"'+index+'\">'+object+'</option>';
                            $(idField).append(option);
                            $(idField).trigger(chosenUpdate);
                        });
                    }else{
                        $(idField).html('');
                        $(idField).append(option);
                        $(idField).trigger(chosenUpdate);
                    }
                }
            });
        });
     }

     var bootboxAddAlignment = function (gameId) {

            var url = $('#teams-for-games').attr('href').split('%')[0]+gameId;
            getTeamsForGames('#team-for-alignment-id',url);
            getAvailablePlayersForAlignmentGame('#team-for-alignment-id','#player-for-alignment-id',gameId)

            loadFieldSelect($('#lista-posiciones').attr('href'),'#position-alignment-id');
            loadFieldSelect($('#list-of-alignment-types').attr('href'),'#alignment-type-id');
            addValidationRulesForms();
            $('#add-alignment-to-game-form').trigger('reset');
            $('#add-alignment-to-game-form').validate({
                rules:{
                    observations:{
                        rangelength:[1,256],
                    },
                    type_id:{
                        required: true,
                        digits: true
                    },
                    team_id:{
                        required: true,
                        digits: true
                    },
                    player_id:{
                        required: true,
                        digits: true
                    },
                    position_id:{
                        required: true,
                        digits: true
                    }
                },
                messages:{
                    observations:{
                        rangelength: 'Por favor ingrese entre [2, 256] caracteres',
                    },
                    type_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    team_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    player_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    position_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
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
                        message: $('#add-alignment-to-game-form-div-box'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#add-alignment-to-game-form').valid()) 
                                    {
                                        $("#add-alignment-to-game-form").submit(function(e){
                                            var formData = {
                                                observations: $('#observations-alignment').val(),
                                                game_id: gameId,
                                                team_id: $('#team-for-alignment-id').val(),
                                                player_id: $('#player-for-alignment-id').val(),
                                                position_id: $('#position-alignment-id').val(),
                                                type_id: $('#alignment-type-id').val(),
                                            };
                                           // console.log(formData);
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#add-new-alignment-for-game').attr('href'), 
                                                data: formData,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    //console.log(responseServer);
                                                    if(responseServer.success) 
                                                    {
                                                        // Muestro otro dialog con información de éxito
                                                        bootbox.dialog({
                                                            message:"Alineación agregada correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        reloadDatatable('#datatable-local-alignments');
                                                                        reloadDatatable('#datatable-away-alignments');
                                                                    }
                                                                }
                                                            }
                                                        });
                                                        // Limpio cada elemento de las clases añadidas por el validator
                                                        $('#add-alignment-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                        $("#add-alignment-to-game-form")[0].reset();
                                                    }else{
                                                        bootbox.dialog({
                                                            message: responseServer.errors,
                                                            title: "Error",
                                                            buttons: {
                                                                danger: {
                                                                    label: "Danger!",
                                                                    className: "btn-danger"
                                                                }
                                                            }
                                                        });
                                                        $('#add-alignment-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                    }
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) {
                                                   //console.log(errorThrown);
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
                                                        $('#add-alignment-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario*/
                                                }
                                            });
                                            e.preventDefault(); //Prevent Default action.
                                            $(this).unbind('submit');
                                        }); 
                                        $("#add-alignment-to-game-form").submit();
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
                        $('#add-alignment-to-game-form-div-box')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#add-alignment-to-game-form-div-box').hide().appendTo('#add-alignment-to-game');
                    })
                    .modal('show');
     }

     var handleBootboxAddAlignment = function () {

        $(".table").delegate(".add-alignment", "click", function() {
            /*console.log($(this).attr('id'));
            console.log($(this).attr('id').split('-')[2]);*/
            var gameId = $(this).attr('id').split('-')[2];
            bootboxAddAlignment(gameId);
        });

        $('button.add-alignment').click(function () {
            /*console.log($(this).attr('id'));
            console.log($(this).attr('id').split('-')[2]);*/
            var gameId = $(this).attr('id').split('-')[2];
            bootboxAddAlignment (gameId);
        });
     }

     var deleteAlignment = function(idAlignment ) 
    {
        bootbox.confirm("¿Esta seguro de eliminar la alineación?", function(result) 
        {
            //console.log("Confirm result: "+result);
            if (result == true)
            {
                $.ajax({
                    type: 'GET',
                    url: $('#delete-alignments').attr('href'),
                    data: {'alignmentId': idAlignment},
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success == true) {
                            $('#delete_alignment_'+idAlignment).parent().parent().remove();
                            bootbox.dialog({
                                message:" ¡Alineación Eliminada!",
                                title: "Éxito",
                                buttons: {
                                    success: {
                                        label: "Success!",
                                        className: "btn-success",
                                        callback: function () {
                                            reloadDatatable('#datatable-local-alignments');
                                            reloadDatatable('#datatable-away-alignments');
                                        }
                                    }
                                }
                            });
                        }
                    }
                });
            }
        });
    }

    var getTeamsForAlignment = function (idField, url,index) 
     {
        /*console.log(url);
        console.log(idField);*/
         $.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                //console.log(response.teams);
                 if (response.success == true) {
                        $(idField).html('');
                        $(idField).append('<option value=\"\"></option>');
                        $.each(response.teams, function (index, team){
                            $(idField).append('<option value=\"'+team.id+'\">'+team.nombre+'</option>');
                            $(idField).trigger("chosen:updated");
                        });
                        $(idField).val(index);
                        $(idField).trigger("chosen:updated");
                    }else{
                        $(idField).html('');
                        $(idField).append('<option value=\"\"></option>');
                        $(idField).trigger("chosen:updated");
                    }
            }
        });
     }

    var loadDataForEditAlignment = function(idAlignment) {
        $.ajax({
            type: 'GET',
            url: $('#data-alignment').attr('href'),    
            data: {'alignmentId': idAlignment},
            dataType: "JSON",
            success: function(response) 
            {
                //console.log(response);
                 if (response != null) 
                 {
                    if (response.success)
                     {
                        var gameId = response.alignment.game_id;
                        var url = $('#teams-for-games').attr('href').split('%')[0]+gameId;
                    
                        var alignment = $('#edit-alignment-to-game-form-div-box');
                        var data = {
                            title: "Editar Alineación",
                            observations_alignment: response.alignment.observations,
                            team_alignment_id: response.alignment.team_id,
                            team_alignment: response.alignment.team.nombre,
                            player_alignment_id: response.alignment.player_id,
                            player_name: response.alignment.player.nombre,
                            position_alignment_id: response.alignment.position_id,
                            position_name: response.alignment.position.nombre,
                            type_alignment_id: response.alignment.type_id,
                            type_alignment_name: response.alignment.type.name
                        };
                        var template = $('#edit-alignment-tpl').html();
                        var html = Mustache.to_html(template, data);
                        alignment.html(html);
                        //console.log(html)
                        initChosen();
                        getTeamsForAlignment('select#team-for-alignment-edit',url,response.alignment.team_id);
                        getAvailablePlayersForAlignmentGame('select#team-for-alignment-edit','select#player-alignment-id-edit',gameId)
                        loadFieldSelect($('#lista-posiciones').attr('href'),'select#position-alignment-id-edit');
                        loadFieldSelect($('#list-of-alignment-types').attr('href'),'select#type-alignment-id-edit');
                        
                        $('select#position-alignment-id-edit').val(response.alignment.position_id);
                        $('select#position-alignment-id-edit').trigger("chosen:updated");
                        $('select#position-alignment-id-edit').on('chosen:updated', function(event){
                            $('select#position-alignment-id-edit').val(response.alignment.position_id);
                        });

                        $('select#type-alignment-id-edit').val(response.alignment.type_id);
                        $('select#type-alignment-id-edit').trigger("chosen:updated");
                        $('select#type-alignment-id-edit').on('chosen:updated', function(event){
                            $('select#type-alignment-id-edit').val(response.alignment.type_id);
                        });
                        bootboxEditAlignment(gameId, response.alignment.id);
                    }
                }
            }
        });
    }

    var bootboxEditAlignment = function  (gameId, alignmentId) {

            addValidationRulesForms();
            $('#edit-alignment-to-game-form').validate({
                rules:{
                    observations:{
                        rangelength:[1,256],
                    },
                    type_id:{
                        required: true,
                        digits: true
                    },
                    team_id:{
                        required: true,
                        digits: true
                    },
                    player_id:{
                        required: true,
                        digits: true
                    },
                    position_id:{
                        required: true,
                        digits: true
                    }
                },
                messages:{
                    observations:{
                        rangelength: 'Por favor ingrese entre [2, 256] caracteres',
                    },
                    type_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    team_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    player_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
                    },
                    position_id:{
                        required: 'Este campo es obligatorio',
                        digits: 'Ingrese un numero entero'
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
                        message: $('#edit-alignment-to-game-form-div-box'),
                        buttons: {
                            success: {
                                label: "Agregar",
                                className: "btn-primary",
                                callback: function () 
                                {
                                    if($('#edit-alignment-to-game-form').valid()) 
                                    {
                                        $("#edit-alignment-to-game-form").submit(function(e){
                                            var formData = {
                                                alignment_id: alignmentId,
                                                observations: $('#observations-alignment-edit').val(),
                                                game_id: gameId,
                                                team_id: $('#team-for-alignment-edit').val(),
                                                player_id: $('#player-alignment-id-edit').val(),
                                                position_id: $('#position-alignment-id-edit').val(),
                                                type_id: $('#type-alignment-id-edit').val(),
                                            };
                                            //console.log(formData);
                                            $.ajax({
                                                type: 'POST',
                                                url: $('#update-alignment').attr('href'), 
                                                data: formData,
                                                dataType: "JSON",
                                                success: function(responseServer) {
                                                    //console.log(responseServer);
                                                    if(responseServer.success) 
                                                    {
                                                        // Muestro otro dialog con información de éxito
                                                        bootbox.dialog({
                                                            message:"Alineación actualizada correctamente!",
                                                            title: "Éxito",
                                                            buttons: {
                                                                success: {
                                                                    label: "Success!",
                                                                    className: "btn-success",
                                                                    callback: function () {
                                                                        reloadDatatable('#datatable-local-alignments');
                                                                        reloadDatatable('#datatable-away-alignments');
                                                                    }
                                                                }
                                                            }
                                                        });
                                                        // Limpio cada elemento de las clases añadidas por el validator
                                                        $('#edit-alignment-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario
                                                        $("#edit-alignment-to-game-form")[0].reset();
                                                    }else{
                                                        bootbox.dialog({
                                                            message: responseServer.errors,
                                                            title: "Error",
                                                            buttons: {
                                                                danger: {
                                                                    label: "Danger!",
                                                                    className: "btn-danger"
                                                                }
                                                            }
                                                        });
                                                        $('#edit-alignment-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
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
                                                        $('#edit-alignment-to-game-form div').each(function(){
                                                            cleanValidatorClasses(this);
                                                        });
                                                        //Reinicio el formulario*/
                                                }
                                            });
                                            e.preventDefault(); //Prevent Default action.
                                            $(this).unbind('submit');
                                        }); 
                                        $("#edit-alignment-to-game-form").submit();
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
                        $('#edit-alignment-to-game-form-div-box')
                                .show();                             // Show the form
                            })
                    .on('hide.bs.modal', function(e) {
                        // Bootbox will remove the modal (including the body which contains the form)
                        // after hiding the modal
                        // Therefor, we need to backup the form
                        $('#edit-alignment-to-game-form-div-box').hide().appendTo('#edit-alignment-to-game');
                    })
                    .modal('show');
     }

    var implementActionsToAlignment = function() 
    {
        $(".table").delegate(".delete-alignment", "click", function() {
             action = getAttributeIdActionSelect($(this).attr('id'));
             //console.log(action.number);
             deleteAlignment(action.number);
        });

        $(".table").delegate(".edit-alignment", "click", function() {
             action = getAttributeIdActionSelect($(this).attr('id'));
             var alignmentId = action.number;
             var gameId = $(this).attr('data-game-id');
             loadDataForEditAlignment(alignmentId);
             //bootboxEditAlignment(gameId, alignmentId);
             //console.log(action.number);
        });
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
            handleBootboxAddGameToGroupCompetition();
            handleBootboxAddPhaseToCompetition();
            handleBootboxAddNewGroupToPhase();
            handleBootboxAddTeamToGroupCompetition();
            handleBootboxAddGoalToGame();
            handleBootboxAddSanctionsToGame();
            handleBootboxAddChangeToGame();
            handleBootboxAddAlignment();
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
            implementActionsToGoal();
            implementActionsToSanction();
            implementActionsToChange();
            implementActionsToAlignment();
            

            loadPositionSelectPlayerCreate();
            loadPositionSelectPlayerEdit();

            enableCountryToCompetition();

            loadFilter();
            loadTypeComptetitionInfo();
            
            //checkIfGameExist();
        }
    }
}();