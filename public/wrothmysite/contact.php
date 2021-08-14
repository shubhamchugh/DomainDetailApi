<?php
session_start();
/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @copyright © 2017 ProThemes.Biz
 *
 */

// Disable Errors
error_reporting(1);

// Required functions
require_once('config.php');
require_once("core/cap.php");
require_once('core/functions.php');

//UTF-8
header( 'Content-Type: text/html; charset=utf-8' ); 

//Check item code
if ($item_purchase_code == '')
{
  die("Item purchase code can't be empty");  
}

// Database Connection
$con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_database);
if (mysqli_connect_errno())
{
die("Unable connect to database");
}

// App Connection
require_once('core/app.php');

// Sitemap Option
$query = "Select * From sitemap_options WHERE id='1'"; 
$result = mysqli_query($con,$query); 
    
while($row = mysqli_fetch_array($result)) {
$priority =  $row['priority'];
$changefreq =  $row['changefreq'];
}

// Load Capthca
$query =  "SELECT * FROM capthca where id='1'";
$result = mysqli_query($con,$query);
       	 	 	 	   
while($row = mysqli_fetch_array($result)) {
$color =  Trim($row['color']);
$mode =   Trim($row['mode']);
$mul =  Trim($row['mul']);
$allowed =   Trim($row['allowed']);
$cap_e = Trim($row['cap_e']);
$cap_c = Trim($row['cap_c']);
}
if ($cap_c == "on")
{
$_SESSION['captcha'] = elite_captcha($color,$mode,$mul,$allowed);    
}

$p_title = $lang['1']; //'Contact Us';

  
OutPut:    
//Theme & Output
require_once('theme/'.$default_theme.'/header.php');
require_once('theme/'.$default_theme.'/contact.php');
require_once('theme/'.$default_theme.'/footer.php');
?>