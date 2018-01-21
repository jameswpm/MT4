<?php

namespace Server\Controller;

use Server\DataBase\Connection;
use Server\Utils;

/**
 * Class Devices
 * Controller for Devices section
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Controller
 */
class Devices
{
    /**
     * @var $devices
     */
    protected $devices;

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
        foreach($conn->query('SELECT * FROM Devices') as $row)
        {
            $this->devices[] = $row;
        }

        $this->view();

    }

    /**
     * Method newDevice
     * Inserts a new device in database and reloads the page
     */
    public function newDevice ()
    {
        $data = Utils::decodeRequest();
        $conn = new Connection();

        $sql = "INSERT INTO Devices VALUES (:id, :hostname, :ip_address, :type_device, :manufacturer, :model, :active, :include_date)";

        $statement = $conn->prepare($sql);
        $statement->execute( [
            ':hostname' => $data->hostname,
            ':ip_address' => $data->ip,
            ':type_device' => $data->type,
            ':manufacturer' => $data->manufacturer,
            ':model' => $data->model,
            ':active' => 1,
            ':include_date' => time()
        ]);

        $this->getAll();

    }

    /**
     * Method activate
     * Actives a specific device
     */
    public function activate()
    {
        $data = Utils::decodeRequest();
        $conn = new Connection();

        $id = $data->id;

        $sql = "UPDATE Devices SET active = 1 WHERE id = ?";

        $statement = $conn->prepare($sql);
        $statement->execute( [ $id]);

        $this->getAll();
    }

    /**
     * Method deactivate
     * Deactivate a specific device
     */
    public function deactivate()
    {
        $data = Utils::decodeRequest();
        $conn = new Connection();

        $id = $data->id;

        $sql = "UPDATE Devices SET active = 0 WHERE id = ?";

        $statement = $conn->prepare($sql);
        $statement->execute( [ $id]);

        $this->getAll();
    }

    /**
     * Method getDevice
     * Get one specific device by id
     */
    public function getDevice()
    {
        $data = Utils::decodeRequest();
        $conn = new Connection();

        $id = $data->id;

        $sql = "SELECT * FROM Devices WHERE id = ?";

        $statement = $conn->prepare($sql);
        $statement->execute( [ $id]);

        echo json_encode($statement->fetchAll());

    }

    /**
     * Method editDevice
     * Edit a specific device and reloads the page
     */
    public function editDevice()
    {
        $data = Utils::decodeRequest();
        $conn = new Connection();

        $sql = "UPDATE Devices SET hostname = :hostname, ip_address = :ip_address, type= :type_device, manufacturer = :manufacturer, model= :model WHERE id = :id";

        $statement = $conn->prepare($sql);
        $statement->execute([
            ':hostname' => $data->hostname,
            ':ip_address' => $data->ip,
            ':type_device' => $data->type,
            ':manufacturer' => $data->manufacturer,
            ':model' => $data->model,
            ':id' => $data->id
        ]);

        $this->getAll();
    }

    /**
     * Method deactivate
     * Deactivate a specific device
     */
    public function delete()
    {
        $data = Utils::decodeRequest();
        $conn = new Connection();

        $id = $data->id;

        $sql = "DELETE FROM Devices WHERE id = ?";

        $statement = $conn->prepare($sql);
        $statement->execute( [ $id]);

        $this->getAll();
    }

}

