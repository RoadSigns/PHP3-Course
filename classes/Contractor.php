<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contractor
 *
 * @author sem6zl
 */
class Contractor extends Person
{
    public function __construct()
    {
        parent::__construct();
        // Set default access values
        
        $this->type          = "Contractor";
        $this->carParkAccess = false;
        $this->libraryAccess = false;
        $this->username      = false;
        $this->email         = false;

    } 
    
    public function setPerson($name)
    {
        $this->name = $name;
    }
    
    public function getPerson()
    {
        return array('Type'     => $this->type,
                     'Name'     => $this->name,
                     'Username' => $this->username,
                     'Email'    => $this->email,
                     'Access'   => array(
                        'Car Park' => $this->carParkAccess,
                        'Library'  => $this->libraryAccess)
                    );
    }
}
