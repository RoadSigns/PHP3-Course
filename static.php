<?php
    /**
     * Classes can be instantiated more than once, which is one of the fundamental feature of Object Oriented Programming. Both Methods and Properties in a class can be declared as static (or 'shared') which means that they can be used without instantiating the class first.
     * However, if access is constantly required particular to a particular Method or Property, instantiating the Class multiple times may cause issues or processing overhead.
     *
     */

    class Log
    {
        public function __construct()
        {
            // Check for a specific log file
            // Create a log file if it doesn't exist
            // etc..
        }

        public function store($url,$action,$user){

            // Write a line to an existing file

        }

    }

    //Each time:
    $l = new Log;
    $l->store($_SERVER['SCRIPT_URI'],'login',$_SESSION['userID']);


    /**
     * Imagine the overhead of checking that a file exists, every time an action happened that wanted to be logged
     * Adding `static` to the method would enable a Log line to be created, without the overhead of the __constructor()
     *
     */
    class newLog
    {
        public function __construct()
        {
            // Check for a specific log file
            // Create a log file if it doesn't exist
            // etc..
        }

        public static function store($url,$action,$user)
        {
            // Write a line to an existing file
        }

    }

    // Instantiate once..
    $l = new newLog;

    // Use many times..
    newLog::store($_SERVER['SCRIPT_URI'],'login',$_SESSION['userID']);