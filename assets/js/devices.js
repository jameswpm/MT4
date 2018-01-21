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
});