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
    /**
     * @var $devices
     */
    protected $devices;

    public function __construct()
    {
        session_start();
    }

    public function view()
    {

        $_SESSION['devices'] = $this->devices;

        header('Location: ' . "pages/devices.php");

        exit();
    }

    /**
     * Method getAll
     * Get All devices in database and return the base page
     */
    public function getAll ()
    {
        $conn = new Connection();
        $this->devices = [];
        foreach($conn->query('SELECT * FROM Devices;') as $row)
        {
            $this->devices[] = $row;
        }

        $this->view();

    }

}

