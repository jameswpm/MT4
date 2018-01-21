<?php
require_once "Main.php";

use Server\Main;

try {
    if (empty($app)) {
        $app = Main::getInstance();
    }
    $app->run();
} catch (Exception $e) {
    print_r ($e->getMessage().$e->getFile().$e->getLine());
}