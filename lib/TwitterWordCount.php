<?php

class TwitterWordCount
{
    
    const PARAMETER_NAME_QUERY_STRING = 'q';
    const PARAMETER_NAME_NUMBER_WORDS = 'l';

    public function run()
    {
        try
        {
        $json_response = new JsonResponse();
        
        $twitter_searcher = new TwitterSearcher();
        $twitter_searcher->setQueryString($this->getQueryString());
        $tweets = $twitter_searcher->getTweets(3);
        
        $ignorable_word = array('the', 'rt', 'in', 'a', 'and', 'to', 'for', 'of',
                                'at', 'i', 'with', 'all', 'on', 'is', 'me', 'or',
                                'if', 'it');
        
        $word_counter = new WordCounter($ignorable_word);
        
        foreach ($tweets as $tweet)
        {
            $word_counter->addString($tweet->getText());
        }
       
        echo $json_response->getSuccessResponse($word_counter->getCounts($this->getNumberOfWords()));
        exit;
        }
        catch (Exception $e)
        {
            echo $json_response->getErrorResponse($e->getMessage());
            exit;
        }
    }
    
    public function getQueryString()
    {
        if (!isset($_GET[self::PARAMETER_NAME_QUERY_STRING]) && 
            !is_string($_GET[self::PARAMETER_NAME_QUERY_STRING]))
        {
            throw new Exception('Required parameter "q" not set. Please speficity a query string.');
        }
        
        return $_GET[self::PARAMETER_NAME_QUERY_STRING];
    }
    
    public function getNumberOfWords()
    {
        if (!isset($_GET[self::PARAMETER_NAME_NUMBER_WORDS]) && 
            !is_int($_GET[self::PARAMETER_NAME_NUMBER_WORDS]))
        {
            throw new Exception('Required parameter "n" not set. Please speficity number of words to return.');
        }
        
        return $_GET[self::PARAMETER_NAME_NUMBER_WORDS];
    }

} // TwitterWordCount 
