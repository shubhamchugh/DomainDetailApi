<?php
/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @copyright © 2017 ProThemes.Biz
 *
 */

// Disable Errors
error_reporting(1);

//Get site Info
 $query =  "SELECT * FROM site_info";
 $result = mysqli_query($con,$query);
        
    while($row = mysqli_fetch_array($result)) {
    $title =  Trim($row['title']);
    $des =   Trim($row['des']);
    $keyword =  Trim($row['keyword']);
    $site_name =   Trim($row['site_name']);
    $email =   Trim($row['email']);
    $twit =   Trim($row['twit']);
    $face =   Trim($row['face']);
    $rgplus =   Trim($row['gplus']);
    $ga  =   Trim($row['ga']);
    $ex_1 =  Trim($row['ex_1']);
    $ex_2 =  Trim($row['ex_2']);
    $ps_1 =  Trim($row['ps_1']);
    $ps_2 =  Trim($row['ps_2']);
    $ps_3 =  Trim($row['ps_3']);
    $max_count =  Trim($row['max']);
    $copyright =  Trim($row['copyright']);
    }

    $query =  "SELECT * FROM image_path where id='1'";
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($result)) {
    $logo_path =  Trim($row['logo_path']);
    $fav_path =  Trim($row['fav_path']);
    }
    if ($logo_path == '')
    $logo_path = 'theme/default/img/logo.png';
    if ($fav_path == '')
    $fav_path = 'theme/default/img/favicon.ico';
        
// Set theme and lang
$query =  "SELECT * FROM interface where id='1'";
$result = mysqli_query($con,$query);
        
while($row = mysqli_fetch_array($result)) {
$default_lang =  Trim($row['lang']);
$default_theme =   Trim($row['theme']);
}
require_once("langs/$default_lang");
    
//Theme path
$default_path = '/theme/'.$default_theme;

// Current Date & User IP
$date = date('jS F Y');
$ip = $_SERVER['REMOTE_ADDR'];
$data_ip = file_get_contents('core/temp_cal.tdata');

// Ads
$query =  "SELECT * FROM ads WHERE id='1'";
$result = mysqli_query($con,$query);
        
while($row = mysqli_fetch_array($result)) {
$text_ads =  Trim($row['text_ads']);
$ads_1 =  Trim($row['ads_1']);
$ads_2 =  Trim($row['ads_2']);
}  

// Banned IP's Checking! 
$query =  "SELECT * FROM ban_user";
$result = mysqli_query($con,$query);
        
while($row = mysqli_fetch_array($result)) {
$banned_ip =  $banned_ip."::".$row['ip'];
}
if (strpos($banned_ip,$ip) !== false)
{
die("You have been banned from ".$site_name); 
}

//Logout
if (isset($_GET['logout']))
{
        unset($_SESSION['token']);
        unset($_SESSION['oauth_uid']);
        unset($_SESSION['username']);
        unset($_SESSION['pic']);
        session_destroy();
        header("Location: index.php");
        echo '<meta http-equiv="refresh" content="1;url=index.php">';
}

// Page View  
    $query =  "SELECT @last_id := MAX(id) FROM page_view";
    
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($result)) {
    $last_id =  $row['@last_id := MAX(id)'];
    }
    
    $query =  "SELECT * FROM page_view WHERE id=".Trim($last_id);
    $result = mysqli_query($con,$query);
        
    while($row = mysqli_fetch_array($result)) {
    $last_date =  $row['date'];
    }
    
    if($last_date == $date)
    {
         if (str_contains($data_ip, $ip)) 
        {
          $query =  "SELECT * FROM page_view WHERE id=".Trim($last_id);
          $result = mysqli_query($con,$query);
        
        while($row = mysqli_fetch_array($result)) {
        $last_tpage =  Trim($row['tpage']);
            }
        $last_tpage = $last_tpage +1;
        
          // Already IP is there!  So update only page view.
        $query = "UPDATE page_view SET tpage=$last_tpage WHERE id=".Trim($last_id);
        mysqli_query($con,$query);
        }
        else
        {
        $query =  "SELECT * FROM page_view WHERE id=".Trim($last_id);
        $result = mysqli_query($con,$query);
        
        while($row = mysqli_fetch_array($result)) {
        $last_tpage =  Trim($row['tpage']);
        $last_tvisit =  Trim($row['tvisit']);
        }
        $last_tpage = $last_tpage +1;
        $last_tvisit = $last_tvisit +1;
        
        // Update both tpage and tvisit.
        $query = "UPDATE page_view SET tpage=$last_tpage,tvisit=$last_tvisit WHERE id=".Trim($last_id);
        mysqli_query($con,$query);
        file_put_contents('core/temp_cal.tdata',$data_ip."\r\n".$ip); 
        }
    }
    else
    { 
    //Delete the file and clear data_ip
    lcme("core/temp_cal.tdata");
    $data_ip ="";
    
    // New date is created!
    $query = "INSERT INTO page_view (date,tpage,tvisit) VALUES ('$date','1','1')"; 
    mysqli_query($con,$query);
    
    //Update the IP!
    file_put_contents('core/temp_cal.tdata',$data_ip."\r\n".$ip); 
    
}
?>