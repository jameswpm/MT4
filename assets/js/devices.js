$(document).ready(function () {

    $('.edit-device').on('click',  function() {
        var id = $(this).attr('id');
        $.ajax({
            method: "POST",
            url: "../index.php",
            data: {"id": id, "action":"Devices/getDevice"},
            success: function(data) {
                var result = JSON.parse(data);
                var form = $('#new-device');
                form.find('#hostname').val(result[0].hostname);
                form.find('#ip').val(result[0].ip_address);
                form.find('#type').val(result[0].type);
                form.find('#manufacturer').val(result[0].manufacturer);
                form.find('#model').val(result[0].model);
                form.append("<input name='id' value='" + id + "' type='hidden'/>")
                form.find('#sent-button').removeClass('btn-success').addClass('btn-primary').html("Modificar");
                form.find('#erase-button').hide();
                form.find("#form-action").val('Devices/editDevice');
            },
            error: function(err) {
                console.log(err);
            }

        })
    });


    $('#devices').DataTable(
        {
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "lengthChange": false,
            "pageLength": 5
        }
    );


});