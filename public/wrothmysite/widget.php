<?php
session_start();
/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @copyright 2020 ProThemes.Biz
 *
 */

// Disable Errors
error_reporting(1);

// Required functions
require_once('config.php');
require_once('core/functions.php');

//UTF-8
header( 'Content-Type: text/html; charset=utf-8' ); 

// Database Connection
$con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_database);
if (mysqli_connect_errno())
    die("Unable connect to database");


// Set theme and lang
$query =  "SELECT lang,theme FROM interface where id=1";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
$default_lang =  Trim($row['lang']);
$default_theme =   Trim($row['theme']);


$domain = trim(htmlentities($_GET['site']));
$domain = clean_url($domain);

// Set theme and lang
$query =  "SELECT estimated_worth FROM domains_data where domain='$domain'";
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($result)) {
    $e_s =  Trim($row['estimated_worth']);
}

//Theme path
$serHTTP = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
$default_path = 'theme/'.$default_theme;
$w_url = $serHTTP. $_SERVER['HTTP_HOST']."/result.php?domain=$domain";

OutPut:    
//Theme & Output
require_once('theme/'.$default_theme.'/widget.php');

?>