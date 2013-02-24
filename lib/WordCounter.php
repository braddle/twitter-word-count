<?php

class WordCounter
{
    
    private $counts = array();
    private $ignorable_words;
    
    public function __construct($ignorable_words = array())
    {
        $this->ignorable_words = $ignorable_words;
    }
    
    public function addString($string)
    {
        $string = strtolower(trim(str_replace(array('.', ',', '!', '?'), '', $string)));
        
        $words = explode(' ', $string);
        
        foreach ($words as $word)
        {
            $word = strtolower($word);
            
            if (is_numeric($word) || $this->isIgnorableWord($word) || empty($word))
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
    
    public function getCounts($limit)
    {
        $counts= $this->counts;
        
        arsort($counts);
        
        $counts = array_slice($counts, 0, $limit, true);
        
        return $counts;
    }
    
    /**
     * 
     * @param type $word
     * @return boolean 
     */
    private function isIgnorableWord($word)
    {
        return in_array($word, $this->ignorable_words);
    }
    
} // WordCounter
