<?php

class CompareTest
{
 
    protected $testid;
 
    protected $questions_counter;

    protected $testlevel;
 
    public function __construct($testid, $questions_counter, $testlevel)
    {
        $this->testid = $testid;
        $this->questions_counter   = $questions_counter;
        $this->testlevel   = $testlevel;
    }
 
    public function getMaxPoints()
    {
        return $this->questions_counter * $this->testlevel;
    }
 
}

?>