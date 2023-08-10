<?php
declare(strict_types = 1);
require_once 'Traits/InstantiationCounter.php';
class InstantiationClass
{
    use InstantiationCounter;
    public function method1() {}
    public function method2() {}
}