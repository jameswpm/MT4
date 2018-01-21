<?php
require_once "Main.php";

use Server\Main;

try {
    $app = new Main();
    $app->run();
} catch (Exception $e) {
    print_r ($e->getMessage().$e->getFile().$e->getLine());
}