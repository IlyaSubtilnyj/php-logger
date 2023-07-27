<?php

spl_autoload_register(function ($class) {
   include "DifferentClasses/" . $class . ".php";
});

$a = new ClassA();