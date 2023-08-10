<?php
declare(strict_types = 1);
require_once 'Classes/AbstractTestClass.php';
require_once 'logging_plugin_pack/Traits/LogTrait.php';
require_once 'logging_plugin_pack/Traits/WrapperLogTrait.php';

/**
 * Any wrapper/decorator can implement interface(abstract methods) of hidden inside object
 * and set his own methods.
 * @example (bullgare.com; example of wrapper on php)
 */
class Wrapper extends AbstractTestClass {

    //You should plug traits straight like below to be able to log and wrapper's and inner object's class methods
    use WrapperLogTrait, LogTrait {
        LogTrait::__call insteadof WrapperLogTrait;
        WrapperLogTrait::__call as __wltCall;
    }
    protected function parameterizedTestFunction(string $mes, int $num): void
    {
        //$this->obj->parameterizedTestFunction($mes, $num);
        //!!!upper statement doesn't log(but why?); do that if you don't need to log the inner object's method calls

        //and below does log; do this if you want to log any inner object's function calls
        $this->__wltCall('parameterizedTestFunction', array($mes, $num));

        echo 'Function Wrapper::parameterizedTestFunction output' . PHP_EOL;
    }

    protected function nonParameterizedTestFunction(): void
    {
        $this->obj->nonParameterizedTestFunction();
        //another stuff...
        echo 'Function Wrapper::nonParameterizedTestFunction output' . PHP_EOL;
    }
    public function specialWrapperMethod() : void {
        //some stuff...
        echo 'Function Wrapper::specialWrapperMethod output' . PHP_EOL;
    }

}