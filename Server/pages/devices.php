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
            <li><a href="crypto.html">Módulo Criptografia</a></li>
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
            <div class="col-md-8 col-lg-offset-4">

                <div class="page-header">
                    <h1>Cadastro de Dispositivos <small>Faça o cadastro dos dispositivos</small></h1>
                </div>

                <div class="row">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Mobile Number</th>
                        </tr>
                        </thead>
                        <tbody>
                        <div class="row">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Mobile Number</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    var_dump ($_SESSION);
                                    /*if (isset($_SESSION['devices'])) {
                                        echo $_SESSION['devices'];
                                        /*foreach ($pdo->query($sql) as $row) {
                                            echo '<tr>';
                                            echo '<td>'. $row['name'] . '</td>';
                                            echo '<td>'. $row['email'] . '</td>';
                                            echo '<td>'. $row['mobile'] . '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<td>'. $row['name'] . '</td>';
                                    }*/
                                ?>
                                </tbody>
                            </table>
                        </div>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

</div>

<script src="../../assets/libs/jquery/jquery.min.js"></script>
<script src="../../assets/libs/bootstrap/bootstrap.min.js"></script>
<script src="../../assets/js/index.js"></script>
</body>
</html>