<?php
/**
 * @author  Chris Maggs <MaggsC1@cardiff.ac.uk>
 * @date    September 2017
 * 
 * @project PHP3: Form Validator
 * @version 2
 * 
 */

class Url {
    
    public $urlArray,
           $urlDomain,
           $urlRootPath,
           $urlFullPath,
           $scriptName,
           $docRoot;
    
    
    public function __construct($rootpath='') {
     
        $this->urlRootPath  = $rootpath;
        $this->urlFullPath  = $_SERVER['REQUEST_URI'];
        $this->scriptName   = $_SERVER['SCRIPT_NAME'];
        $this->docRoot      = $_SERVER['DOCUMENT_ROOT'];
        $this->isSecure     = (bool)isset($_SERVER['HTTPS']); 
        
        $this->urlArray     = $this->parseUrl();
        $this->urlDomain    = $this->buildFQDN();
        
    }
    
    
    /**
     * @desc get, clean and parse the URL
     * @return type
     */
    private function parseUrl(){
        if (isset($this->urlFullPath)) {
            
            $projectURL = str_replace($this->urlRootPath,'',$this->urlFullPath);
            
            $a = parse_url($projectURL,  PHP_URL_PATH);
            $b = trim($a, '/');
            $c = explode('/', $b);
            $d = array_filter($c);
            return $d;
        }
        return array();
    }
    
    
    /**
     * 
     * @return type
     */
    private function buildFQDN(){
        
        $protocol = $this->isSecure ? 'https://' : 'http://';
        return $protocol.$this->scriptName;
    }
    
    
    /**
     * 
     */
    public function getSegment($key){
        if(count($this->urlArray)){
            if(isset($this->urlArray[$key-1])){
                return $this->urlArray[$key-1];
            }
        }
        return false;
    }
    
    
    
}

