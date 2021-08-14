<?php
session_start();
/*
 * @author Balaji
 */
error_reporting(1);
if ($_SERVER['REQUEST_METHOD'] =='POST')
{
    $scode = strtolower(htmlentities(Trim($_POST['scode'])));
    $cap_code = strtolower($_SESSION['captcha']['code']);
    if ($cap_code == $scode)
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
}
?>