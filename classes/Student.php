<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student
 *
 * @author sem6zl
 */
class Student extends Person 
{
    public function __construct()
    {
        parent::__construct();
        
        $this->type = 'Student';
        $this->libraryAccess = true;
    } 
    
}