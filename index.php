<?php
/**
 * 
 * @param auto load classes
 */
function __autoload($class) {
    $class = 'application/' . str_replace('\'', '/', $class) . '.php';
    require_once($class);
}
/**
 * Start application
 */
try {
    $r = new Bootstrap();
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

