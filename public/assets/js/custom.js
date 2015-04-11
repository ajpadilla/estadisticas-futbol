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
    /*  Bootbox
    /*-----------------------------------------------------------------------------------*/
    var cleanValidatorClasses = function(element) {
        if($(element).hasClass('has-error'))
            $(element).closest('.form-group').removeClass('has-error');
        if($(element).hasClass('has-success'))
            $(element).closest('.form-group').removeClass('has-success');
    }

    var handleBootboxNewPlayer = function () {

        $.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
            }, 'sólo letras, números y espacios.');

        $.validator.addMethod('customDateValidator', function(value, element) {
            try{
                jQuery.datepicker.parseDate('dd/mm/yy', value);return true;}
            catch(e){return false;}
        },'Por favor, Ingrese una fecha valida.');

        jQuery.validator.addMethod('decimalNumbers', function(value, element) {
            return this.optional(element) || /^\d{0,10}(\.\d{0,2})?$/i.test(value);
        }, 'Por favor ingrese maximo'+[10]+'digitos enteros'+'y maximo'+[2]+'digitos decimales');

        $.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
              return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, 'sólo letras, números y guiones.');

        $('#player-form').validate({
            rules:{
                nombre:{
                    required:true,
                    rangelength: [2, 64],
                    onlyLettersNumbersAndSpaces: true
                },
                fecha_nacimiento:{
                    required:true,
                    //customDateValidator: true
                },
                altura:{
                    required:true,
                    decimalNumbers:true
                },
                abreviacion:{
                    required:true,
                    onlyLettersNumbersAndDash:true
                },
                posicion:{
                    required:true,
                },
                pais:{
                    required:true,
                }
            },
            messages:{
                nombre:{
                    required:'Este campo es obligatorio.',
                },
                fecha_nacimiento:{
                    required:'Este campo es obligatorio.',
                },
                altura:{
                   required:'Este campo es obligatorio.',
                },
                abreviacion:{
                  required:'Este campo es obligatorio.',
                },
                posicion:{
                    required:'Este campo es obligatorio.',
                },
                pais:{
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

        $('#new-player').on('click', function() {
            bootbox
                .dialog({
                    message: $('#player-form-div'),
                    buttons: {
                        success: {
                            label: "Guardar",
                            className: "btn-primary",
                            callback: function () {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#player-form').valid()) {

                                    var response = false; // Esta variable debería recibir los datos por ajax.
                                    var dataServer = null;

                                    $("#player-form").submit(function(e){
                                        var formData = new FormData(this);
                                        //var form = $('#player-form').serializeArray();

                                        $.ajax({
                                            type: 'POST',
                                            url: $('#agregar-jugador').attr('href'), 
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            dataType: "JSON",
                                            success: function(responseServer) {
                                                if(responseServer.success == true) 
                                                {
                                                    dataServer = responseServer;
                                                    console.log(dataServer);
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
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#player-form")[0].reset();
                                                    $('.chosen-select').html("");
                                                    $('.chosen-select').trigger("chosen:updated");
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
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#player-form")[0].reset();
                                                    $('.chosen-select').html("");
                                                    $('.chosen-select').trigger("chosen:updated");
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
                                                    $("#player-form")[0].reset();
                                                    $('.chosen-select').html("");
                                                    $('.chosen-select').trigger("chosen:updated");
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#player-form").submit();
                                } else {
                                    return false;
                                }

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

    // Metodo para editar datos del jugador
    var editPlayer = function(idPlayer) {

        $.validator.addMethod('onlyLettersNumbersAndSpaces', function(value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9ñÑ\s]+$/i.test(value);
            }, 'sólo letras, números y espacios.');

        $.validator.addMethod('customDateValidator', function(value, element) {
            try{
                jQuery.datepicker.parseDate('dd/mm/yy', value);return true;}
            catch(e){return false;}
        },'Por favor, Ingrese una fecha valida.');

        jQuery.validator.addMethod('decimalNumbers', function(value, element) {
            return this.optional(element) || /^\d{0,10}(\.\d{0,2})?$/i.test(value);
        }, 'Por favor ingrese maximo'+[10]+'digitos enteros'+'y maximo'+[2]+'digitos decimales');

        $.validator.addMethod('onlyLettersNumbersAndDash', function(value, element) {
              return this.optional(element) || /^[a-zA-Z0-9ñÑ\-]+$/i.test(value);
        }, 'sólo letras, números y guiones.');

        $('#player-form').validate({
            rules:{
                nombre:{
                    required:true,
                    rangelength: [2, 64],
                    onlyLettersNumbersAndSpaces: true
                },
                fecha_nacimiento:{
                    required:true,
                    //customDateValidator: true
                },
                altura:{
                    required:true,
                    decimalNumbers:true
                },
                abreviacion:{
                    required:true,
                    onlyLettersNumbersAndDash:true
                },
                posicion:{
                    required:true,
                },
                pais:{
                    required:true,
                }
            },
            messages:{
                nombre:{
                    required:'Este campo es obligatorio.',
                },
                fecha_nacimiento:{
                    required:'Este campo es obligatorio.',
                },
                altura:{
                   required:'Este campo es obligatorio.',
                },
                abreviacion:{
                  required:'Este campo es obligatorio.',
                },
                posicion:{
                    required:'Este campo es obligatorio.',
                },
                pais:{
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
            url: $('#datos-jugador').attr('href'),    
            data: {'jugadorId': idPlayer},
            dataType: "JSON",
            success: function(response) {
                if (response.success == true) {
                    console.log(response);
                    console.log(response.jugador);
                    $('#jugador_id').val(response.jugador.id);
                    $('#nombre').val(response.jugador.nombre);
                    $('#fecha_nacimiento').val(response.jugador.fecha_nacimiento);
                    $('#altura').val(response.jugador.altura);
                    $('#abreviacion').val(response.jugador.abreviacion);
                    $('#posicion_id').val(response.jugador.posicion_id);
                    $('#pais_id').val(response.jugador.pais_id);
                    $('.chosen-select').trigger("chosen:updated");
                }
            }
        });
        
        bootbox.dialog({
                    message: $('#player-form-div'),
                    buttons: {
                        success: {
                            label: "Actualizar",
                            className: "btn-primary",
                            callback: function () {
                                // Si quieres usar aquí jqueryForm, es lo mismo, lo agregas y ya. Creo que es buena idea!

                                //ajax para el envío del formulario.
                                if($('#player-form').valid()) {

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
                                                if(responseServer.success == true) 
                                                {
                                                    dataServer = responseServer;
                                                    console.log(dataServer);
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
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#player-form")[0].reset();
                                                    $('.chosen-select').html("");
                                                    loadFieldSelect($('#lista-paises').attr('href'),'#pais_id');
                                                    loadFieldSelect($('#lista-posiciones').attr('href'),'#posicion_id');
                                                    $('.chosen-select').trigger("chosen:updated");
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
                                                    $('#player-form div').each(function(){
                                                        cleanValidatorClasses(this);
                                                    });
                                                    //Reinicio el formulario
                                                    $("#player-form")[0].reset();
                                                    $('.chosen-select').html("");
                                                    $('.chosen-select').trigger("chosen:updated");
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
                                                    $("#player-form")[0].reset();
                                                    $('.chosen-select').html("");
                                                    loadFieldSelect($('#lista-paises').attr('href'),'#pais_id');
                                                    loadFieldSelect($('#lista-posiciones').attr('href'),'#posicion_id');
                                                    $('.chosen-select').trigger("chosen:updated");
                                            }
                                        });
                                        e.preventDefault(); //Prevent Default action. 
                                    }); 
                                    $("#player-form").submit();
                                } else {
                                    return false;
                                }

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

         bootbox.dialog({
                    message: $('#player-form-view-div'),
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
                    $('#abreviacion_vista').val(response.jugador.abreviacion);
                    $('#posicion_vista').val(response.posicion.nombre);
                    $('#pais_vista').val(response.pais.nombre);

                   /* var form = $('#new-player-form-view');*/

                    /*var template = $('#player-form-view-div-tpl').html();
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

    //Metodo para eliminar jugador de l BD.
    var deletePlayer = function (idPlayer) {
        bootbox.confirm("¿Esta seguro de eliminar al jugador?", function(result) {
            console.log("Confirm result: "+result);
            if (result == true){
               $.ajax({
                type: 'GET',
                url: $('#eliminar-jugador').attr('href'),
                data: {'jugadorId': idPlayer},
                dataType: "JSON",
                success: function(response) {
                    if (response.success == true) {
                        $('#eliminar_'+idPlayer).parent().parent().remove();
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

    // Metodo para saber cual opcion(ver, editar, borrar) fue seleccionada
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
                var numberId = id ? id.split('_')[1] : '';

                if (type == "editar") {
                    editPlayer(numberId);
                }else if(type == "ver"){
                    viewDataPlayer(numberId);
                }else if(type == "eliminar"){
                    deletePlayer(numberId);
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

    var initChosen = function(argument) {
        // Iniciar select chosen
        $('.chosen-select').chosen({width: "100%"});
    }

    var initDataPicker = function() {
         // Iniciar datepicker
         jQuery(function($){
            $.datepicker.regional['es'] = {
                showOn: "both",
                buttonImageOnly: true,
                buttonImage: "calendar.gif",
                buttonText: "Calendar",
                closeText: 'Cerrar',
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
                yearRange: '2014:2030',
                dateFormat: 'dd/mm/yy',
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);
        });    
        $('#fecha_nacimiento').datepicker();
    }

    var loadFieldSelect = function(url,idField) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType:'json',
            success: function(response) {
                console.log(response);
                if (response.success == true) {
                    jQuery(idField).html('');
                    jQuery(idField).append('<option value=\"\"></option>');
                    $.each(response.data,function (k,v){
                        jQuery(idField).append('<option value=\"'+k+'\">'+v+'</option>');
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
            initDataPicker();
            handleBootstrapFileInput();
            handleBootboxNewPlayer();
            loadFieldSelect($('#lista-paises').attr('href'),'#pais_id');
            loadFieldSelect($('#lista-posiciones').attr('href'),'#posicion_id');
            loadDataPlayer();
        }
    };
}();