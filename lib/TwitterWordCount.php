<?php

class TwitterWordCount
{
    
    const PARAMETER_NAME_QUERY_STRING = 'q';
    const PARAMETER_NAME_NUMBER_WORDS = 'n';

    /**
     * Run the Twitter word count API action.
     */
    public function run()
    {
        $json = null;
        
        try
        {
            $json_response = new JsonResponse();
        
            $twitter_searcher = new TwitterSearcher();
            $twitter_searcher->setQueryParamQuery($this->getQueryString());
            $tweets = $twitter_searcher->getTweets(3);
        
            $word_counter = new WordCounter();
        
            foreach ($tweets as $tweet)
            {
                $word_counter->addString($tweet->getText());
            }
       
            $json =  $json_response->getSuccessResponse($word_counter->getCounts($this->getNumberOfWords()));
        }
        catch (Exception $e)
        {
            $json = $json_response->getErrorResponse($e->getMessage());
        }
        
        return $json;
    }
    
    /**
     * Returns the query string specified by the API consumer in the $_GET params.
     * 
     * @return string
     * @throws Exception If the query string is not specified in the $_GET request.
     */
    public function getQueryString()
    {
        if (!isset($_GET[self::PARAMETER_NAME_QUERY_STRING]) && 
            !is_string($_GET[self::PARAMETER_NAME_QUERY_STRING]))
        {
            throw new Exception('Required parameter "q" not set. Please speficity a query string.');
        }
        
        return $_GET[self::PARAMETER_NAME_QUERY_STRING];
    }
    
    /**
     * Retunrs the number of words required specified by the API consumer in the $_GET params.
     * 
     * @return integer
     * @throws Exception If the number of words to be return is not specified in the $_GET request
     */
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
