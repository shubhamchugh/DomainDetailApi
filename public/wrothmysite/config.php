<?php
/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @copyright 2019 ProThemes.Biz
 *
 */
error_reporting(1);

// MySQL Hostname
$mysql_host = "";

// MySQL Username
$mysql_user = "";

// MySQL Password
$mysql_pass = "";

// MySQL Database Name
$mysql_database = "";

//Item Purchase Code
$item_purchase_code = "";

//mod_rewrite
$mod_rewrite = "1";


//Oauth Services

// Facebook
define('FB_APP_ID', '');   // Enter your facebook application id
define('FB_APP_SECRET', '');    // Enter your facebook application secret code

// Google 
define('G_Client_ID', '');  // Enter your google api application id
define('G_Client_Secret', ''); // Enter your google api application secret code
define('G_Redirect_Uri', 'http://script6.prothemes.biz/oauth/google.php');
define('G_Application_Name', 'Worth_My_Site');
?>