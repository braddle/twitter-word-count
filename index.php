<?php


function __autoload($class_name)
{
    include_once $class_name . '.php';
}

TwitterWordCount::run();
