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
    private $formVal;

    private $projectPath = '/webstudent/sem6zl/members/';
    private $uploadPath  = '/webstudent/sem6zl/members/images/';

    public function __construct($link, $formVal)
    {
        $this->link       = $link;
        $this->formVal    = $formVal;

        if(isset($_POST['frmName']) && $_POST['frmName']=='add'){
            $this->fileUpload = new FileUpload('upload');
            $this->_addMember();
        }

        if(isset($_POST['frmName']) && $_POST['frmName']=='edit'){
            $this->fileUpload = new FileUpload('upload');
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
            require('Member.php');

            foreach ($result as $member){
                $members[] = new Member($member);
            }

            return $members;
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
            $this->getErrors();
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
        $this->formVal->setMethod('POST');
        $this->formVal->registerFields();

        $this->formVal->validate('telephone')->clean()->isRequired();
        $this->formVal->validate('fName')->clean()->isRequired();
        $this->formVal->validate('sName')->clean()->isRequired();
        $this->formVal->validate('email')->clean()->isRequired()->isEmail();

        $fields = $this->formVal->getFields();

        $username = $fields['sName'] . "" . substr($fields['fName'], 1);

        $table = 'members';
        $columns = array (
            "uName"     => $username,
            "email"     => $fields['email'],
            "fName"     => $fields['fName'],
            "sName"     => $fields['sName'],
            "telephone" => $fields['telephone']
        );

        if ($_FILES['upload']['name'] != '') {
            $thumbnailInformation = $this->_uploadImage();
            $profileImage = $thumbnailInformation['filename'];
            $columns["profileImage"] = $profileImage;
        }

        $result = $this->link->insert($table, $columns);
        if ($result) {
            $this->redirect();
        } else {
            $this->getErrors();
        }

    }

    /**
     *
     */
    private function _updateMember()
    {
        $this->formVal->setMethod('POST');
        $this->formVal->registerFields();

        $this->formVal->validate('memberID')->clean()->isRequired();
        $this->formVal->validate('telephone')->clean()->isRequired();
        $this->formVal->validate('fName')->clean()->isRequired();
        $this->formVal->validate('sName')->clean()->isRequired();
        $this->formVal->validate('email')->clean()->isRequired()->isEmail();

        $fields = $this->formVal->getFields();

        $username = $fields['sName'] . "" . substr($fields['fName'], 1);

        $table = 'members';

        $columns = array (
            "uName"     => $username,
            "email"     => $fields['email'],
            "fName"     => $fields['fName'],
            "sName"     => $fields['sName'],
            "telephone" => $fields['telephone']
        );

        if ($_FILES['upload']['name'] != '') {
            $thumbnailInformation = $this->_uploadImage();
            $profileImage = $thumbnailInformation['filename'];
            $columns["profileImage"] = $profileImage;
        }

        $id = $fields['memberID'];

        $where = "memberID = '$id'";
        $result = $this->link->update($table, $columns, $where);
        if ($result) {
            $this->redirect();
        } else {
            $this->errors = $this->formVal->getErrors();
        }
    }

    /**
     * 
     */
    private function _deleteMember()
    {
        $id = FILTER_INPUT(INPUT_GET, 'memberID',  FILTER_SANITIZE_STRING );
        $table = 'members';
        $where = "memberID = '$id'";

        $result = $this->link->delete($table, $where);
        if ($result) {
            $this->redirect();
        } else {
            $this->getErrors();
        }
    }

    private function _uploadImage()
    {
        $this->fileUpload->targetPath = $_SERVER['DOCUMENT_ROOT'] ."/webstudent/sem6zl/members/images/";
        if ($this->fileUpload->validate()) {
            return $this->fileUpload->process();
        } else {
            return $this->fileUpload->getError();
        }
    }
}