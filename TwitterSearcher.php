<?php

class TwitterSearcher
{
    
    const URL_FORMAT = "http://search.twitter.com/search.json?q=%s&lang=en&result_type=recent&rpp=100";

    private $query_string;
    
    
    public function setQueryString($query_string)
    {
        $this->query_string =$query_string;
    }
    
    public function getQueryString()
    {
        return $this->query_string;
    }

    /**
     * 
     * @return array of \Tweet
     */
    public function getTweets()
    {
        $json = file_get_contents($this->getRequestUrl());
        $data = json_decode($json);
        $tweets = array();
        
        foreach ($data->results
                as $row)
        {
            $tweet = new Tweet($row);
            $tweets[] = $tweet;
        }
        
        return $tweets;
    }
    
    private function getRequestUrl()
    {
        return sprintf(self::URL_FORMAT, $this->getQueryString());
    }
    
} // TwitterSearcher