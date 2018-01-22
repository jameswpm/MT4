$(document).ready(function () {

    $('#execute-hash').on('click',  function(e) {
        e.preventDefault();
        var plain = $("#plain").val();
        var compare = $("#compare").val();
        $.ajax({
            method: "POST",
            url: "../index.php",
            data:{
                "action":"Hash/getHash",
                "plain": plain,
                "compare": compare
            },
            success: function(data) {
                var result = JSON.parse(data);
                if(result.results === 'true') {
                    $('#sha').val(result.sha512);
                    $('#hmac').val(result.hmac);
                    $('#gost').val(result.gc);
                }

                if (result.compare === 'true') {
                    $('#system-sha').html(result.sha512);
                    $('#system-hmac').html(result.hmac);
                    $('#system-gc').html(result.gc);
                    if(result.shaCompare == true) {
                        $('#sha-compare').html('Igual');
                    } else {
                        $('#sha-compare').html('Diferente');
                    }

                    if(result.hmacCompare == true) {
                        $('#hmac-compare').html('Igual');
                    } else {
                        $('#hmac-compare').html('Diferente');
                    }

                    if(result.gcCompare == true) {
                        $('#gc-compare').html('Igual');
                    } else {
                        $('#gc-compare').html('Diferente');
                    }

                    $('#modal-hash').modal('show');
                }
            },
            error: function(err) {
                console.log(err);
            }

        })
    });

    $('#modal-hash').on('shown.bs.modal', function () {
        window.setTimeout(closeModal, 10000)
    });

    function closeModal(){
        $('#modal-ssh').modal('hide');
    }
});