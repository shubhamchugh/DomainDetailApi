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

//Page Title
$p_title = "Login/Register";

if(isset($_GET['new_user']))
{
    $new_user = 1;
}

$username = $_SESSION['username'];

// POST Handler
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['user_change']))
    {
        $new_username = htmlentities(Trim($_POST['new_username']));
        if ($new_username == "" || $new_username == null)
        {
            $error =  $lang['23']; //"Username not vaild";
        }
        else
        {    
        $res= isValidUsername($new_username);
        if ($res == '1')
        {
        $query =  "SELECT * FROM users WHERE username='$new_username'";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) > 0)  
        {
            $error = $lang['17']; //"Username already taken";
        }
        else
        {
        $client_id = Trim($_SESSION['oauth_uid']);
        $query = "UPDATE users SET username='$new_username' WHERE oauth_uid='$client_id'";
        mysqli_query($con,$query);
        if(mysqli_error($con))
        {
        $error = $lang['6'];// "Unable to post on database! Contact Support!";
        }
        else
        {
            $success = $lang['24']; //"Username changed successfully";
            unset($_SESSION['username']);
            $_SESSION['username'] = $new_username;
        }
        }
        }
        else
        {
            $error = $lang['23']; //"Username not vaild";
            $username = Trim($_SESSION['username']);
            goto OutPut;
        }
        }
    }
}

OutPut:
//Theme & Output
require_once('theme/'.$default_theme.'/header.php');
require_once('theme/'.$default_theme.'/oauth.php');
require_once('theme/'.$default_theme.'/footer.php');
?>