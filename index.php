<?php

function __autoload($class_name)
{
    include_once 'lib/' . $class_name . '.php';
}

$twitter_word_count = new TwitterWordCount();
$twitter_word_count->run();
