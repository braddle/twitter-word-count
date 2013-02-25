<?php

/**
 * 
 * @method null setQueryParamLanguage(string $language) Takes a ISO 639-1 languge code to pass to the twitter API call
 * @method null setQueryParamResultsPerPage(integer $rpp) Takes a number of results required per twitter API request
 * @method null setQueryParamResultType(string $result_type) Takes the type of search result required from the twitter API
 * @method null setQueryQuery(string $query) Taker the query to pass to the twitter API
 */
class TwitterSearcher
{
    const PARAM_RESULTS_PER_PAGE = 'count';
    const PARAM_LANGUAGE         = 'lang';
    const PARAM_RESULT_TYPE      = 'result_type';
    const PARAM_QUERY            = 'q';
    
    const FUNCTION_SET_QUERY_PARAM = 'setQueryParam';
    
    const URL_FORMAT = "http://search.twitter.com/search.json?";

    private $query_parameters = array();

    /**
     * Set up the default values for the Twitter API require
     */
    public function __construct()
    {
        $this->setQueryParamLanguage('en');
        $this->setQueryParamResultsPerPage(100);
        $this->setQueryParamResultType('recent');
    }
    
    /**
     * Gets latest tweets for given query string.
     * 
     * @param integer $limit 
     * @return array of \Tweet
     */
    public function getTweets($pages_required)
    {
        $tweets = array();
        
        for ($page = 1; $page <= $pages_required; $page++)
        {
            $tweets = array_merge($tweets, $this->doGetTweets($page));
        }
        
        if (empty($tweets))
        {
            throw new Exception('No tweets found for query: ' . $this->query_parameters['q']);
        }
                
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
        $query_parameters['page'] = $page;
        
        return self::URL_FORMAT . http_build_query($query_parameters);
    }

    /**
     * 
     * @param string $name
     * @param mixed $arguments
     */
    public function __call($name, $arguments)
    {
        if (strpos($name, self::FUNCTION_SET_QUERY_PARAM) !== false)
        {
            $constant = 'self::PARAM_' . 
                        strtoupper(unCamelCase(substr($name, strlen(self::FUNCTION_SET_QUERY_PARAM))));
            
            if (defined($constant))
            {
                $this->query_parameters[constant($constant)] = $arguments[0];
            }
        }
    }
    
} // TwitterSearcher