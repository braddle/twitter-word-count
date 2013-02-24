<?php

class WordCounter
{
    
    private $counts = array();
    
    /**
     * Take a string and stores a count of each word in it.
     * 
     * @param string $string
     */
    public function addString($string)
    {
        $string = strtolower(trim(str_replace(array('.', ',', '!', '?'), '', $string)));
        
        $words = explode(' ', $string);
        
        foreach ($words as $word)
        {
            $word = strtolower($word);
            
            if (is_numeric($word) || empty($word))
            {
                continue;
            }
            
            if (array_key_exists($word, $this->counts))
            {
                $this->counts[$word]++;
            }
            else
            {
                $this->counts[$word] = 1;
            }
        }
    }
    
    /**
     * Returns an array of the current count of words ordered by number of uses of the words descending.
     * 
     * @param int $limit
     * @return array
     */
    public function getCounts($limit)
    {
        $counts= $this->counts;
        
        arsort($counts);
        
        $counts = array_slice($counts, 0, $limit, true);
        
        return $counts;
    }
        
} // WordCounter
