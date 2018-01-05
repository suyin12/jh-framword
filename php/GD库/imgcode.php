<?php
session_start();
require_once 'vcode.class.php';

echo new Vcode(100,30,4);