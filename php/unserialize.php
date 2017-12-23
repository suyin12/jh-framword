<?php
require 'person.class.php';
$string_person = file_get_contents('file.txt');
$person = unserialize($string_person);

$person->say();