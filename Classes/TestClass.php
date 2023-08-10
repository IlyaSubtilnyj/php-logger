<?php
declare(strict_types = 1);
require_once 'Classes/AbstractTestClass.php';
require_once 'Traits/LogTrait.php';
class TestClass extends AbstractTestClass {

    use LogTrait;
    protected function parameterizedTestFunction(string $mes, int $num) : void {
        echo $mes . $num . PHP_EOL;
    }

    protected function nonParameterizedTestFunction() : void {
        echo 'nonParameterizedTestFunction';
    }
}