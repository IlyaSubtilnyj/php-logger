<?php
declare(strict_types = 1);
require_once 'Classes/AbstractTestClass.php';
require_once 'logging_plugin_pack/Traits/LogTrait.php';
class TestClass extends AbstractTestClass {

    use LogTrait;
    protected function parameterizedTestFunction(string $mes, int $num) : void {
        //any stuff...
        echo 'Function TestClass::parameterizedTestFunction output: ' . $mes . $num . PHP_EOL;
    }

    protected function nonParameterizedTestFunction() : void {
        //any stuff...
        echo 'Function TestClass::nonParameterizedTestFunction output' . PHP_EOL;
    }
}