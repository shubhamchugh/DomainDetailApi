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
include_once('core/pagination.php');

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

$p_title = $lang['26']; //'Top Sites';

// Define Page
$per_page = '9';
$sql = "SELECT * FROM domains_data ORDER BY estimated_worth";
$rsd = mysqli_query($con, $sql);
$totalrecords = mysqli_num_rows($rsd);
if (isset($_GET['p']))
{
    $pagenumber = Trim(htmlentities($_GET['p']));
    $page = $pagenumber -1;
}else{
    $pagenumber = '1';
    $page = 0;
}
    
if ($mod_rewrite == '1') {$page_url = '/top/';}else{$page_url = 'top.php';}     
if ($mod_rewrite == '1') {$page_p_url = '/top/[p]';}else{$page_p_url = 'top.php?p=[p]';}  

$offset = $per_page * $page;

$pg = new bootPagination();
$pg->pagenumber = $pagenumber;
$pg->pagesize = $per_page;
$pg->totalrecords = $totalrecords;
$pg->showfirst = true;
$pg->showlast = true;
$pg->paginationcss = "pagination-normal";
$pg->paginationstyle = 0;
$pg->defaultUrl = $page_url;
$pg->paginationUrl = $page_p_url;

OutPut:    
//Theme & Output
require_once('theme/'.$default_theme.'/header.php');
require_once('theme/'.$default_theme.'/top.php');
require_once('theme/'.$default_theme.'/footer.php');
?>