<?php
session_start();
/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @copyright 2019 ProThemes.Biz
 *
 */

// Disable Errors
error_reporting(1);

if ('/admin/' == $_SERVER['REQUEST_URI']) {
    header("Location: /admin/index.php");
    exit();
}

// Required functions
require_once 'config.php';
require_once 'core/functions.php';
require_once 'core/whois.php';

//UTF-8
header('Content-Type: text/html; charset=utf-8');

//Check item code
if ('' == $item_purchase_code) {
    die("Item purchase code can't be empty");
}

// Database Connection
$con = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_database);
if (mysqli_connect_errno()) {
    die("Unable connect to database");
}

// App Connection
require_once 'core/app.php';

// Sitemap Option
$query  = "Select * From sitemap_options WHERE id='1'";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) {
    $priority   = $row['priority'];
    $changefreq = $row['changefreq'];
}

//get domain
$domain = Trim(htmlentities($_GET['domain']));

$domain = clean_url($domain);
$res    = isValidSite($domain);
if ('1' == $res) {
    require_once 'theme/' . $default_theme . '/404.php';
    die();
}

$qu = mysqli_query($con, "SELECT * FROM domains_data WHERE domain='$domain'");
if (mysqli_num_rows($qu) > 0) {
// Already domain exits
    $result = mysqli_query($con, "SELECT * FROM domains_data WHERE domain='$domain'");

    while ($row = mysqli_fetch_array($result)) {
        $domain          = Trim($row['domain']);
        $last_date       = Trim($row['last_date']);
        $estimated_worth = Trim($row['estimated_worth']);
        $site_title      = Trim($row['site_title']);
        $site_des        = Trim($row['site_des']);
        $site_keyword    = Trim($row['site_keyword']);
        $domain_age      = Trim($row['domain_age']);
        $response_time   = Trim($row['response_time']);
        $global_rank     = Trim($row['global_rank']);
        $alexa_pop       = Trim($row['alexa_pop']);
        $regional_rank   = Trim($row['regional_rank']);
        $alexa_back      = Trim($row['alexa_back']);
        $g_page_rank     = Trim($row['g_page_rank']);
        $g_indexed_page  = Trim($row['g_indexed_page']);
        $y_indexed_page  = Trim($row['y_indexed_page']);
        $b_indexed_page  = Trim($row['b_indexed_page']);
        $g_back          = Trim($row['g_back']);
        $b_back          = Trim($row['b_back']);
        $dmoz            = Trim($row['dmoz']);
        $moz_rank        = Trim($row['moz_rank']);
        $da              = Trim($row['da']);
        $pa              = Trim($row['pa']);
        $face_like       = Trim($row['face_like']);
        $face_share      = Trim($row['face_share']);
        $face_comment    = Trim($row['face_comment']);
        $tweet           = Trim($row['tweet']);
        $gplus           = Trim($row['gplus']);
        $pinterest       = Trim($row['pinterest']);
        $linkedin        = Trim($row['linkedin']);
        $stumbleupon     = Trim($row['stumbleupon']);
        $domain_ip       = Trim($row['domain_ip']);
        $country         = Trim($row['country']);
        $isp             = Trim($row['isp']);
        $blacklist       = Trim($row['blacklist']);
        $safe_browsing   = Trim($row['safe_browsing']);
        $antivirus       = Trim($row['antivirus']);
        $whois_info      = Trim($row['whois_info']);
    }
} else {
    require_once 'theme/' . $default_theme . '/404.php';
    die();
}

$estimated_worth = number_format($estimated_worth);
$p_title         = ucfirst($domain);
$yahoo_dir       = ('1' == $yahoo_dir ? 'Listed' : 'Not Listed');
$antivirus       = ('1' == $antivirus ? 'Good' : 'Bad');
$safe_browsing   = ('204' == $safe_browsing ? 'Good (Safe Site)' : 'Bad (Harmful Site)');
$y_indexed_page  = number_format($y_indexed_page);

//Set Global Rank
$my_global_rank = ('No Global Rank' == $global_rank ? '0' : $global_rank);

//PageView
$monthly_page_view = round(pow($my_global_rank, -1.008) * 104943144672);
$monthly_page_view = (is_infinite($monthly_page_view) ? '40' : $monthly_page_view);
$daily_page_view   = round($monthly_page_view / 30);
$daily_page_view   = (is_infinite($daily_page_view) ? '0' : $daily_page_view);
$yearly_page_view  = round($monthly_page_view * 12);
$yearly_page_view  = (is_infinite($yearly_page_view) ? '0' : $yearly_page_view);

//Unique visitors
$monthly_unique_visitors = round($monthly_page_view / 50);
$monthly_unique_visitors = (is_infinite($monthly_unique_visitors) ? '20' : $monthly_unique_visitors);
$daily_unique_visitors   = round($daily_page_view / 50);
$daily_unique_visitors   = (is_infinite($daily_unique_visitors) ? '0' : $daily_unique_visitors);
$yearly_unique_visitors  = round($monthly_unique_visitors * 12);
$yearly_unique_visitors  = (is_infinite($yearly_unique_visitors) ? '0' : $yearly_unique_visitors);

//Income
$monthly_inc = round((pow($my_global_rank, -1.008) * 104943144672) / 524);
$monthly_inc = (is_infinite($monthly_inc) ? '5' : $monthly_inc);
$daily_inc   = round($monthly_inc / 30);
$daily_inc   = (is_infinite($daily_inc) ? '0' : $daily_inc);
$yearly_inc  = round($monthly_inc * 12);
$yearly_inc  = (is_infinite($yearly_inc) ? '0' : $yearly_inc);

//Image
if (file_exists("site_snapshot/$domain.jpg")) {
    $myimage = "../site_snapshot/$domain.jpg";
} else {
    $myimage = "../core/img/no-preview.png";
}

$des = ucfirst($domain) . " has estimated worth of $$estimated_worth, this site has $global_rank rank in the world wide web. The age of $domain is $domain_age. According to the global rank, the site has esitmated daily page views of " . number_format($daily_page_view);

OutPut:
//Theme & Output
require_once 'theme/' . $default_theme . '/header.php';
require_once 'theme/' . $default_theme . '/result.php';
require_once 'theme/' . $default_theme . '/footer.php';
