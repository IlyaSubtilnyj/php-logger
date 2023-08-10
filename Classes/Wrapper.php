<?php
declare(strict_types = 1);
require_once 'Classes/AbstractTestClass.php';
require_once 'Traits/LogTrait.php';
require_once 'Traits/WrapperLogTrait.php';
class Wrapper extends AbstractTestClass {
    use WrapperLogTrait, LogTrait {
        WrapperLogTrait::__call insteadof LogTrait;
        LogTrait::__call as __ltCall;
    }
    protected function parameterizedTestFunction(string $mes, int $num): void
    {
        //this doesn't register
        //$this->obj->parameterizedTestFunction($mes, $num);
        //this does register
        //$this->__wltCall('parameterizedTestFunction', array($mes, $num));
        echo 'wrapper parameterizedTestFunction' . PHP_EOL;
    }

    protected function nonParameterizedTestFunction(): void
    {
        $this->obj->nonParameterizedTestFunction();
        //another stuff
    }
    public function specialWrapperMethod() : void {
        echo 'in wrapper method';
    }

}