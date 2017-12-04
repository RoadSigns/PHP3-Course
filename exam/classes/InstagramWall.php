<?php

class InstagramWall extends Instagram
{
    public $search;
    public $searchType;
    
    public function __construct()
    {
        $this->search     = filter_input(INPUT_POST, 'search',     FILTER_SANITIZE_STRING);
        $this->searchType = filter_input(INPUT_POST, 'searchType', FILTER_SANITIZE_STRING);
    }
    
    public function getResults()
    {
        if (isset($_POST['search'])) {
            return ($this->searchType == 'username') 
                    ? $this->_searchByUsername($this->search) 
                    : $this->_searchByKeyword($this->search);
        }
    }
    
    private function _searchByKeyword($search)
    {
        $keyword = StringSantizer::removeHashtag($search);
        $url     = InstagramUrlGenerator::generateKeywordUrl($keyword);
        $json    = $this->_parseInstagram($url);
        $results = $this->_generateKeywordObjects($json);
        
        return $results;
    }
    
    private function _searchByUsername($search)
    {
        $username = StringSantizer::removeCommercialAt($search);
        $url      = InstagramUrlGenerator::generateUsernameUrl($username);
        $json     = $this->_parseInstagram($url);
        $results  = $this->_generateUsernameObjects($json);
        
        return $results;
    }
    
    private function _generateUsernameObjects($json)
    {
        $usersInformation = $this->_gatherUsersInformation($json->user);
        
        $media = $json->user->media->nodes;
        $posts = array();
        foreach ($media as $post){
            $posts[] = $this->_generatePostObject($post, $usersInformation);
        }
        
        return $posts;
    }
    
    private function _generateKeywordObjects($json)
    {
        $media = $json->tag->media->nodes;
        $posts = array();
        
        foreach ($media as $post) {
            $json = $this->_parseInstagram('https://www.instagram.com/p/'.$post->code.'/?__a=1');
            
            $usersInformation = $this->_gatherUsersInformation($json->graphql->shortcode_media->owner);
            
            $posts[] = $this->_generatePostObject($post, $usersInformation); 
        }
        
        return $posts;
    }
    
    private function _generatePostObject($object, $usersInformation)
    {
        $tmp = new stdClass;
        
        // Image Information
        $tmp->link  = InstagramUrlGenerator::generateImageUrl($object->code);
        $tmp->thumb = $object->thumbnail_src;
        
        // User Information
        $tmp->name      = $usersInformation->Name;
        $tmp->username  = $usersInformation->UserName;
        $tmp->userimage = $usersInformation->UserImage;
        
        // Video Information
        $tmp->isVideo = $object->is_video;
        $tmp->video   = $this->_parseVideo($tmp->link);
             
        return $tmp;
    }
    
    private function _gatherUsersInformation($json)
    {
        $user = new stdClass;
        
        $user->Name      = $json->full_name;
        $user->UserName  = $json->username;
        $user->UserImage = $json->profile_pic_url;
        
        return $user;
    }
}
