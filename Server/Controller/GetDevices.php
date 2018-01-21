<?php

namespace Server\Controller;

use Server\DataBase\Connection;

/**
 * Class GetDevices
 * Controller for Devices section
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Controller
 */
class GetDevices
{

    public function view()
    {

    }

    /**
     * Method getAll
     * Get All devices in database and return the base page
     */
    public function getAll ()
    {
        $conn = new Connection();
    }

}

