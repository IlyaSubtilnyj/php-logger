<?php
declare(strict_types = 1);
require_once 'Classes/TestClass.php';
require_once 'Classes/Wrapper.php';
require_once 'Classes/MyClonable.php';

$instantiationObject_1 = new InstantiationClass();
var_dump($instantiationObject_1);

$instantiationObject_2 = new InstantiationClass();
var_dump($instantiationObject_2);
unset($instantiationObject_2);

$instantiationObject_3 = new InstantiationClass();
var_dump($instantiationObject_3);

$obj = new MyCloneable();

$obj->object1 = new InstantiationClass();
$obj->object2 = new InstantiationClass();

$obj2 = clone $obj;

print("Original Object:\n");
print_r($obj);

print("Cloned Object:\n");
print_r($obj2);


$testClass = new TestClass();
try {
    $testClass->parameterizedTestFunction('It\'s a number ', 8);
    $testClass->nonParameterizedTestFunction();
} catch (Throwable $exception) {
    echo $exception->getMessage();
}

$wrapperObject = new Wrapper(new TestClass());
$wrapperObject->specialWrapperMethod();
try {
    $wrapperObject->parameterizedTestFunction('wrapper param', 17);
    echo 'end';
} catch (Throwable $exception) {
    echo $exception->getMessage();
}