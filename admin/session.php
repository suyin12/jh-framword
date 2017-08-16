<?php
/**
 *
 * User: suyin
 * Date: 2017/7/11 16:58
 *
 */
session_start();
if($_SESSION['name'] == ""){
    header("Location:".ROOTPATH."admin/login.html");
}