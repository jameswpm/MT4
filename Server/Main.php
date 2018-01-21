<?php

namespace Server;

use Server\Exceptions\ServerException;

/**
 * Class Main
 * Entry Point and autoload class
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server
 * @access public
 */
class Main
{
    /**
     * @var array $route
     */
    private static $route = array();

    /**
     * Main constructor.
     */
    public function __construct()
    {
        self::$route['index'] = "../index.html";
    }

    /**
     * Method run
     * Call the app
     * @return void
     */
    public function run ()
    {
        //Registry AutoLoader
        spl_autoload_register(array($this, 'loader'));
        //dynamic route
        $this->route();
    }

    /**
     * Method loader
     * Autoload
     * @param string $fileName
     * @return void
     * @throws \Exception
     */
    private function loader ($fileName)
    {
        if (PHP_OS == "Windows" || PHP_OS == "WINNT") {
            $separator = '\\';
        } else {
            $fileName = preg_filter("/\\\/", '/', $fileName);
            $separator = '/';
        }

        $fileCheck = explode($separator, $fileName);

        $dir = __DIR__;

        if($fileCheck[0] == __NAMESPACE__) {
            unset($fileCheck[0]);
            $fileName = implode($separator, $fileCheck);
            require_once $dir . "{$separator}{$fileName}.php";
        } else {
            if (file_exists($dir . "/{$fileName}.php")) {
                require_once "./{$fileName}.php";
            } elseif (file_exists(strtolower($dir . "/{$fileName}.php"))) {
                require_once strtolower("./{$fileName}.php");
            }
        }
    }

    /**
     * Method route
     * Get the class and method according to the Route
     */
    private function route ()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['action'])) {
            $index = isset(self::$route['index']) ? self::$route['index'] : null;
            header("Location: $index");
        }
        elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
            $queryStrings = array_filter(explode('/', $_GET['action']));

        } elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
            $queryStrings = array_filter(explode('/', $_POST['action']));

        }

        if (!empty($queryStrings)) {
            $nameClass = 'Controller';

            foreach ($queryStrings as $key => $qs) {
                unset($queryStrings[$key]);
                $nameClass .= '\\' . ucfirst($qs);
                if (class_exists(__NAMESPACE__ . "\\" . $nameClass)) {
                    break;
                }
            }

            if (!class_exists(__NAMESPACE__ . "\\" . $nameClass) || $nameClass == 'Controller') {
                $ex = new ServerException("Class \"$nameClass\" not found.");
                throw $ex;
            }

            $completeClassName = __NAMESPACE__ . "\\" . $nameClass;
            $class = new $completeClassName;
            $queryStrings = array_values($queryStrings);

            $nameMethod = $queryStrings[0];
            if (method_exists($class, $nameMethod)) {
                $class->$nameMethod();
            } else {
                throw new ServerException("Method \"$nameMethod\" not found.");
            }
        } else {
            throw new ServerException("Impossible to get the action for this request");
        }

    }
}
