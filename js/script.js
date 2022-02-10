$(function() {


    jQuery.validator.setDefaults({
        onfocusout: function(e) {
            this.element(e);
        },
        onkeyup: false,

        highlight: function(element) {
            jQuery(element).closest('.form-control').addClass('is-invalid');
        },
        unhighlight: function(element) {
            jQuery(element).closest('.form-control').removeClass('is-invalid');
            jQuery(element).closest('.form-control').addClass('is-valid');
        },

        errorElement: 'div',
        errorClass: 'invalid-feedback',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group-prepend').length) {
                $(element).siblings(".invalid-feedback").append(error);
                //error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
    });

    jQuery.validator.addMethod("phone", function(value, element) {
        value = value.replace("(", "");
        value = value.replace(")", "");
        value = value.replace("-", "");
        var lenValor = value.length;
        if (lenValor != 10 && lenValor != 11) {
            return false;
        }
        return true;
    }, "Por favor, um telefone válido");

     $('#myCustomForm').validate({

        rules: {
            customerName: {
                required: true,
                minlength: 5,
            },
            email: {
                required: true,
                email: true,
            },
            phone: {
                required: true,
                phone: true,

            },
            cidade: {
                required: true,
            },
            estado: {
                required: true,
            },
            resumoProf: {
                required: true,
                minlength: 10,
            },
            presencial: {
                required: true,
            },
        },
        messages: {
            customerName: {
                required: "<i>Campo Obrigatório!</i>",
                minlength: "<i>Seu nome deve conter no mínimo 5 caracteres!</i>",
            },
            phone: {
                required: "<i>Campo Obrigatório!</i>",
                minlength: "<i>Seu telefone deve conter no mínimo 10 caracteres!</i>", 
            },
            email: {
                required: "<i>Campo Obrigatório!</i>",
                email: "<i>Digite um e-mail válido!</i>",
            },
            cidade: {
                required: "<i>Campo Obrigatório!</i>",
                minlength: "<i>Seu nome deve conter no mínimo 3 caracteres!</i>",
            },
            estado: {
                required: "<i>Campo Obrigatório!</i>",
            },
            resumoProf:{
                required: "<i>Campo Obrigatório!</i>",
                minlength: "<i>Você deve digitar no mínimo 10 caracteres!</i>",
            },
            presencial:{
                required: "<i>Campo Obrigatório!</i>",
            },

        }
    });
})

/* 
//https://jqueryvalidation.org/
//https://code.jquery.com/
*/