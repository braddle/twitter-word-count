<?php

class Tweet
{
    
    private $text;
    private $user_name;

    /**
     * The constucter takes the StdObj recieved form a Twitter API call and
     * pulls out the parts tweet data we require.
     * 
     * @param StdObj $tweet_data
     */
    public function __construct($tweet_data)
    {
        $this->text = $tweet_data->text;
        $this->user_name = $tweet_data->from_user_name;
    }
    
    /**
     * Return the text of the tweet.
     * 
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    
    /**
     * Returns the user name of the user who wrote the tweet.
     * @return string
     */
    public function getUserName()
    {
        return $this->user_name;
    }
    
} // Tweet
