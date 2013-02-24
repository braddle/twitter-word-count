<?php

class TwitterSearcher
{
    
    const URL_FORMAT = "http://search.twitter.com/search.json?";

    private $query_parameters = array();

    /**
     * Set up the default values for the Twitter API require
     */
    public function __construct()
    {
        $this->query_parameters['rpp']  = 100;
        $this->query_parameters['lang'] = 'en';
    }
    
    /**
     * Take the query to be used to search Twitter
     * @param string $query_string
     */
    public function setQueryString($query_string)
    {
        $this->query_parameters['q']  = urlencode($query_string);
    }
    
    /**
     * Gets latest tweets for given query string.
     * 
     * Uses array_unique as we could be running the search for multiple request
     * to get each page and could lead to duplicate tweets.
     * 
     * @param integer $limit 
     * @return array of \Tweet
     */
    public function getTweets($pages_required)
    {
        $tweets = array();
        
        for ($page = 1; $page <= $pages_required; $page++)
        {
            array_merge($tweets, $this->doGetTweets($page));
        }
        
        array_unique($tweets);
        
        return $tweets;
    }
    
    /**
     * Return an array of Tweets.
     * 
     * @param integer $page
     * @return array of \Tweet
     */
    private function doGetTweets($page)
    {
        $json = file_get_contents($this->getRequestUrl($page));
        $data = json_decode($json);
        $tweets = array();
        
        foreach ($data->results as $row)
        {
            $tweet = new Tweet($row);
            $tweets[] = $tweet;
        }
        
        return $tweets;
    }
    
    /**
     * Returns the request URL for the twitter search API 
     * @param integer $page
     * @return string
     */
    private function getRequestUrl($page)
    {
        $query_parameters = $this->query_parameters;
        $query_parameters[''] = $page;
        
        return self::URL_FORMAT . http_build_query($query_parameters);
    }
    
} // TwitterSearcher