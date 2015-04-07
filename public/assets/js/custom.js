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
            }, 'only letters, numbers and spaces.');
        $('#player-form').validate({
            rules:{
                nombre:{
                    required:true,
                    rangelength: [2, 64],
                    onlyLettersNumbersAndSpaces: true
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
                                //ajax para el envío del formulario.
                                if($('#player-form').valid()) {
                                    var form = $('#player-form-div').serialize();
                                    var response = true; // Esta variable debería recibir los datos por ajax.
                                    
                                    if(response) {
                                        // Aquí decido que hacer con los datos de la respuesta

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
                                    }

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

    return {
        init: function() {
            handleBootstrapFileInput();
            handleBootboxNewPlayer();
        }
    };
}();