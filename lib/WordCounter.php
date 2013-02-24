<?php

class WordCounter
{
    
    private $counts = array();
    
    /**
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
