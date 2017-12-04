<?php 

date_default_timezone_set('Europe/London');

require_once($_SERVER['DOCUMENT_ROOT'].'/learn/phpcourse/classes/twitteroauth/twitteroauth.php');

class Twitter {
    
    
    //private $ConsumerKey,
    //        $ConsumerSecret,
    //        $AccessToken,
    //        $AccessTokenSecret;
    
    public  $search,
            $tweets;
    
    public function __construct(){
        
        //$this->ConsumerKey          = "nynWoWV8qWqQ5iYrEGHVoPiMu";
        //$this->ConsumerSecret       = "pkTdDQ8fdrvxq6EHg5GfMrSiWM6F3IhgtdZKBw0sVDyrFkQ2Fb";
        //$this->AccessToken          = "74141220-luuLmILZP3IhWHPbyCLyRb06MZfbgAhFqp9B8uCJN";
        //$this->AccessTokenSecret    = "JKlXZtZPRcDPCm0bMXfFMdfWynxoNNdMFiWw2nTuvQUUw";

        $this->search = isset($_GET['search']) ? $_GET['search'] : false;
        $this->tweets = array();
        
        if($this->search){
            $this->_searchTwitter();
        }
        
    }
    
    /**
     * 
     */
    public function getTweets(){
        
        return count($this->tweets) ? $this->tweets : false;
        
    }
    
    
    /**
     * 
     */
    private function _searchTwitter() {
        
        $searchType = substr($this->search,0,1);
        switch($searchType){
            case '@':   $searchParam = "from:".substr($this->search,1). " -filter:retweets  filter:safe";    break;
            case '#':   
            default:    $searchParam = $this->search . ' filter:safe';
        }        
        
        $searchArr = array(
            "lang"              => "en",
            //"result_type"       => "recent",   // recent|popular
            "exclude_replies"   => false,      // exclude replies
            "include_rts"       => false,      // include retweets
            "count"             => 10,         // max tweets returned
            "q"                 => $searchParam
        );
       // dumpr($searchArr);
        
        $connection = new TwitterOAuth($this->ConsumerKey, $this->ConsumerSecret, $this->AccessToken, $this->AccessTokenSecret);
        $results = $connection->get('search/tweets', $searchArr);
        
        foreach($results->statuses as $result){

            $tweet                       = new StdClass;
            $tweet->tweet                = '';
            $tweet->link                 = '';
            $tweet->timestamp            = '';
            
            $tweet->profile              = new StdClass;
            $tweet->profile->name        = '';
            $tweet->profile->username    = '';
            $tweet->profile->description = '';
            $tweet->profile->link        = '';
            $tweet->profile->image       = '';
            
            $tweet->media = false;
            
            if(isset($result->entities)){
                if(isset($result->entities->media)){
                    
                    $tweet->media = new StdClass;
                    $tweet->media->type = '';
                    $tweet->media->url  = '';
                    
                }
            }
                
            $this->tweets[] = $tweet;
        }
        
    }
    
    
    /**
     * 
     * @param type $datetime
     * @param type $full
     * @return type
     */
    private function _timeAgo($datetime) {
        
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        $string = array_slice($string, 0, 1);
        
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

} 