<?php

class InstagramUrlGenerator
{
    public static function generateKeywordUrl($keyword)
    {
       return 'https://www.instagram.com/explore/tags/' . $keyword . '/?__a=1'; 
    }
    
    public static function generateUsernameUrl($username)
    {
        return 'https://www.instagram.com/' . $username . '/?__a=1';
    }
    
    public static function generateImageJsonUrl($imageCode)
    {
        return 'https://www.instagram.com/p/'. $imageCode .'?__a=1';
    }
    
    public static function generateImageUrl($imageCode)
    {
        return 'https://www.instagram.com/p/'. $imageCode . '/';
    }
    
    public static function generateVideoUrl($videoCode)
    {
        return 'https://www.instagram.com/p/'. $videoCode .'?__a=1' ;
    }
    
    
}
