<?php

/*
* @author Balaji
* @name: Worth My Site PHP Script
* @copyright 2020 ProThemes.Biz
*
*/

//For Checking the Version Number of WorthMySite

// Disable Errors
error_reporting(1);

// Required functions
require_once('../config.php');


define('NAME','WorthMySite');
define('VERSION','v1.9.9a');
$server_ip = $_SERVER['SERVER_ADDR'];

if(isset($_GET['userCode'])) {
    
    $itemCode = md5($item_purchase_code);
    $userCode = Trim(htmlspecialchars($_GET['userCode']));
    if ($itemCode == $userCode) {
        echo "Script Name: ". NAME .'<br>';
        echo "Script Version: ". VERSION .'<br>';
        echo "Server IP: ". $server_ip .'<br>';
    }
}
