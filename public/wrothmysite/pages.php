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

//Get Page
if (isset($_GET{'page'})) { 
$page_name = trim(htmlentities($_GET['page']));
$sql = "SELECT * FROM pages where page_name='$page_name'";
$result = mysqli_query($con, $sql);

//we loop through each records
while($row = mysqli_fetch_array($result)) {
//populate and display results data in each row
$page_title = $row['page_title'];
$page_content = $row['page_content'];
$last_date = $row['last_date'];
$stats = "OK";
$p_title = $page_title;
}
if ($stats == "OK"){}
else
{
 die($lang['25']);
}
}
else
{
    die($lang['25']);
} 
OutPut:    
//Theme & Output
require_once('theme/'.$default_theme.'/header.php');
require_once('theme/'.$default_theme.'/page.php');
require_once('theme/'.$default_theme.'/footer.php');
?>