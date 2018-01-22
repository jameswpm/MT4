$(document).ready(function () {

    $('#execute-crypto').on('click',  function(e) {
        e.preventDefault();
        var textorig = $("#original").val();
        $.ajax({
            method: "POST",
            url: "../index.php",
            data:{
                "action":"Crypto/encrypt",
                "original": textorig
            },
            success: function(data) {
                var result = JSON.parse(data);
                $('#caesar').val(result.caesar);
                $('#aes').val(result.aes);
                $('#tdes').val(result.tdes);
            },
            error: function(err) {
                console.log(err);
            }

        })
    });

    $('#execute-decipher').on('click',  function(e) {
        e.preventDefault();
        var textorig = $("#original").val();
        $.ajax({
            method: "POST",
            url: "../index.php",
            data:{
                "action":"Crypto/decipher",
                "original": textorig
            },
            success: function(data) {
                var result = JSON.parse(data);
                $('#caesar').val(result.caesar);
                $('#aes').val(result.aes);
                $('#tdes').val(result.tdes);
            },
            error: function(err) {
                console.log(err);
            }

        })
    });
});