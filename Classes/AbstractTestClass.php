<?php

abstract class AbstractTestClass
{
    abstract protected function parameterizedTestFunction(string $mes, int $num) : void;
    abstract protected function nonParameterizedTestFunction() : void;
}