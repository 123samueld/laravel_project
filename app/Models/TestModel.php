<?php

namespace App\Models;

class TestModel
{
    public $name;
    
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function hello()
    {
        echo "Hello ". $this->name;
    }

    public function loop_out()
    {
        $nums = array('1', '2', '3', '4', '5');

        foreach($nums as $value)
        {
            echo "$value <br>";           
        }
    }
}