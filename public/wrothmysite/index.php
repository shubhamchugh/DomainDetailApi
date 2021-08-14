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

// Check installation file exists
$filename = 'admin/install/install.php';

if (file_exists($filename)) {
    echo "Install.php file exists! <br /> <br />  Redirecting to installer panel...";
    header("Location: /admin/install/install.php");
    echo '<meta http-equiv="refresh" content="1;url=/admin/install/install.php">';
    exit();
} 

// Required functions
require_once('config.php');
require_once("core/cap.php");
require_once('core/functions.php');
require_once('core/whois.php');

//UTF-8
header( 'Content-Type: text/html; charset=utf-8' ); 

//Check item code
if ($item_purchase_code == '')
  die("Item purchase code can't be empty");  


// Database Connection
$con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_database);
if (mysqli_connect_errno())
    die("Unable connect to database");


// App Connection
require_once('core/app.php');

// Sitemap Option
$query = "Select priority,changefreq From sitemap_options WHERE id=1";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
$priority =  $row['priority'];
$changefreq =  $row['changefreq'];

// Load Capthca
$query =  "SELECT color,mode,mul,allowed,cap_e FROM capthca where id=1";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
$color =  Trim($row['color']);
$mode =   Trim($row['mode']);
$mul =  Trim($row['mul']);
$allowed =   Trim($row['allowed']);
$cap_e = Trim($row['cap_e']);


if ($cap_e === 'on')
    $_SESSION['captcha'] = elite_captcha($color,$mode,$mul,$allowed);


//Worth
$query =  "SELECT estimated_worth FROM domains_data WHERE domain='".Trim(strtolower($ps_1))."'";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
$ps_1_worth =  Trim($row['estimated_worth']);

$query =  "SELECT estimated_worth FROM domains_data WHERE domain='".Trim(strtolower($ps_2))."'";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
$ps_2_worth =  Trim($row['estimated_worth']);

$query =  "SELECT estimated_worth FROM domains_data WHERE domain='".Trim(strtolower($ps_3))."'";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
$ps_3_worth =  Trim($row['estimated_worth']);


if ($mod_rewrite == '1') {$ps_1_url = '/'.$ps_1;}else{$ps_1_url = 'result.php?domain='.$ps_1;}      
if ($mod_rewrite == '1') {$ps_2_url = '/'.$ps_2;}else{$ps_2_url = 'result.php?domain='.$ps_2;}  
if ($mod_rewrite == '1') {$ps_3_url = '/'.$ps_3;}else{$ps_3_url = 'result.php?domain='.$ps_3;}   
            
OutPut:    
//Theme & Output
require_once('theme/'.$default_theme.'/header.php');
require_once('theme/'.$default_theme.'/main.php');
require_once('theme/'.$default_theme.'/footer.php');
?>