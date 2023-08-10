<?php
declare(strict_types = 1);
trait InstantiationCounter
{
    static int $instances = 0;
    public int $instance;
    public function __construct() {
        $this->instance = ++self::$instances;
    }
    public function __clone() {
        $this->instance = ++self::$instances;
    }

    public function __destruct() {
        self::$instances--;
    }
}