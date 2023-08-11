<?php
declare(strict_types = 1);
require_once(dirname(__FILE__) . '/../Classes/Logger.php');
trait LogTrait
{
    public function __call($method, $args) : mixed
    {
        if (in_array($method, get_class_methods($this))) {
            Logger::$method($args);
            return call_user_func_array(array($this, $method), $args);
        }
        else {
            throw new BadMethodCallException($method . 'is not exists');
        }
    }
}