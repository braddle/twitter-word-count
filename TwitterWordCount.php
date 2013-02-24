<?php

class TwitterWordCount
{
    
    public static function run()
    {
        if (!isset($_GET['q']) && !is_string($_GET['q']))
        {
            $this->returnError('Required parameter "q" not set. Please speficity a query string.');
        }
        elseif (!isset($_GET['q']) && !is_int($_GET['q']))
        {
            $this->returnError('Required parameter "n" not set. Please speficity number of words to return.');
        }
        
        $twitter_searcher = new TwitterSearcher();
        $twitter_searcher->setQueryString($_GET['q']);
        $tweets = $twitter_searcher->getTweets();
        
        $word_counter = new WordCounter();
        
        foreach ($tweets as $tweet)
        {
            //echo '<p>' . $tweet->getText() . '</p>';
            $word_counter->addString($tweet->getText());
        }
        
        print_r($word_counter->getCounts());
        die;
    }
    
} // TwitterWordCount 
