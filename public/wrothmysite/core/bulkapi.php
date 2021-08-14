<?php
/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @copyright © 2015 ProThemes.Biz
 *
 */

// Disable Errors
error_reporting(1);

// Required functions
require_once('../config.php');
require_once('functions.php');
require_once('whois.php');
 
// Database Connection
// $con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_database);
// if (mysqli_connect_errno())
// {
// die("Unable connect to database");
// }
if($_GET['sitelink'])
{
	$var1 = $_GET['sitelink'];

$_POST['sitelink'] = $var1;
}else{
	die("Please enter Url");
}


if (true)
{
	
    if (isset($_POST['sitelink']))
    {
    $site =  htmlspecialchars(Trim($_POST['sitelink']));  
    $site = clean_url($site);
    $res = isValidSite($site); 
    if ($res == '1')
    {
    // Site not valid either sub-domain & unknown format
    die("Domain name not valid!");
    }
    else
    {
    //Bad Word Checking
    $bad_word_arr = mysqli_query($con, "SELECT * FROM bad_word");
    while($row = mysqli_fetch_array($bad_word_arr)) 
    {
    $word = Trim($row['word']);
    if (str_contains($site,$word) !== false)
    {
    echo "Oh no! Bad Word Found.";
    die();
    }
    }
    //Check it is banned site
    $qu = mysqli_query($con, "SELECT * FROM ban_site WHERE site='$site'");
    if (mysqli_num_rows($qu) > 0)
    {
    echo "Site is banned for some reason! Contact Support!";
    die();
    }
    
    // Check new domain (or) not
    $qu = mysqli_query($con, "SELECT * FROM domains_data WHERE domain='$site'");
    if (mysqli_num_rows($qu) > 0)
    {
    // Already domain exits
    echo "2";
    die();
    }
           
    // Everthing is fine  
    $wsite = "www.$site";
    if(checkOnline($wsite)) 
    { 
    // Site online 
    $status = "1";
    $response_time = substr($rtime['total_time'], 0, 4);
    
    // Get Meta Tags information
    $html = file_get_contents("http://".$wsite);
    $html = str_ireplace(array("Title","TITLE"),"title",$html);
    $html = str_ireplace(array("Description","DESCRIPTION"),"description",$html);
    $html = str_ireplace(array("Keywords","KEYWORDS"),"keywords",$html);
    $html = str_ireplace(array("Content","CONTENT"),"content",$html);  
    $html = str_ireplace(array("Meta","META"),"meta",$html);  
    $html = str_ireplace(array("Name","NAME"),"name",$html);      
         
    //parsing begins here:
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $nodes = $doc->getElementsByTagName('title');

    //get and display what you need:
    $title = $nodes->item(0)->nodeValue;

    $metas = $doc->getElementsByTagName('meta');

    for ($i = 0; $i < $metas->length; $i++)
    {
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description')
       $description = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'keywords')
        $keywords = $meta->getAttribute('content');
    }
    $site_title = ($title == '' ? "No Title" : $title);
    $site_description = ($description == '' ? "No Description" : $description);
    $site_keywords = ($keywords == '' ? "No Keywords" : $keywords);
    
    // Get Global ranking stats
    //$go_rank = google_page_rank($wsite);
    $google_page_rank = 0;
    $alexa = alexaRank($wsite);
    
    $alexa_global_rank = $alexa[0];
    $alexa_pop = $alexa[1];
    $alexa_regional_rank = $alexa[2];
    $alexa_back = $alexa[3];

    //Get Social Stats
    $social_count= getSocialData($html);
    $tweets_count = $social_count['twit'];
    $facebook_like = $social_count['fb'];
    $facebook_share = $social_count['insta'];

    $gplus = $stumble_count = $linkedin_count = $pinterest_count = $facebook_comment = 0;
    
    //Host Information
    $host_data = host_info($wsite);
    $host_data = explode("::", $host_data);
    
    $host_ip = Trim($host_data[0]);
    $host_country = Trim($host_data[1]);
    $host_isp = Trim($host_data[2]);
    
    // Indexed Pages
    $google_index_pages = googleIndex($site);
    $yahoo_index_pages = yahooIndex($site);
    $bing_index_pages = bingIndex($site);
    
    // Backlinks and Directory Check
    $gogle_backlink = googleBack($site);
    $bing_backlink = bingBack($site);
    $dmoz_dir = dmozCheck($site);

    //Moz Rank
    $mozAPi = seoMoz($site,MOZ_ACCESS_ID,MOZ_SECRET_KEY);
    $moz_rank = $mozAPi[0];
    $da = $mozAPi[1];
    $pa = $mozAPi[2];
    
    // IP blacklist check
    $blacklist_result = dnsblookup(Trim($data[0]));
    
    // WHOIS Data and Domain Age
    $whois= new whois;
    $whoisClean_url = $whois->cleanUrl($wsite);
    $whoisData = $whois->whoislookup($whoisClean_url);
    $whois_data = $whoisData[0];   
    $age = $whoisData[1];



    $whois_data = ($whois_data == '' ? "No Whois data found!" : $whois_data);
     $whois_data =  strip_tags($whois_data);
    $age = ($age == '' ? "Not Available" : $age);
    
    //Safe Browsing check
    $safe_value = Trim(check_mal($site));
    $avg_virus_check  = Trim(avgCheck($site));
    require_once('get_image.php');
       
    // Price
    $price = price($alexa_global_rank,$gogle_backlink,$google_page_rank,$google_index_pages,$facebook_like,$tweets_count,$age);
    $price = ($price=='0' ? '10' : $price);
    
    // Everything is fine
    $date = date('jS F Y h:i:s A');
    // $site_title =  mysqli_real_escape_string($con,htmlspecialchars($site_title));
    // $site_description =  mysqli_real_escape_string($con,htmlspecialchars($site_description));
    // $site_keywords =  mysqli_real_escape_string($con,htmlspecialchars($site_keywords));
    // $whois_data =  htmlspecialchars($whois_data);


//     $query = "INSERT INTO domains_data (domain,last_date,estimated_worth,site_title,site_des,site_keyword,domain_age,response_time,
// global_rank,alexa_pop,regional_rank,alexa_back,g_page_rank,g_indexed_page,y_indexed_page,b_indexed_page,g_back,b_back,dmoz,moz_rank,da,pa,face_like,
// face_share,face_comment,tweet,gplus,pinterest,linkedin,stumbleupon,domain_ip,country,isp,blacklist,safe_browsing,antivirus,whois_info) VALUES 
// ('$site','$date','$price','$site_title','$site_description','$site_keywords','$age','$response_time','$alexa_global_rank','$alexa_pop','$alexa_regional_rank','$alexa_back',
// '$google_page_rank','$google_index_pages','$yahoo_index_pages','$bing_index_pages','$gogle_backlink','$bing_backlink','$dmoz_dir','$moz_rank','$da','$pa','$facebook_like','$facebook_share','$facebook_comment',
// '$tweets_count','$gplus_count','$pinterest_count','$linkedin_count','$stumble_count','$host_ip','$host_country','$host_isp','$blacklist_result','$safe_value','$avg_virus_check','$whois_data')";
    // mysqli_query($con, $query);



$value = array();

$value['site'] = $site;
$value['price'] = $price;
$value['date'] = $date;
$value['age'] = $age;
$value['response_time'] = $response_time;
$value['alexa_global_rank'] = $alexa_global_rank;
$value['alexa_pop'] = $alexa_pop;
$value['alexa_regional_rank'] = $alexa_regional_rank;
$value['alexa_back'] = $alexa_back;
$value['host_ip'] = $host_ip;
$value['host_country'] = $host_country;
$value['host_isp'] = $host_isp;
$value['host_ispsafe_value'] = $safe_value;
$value['avg_virus_check'] = $avg_virus_check;
$value['whois_data'] = $whois_data;


 echo json_encode($value);

//     echo "$site
// $date
// $price
// $site_title
// $site_description
// $site_keywords
// $age
// $response_time
// $alexa_global_rank
// $alexa_pop
// $alexa_regional_rank
// $alexa_back
// $google_page_rank
// $google_index_pages
// $yahoo_index_pages
// $bing_index_pages
// $gogle_backlink
// $bing_backlink
// $dmoz_dir
// $moz_rank
// $da
// $pa
// $facebook_like
// $facebook_share
// $facebook_comment
// $tweets_count
// $gplus_count
// $pinterest_count
// $linkedin_count
// $stumble_count
// $host_ip
// $host_country
// $host_isp
// $blacklist_result
// $safe_value
// $avg_virus_check
// $whois_data";
            
    if (mysqli_error($con))
    {
    die("0");
    }
    // addToSitemap($site,$con);
    //Success
    //echo "1";
    die();        
    }  
    }
    }
    else
    {
        die("0");
    }
}
else
{
    echo "Malformed Request!";
    die();
}
?>