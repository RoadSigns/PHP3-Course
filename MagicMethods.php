<?php

/*
 * Magic Methods must be public.
 * Declaring any of these otherwise will result in an error.
 */
class MagicMethods {
    
    /*
     * __construct()
     * 
     * This method is called automatically when a class is instantiated. 
     * It has no default action, but is commonly used to set 
     * properties / trigger events as soon as the Class has been instantiated. 
     * It is usually included as the first method in any Class.
     * If initial parameters are required on Class instantiation, 
     * they can be passed to the Class declaration inside parenthesis 
     * and used from within the __constructor() in the same order.
     */
    public function __construct() 
    {
        
    }
    
    /* 
     * __destruct()
     *
     * This method is called automatically when the class is ended. 
     * It has no default action, but is commonly used to clean up open files, 
     * store objects, or any other cleanup operations required at the end of the script.
     *
     * The _destruct() method does not accept passed in parameters.
     */
    public function __destruct()
    {
    
    }
    
    /*
     * __get()
     * 
     * This method is called automatically when attempting to retrieve an inaccessible property. 
     * The __get() method takes 1 parameter by default: $propertyName.
     * 
     * Including this method in a Class can be used to:
     *      a) prevent an error on attempting to retrieve an inaccessible property (by leaving the method blank)
     *      b) trigger an event on when requesting an undeclared property, ie: Log
     */
    public function __get($name)
    {
    
    }
    
    /*
     * __set()
     * 
     * This method is called automatically when an inaccessible property is set.
     * The __set() method takes 2 parameters by default: $propertyName and $propertyValue. 
     * The default action is to create the property as a public property and set its value at the same time.
     * 
     * Including this method in a Class can be used to:
     *      a) prevent undeclared properties being set (by leaving the method blank)
     *      b) trigger an event on when setting an undeclared property, ie: Log
     */
    public function __set($name, $value) 
    {
     
    }    
}


