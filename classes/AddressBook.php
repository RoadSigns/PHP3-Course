<?php

class AddressBook 
{

    private $link;

    public function __construct()
    {
        $this->link = new MyPDO();

        if(isset($_POST['frmName']) && $_POST['frmName']=='update'){
            $this->_updateAddress();
            $this->_redirect();
        }
        if(isset($_POST['frmName']) && $_POST['frmName']=='add'){
            $this->_addAddress();
            $this->_redirect();
        }
        if(isset($_GET['frmName']) && $_GET['frmName']=='delete'){
            $this->_deleteAddress();
            $this->_redirect();
        }

    }

    public function getAddresses()
    {
        $sql  = "SELECT * FROM addressBook";

        $result = $this->link->query($sql)->fetchAll();
        if ($result) {
            return $result;
        } else {
            return $this->link->getError();
        }
    }

    private function _addAddress()
    {
        $table = "addressBook";

        $columns = array (
           "addressID" => "",
           "fName"     => filter_input(INPUT_POST, 'fName',     FILTER_SANITIZE_STRING),
           "sName"     => filter_input(INPUT_POST, 'sName',     FILTER_SANITIZE_STRING),
           "telephone" => filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING),
           "email"     => filter_input(INPUT_POST, 'email',     FILTER_SANITIZE_EMAIL)
        );

        $result = $this->link->insert($table, $columns);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    private function _updateAddress()
    {
        $table = "addressBook";

        $columns = array (
            "fName"     => filter_input(INPUT_POST, 'fName',     FILTER_SANITIZE_STRING),
            "sName"     => filter_input(INPUT_POST, 'sName',     FILTER_SANITIZE_STRING),
            "telephone" => filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING),
            "email"     => filter_input(INPUT_POST, 'email',     FILTER_SANITIZE_EMAIL)
        );

        $id = filter_input(INPUT_POST, 'addressID', FILTER_SANITIZE_NUMBER_INT);
        $where = "addressID = '$id'";

        $result = $this->link->update($table, $columns, $where);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    private function _deleteAddress()
    {
        $cleanID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        $table = 'addressBook';
        $where = "addressID = '$cleanID'";
        $result = $this->link->delete($table, $where);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    private function _redirect()
    {
       header("Location: " . $_SERVER['PHP_SELF']);
       exit();
    }

} 