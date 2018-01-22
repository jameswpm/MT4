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
            <li>
                <form id="get-crypto" method="GET" action="../">
                    <input type="hidden" name="action" value="Crypto/view">
                    <a href="javascript:{}" onclick="document.getElementById('get-crypto').submit();">Módulo Criptografia</a>
                </form>
            </li>
            <li class="active"><a href="#">Módulo Hash</a></li>

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
                    <h1>Módulo Hash <small>Cria e Compara hashs do texto de um texto a sua escolha com três métodos</small></h1>
                </div>

                <div class="row">
                    <form id="hash-form">

                        <label for="plain" class="control-label">Texto original (plain text):</label>
                        <textarea  class="form-control" name="plain" id="plain" cols="30" rows="10" placeholder="Insira seu texto aqui:"></textarea>

                        <label for="compare" class="control-label">Texto Original ou Cifra:</label>
                        <textarea  class="form-control" name="compare" id="compare" cols="30" rows="10" placeholder="Insira aqui o hash para comparação (opcional):"></textarea>
                        <button type="submit" id="execute-hash" class="btn btn-primary pull-right top-buffer">Criar/Comparar</button>

                    </form>
                </div>
            </div>
        </div>


        <div class="row top-buffer">
            <div class="col-md-3 col-lg-offset-1">
                <label for="sha" class="control-label">SHA512:</label>
                <textarea  class="form-control" name="sha" id="sha" cols="10" rows="10" readonly></textarea>
            </div>
            <div class="col-md-3 col-lg-offset-1">
                <label for="hmac" class="control-label">HMAC:</label>
                <textarea  class="form-control" name="hmac" id="hmac" cols="10" rows="10" readonly></textarea>
            </div>
            <div class="col-md-3 col-lg-offset-1">
                <label for="gost" class="control-label">Gost-crypto:</label>
                <textarea  class="form-control" name="gost" id="gost" cols="10" rows="10" readonly></textarea>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modal-hash" tabindex="-1" role="dialog" aria-labelledby="hash-result" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="resultToHash">Resultados SSH</h4>
            </div>
            <div class="modal-body" style="overflow-x: auto;">
                <table id="devices" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Tipo do Hash</th>
                            <th>Hash do Usuário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="system-sha"></td>
                            <td id="sha-compare"></td>
                        </tr>
                        <tr>
                            <td id="system-hmac"></td>
                            <td id="hmac-compare"></td>
                        </tr>
                        <tr>
                            <td id="system-gc"></td>
                            <td id="gc-compare"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script src="../../assets/libs/jquery/jquery.min.js"></script>
<script src="../../assets/libs/bootstrap/bootstrap.min.js"></script>
<script src="../../assets/js/index.js"></script>
<script src="../../assets/js/hash.js"></script>
</body>
</html>