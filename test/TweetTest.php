<?php

class TweetTest extends PHPUnit_Framework_TestCase
{
    
    public function testConstructor()
    {
        $text      = 'This is a fake tweet';
        $user_name = 'test_user';
        
        $fake_tweet = new stdClass();
        $fake_tweet->text = $text;
        $fake_tweet->from_user_name = $user_name;
        
        $tweet = new Tweet($fake_tweet);
        
        $this->assertEquals($text, $tweet->getText());
        $this->assertEquals($user_name, $tweet->getUserName());
    }
    
} // TweetTest
