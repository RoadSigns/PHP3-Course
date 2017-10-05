<?php

class PostCodeLookup {
    

    /**
     * 
     */
    private $encodePostCode,
            $decodePostCode;
    
    /**
     *
     */
    public $Object;
    
    
    public function __construct(){
        
        $this->_setDefaultObject();
        
        if (isset($_POST['postcode']) && $_POST['postcode'] != '') {

            $this->encodePostCode = urlencode($_POST['postcode']);
            $this->decodePostCode = urldecode($_POST['postcode']);
            
            if($_POST['type'] == 'JSON'){
                
                $this->_setJSONObject();
                
            }
            
            if($_POST['type'] == 'XML'){
                
                $this->_setXMLObject();
                
            }      
            
        }
        
    }

    
    // PUBLIC METHODS  //////////////////////////////////////////////////////////////

    // PRIVATE METHODS  //////////////////////////////////////////////////////////////
    
    
    /**
     * 
     */
    private function _setDefaultObject()
    {
        $this->Object = new stdClass();
        $this->Object->postcode = false;    // Decoded Post Code
        $this->Object->address  = false;    // Single line address
        $this->Object->lat      = false;    // float
        $this->Object->lng      = false;    // float
        $this->Object->type     = false;    // JSON|XML
    }
    
    
    /**
     * 
     */
    private function _setJSONObject()
    {
        
        $url = 'https://maps.google.com/maps/api/geocode/json?address=' . $this->encodePostCode;
        
        $geocode = file_get_contents($url);

        $parsedJSON = json_decode($geocode);

        if($parsedJSON->status == 'OK'){
            $this->Object->postcode = $this->decodePostCode;    // Decoded Post Code
            $this->Object->address  = $parsedJSON->results[0]->formatted_address;    // Single line address
            $this->Object->lat      = $parsedJSON->results[0]->geometry->location->lat;    // float
            $this->Object->lng      = $parsedJSON->results[0]->geometry->location->lng;    // float
            $this->Object->type     = 'JSON';    // JSON|XML
        }
        
    }
    
    
    /**
     * 
     */
    private function _setXMLObject()
    {
        
        $url = 'https://maps.google.com/maps/api/geocode/xml?address=' . $this->encodePostCode;
        
        $geocode = file_get_contents($url);

        $parsedXML = new SimpleXMLElement($geocode);
        
        if($parsedXML->status == 'OK'){
            $this->Object->postcode = $this->decodePostCode;
            $this->Object->address = $parsedXML->result->formatted_address->__toString();
            $this->Object->lat = (float)$parsedXML->result->geometry->location->lat;
            $this->Object->lng = (float)$parsedXML->result->geometry->location->lng;
            $this->Object->type = 'XML';
        }
        
    }
    
    
    
}
