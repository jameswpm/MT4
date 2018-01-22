<?php

namespace Server\Controller;

use Server\Crypto\AES;
use Server\Crypto\Caesar;
use Server\Crypto\TripleDES;
use Server\Utils;

/**
 * Class Controller
 * basic Controller
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Controller
 */
class Controller
{
    public function __construct()
    {
        session_start();
    }

    /**
     * Method view
     * Method that loads the page info and redirect the user to the page
     */
    public function view()
    {
        header('Location: ' . "../../index.html");

        exit();
    }
}

