<?php

class TwitterWordCount
{
    
    public static function run()
    {
        $json_response = new JsonResponse();
        
        if (!isset($_GET['q']) && !is_string($_GET['q']))
        {
            
            $json_response->sendErrorResponse('Required parameter "q" not set. Please speficity a query string.');
        }
        elseif (!isset($_GET['q']) && !is_int($_GET['q']))
        {
            $json_response->sendErrorResponse('Required parameter "n" not set. Please speficity number of words to return.');
        }
        
        $twitter_searcher = new TwitterSearcher();
        $twitter_searcher->setQueryString($_GET['q']);
        $tweets = $twitter_searcher->getTweets();
        
        $word_counter = new WordCounter();
        
        foreach ($tweets as $tweet)
        {
            $word_counter->addString($tweet->getText());
        }
       
        $json_response->sendSuccessResponse($word_counter->getCounts());
    }
    
} // TwitterWordCount 
