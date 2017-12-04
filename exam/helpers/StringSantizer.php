<?php

class StringSantizer 
{
    public static function removeCommercialAt($string)
    {
        return str_replace('@', '', $string);   
    }
    
    public static function removeHashtag($string)
    {
        return str_replace('#', '', $string);
    }
}
