<?php

class ContactBook 
{
    public $list;
    public function __construct()
    {
        $this->list = new stdClass();
    }
    
    public function addContact($firstName, $surname, $dateOfBirth) 
    {
        $contact = $firstName . " " . $surname;
        $contactDetails = new Contact($firstName, $surname, $dateOfBirth);
        $this->list->$contact = $contactDetails;
    }
}

class Contact 
{
    protected $firstName;
    protected $surname;
    protected $fullName;
    protected $dateOfBirth;
    protected $age;
    
    public function __construct($firstName, $surname, $dateOfBirth)
    {
        $this->firstName   = $firstName;
        $this->surname     = $surname;
        $this->fullName    = $firstName . " " . $surname;
        $this->dateOfBirth = date("d F Y", strtotime($dateOfBirth));
    }
    
}

$contactList = new ContactBook;

$contactList->addContact("Zack", "Lott", "1993-04-14");

echo "<pre>";
    var_dump($contactList);
echo "</pre>";