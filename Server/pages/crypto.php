<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MT4 - Test Page</title>

    <!-- Bootstrap -->
    <link href="../../assets/libs/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/index.css" rel="stylesheet">
    <link href="../../assets/css/devices.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <h3>Módulos do Sistema de Teste</h3>
        </div>

        <!-- Sidebar Links -->
        <ul class="list-unstyled components">
            <li><a href="../../index.html">Home</a></li>

            <li>
                <form id="get-devices" method="GET" action="../">
                    <input type="hidden" name="action" value="Devices/getAll">
                    <a href="javascript:{}" onclick="document.getElementById('get-devices').submit();">Cadastro de Dispositivos</a>
                </form>
            </li>
            <li class="active"><a href="#">Módulo Criptografia</a></li>
            <li><a href="hash.html">Módulo Hash</a></li>

        </ul>


    </nav>

    <!-- Page Content -->
    <div id="content">

        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
            <i class="glyphicon glyphicon-align-left"></i>
            Esconder
        </button>

        <div class="row">
            <div class="col-md-10 col-lg-offset-2">

                <div class="page-header">
                    <h1>Módulo Criptografia <small>Criptografe/Descriptografe um texto a sua escolha com três métodos</small></h1>
                </div>

                <div class="row">
                    <?php
                    echo '<form id="cripto-form">
                             <label for="original" class="control-label">Texto Original ou Cifra:</label>                                   
                             <textarea  class="form-control" name="original" id="original" cols="30" rows="10" placeholder="Insira seu texto ou cifra aqui:"></textarea>
                             <button type="submit" id="execute-crypto" class="btn btn-primary pull-right top-buffer">Criptografar</button>
                             <button type="submit" id="execute-decipher" class="btn btn-primary pull-left top-buffer">Decifrar</button>
                           </form>';
                    ?>
                </div>
            </div>
        </div>
        <div class="row top-buffer">
            <div class="col-md-3 col-lg-offset-1">
                <label for="caesar" class="control-label">Cifra de César:</label>
                <textarea  class="form-control" name="caesar" id="caesar" cols="10" rows="10" readonly></textarea>
            </div>
            <div class="col-md-3 col-lg-offset-1">
                <label for="aes" class="control-label">AES256:</label>
                <textarea  class="form-control" name="aes" id="aes" cols="10" rows="10" readonly></textarea>
            </div>
            <div class="col-md-3 col-lg-offset-1">
                <label for="tdes" class="control-label">Triple DES:</label>
                <textarea  class="form-control" name="tdes" id="tdes" cols="10" rows="10" readonly></textarea>
            </div>
        </div>
    </div>

</div>

<script src="../../assets/libs/jquery/jquery.min.js"></script>
<script src="../../assets/libs/bootstrap/bootstrap.min.js"></script>
<script src="../../assets/js/index.js"></script>
<script src="../../assets/js/crypto.js"></script>
</body>
</html>