<?php
declare(strict_types = 1);
require_once 'Classes/InstantiationClass.php';
class MyCloneable
{
    public InstantiationClass $object1;
    public InstantiationClass $object2;

    function __clone()
    {
        $this->object1 = clone $this->object1;
    }
}