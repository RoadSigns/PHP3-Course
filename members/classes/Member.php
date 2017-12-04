<?php
    class Member
    {
        public $uName;
        public $fName;
        public $sName;
        public $email;
        public $memberID;
        public $telephone;
        public $profileImagePath;

        public function __construct($member)
        {
            $this->fName = $member->fName;
            $this->sName = $member->sName;
            $this->uName = $member->uName;
            $this->email = $member->email;
            $this->memberID = $member->memberID;
            $this->telephone = $member->telephone;
            $this->profileImagePath = 'http://learn.cf.ac.uk/webstudent/sem6zl/members/images/' . $member->profileImage;
        }
    }