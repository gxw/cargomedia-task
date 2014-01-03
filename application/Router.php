<?php

/**
 * Router class 
 */

class Router {

    
    /**
     * List of url parameters
     * @var array
     */
    public $list = array();

    function __construct() {
        $this->list = $this->getRouter();
    }
    /**
     * Return a router with parameters
     * @return array
     */
    private function getRouter() {
        $requestURI = explode('/', $_SERVER['REQUEST_URI']);
        $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);

        for ($i = 0; $i < sizeof($scriptName); $i++) {
            if ($requestURI[$i] == $scriptName[$i]) {
                unset($requestURI[$i]);
            }
        }

        $command = array_values($requestURI);        
        return $command;
    }

}

?>
