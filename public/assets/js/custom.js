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
            $("#new-player-form").show();
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Bootbox
    /*-----------------------------------------------------------------------------------*/
    var handleBootboxNewPlayer = function () {
        $('#loginForm').validate({
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'The username is required'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    }
                }
            });

        $('#new-player').on('click', function() {
            bootbox
                .dialog({
                    title: 'Nuevo Jugador',
                    message: $('#new-player-form'),
                    buttons: {
                        success: {
                            label: "Guardar",
                            className: "btn-success",
                            callback: function () {
                                alert('algo');
                                return false;
                            }
                        }
                    },
                    show: false // We will show it manually later
                })                
                .modal('show');
        });               
    }

    /*-----------------------------------------------------------------------------------*/
    /*  Fancybox New Player
    /*-----------------------------------------------------------------------------------*/
    /*var handleFancyboxNewPlayer = function () {
        $("#new-player").on('click', function(){
            $("#new-player").fancybox({
                openEffect  : 'elastic',
                closeEffect : 'elastic',
                centerOnScroll: true,
                hideOnOverlayClick: true
            });          
        });            
    }*/  

    return {
        init: function() {
            handleBootstrapFileInput();
            handleBootboxNewPlayer();
        }
    };
}();