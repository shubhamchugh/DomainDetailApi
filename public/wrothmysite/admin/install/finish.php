<?php
/*
 * @author Balaji
 */
error_reporting(1);
require_once("../../config.php");

$admin_user = htmlspecialchars(Trim($_POST['admin_user']));
$admin_pass = Md5(htmlspecialchars(Trim($_POST['admin_pass'])));

$con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_database);

if (mysqli_connect_errno())
{
echo "Failed to connect:". mysqli_connect_error()."<br>";
}
  
$resDa = mysqli_query($con,"SHOW TABLES LIKE 'site_info'");
if(mysqli_num_rows($resDa) > 0) {
//Found
echo "Error! Already tables exists on database!";
die();
}


$sql = "CREATE TABLE admin 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
user VARCHAR(250),
pass VARCHAR(250)
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Admin Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
    $query = "INSERT INTO admin (user,pass) VALUES ('$admin_user','$admin_pass')"; 
    mysqli_query($con,$query);
    
$sql = "CREATE TABLE admin_history 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
last_date VARCHAR(255),
ip VARCHAR(255)
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Admin History Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
   $query = "INSERT INTO admin_history (last_date,ip) VALUES ('14th January 2016','23.54.2.43')"; 
   mysqli_query($con,$query);
   $query = "INSERT INTO admin_history (last_date,ip) VALUES ('14th January 2016','26.32.34.33')"; 
   mysqli_query($con,$query);
   $query = "INSERT INTO admin_history (last_date,ip) VALUES ('15th January 2016','31.7.42.03')"; 
   mysqli_query($con,$query);
   
   
   $sql = "CREATE TABLE page_view 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
date VARCHAR(255),
tpage VARCHAR(255),
tvisit VARCHAR(255)
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Page view Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }

   $sql = "CREATE TABLE ads 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
text_ads text,
ads_1 text,
ads_2 text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Ads Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     $query = "INSERT INTO ads (text_ads,ads_1,ads_2) VALUES ('<br />Try Pro IP locator Script Today! <a title=\"Get Pro IP locator Script\" href=\"http://prothemes.biz/index.php?route=product/product&path=65&product_id=59\">CLICK HERE</a> <br /><br />

Get 20,000 Unique Traffic for $5 [Limited Time Offer] - <a title=\"Get 20,000 Unique Traffic\" href=\"http://prothemes.biz\">Buy Now! CLICK HERE</a><br /><br />

Custom OpenVPN GUI - Get Now for $26 ! <a title=\"Custom OpenVPN GUI\" href=\"http://codecanyon.net/item/custom-openvpn-gui-pro-edition/9904287?ref=Rainbowbalaji\">CLICK HERE</a><br />','<div >
<img class=\"imageres\" src=\"/theme/default/img/a700.png\" />
</div> ','<img src= \"/theme/default/img/a336.png\" class=\"imageres\"/>')"; 
     mysqli_query($con,$query);
     
     
   $sql = "CREATE TABLE site_info 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
title VARCHAR(255),
des mediumtext,
keyword mediumtext,
site_name VARCHAR(255),
email VARCHAR(255),
twit text,
face text,
gplus text,
ga text,
ex_1 text,
ex_2 text,
ps_1 text,
ps_2 text,
ps_3 text,
max text,
copyright text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Site Info Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     $query = "INSERT INTO site_info (title,des,keyword,site_name,email,twit,face,gplus,ga,ex_1,ex_2,ps_1,ps_2,ps_3,max,copyright) VALUES ('Estimate Your Site Worth | Worth My Site','Get complete information about your website, our unique algorithm will calculate and estimate the daily visitors, pagerank, traffic details and social stats etc..','worth,analyzer,woorank,seo,alexa','Worth My Site','admin@prothemes.biz','https://twitter.com/','https://www.facebook.com/','https://plus.google.com/','UA-','Google.com','ProThemes.biz','google.com','prothemes.biz','codecanyon.net','5','Copyright &copy; 2019 ProThemes.Biz. All rights reserved.')"; 
     mysqli_query($con,$query);


   $sql = "CREATE TABLE interface 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
theme text,
lang text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Interface Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     $query = "INSERT INTO interface (theme,lang) VALUES ('default','en.php')"; 
     mysqli_query($con,$query);
     
   $sql = "CREATE TABLE ban_user 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
ip VARCHAR(255),
last_date VARCHAR(255)
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Ban User Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     $query = "INSERT INTO ban_user (id,ip,last_date) VALUES ('1','2.2.2.2','17th January 2016')"; 
     mysqli_query($con,$query);
     
$sql = "CREATE TABLE bad_word 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
word text,
last_date text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Bad Word Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     $query = "INSERT INTO bad_word (id,word,last_date) VALUES ('1','sexy','17th February 2016')"; 
     mysqli_query($con,$query);
     $query = "INSERT INTO bad_word (id,word,last_date) VALUES ('2','porn','17th February 2016')"; 
     mysqli_query($con,$query);


   $sql = "CREATE TABLE image_path
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
logo_path text,
fav_path text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Image Path Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     $query = "INSERT INTO image_path (id,logo_path,fav_path) VALUES ('1','theme/default/img/logo.png','theme/default/img/favicon.ico')"; 
     mysqli_query($con,$query);
     

      $sql = "CREATE TABLE users 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
oauth_uid text,
username text,
email_id text,
full_name text,
platform text,
password text,
verified text,
picture text,
date text,
ip text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Users Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     
     
      $sql = "CREATE TABLE mail 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
smtp_host text,
smtp_username text,
smtp_password text,
smtp_port text,
protocol text,
auth text,
socket text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Mail Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     
     $query = "INSERT INTO mail (smtp_host,smtp_username,smtp_password,smtp_port,protocol,auth,socket) VALUES ('','','','','1','true','ssl')"; 
     mysqli_query($con,$query);
          
     
           $sql = "CREATE TABLE pages 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
last_date VARCHAR(255),
page_name VARCHAR(255),
page_title mediumtext,
page_content text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Pages Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     $query = "INSERT INTO pages (id,last_date,page_name,page_title,page_content) VALUES ('1','17th January 2016','about','About US','<p><strong>Nothing to say</strong></p><br><br><br><br><br><br><br><br><br><br>')"; 
     mysqli_query($con,$query);
    
        $sql = "CREATE TABLE ban_site 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
site VARCHAR(255),
last_date VARCHAR(255)
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Ban Site Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     $query = "INSERT INTO ban_site (id,site,last_date) VALUES ('1','example.com','17th January 2016')"; 
     mysqli_query($con,$query);
     $query = "INSERT INTO ban_site (id,site,last_date) VALUES ('2','example.biz','17th January 2016')"; 
     mysqli_query($con,$query);
                  
   $sql = "CREATE TABLE domains_data 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
domain text,
last_date text,
estimated_worth text,
site_title text,
site_des text,
site_keyword text,
domain_age text,
response_time text,
global_rank text,
alexa_pop text,
regional_rank text,
alexa_back text,
g_page_rank text,
g_indexed_page text,
y_indexed_page text,
b_indexed_page text,
g_back text,
b_back text,
dmoz text,
moz_rank text,
da text,
pa text,
face_like text,
face_share text,
face_comment text,
tweet text,
gplus text,
pinterest text,
linkedin text,
stumbleupon text,
domain_ip text,
country text,
isp text,
blacklist text,
safe_browsing text,
antivirus text,
whois_info text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Domains Data created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
   

  
     $sql = "CREATE TABLE sitemap_options 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
priority VARCHAR(255),
changefreq VARCHAR(255)
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Sitemap Options Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     $query = "INSERT INTO sitemap_options (id,priority,changefreq) VALUES ('1','0.9','weekly')"; 
     mysqli_query($con,$query);
              
           $sql = "CREATE TABLE capthca 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
cap_e VARCHAR(255),
cap_c VARCHAR(255),
mode VARCHAR(255),
mul VARCHAR(255),
allowed text,
color mediumtext
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Capthca Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
     
     $query = "INSERT INTO capthca (cap_e,mode,mul,allowed,color,cap_c) VALUES ('off','Normal','off','ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz234567891','#FFFFFF','off')"; 
     mysqli_query($con,$query); 
    
 $sql = "CREATE TABLE site_history 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
last_date VARCHAR(255),
ip VARCHAR(255),
site text,
worth text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Site History Table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
   
    $query = "INSERT INTO site_history(last_date,ip,site,worth) VALUES ('14th January 2016','23.54.72.77','prothemes.biz','1,793')"; 
  mysqli_query($con,$query);   
    $query = "INSERT INTO site_history(last_date,ip,site,worth) VALUES ('14th January 2016','23.54.72.77','bluepay.com','112,983')"; 
  mysqli_query($con,$query);   
    $query = "INSERT INTO site_history(last_date,ip,site,worth) VALUES ('14th January 2016','23.54.72.77','codecanyon.net','1,661,203')"; 
  mysqli_query($con,$query);  
      $query = "INSERT INTO site_history(last_date,ip,site,worth) VALUES ('14th January 2016','23.54.72.77','interserver.net','135,443')"; 
  mysqli_query($con,$query);  
      $query = "INSERT INTO site_history(last_date,ip,site,worth) VALUES ('14th January 2016','23.54.72.77','stackoverflow.com','693,319')"; 
  mysqli_query($con,$query);  
    $query = "INSERT INTO site_history(last_date,ip,site,worth) VALUES ('14th January 2016','23.54.72.77','google.com','3,672,290,312')"; 
  mysqli_query($con,$query);  
  
$sql = "CREATE TABLE ip_limit 
(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
ip text,
date text,
count text
)";
    // Execute query
    if (mysqli_query($con,$sql)) {
    echo "Visitors limitation table created successfully <br>";
    } else {
    echo "Error creating table: " . mysqli_error($con)."<br>";
     }
   
  $c_date = date('Y-m-d');
    $data = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>http://'.$_SERVER['SERVER_NAME'].'/</loc>
        <priority>1.0</priority>
        <changefreq>daily</changefreq>
        <lastmod>'.$c_date.'</lastmod>
</url>
</urlset>';
file_put_contents("../../sitemap.xml",$data);
    echo "Sitemap file created successfully <br> <br>";

  unlink('install.php');
  unlink('process.php');
  unlink('finish.php');
  
  echo 'Installation Complete! <br> <br>';  
?>
  <a href="/" class="btn btn-info" >Index Page</a>   <a href="/admin/index.php" class="btn btn-info">Admin Panel</a>