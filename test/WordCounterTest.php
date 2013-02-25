<?php

class WordCounterTest extends PHPUnit_Framework_TestCase
{
    
    public function testAddString()
    {
        $first_string = 'This is a test';
        $counts = array('this' => 1,
                        'is'   => 1,
                        'a'    => 1,
                        'test' => 1);
        arsort($counts);
        
        $word_counter = new WordCounter();
        $word_counter->addString($first_string);
        
        $this->assertEquals($counts, $word_counter->getCounts(20));

        $second_string = 'This is a good test';
        
        $word_counter->addString($second_string);
        
        $counts = array('this' => 2,
                        'is'   => 2,
                        'a'    => 2,
                        'good' => 1,
                        'test' => 2);
        
        
        arsort($counts);
        
        $this->assertEquals($counts, $word_counter->getCounts(20));
        
        
        $this->assertCount(2, $word_counter->getCounts(2));
    }
}
