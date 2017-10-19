<?php
// PERSON  /////////////////////////////////////////////////

abstract class Person 
{

    /**
     * @use Protected properties can be used and modified
     *      by the containing class or child classes
     * 
     * @var type 
     */
    protected $carParkAccess,
              $libraryAccess;

    /**
     * @use Private properties can only be 
     *      used by the containing class
     *  
     * @var type 
     */
    private $type,
            $name,
            $email,
            $username;
    
    public function __construct()
    {
        
        // Set default access values
        $this->type          = false;
        $this->carParkAccess = false;
        $this->libraryAccess = false;

    } 
    
    public function setPerson($name)
    {
        
        $this->name = $name;

        $a = explode(' ',$this->name);
        $b = end($a).substr($this->name,0,1);
        $c = strtolower($b);
        $this->username = $c;
        
        $a = explode(' ',$this->name);
        $b = implode('.',$a);
        $c = strtolower($b);
        $this->email = "$c@email.co.uk";
        
    }
    
    public function getPerson()
    {
        return array('Name'     => $this->name,
                     'Username' => $this->username,
                     'Email'    => $this->email,
                     'Access'   => array(
                        'Car Park' => $this->carParkAccess,
                        'Library'  => $this->libraryAccess)
                    );
    }
    
}