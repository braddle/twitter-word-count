<?php

class WordCounter
{
    
    private $counts = array();
    
    public function addString($string)
    {
        $string = strtolower(trim(str_replace(array('.', ',', '!', '?'), '', $string)));
        
        $words = explode(' ', $string);
        
        foreach ($words as $word)
        {
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
    
    public function getCounts()
    {
        arsort($this->counts);
        
        return $this->counts;
    }
    
}
