<?php

/*
* @author Balaji
* @name: Worth My Site PHP Script
* @Theme: Default Style
* @copyright 2018 ProThemes.Biz
*
*/

// Disable Errors
error_reporting(1);

$serHTTP = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';

echo "document.write(\"<div style='width: 200px; height: 88px;	border-style: solid; border-color: #e1e1e1; background: url($serHTTP". $_SERVER['HTTP_HOST']."/".$default_path."/img/widget.png) no-repeat;'>\");
document.write(\"<div style='padding: 10px; font: normal 10px Arial, sans-serif; color: #FFF;'><a href='".$w_url."' target='_blank' style='color: #FFF; font: normal 10px Arial, sans-serif; font-weight: bold; text-decoration: none;'>Worth of ".ucfirst($domain)."</a></div>\");
document.write(\"<div style='padding: 18px 5px 0 24px; text-align: center; font: bold 18px Arial, sans-serif; color: #3C81DE;'>$ ".number_format($e_s)."</div>\");
document.write(\"</div>\");";