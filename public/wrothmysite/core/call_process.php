<?php
/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @copyright 2018 ProThemes.Biz
 *
 */
 
$site = $domain;
if (isset($site))
{
$site = clean_url($site);
$res = isValidSite($site);
if ($res == '1')
{
    // Site not valid either sub-domain & unknown format
    $error = "Domain name not valid!";
}
else
{
    // Everthing is fine
    
    $wsite = "www.$site";
    if(checkOnline($wsite)) 
    { 
    // Site online 
    $status = "1";
    $response_time = substr($rtime['total_time'], 0, 4);
    
    // Get Meta Tags information
    $html = curlGET("http://".$wsite);
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
    $google_page_rank = round($moz_rank);
    $price = price($alexa_global_rank,$gogle_backlink,$google_page_rank,$google_index_pages,0,0,$age);
    $price = ($price=='0' ? '10' : $price);
}
else
{   
    // Site Offline
    $error = "Site Offline!"; 
    $title = "No Title";
    $response_time = "No response";
    $status = "0";
    $keywords = "No Description";
    $description = "No Keywords";
    
}   
}
}
else
{
    // No site entered by user! 
    $error = "Site not found!"; 
}
?>