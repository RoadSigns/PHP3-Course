<?php
include 'dumpr.php';
class Contacts {    
    
    public function getContacts()
    {
        // Simulation of records from the 'contacts' db table
        // ---------------------------------------------------
        // SELECT   * 
        // FROM     contacts
        // ORDER BY contactTitle,contactSurname,contactFirstName
        $contact1 = $c = new StdClass;$c->contactID=1;$c->contactTitle='Mr';$c->contactSurname='Maggs';$c->contactFirstName='Chris';$c->dob='1974-06-30';
        $contact2 = $c = new StdClass;$c->contactID=2;$c->contactTitle='Mr';$c->contactSurname='Maggs';$c->contactFirstName='Craig';$c->dob='1984-11-20';
        $contact3 = $c = new StdClass;$c->contactID=3;$c->contactTitle='Mr';$c->contactSurname='Maggs';$c->contactFirstName='Colin';$c->dob='1982-02-10';
        $contacts = (array($contact1,$contact2,$contact3));
        // End
        
        if($contacts){
            
            foreach ($contacts as $contact) {
                
                // Setting new properties
                $contact->name        = $contact->contactFirstName;
                $contact->fullName    = $contact->contactFirstName . " " . $contact->contactSurname;
                $contact->dateOfBirth = date("jS F Y", strtotime($contact->dob));
                $contact->age         = (date('Y') - date('Y',strtotime($contact->dateOfBirth)));
                
                // Unset the not needed properties
                unset($contact->contactID);
                unset($contact->contactTitle);
                unset($contact->contactFirstName);
                unset($contact->contactSurname);
                unset($contact->dob);
                
                dumpr($contact);
            }
            
            return $contacts;
        }
        
        // return false allows the method to be used as a 'test' as well as for the results
        return false;
    }
    
    
}


$c = new Contacts();
$contacts = $c->getContacts();
dumpr($contacts);