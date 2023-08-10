<?php
declare(strict_types = 1);
require_once 'Classes/TestClass.php';
require_once 'Classes/Wrapper.php';

$testClass = new TestClass();
try {
    $testClass->parameterizedTestFunction('message from the line ', __LINE__);
    $testClass->nonParameterizedTestFunction();
} catch (Throwable $exception) {
    echo $exception->getMessage();
}

$wrapperObject = new Wrapper(new TestClass());
$wrapperObject->specialWrapperMethod();
try {
    $wrapperObject->parameterizedTestFunction('wrapper message from the line ', __LINE__);
} catch (Throwable $exception) {
    echo $exception->getMessage();
}