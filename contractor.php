<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'classes/Person.php';
include 'classes/Student.php';
include 'classes/Staff.php';
include 'classes/Contractor.php';
include 'dumpr.php';

$c = new Contractor;
$c->setPerson('Chris Maggs');
dumpr($c->getPerson());

$su = new Student;
$su->setPerson('Zack Lott');
dumpr($su->getPerson());

$st = new Staff;
$st->setPerson('Janitor Man');
dumpr($st->getPerson());