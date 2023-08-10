<?php

interface TestClassInterface
{
    public function parameterizedTestFunction(string $mes, int $num) : void;
    public function nonParameterizedTestFunction() : void;
}