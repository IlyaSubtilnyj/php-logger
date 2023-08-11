<?php
declare(strict_types = 1);
require_once 'logging_plugin_pack/Classes/Logger.php';

trait WrapperLogTrait
{
    private mixed $obj = null;

    function __construct(mixed $class)
    {
        $this->obj = $class;
    }

    public function __call($method, $args) : mixed
    {
        /**
         * if (in_array($method, get_class_methods($this->obj))) {
         * !!!upper statement doesn't work in this case although in LogTrait::__call this does work perfectly
         */
        if (method_exists($this->obj, $method)) {
            Logger::$method($args);
            return call_user_func_array(array($this->obj, $method), $args);
        }
        else {
            throw new BadMethodCallException($method . 'is not exists');
        }
    }

}