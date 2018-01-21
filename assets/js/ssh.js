$(document).ready(function () {

    $('#connect-ssh').on('click',  function(e) {
        e.preventDefault();
        var form = $(this).parent('form');
        $.ajax({
            method: "POST",
            url: "../index.php",
            data: {
                "action":"SSH/connect",
                "user_ssh": form.find('#user_ssh').val(),
                "password_ssh": form.find('#password_ssh').val(),
                "ip_address": form.find('#ip_address').val()
            },
            success: function(data) {
                if (data == 'true') {
                    $('#command-form').show();
                    $('#modal-ssh').find('#message').html("Conectado");
                    $('#modal-ssh').modal('show');
                } else {
                    console.log(data);
                    $('#modal-ssh').find('#message').html("Impossível conectar via SSH. Verifique as informações e tente novamente");
                    $('#modal-ssh').modal('show');
                }

            },
            error: function(err) {
                console.log(err);
                $('#modal-ssh').find('#message').html("Impossível conectar via SSH. Verifique as informações e tente novamente");
                $('#modal-ssh').modal('show');
            }

        });
    });

    $('#execute-ssh').on('click',  function(e) {
        e.preventDefault();
        var form = $(this).parent('form');
        $.ajax({
            method: "POST",
            url: "../index.php",
            data: {
                "action":"SSH/command",
                "command": form.find('#command').val()
            },
            success: function(data) {
                if (data != 'false') {
                    $('#modal-ssh').find('#message').html(data);
                    $('#modal-ssh').modal('show');
                } else {
                    console.log(data);
                    $('#modal-ssh').find('#message').html("Impossível Impossível realizar o comando específicado. Tente novamente");
                    $('#modal-ssh').modal('show');
                }

            },
            error: function(err) {
                console.log(err);
                $('#modal-ssh').find('#message').html("Problemas na conexão com o servidor");
                $('#modal-ssh').modal('show');
            }

        });
    });

    $('#modal-ssh').on('shown.bs.modal', function () {
        window.setTimeout(closeModal, 10000)
    });

    function closeModal(){
        $('#modal-ssh').modal('hide');
    }
});