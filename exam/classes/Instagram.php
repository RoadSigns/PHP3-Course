 <?php

abstract class Instagram {
    
    /**
     * 
     * @param type $url
     * @return type
     */
    protected final function _parseInstagram($url)
    {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($ch);
        curl_close($ch);                
        
        return json_decode($data);
    }
    
    
    
    /**
     * 
     * @param type $url
     * @return boolean
     */
    protected final function _parseVideo($url)
    {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($ch);
        curl_close($ch);

        $doc = new DOMDocument();
        $doc->loadHTML($data);

        $metas = $doc->getElementsByTagName('meta');

        for ($i = 0; $i < $metas->length; $i++) {
            $meta = $metas->item($i);
            if ($meta->getAttribute('property') == "og:video:secure_url"){
                return $meta->getAttribute('content');
            }
        }
        return false;
        
    }
    
} 