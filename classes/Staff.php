<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff
 *
 * @author sem6zl
 */

class Staff extends Person 
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->type = 'Staff';
        $this->carParkAccess = true;
        $this->libraryAccess = true;

    } 
    
}