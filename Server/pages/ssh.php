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

            <li class="active"><a href="#">Cadastro de Dispositivos</a></li>
            <li>
                <form id="get-crypto" method="GET" action="Server">
                    <input type="hidden" name="action" value="Crypto/view">
                    <a href="javascript:{}" onclick="document.getElementById('get-crypto').submit();">Módulo Criptografia</a>
                </form>
            </li>
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
                    <h1>Comandos SSH <small>Envie comandos para o seu dispositivo</small></h1>
                </div>

                <div class="row">
                    <?php
                        echo '<form>
                                    <input type="hidden" name="action" value="SSH/command">
                                    
                                    <label for="ip_address" class="control-label"> Endereço IP:</label>                                    
                                    <input readonly type="text" class="form-control" name="ip_address" id="ip_address" value="' . $_SESSION['selected_device']->ip_address . '">
                                    
                                    <label for="hostname" class="control-label"> Hostname:</label>                                    
                                    <input readonly type="text" class="form-control" name="hostname"  id="hostname" value="' . $_SESSION['selected_device']->hostname . '">
                                   
                                    <label for="user_ssh" class="control-label"> Usuário:</label>                                    
                                    <input type="text" class="form-control" id="user_ssh" name="user_ssh">
                                    
                                    <label for="password_ssh" class="control-label"> Senha:</label>                                    
                                    <input type="password" class="form-control" name="password_ssh" id="password_ssh">
                                    
                                    <button type="submit" id="connect-ssh" class="btn btn-success pull-right top-buffer">Conectar SSH</button>
                                    
                                    <a href="javascript:history.go(-1)" class="btn btn-primary top-buffer">Voltar para tabela de dispositivos.</a>
                              </form>
                              <form id="command-form" style="display: none;" class="top-buffer">
                                <label for="command" class="control-label">Comando:</label>                                    
                                <textarea  class="form-control" name="command" id="command" cols="30" rows="10" placeholder="Insira seu comando aqui:"></textarea>
                                <button type="submit" id="execute-ssh" class="btn btn-success pull-right top-buffer">Executar comando</button>
                              </form>';
                    ?>
                </div>


            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modal-ssh" tabindex="-1" role="dialog" aria-labelledby="results" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Resultados SSH</h4>
            </div>
            <div class="modal-body">
                <span id="message"></span>
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
<script src="../../assets/js/devices.js"></script>
<script src="../../assets/js/ssh.js"></script>
</body>
</html>