<?php

namespace Server\Connection;

use Exception;

/**
 * Class SSH
 * Client for SSH execute commands
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Connection
 * @see http://php.net/manual/en/function.ssh2-connect.php
 */
class SSH {

    /**
     * @var string $ssh_host
     */
    private $ssh_host;
    /**
     * @var int $ssh_port. Default is 22
     */
    private $ssh_port = 22;

    /**
     * @var string $ssh_auth_user
     */
    private $ssh_auth_user;
    /**
     * @var $ssh_auth_pass. Password
     */
    private $ssh_auth_pass;

    /**
     * @var resource $connection. Represents the ssh client
     */
    private $connection;

    /**
     * SSH constructor.
     * Sets the prams to create the ssh connection
     * @param $host
     * @param $user
     * @param $pass
     */
    public function __construct($host, $user, $pass)
    {
        $this->ssh_host = $host;
        $this->ssh_auth_user = $user;
        $this->ssh_auth_pass = $pass;
    }

    /**
     * Method connect
     * Creates the SSH connection using user and password
     * @throws Exception
     */
    public function connect() {
        if (!($this->connection = ssh2_connect($this->ssh_host, $this->ssh_port))) {
            throw new Exception('Cannot connect to server');
        }

        if (!ssh2_auth_password($this->connection, $this->ssh_auth_user, $this->ssh_auth_pass)) {
            throw new Exception('Autentication rejected by server');
        }

        //If connection passed, save the connection info in Session to use it when commands in
        $_SESSION['user_ssh'] = $this->ssh_auth_user;
        $_SESSION['ssh_host'] = $this->ssh_host;
        $_SESSION['ssh_port'] = $this->ssh_port;
        $_SESSION['ssh_auth_pass'] = $this->ssh_auth_pass;

    }

    /**
     * Method exec
     * @param string $cmd Command to execute
     * @return string
     * @throws Exception
     */
    public function exec($cmd) {
        if (!($stream = ssh2_exec($this->connection, $cmd))) {
            throw new Exception('SSH command failed');
        }

        stream_set_blocking($stream, true);
        $data = "";

        while ($buf = fread($stream, 4096)) {
            $data .= $buf;
        }
        fclose($stream);
        return $data;
    }

    /**
     * Method to disconnect from SSH server
     */
    public function disconnect() {
        $this->exec('exit;');
        $this->connection = null;
    }
}
?>