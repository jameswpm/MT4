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
                <form id="get-crypto" method="GET" action="../">
                    <input type="hidden" name="action" value="Crypto/view">
                    <a href="javascript:{}" onclick="document.getElementById('get-crypto').submit();">Módulo Criptografia</a>
                </form>
            </li>
            <li>
                <form id="get-hash" method="GET" action="../">
                    <input type="hidden" name="action" value="Hash/view">
                    <a href="javascript:{}" onclick="document.getElementById('get-hash').submit();">Módulo Hash</a>
                </form>
            </li>

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
                    <h1>Cadastro de Dispositivos <small>Busque e faça o cadastro dos dispositivos</small></h1>
                </div>

                <div class="row">
                    <table id="devices" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Hostname</th>
                            <th>IP</th>
                            <th>Tipo</th>
                            <th>Fabricante</th>
                            <th>Modelo</th>
                            <th>Ativo</th>
                            <th>Cadastrado Em</th>
                            <th colspan="4">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if (isset($_SESSION['devices'])) {
                                foreach ($_SESSION['devices'] as $device) {
                                    echo '<tr>';
                                    echo '<td>'. $device->id . '</td>';
                                    echo '<td>'. $device->hostname . '</td>';
                                    echo '<td>'. $device->ip_address . '</td>';
                                    echo '<td>'. $device->type . '</td>';
                                    echo '<td>'. $device->manufacturer . '</td>';
                                    echo '<td>'. $device->model . '</td>';
                                    if ($device->active == 1) {
                                        echo '<td>'. "Sim" . '</td>';
                                    } else {
                                        echo '<td>'. "Não" . '</td>';
                                    }
                                    echo '<td>'. gmdate("d-m-Y\TH:i:s\Z", $device->include_date) . '</td>';
                                    echo '<td>';

                                    if ($device->active == 1) {
                                        echo '<form method="POST" action="../">
                                                <input type="hidden" name="action" value="Devices/deactivate">
                                                <input type="hidden" name="id" value="' . $device->id . '">
                                                <button type="submit" class="btn btn-warning">Desativar</button>
                                              </form>';
                                    } else {
                                        echo '<form method="POST" action="../">
                                                <input type="hidden" name="action" value="Devices/activate">
                                                <input type="hidden" name="id" value="' . $device->id . '">
                                                <button type="submit" class="btn btn-primary">Ativar</button>
                                              </form>';
                                    }
                                    echo '</td>';
                                    echo '<td>';
                                    echo
                                              '<button type="button" class="edit-device btn btn-default" id="'. $device->id. '">Editar</button>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<form method="POST" action="../">
                                                <input type="hidden" name="action" value="SSH/view">
                                                <input type="hidden" name="id" value="' . $device->id . '">
                                                <button type="submit" class="btn btn-primary">SSH</button>
                                          </form>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<form method="POST" action="../">
                                                <input type="hidden" name="action" value="Devices/delete">
                                                <input type="hidden" name="id" value="' . $device->id . '">
                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                              </form>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr>';
                                echo '<td colspan="9">'. "Nenhum dispositivo cadastrado" . '</td>';
                                echo '<tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="row top-buffer">
                    <div class="col-md-8">
                        <h3>Cadastre ou modifique um dispositivo</h3>
                        <form id="new-device" method="POST" action="../">
                            <input type="hidden" name="action" id="form-action" value="Devices/newDevice">
                            <label for="hostname" class="control-label">Hostname do dispositivo:</label>
                            <input class="form-control" type="text" name="hostname" id="hostname">

                            <label for="ip" class="control-label">IP do dispositivo:</label>
                            <input class="form-control" type="text" name="ip" id="ip">

                            <label for="type" class="control-label">Tipo do dispositivo:</label>
                            <input class="form-control" type="text" name="type" id="type">

                            <label for="manufacturer" class="control-label">Fabricante do dispositivo:</label>
                            <input class="form-control" type="text" name="manufacturer" id="manufacturer">

                            <label for="model" class="control-label">Modelo do dispositivo:</label>
                            <input class="form-control" type="text" name="model" id="model">

                            <div class="btn-group top-buffer pull-right" role="group">
                                <button type="submit" class="btn btn-success" id="sent-button"> Inserir</button>
                                <button type="reset" class="btn btn-warning" id="erase-button"> Apagar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="../../assets/libs/jquery/jquery.min.js"></script>
<script src="../../assets/libs/bootstrap/bootstrap.min.js"></script>
<script src="../../assets/js/index.js"></script>
<script src="../../assets/js/devices.js"></script>
</body>
</html>