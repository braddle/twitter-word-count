<?php

function __autoload($class_name)
{
    include_once 'lib/' . $class_name . '.php';
}

function unCamelCase($str) 
{
  $str[0] = strtolower($str[0]);
  $func = create_function('$c', 'return "_" . strtolower($c[1]);');
  return preg_replace_callback('/([A-Z])/', $func, $str);
}

function camelCase($str, $capitalise_first_char = false) 
{
  if($capitalise_first_char) 
  {
	$str[0] = strtoupper($str[0]);
  }

  $func = create_function('$c', 'return strtoupper($c[1]);');
  return preg_replace_callback('/_([a-z])/', $func, $str);
}

$twitter_word_count = new TwitterWordCount();
echo $twitter_word_count->run();