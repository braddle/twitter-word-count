<?php

class Tweet
{
    
    private $text;
    private $user_name;

    public function __construct($tweet_data)
    {
        $this->text = $tweet_data->text;
        $this->user_name = $tweet_data->from_user_name;
    }
    
    public function getText()
    {
        return $this->text;
    }
}
