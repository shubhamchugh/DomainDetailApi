<?php
/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @Theme: Default Style
 * @copyright © 2017 ProThemes.Biz
 *
 */

//UTF-8
header( 'Content-Type: text/html; charset=utf-8' );

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" type="image/png" href="/<?php echo $fav_path; ?>" />

        <!-- social network metas -->
        <title><?php if(isset($p_title)) { echo $p_title.' | '. $site_name;}else { echo $title; } ?></title>
                
        <meta property="site_name" content="<?php echo $site_name; ?>"/>
        <meta property="description" content="<?php echo $des; ?>" />
        <meta name="description" content="<?php echo $des; ?>" />
        <meta name="keywords" content="<?php echo $keyword; ?>" />

        <!-- Main style -->
        <link href="<?php echo $default_path; ?>/css/theme.css" rel="stylesheet" />
        <!-- Font-Awesome -->
        <link href="<?php echo $default_path; ?>/css/font-awesome.min.css" rel="stylesheet" />


        <!-- Ionicons -->
        <link href="<?php echo $default_path; ?>/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo $default_path; ?>/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo $default_path; ?>/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo $default_path; ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $default_path; ?>/css/reset.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<style> 
<?php if ($cap_e == "on") { ?> 
#myhome{ display:none; } 
#newhome{ display:block; } 
<?php } else { ?>
#myhome{ display:block; } 
#newhome{ display:none; } 
<?php } ?>
#c_alert1{ display:none; } #c_alert2{ display:none; } #preloader{ display:none; }</style>   
<script>
function showLoading() {
    $("#preloader").show();
    $("#myhome").hide();
    $("#newhome").hide();
}
function loadXMLDoc()
{
var xmlhttp;
var strr = $('input[name=url]').val();
strr=jQuery.trim(strr);
strr = strr.toLowerCase();
if (strr.indexOf("https://") == 0){strr=strr.substring(8);}
if (strr.indexOf("http://") == 0){strr=strr.substring(7);}
if (strr.indexOf("/") != -1){var tyv=strr.indexOf("/");strr=strr.substring(0,tyv);}
if (strr.indexOf(".") == -1 ){strr+=".com";}
if (strr.indexOf(".") == (strr.length-1)){strr+="com";}
strr = strr.replace("www.", ""); 
var rgx = /^(http(s)?:\/\/)?(www\.)?[a-z0-9\-]{2,100}(\.[a-z]{2,100})(\.[a-z]{2,2})?$/i; 
if (strr==null || strr=="" || !rgx.test(strr)) {
alert("Not a vaild domain name");
return false;
}
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    }
  }
showLoading();
$.post("core/process.php", {domain:strr}, function(results){
if (results == 1)
{
<?php  if ($mod_rewrite == '1') {
?>  
url = "/"+strr;
<?php
} else { 
?>
url = "result.php?domain="+strr;
<?php   
}?>

$( location ).attr("href", url);
}
else if(results == 0)
{
$("#preloader").hide();
$("#newhome").hide();
$("#myhome").show();
alert("Something went wrong");
}
else
{
    $("#newhome").hide();
    $("#preloader").hide();
    $("#myhome").show();
    alert(results);
}
});
}
</script>

<script>
function cap_showLoading() {
    $("#preloader").show();
    $("#newhome").hide();
    $("#myhome").hide(); 
}
function cap_loadXMLDoc()
{
var xmlhttp;
var strr = $('input[name=cap_url]').val();
strr=jQuery.trim(strr);
strr = strr.toLowerCase();
if (strr.indexOf("https://") == 0){strr=strr.substring(8);}
if (strr.indexOf("http://") == 0){strr=strr.substring(7);}
if (strr.indexOf("/") != -1){var tyv=strr.indexOf("/");strr=strr.substring(0,tyv);}
if (strr.indexOf(".") == -1 ){strr+=".com";}
if (strr.indexOf(".") == (strr.length-1)){strr+="com";}
strr = strr.replace("www.", ""); 
var capc = $('input[name=scode]').val();
var rgx = /^(http(s)?:\/\/)?(www\.)?[a-z0-9\-]{2,100}(\.[a-z]{2,100})(\.[a-z]{2,2})?$/i; 
if (strr==null || strr=="" || !rgx.test(strr)) {
alert("Not a vaild domain name");
return false;
}
if (capc==null || capc=="") {
alert("Enter the image verification");
return false;
}
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    }
  }
cap_showLoading();
$.post("core/verify.php", {scode:capc}, function(results){
if (results == 1) {
$.post("core/process.php", {domain:strr}, function(results){
if (results == 1)
{
<?php  if ($mod_rewrite == '1') {
?>  
url = "/"+strr;
<?php
} else { 
?>
url = "result.php?domain="+strr;
<?php   
}?>

$( location ).attr("href", url);
}
else if(results == 0)
{
$("#preloader").hide();
$("#newhome").show();
alert("Something went wrong");
}
else
{
    $("#preloader").hide();
    $("#newhome").show();
    alert(results);
}
});
}
else
{
$("#preloader").hide();
$("#newhome").show();
alert("Captcha code is wrong!");
return false;   
}
});
}
</script>

<script>
function mshowLoading() {
    $("#preloader").show();
    $("#myhome").hide();
    $("#newhome").hide();
}
function mloadXMLDoc()
{
var xmlhttp;
var strr = $('input[name=url]').val();
strr=jQuery.trim(strr);
strr = strr.toLowerCase();
if (strr.indexOf("https://") == 0){strr=strr.substring(8);}
if (strr.indexOf("http://") == 0){strr=strr.substring(7);}
if (strr.indexOf("/") != -1){var tyv=strr.indexOf("/");strr=strr.substring(0,tyv);}
if (strr.indexOf(".") == -1 ){strr+=".com";}
if (strr.indexOf(".") == (strr.length-1)){strr+="com";}
strr = strr.replace("www.", ""); 
var rgx = /^(http(s)?:\/\/)?(www\.)?[a-z0-9\-]{2,100}(\.[a-z]{2,100})(\.[a-z]{2,2})?$/i; 
var u1 = '1';
if (strr==null || strr=="" || !rgx.test(strr)) {
alert("Not a vaild domain name");
return false;
}
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    }
  }
mshowLoading();
$.post("core/process.php", {domain:strr,update:u1}, function(results){
if (results == 1)
{
<?php  if ($mod_rewrite == '1') {
?>  
url = "/"+strr;
<?php
} else { 
?>
url = "result.php?domain="+strr;
<?php   
}?>

$( location ).attr("href", url);
}
else if(results == 0)
{
$("#newhome").hide();
$("#preloader").hide();
$("#myhome").show();
alert("Something went wrong");
}
else
{
        $("#newhome").hide();
    $("#preloader").hide();
    $("#myhome").show();
    alert(results);
}
});
}
</script>

</head>

<body>   
   <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="    border-bottom-style: solid;
    border-bottom-width: 1px;
    z-index: 3; background-color: #F7FAFE;   border-color: #e1e1e1;">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/index.php" style="margin-top: -13px;padding: 0 50px;">
                  <img alt="worthmysite" src="/<?php echo $logo_path; ?>" class="worth_my_site_logo" /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="collapse-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li  <?php if (strpos($_SERVER['PHP_SELF'],'index.php') !== false)
                        echo 'class="active"';
                        elseif (strpos($_SERVER['PHP_SELF'],'result.php') !== false)
                        echo 'class="active"';
                        ?>><a href="<?php if ($mod_rewrite=='1') { echo '/'; }else { echo '/index.php'; } ?>"><?php echo $lang['36']; ?></a></li>
                       <li  <?php if (strpos($_SERVER['PHP_SELF'],'top.php') !== false)
                        echo 'class="active"';
                        ?>> 
                         <a href="<?php if ($mod_rewrite=='1') { echo '/top/'; }else { echo '/top.php'; } ?>"><?php echo $lang['26']; ?> </a>
                        </li>     
                        <li  <?php if (strpos($_SERVER['PHP_SELF'],'contact.php') !== false)
                        echo 'class="active"';
                        ?>>
                            <a href="<?php if ($mod_rewrite=='1') { echo '/contact/'; }else { echo '/contact.php'; } ?>"><?php echo $lang['1']; ?> </a>
                        </li>
    <?php
    $query =  "SELECT * FROM pages";
    $result = mysqli_query($con,$query);
        
    while($row = mysqli_fetch_array($result)) {
    $page_name =  Trim($row['page_name']);
    $cl = "";
    if (strpos($_SERVER['QUERY_STRING'],$page_name) !== false)
    $cl = "active";
     if ($mod_rewrite=='1')
     {
     echo '<li class="'.$cl.'"><a href="/page/'.$page_name.'/">'.ucfirst($page_name).'</a></li>';
     }else
     {
    echo '<li class="'.$cl.'"><a href="/pages.php?page='.$page_name.'">'.ucfirst($page_name).'</a></li>';
    } } ?>
              <?php if(isset($_SESSION['token']))
          { ?>
                        <li>
                            <a href="/index.php?logout"><?php echo $lang['37']; ?></a>
                        </li>
          <?php } else { ?>
                        <li>
                            <a href="#" data-target="#signin" data-toggle="modal"><?php echo $lang['38']; ?> </a>
                        </li>
                        <li>
                            <a href="#" data-target="#signup" data-toggle="modal"><?php echo $lang['39']; ?> </a>
                        </li>  
                        <?php } ?>
                        </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
             </nav><!--/.navbar-->  