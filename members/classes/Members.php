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
    
    private $link;
    private $projectPath = '/webstudent/sem6zl/php3/members/';
    private $uploadPath  = '/webstudent/sem6zl/php3/members/images';
    
    public function __construct($link)
    {

        $this->link = $link;
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

        $sql  = "SELECT * FROM members";
            
        $result = $this->link->query($sql)->fetchAll();
        if ($result) {
            return $result;
        } else {
            return $this->link->getError();
        }
        
    }
    
    
    /**
     * 
     * @param type $memberID
     * @return type
     */
    public function getMember($memberID)
    {
        $sql = " SELECT * FROM members WHERE memberid = :id";
        
        $result = $this->link->query($sql)->bind(':id', $memberID)->fetchRow();
        if ($result) {
            return $result;
        } else {
            return false;
        }
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
        $telephone = FILTER_INPUT(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
        $firstname = FILTER_INPUT(INPUT_POST, 'fName',     FILTER_SANITIZE_STRING);
        $surname   = FILTER_INPUT(INPUT_POST, 'sName',     FILTER_SANITIZE_STRING);
        $email     = FILTER_INPUT(INPUT_POST, 'email',     FILTER_SANITIZE_EMAIL );
        
        $username = $surname . "" . substr($firstname, 1);
        
        $table = 'members';
        $columns = array (
            "memberID"  => "",
            "uName"     => $username,
            "email"     => $email,
            "fName"     => $firstname,
            "sName"     => $surname,
            "telephone" => $telephone
        );
        $result = $this->link->insert($table, $columns);
        if ($result) {
            return true;
        } else {
            return false;
        }

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