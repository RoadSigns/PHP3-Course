<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Today
 *
 * @author sem6zl
 */
class Today {
  
    var $timestamp;
    
    // Sets $this->timestamp on Class instantiation
    // $this->timestamp is now available throughout the Class
    function __construct(){
        $this->timestamp = time();
    }

    // Returns a string
    function getClassName(){
        return 'Class is `Today`';
    }

    // Returns the timestamp, formatted into a date
    function getDateTime(){
        return date('jS F Y\, g:ia',$this->timestamp);
    }

    // Returns the current day
    function getDay(){
        return date('l',$this->timestamp);
    }

    // Returns the current month
    function getMonth(){
        return date('F',$this->timestamp);
    }

    // Returns the current year
    // The format of the year can be modified depending on the $digits parameter
    function getYear($digits=2){
        switch($digits){
            case 2:     return date('y',$this->timestamp);  
            case 4:     return date('Y',$this->timestamp);  
            default:    return date('Y',$this->timestamp);  
        }
    }
    
    function incrementDay($value){
        $this->timestamp = strtotime("+${value} day" , $this->timestamp);
        
        return $this;
    }
    
}

$today = new Today;

echo $today->getDateTime();
$today->incrementDay(2);
echo "<hr/>";
echo $today->getDateTime();
echo "<hr/>";
echo $today->incrementDay(5)->getDateTime();
