<?php
require 'person.class.php';

$person = new Person('粟建晖','男',18);

$string_person = serialize($person);
//var_dump($string_person);exit;
file_put_contents('file.txt',$string_person);