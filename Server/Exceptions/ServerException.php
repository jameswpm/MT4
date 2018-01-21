<?php
namespace Server\Exceptions;

use Exception;

/**
 * Class ServerException
 * @package Server\Exceptions
 * @author James Miranda <jameswpm@gmail.com>
 */
class ServerException extends Exception
{

    /**
     * Method __construct
     * Add message
     * @param string $msg
     * @param int $code
     * @access public
     */
    public function __construct ($msg, $code = 0)
    {
        $code = is_int($code) ? $code : null;
        parent::__construct($msg, $code);
    }
}