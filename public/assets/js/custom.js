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
    return {
        init: function() {
            handleBootstrapFileInput();
            handleShowNewPlayerForm();
        }
    };

}();