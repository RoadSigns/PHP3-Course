<?php
    class Lesson1 {
        
        public $name;
        public $age;
        
        public function __construct($name, $age) 
        {
            $this->name = $name;
            $this->age  = $age;
        }
    }
    
    
    $zack = new Lesson1('Zack', 24);
    $chris = new Lesson1('Chris', 35);
  
    echo "<pre>";
        var_dump($zack);
        var_dump($chris);
    echo "</pre>";


