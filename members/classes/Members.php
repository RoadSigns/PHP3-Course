<?php

/**
 * @author  Chris Maggs <MaggsC1@cardiff.ac.uk>
 * @date    September 2017
 * 
 * @project     PHP3: Members
 * @requires    DB Wrapper
 * @requires    FormValidator
 * @requires    FileUpload
 * 
 */

class Members {
    
    private $errors = array();
    
    private $projectPath = '/xx/xx/xx/xx/';
    private $uploadPath  = '/xx/xx/xx/';
    
    public function __construct()
    {

        if(isset($_POST['frmName']) && $_POST['frmName']=='add'){
            $this->_addMember();
        }
        
        if(isset($_POST['frmName']) && $_POST['frmName']=='edit'){
            $this->_updateMember();
        }

        if(isset($_GET['frmName']) && $_GET['frmName']=='delete'){
            $this->_deleteMember();
        }
        
    }
    
    
    /*
     * Check/Return error array
     */
    public function getErrors(){
        return count($this->errors) ? $this->errors : false;
    }
    
    
    /**
     * 
     * @return type
     */
    public function getMembers()
    {

        // TO DO
        
    }
    
    
    /**
     * 
     * @param type $memberID
     * @return type
     */
    public function getMember($memberID)
    {

        // TO DO
        
    }
    

    /**
     * 
     */
    public function redirect()
    {
        header("Location: ".$this->projectPath);
        exit;
    }
    
    
    
    
    /**
     * 
     */
    private function _addMember()
    {
        
        // TO DO
        
    }
    
    
    /**
     * 
     */
    private function _updateMember()
    {

        // TO DO
        
    }
    
    
    /**
     * 
     */
    private function _deleteMember()
    {

        // TO DO
        
    }
    

    
}