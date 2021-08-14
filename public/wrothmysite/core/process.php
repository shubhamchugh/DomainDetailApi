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
require_once('../config.php');
require_once('functions.php');
require_once('whois.php');

//UTF-8
header( 'Content-Type: text/html; charset=utf-8' ); 

//Check item code
if ($item_purchase_code == '')
{
  $msg = "Item purchase code can't be empty";  
}
else
{
    // Database Connection
    $con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_database);
    if (mysqli_connect_errno())
    {
    $msg = "Unable connect to database";
    }
    else
    {
    $query =  "SELECT * FROM site_info";
    $result = mysqli_query($con,$query);
        
    while($row = mysqli_fetch_array($result)) {
    $site_name =   Trim($row['site_name']);
    $max_count =  Trim($row['max']);
    }    
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $domain = Trim(htmlentities($_POST['domain']));
        $domain = clean_url($domain);
        
        //Bad Word Checking
        $bad_word_arr = mysqli_query($con, "SELECT * FROM bad_word");
        while($row = mysqli_fetch_array($bad_word_arr)) 
        {
        $word = Trim($row['word']);
        if (str_contains($domain,$word) !== false)
        {
            echo "Oh no! Bad Word Found.";
            die();
        }
        }
        
        $qu = mysqli_query($con, "SELECT * FROM ban_site WHERE site='$domain'");
        if (mysqli_num_rows($qu) > 0)
        {
        $msg = "Site is banned for some reason! Contact Support!";
        }
        else
        {
        $date = date('jS F Y');
        $ip = $_SERVER['REMOTE_ADDR'];
        $c_count = 0;
        $qu = mysqli_query($con, "SELECT * FROM ip_limit WHERE ip='$ip' AND date='$date'");
        if (mysqli_num_rows($qu) > 0)
        {
        while($row = mysqli_fetch_array($qu)) 
        {
            $c_count = Trim($row['count']);
        }
        }
        if(isset($_SESSION['token']))
        {
            $c_count  = '1';
            $max_count = '999';
        }
        if ($c_count > $max_count)
        {
            $msg = "Visitors limit reached! Login and estimate more site's."; 
        }
        else{
        if(isset($_POST['update']))
        {
            // Need to update the data.
            require('call_process.php');
            
            if(isset($error))
            {
                // Something went wrong!
                $msg = Trim($error);
            }
            else
            {
                // Everything is fine
                $date = date('jS F Y h:i:s A');
                $site_title =  mysqli_real_escape_string($con,htmlspecialchars($site_title));
                $site_description =  mysqli_real_escape_string($con,htmlspecialchars($site_description));
                $site_keywords =  mysqli_real_escape_string($con,htmlspecialchars($site_keywords));
                $whois_data =  mysqli_real_escape_string($con,htmlspecialchars($whois_data));
                
                $query = "UPDATE domains_data SET last_date ='$date',estimated_worth ='$price',site_title='$site_title',site_des='$site_description',site_keyword='$site_keywords',domain_age='$age',response_time='$response_time',global_rank='$alexa_global_rank',
alexa_pop='$alexa_pop',regional_rank='$alexa_regional_rank',alexa_back='$alexa_back',g_page_rank='$google_page_rank',g_indexed_page='$google_index_pages',y_indexed_page='$yahoo_index_pages',b_indexed_page='$bing_index_pages',g_back='$gogle_backlink',b_back='$bing_backlink',dmoz='$dmoz_dir',
moz_rank='$moz_rank',da='$da',pa='$pa',face_like='$facebook_like',face_share='$facebook_share',face_comment='$facebook_comment',tweet='$tweets_count',gplus='$gplus_count',pinterest='$pinterest_count',linkedin='$linkedin_count',stumbleupon='$stumble_count',
domain_ip='$host_ip',country='$host_country',isp='$host_isp',blacklist='$blacklist_result',safe_browsing='$safe_value',antivirus='$avg_virus_check',whois_info='$whois_data' WHERE domain='$site'";
            mysqli_query($con, $query);
            
            if (mysqli_error($con))
            {
            $msg = mysqli_error($con);
            }
            else
            {
                $ip = $_SERVER['REMOTE_ADDR'];
                $date = date('jS F Y');
                $price = number_format($price);
                $query1  = "INSERT INTO site_history (last_date,ip,site,worth) VALUES ('$date','$ip','$site','$price')";
                mysqli_query($con, $query1);
                $qu = mysqli_query($con, "SELECT * FROM ip_limit WHERE ip='$ip' AND date='$date'");
                if (mysqli_num_rows($qu) > 0)
                {
                while($row = mysqli_fetch_array($qu)) 
                {
                $c_count = Trim($row['count']);
                }
                $c_count = (int)$c_count +1;
                $query =  "UPDATE ip_limit SET count ='$c_count' WHERE ip='$ip' AND date='$date'";
                mysqli_query($con, $query); 
                }
                else
                {
                $query = "INSERT INTO ip_limit (ip,date,count) VALUES ('$ip','$date','1')";
                mysqli_query($con, $query); 
                }
                $msg ='1';
            }
            
            }
            
        }
        else
        {
        // Check new domain (or) not
        $qu = mysqli_query($con, "SELECT * FROM domains_data WHERE domain='$domain'");
        if (mysqli_num_rows($qu) > 0)
        {
            // Already domain exits
            $msg = '1';

        }
        else
        {
            //process the calculation
            require('call_process.php');
            if(isset($error))
            {
                // Something went wrong!
                $msg = Trim($error);
            }
            else
            {
                // Everything is fine
                $date = date('jS F Y h:i:s A');
                $site_title =  mysqli_real_escape_string($con,htmlspecialchars($site_title));
                $site_description =  mysqli_real_escape_string($con,htmlspecialchars($site_description));
                $site_keywords =  mysqli_real_escape_string($con,htmlspecialchars($site_keywords));
                $whois_data =  mysqli_real_escape_string($con,htmlspecialchars($whois_data));
                
                $query = "INSERT INTO domains_data (domain,last_date,estimated_worth,site_title,site_des,site_keyword,domain_age,response_time,
global_rank,alexa_pop,regional_rank,alexa_back,g_page_rank,g_indexed_page,y_indexed_page,b_indexed_page,g_back,b_back,dmoz,moz_rank,da,pa,face_like,
face_share,face_comment,tweet,gplus,pinterest,linkedin,stumbleupon,domain_ip,country,isp,blacklist,safe_browsing,antivirus,whois_info) VALUES 
('$site','$date','$price','$site_title','$site_description','$site_keywords','$age','$response_time','$alexa_global_rank','$alexa_pop','$alexa_regional_rank','$alexa_back',
'$google_page_rank','$google_index_pages','$yahoo_index_pages','$bing_index_pages','$gogle_backlink','$bing_backlink','$dmoz_dir','$moz_rank','$da','$pa','$facebook_like','$facebook_share','$facebook_comment',
'$tweets_count','$gplus_count','$pinterest_count','$linkedin_count','$stumble_count','$host_ip','$host_country','$host_isp','$blacklist_result','$safe_value','$avg_virus_check','$whois_data')";
            mysqli_query($con, $query);
            
            if (mysqli_error($con))
            {
            $msg = mysqli_error($con);
            }
            else
            {
                $ip = $_SERVER['REMOTE_ADDR'];
                $date = date('jS F Y');
                $price = number_format($price);
                $query1  = "INSERT INTO site_history (last_date,ip,site,worth) VALUES ('$date','$ip','$site','$price')";
                mysqli_query($con, $query1);
                addToSitemap($site,$con);
                $qu = mysqli_query($con, "SELECT * FROM ip_limit WHERE ip='$ip' AND date='$date'");
                if (mysqli_num_rows($qu) > 0)
                {
                while($row = mysqli_fetch_array($qu)) 
                {
                $c_count = Trim($row['count']);
                }
                $c_count = (int)$c_count +1;
                $query =  "UPDATE ip_limit SET count ='$c_count' WHERE ip='$ip' AND date='$date'";
                mysqli_query($con, $query); 
                }
                else
                {
                $query = "INSERT INTO ip_limit (ip,date,count) VALUES ('$ip','$date','1')";
                mysqli_query($con, $query); 
                }
                $msg ='1';
            }
            
            }
        }
        
        }
        }
        }
    }
    else
    {
    $msg = "0"; 
    }
    }
  
}

echo $msg;
?>