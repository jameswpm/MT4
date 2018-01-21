<?php
namespace Server\DataBase;

use PDO;
use PDOException;
use PDOStatement;
use Server\Utils;

/**
 * Class Connection
 * DataBase Manager
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\DataBase
 */
class Connection
{
    const _AND = 'AND ';
    const _OR  = 'OR ';

    /**
     * @var PDO Stores the database connection
     */
    public $conn;

    /**
     * Method __construct
     * @access public
     * @param string|array $db
     */
    public function __construct ($db = null)
    {
        if (!is_null($db)) {
            $this->open($db);
        } else {
            $this->open(Utils::dbConfig());
        }
    }

    /**
     * Method open
     * Open a new connection with the database
     * @access public
     * @param array $db
     * @throws PDOException
     * @return PDO
     */
    public function open ($db)
    {
        
        //Set Values
        $userName   = isset($db['UserName'])    ? $db['UserName']   : null;
        $password   = isset($db['Password'])    ? $db['Password']   : null;
        $dbName     = isset($db['DBName'])      ? $db['DBName']     : null;
        $hostName   = isset($db['HostName'])    ? $db['HostName']   : null;
        $drive      = isset($db['Drive'])       ? $db['Drive']      : null;
        $port       = isset($db['Port'])        ? $db['Port']       : null;

        //Get the correct drive for each database
        switch ($drive) {
            case 'mysql':
                $port  = is_null($port) ? '3306' : $port;
                try {
                    $this->conn = new PDO("mysql:host={$hostName}; port={$port}; dbname={$dbName}", $userName, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
                } catch (PDOException $e) {
                    throw new $e;
                }
                break;

            case 'sqlite':
                try {
                    $this->conn = new PDO("sqlite:{$dbName}");
                } catch (PDOException $e) {
                    throw $e;
                }
                break;
        }

        //Set PDO to throw Exceptions for errors
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Set PDO to always return objects
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $this->conn;
    }

    /**
     * Method exec
     * Performs a SQL script
     * @access public
     * @return int
     * @param string $sql
     * @throws \Exception
     */
    public function exec ($sql)
    {
        try {
            return $this->conn->exec($sql);
        } catch (PDOException $e) {
            throw new \Exception($e->getMessage(), (int)$e->getCode(), $sql);
        }
    }

    /**
     * Method query
     * Performs a SQL instruction and return objects of type PDOStatement
     * @access public
     * @param string $sql
     * @throws \Exception
     * @return PDOStatement
     */
    public function query ($sql)
    {
        try {
            return $this->conn->query($sql);
        } catch (PDOException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Method prepare
     * Prepare a SQL Statement for execution and return a PDOStatement
     * @access public
     * @param string $sql
     * @throws \Exception
     * @return PDOStatement
     */
    public function prepare ($sql)
    {
        try {
            return $this->conn->prepare($sql);
        } catch (PDOException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }


    /**
     * Method lastInsertId
     * Returns the ID of last inserted line
     * @access public
     * @param string $name
     * @return int
     */
    public function lastInsertId ($name = null)
    {
        return $this->conn->lastInsertId($name);
    }
}
