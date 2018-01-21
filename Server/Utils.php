<?php
namespace Server;

use ArrayObject;
use ReflectionMethod;
use RecursiveArrayIterator;

/**
 * Class Utils
 * @package Server
 */
trait Utils
{

    public static function dbConfig()
    {
        return array(
            'DBName' => __DIR__. '/db/mt4.db',
            'Drive' => 'sqlite'
        );
    }

    /**
     * Method decodeRequest
     * Decodes request and turns into object or string
     * @param bool $getString Return string or object
     * @access public
     * @return mixed
     */
    public static function decodeRequest ($getString = false)
    {
        if ($getString) {
            return file_get_contents("php://input");
        }

        $data = json_decode(file_get_contents("php://input"));
        if (json_last_error() == JSON_ERROR_NONE) {
            return $data;
        } else {
            parse_str(file_get_contents("php://input"), $result);
            return (object) $result;
        }
    }
}