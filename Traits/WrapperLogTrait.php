<?php
declare(strict_types = 1);
require_once 'Classes/Logger.php';
/**
 * any wrapper/decorator can implement interface of hidden inside object and set his own methods so
 * using trait (bullgare.com; example of wrapper on php)
 */
trait WrapperLogTrait
{
    private mixed $obj = null;
    function __construct($class)
    {
        $this->obj = $class;
    }

    public function __call($method, $args) : mixed
    {
        //get_class_methods($this->obj) doesn't work in this case

            //method_exists($this->obj, $method)
        if (in_array($method, get_class_methods($this->obj))) {
            Logger::$method($args);
            return call_user_func_array(array($this->obj, $method), $args);
        }
        else {
            throw new BadMethodCallException($method . 'is not exists');
        }
    }

}