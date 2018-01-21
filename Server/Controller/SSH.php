<?php

namespace Server\Controller;

use Server\DataBase\Connection;
use Server\Exceptions\ServerException;
use Server\Utils;

/**
 * Class SSH
 * Controller for SSH section
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Controller
 */
class SSH
{
    /**
     * @var $device
     */
    protected $device;

    /**
     * @var \Server\Connection\SSH $ssh_client
     */
    protected $ssh_client;

    public function __construct()
    {
        session_start();
    }

    /**
     * Method view
     * Method that loads the devices page info and redirect the user to the page
     */
    public function view()
    {
        if (empty($this->device)) {
            $data = Utils::decodeRequest();
            $id = $data->id;
            $conn = new Connection();

            $sql = "SELECT * FROM Devices WHERE id = ?";

            $statement = $conn->prepare($sql);
            $statement->execute( [ $id]);

            $this->device = $statement->fetchAll()[0];
        }

        $_SESSION['selected_device'] = $this->device;

        header('Location: ' . "pages/ssh.php");

        exit();
    }

    /**
     * Method connect
     * Performs a SSH connection
     */
    public function connect()
    {
        $data = Utils::decodeRequest();
        $user = $data->user_ssh;
        $pass = $data->password_ssh;
        $host = $data->ip_address;

        try {
            $this->ssh_client = new \Server\Connection\SSH($host, $user, $pass);
            $this->ssh_client->connect();
            $_SESSION['ssh_client'] = $this->ssh_client;
            echo 'true';
        } catch (\Exception $e)
        {
            echo "false";
        }
    }

    /**
     * Method command
     * Performs a SSH command
     */
    public function command()
    {
        $data = Utils::decodeRequest();
        $command = $data->command;

        try {
            if (is_null($this->ssh_client)) {
                $this->ssh_client = new \Server\Connection\SSH($_SESSION['ssh_host'], $_SESSION['user_ssh'], $_SESSION['ssh_auth_pass']);
            }
            $this->ssh_client->connect();
            $result = $this->ssh_client->exec($command);

            echo $result;
        } catch (\Exception $e)
        {
            echo "false";
        }
    }

}

