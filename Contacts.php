<?php

    include 'dumpr.php';

class ContactBook 
{
    public function __construct()
    {
    }
    
    public function addContact($firstName, $surname, $dateOfBirth) 
    {
        $contact = $firstName . "" . $surname;
        $contactDetails = new Contact($firstName, $surname, $dateOfBirth);
        $this->$contact = $contactDetails;
    }

    public function removeContact($contact)
    {
        unset($this->$contact);
    }


    /*
     *
     * Currently I am unable to turn Objects with Objects within them into JSON using json_encode()
     * Might have to turn details within the Contact Object into an key => value array to allow the encoding to work easier
     * This would mean I might have to loop out all the results if I want to use them information going forward
     *
     */
    public function listContacts()
    {
        return $this;
    }


}

class Contact 
{
    protected $fullName;
    protected $dateOfBirth;
    protected $age;
    
    public function __construct($firstName, $surname, $dateOfBirth)
    {
        $this->fullName    = $firstName . " " . $surname;
        $this->dateOfBirth = date("d F Y", strtotime($dateOfBirth));
    }
}

$contactList = new ContactBook;

$contactList->addContact("Zack", "Lott", "1993-04-14");
$contactList->addContact("Jacquizz", "Rodgers", "1989-12-14");
$contactList->addContact("Jared", "Goff", "1991-08-12");
$contactList->addContact("Ling", "Chan", "1995-10-01");

dumpr($contactList);

$contactList->removeContact("ZackLott");

dumpr($contactList);