<?php
    class Family {
        protected $familyName;
        protected $parents;
        protected $children;
        
        public function __construct($familyName) {
            $this->familyName = $familyName;
            $this->parents = new stdClass;
            $this->children = new stdClass;
        }
        
        public function addChild($name, $age, $title) {
            $this->children->$name = [
                "title" => $title,
                "name" => $name, 
                "age" => $age
                
            ];
        }
        
        public function addParent($name, $age, $title) {
            $this->parents->$name = [
                "title" => $title,
                "name" => $name, 
                "age" => $age
            ];
        }
    }

    
    $lott = new Family("Lott");
    $lott->addChild("Zack", 24, "Son");
    
    
    $jones = new Family ("Jones");
    $jones->addParent("Tom", 45, "Father");
   
    
    echo "<pre>";
        var_dump($lott);
        var_dump($jones);
    echo "</pre>";