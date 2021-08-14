<?php

/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @copyright © 2017 ProThemes.Biz
 *
 */

// Disable Errors
error_reporting(1);

require_once('../config.php');
require_once('html2pdf.class.php');

if($_SERVER['REQUEST_METHOD'] =='POST')
{
if (isset($_POST['domain']))
{
$site_name = Trim(htmlentities($_POST['site_name']));
$domain =  Trim(htmlentities($_POST['domain']));
$last_date =  Trim(htmlentities($_POST['last_date']));
$estimated_worth =  Trim(htmlentities($_POST['estimated_worth']));
$site_title =  Trim(htmlentities($_POST['site_title']));
$site_des =  Trim(htmlentities($_POST['site_des']));
$site_keyword =  Trim(htmlentities($_POST['site_keyword']));
$domain_age =  Trim(htmlentities($_POST['domain_age']));
$response_time =  Trim(htmlentities($_POST['response_time']));
$global_rank =  Trim(htmlentities($_POST['global_rank']));
$alexa_pop =  Trim(htmlentities($_POST['alexa_pop']));
$regional_rank =  Trim(htmlentities($_POST['regional_rank']));
$alexa_back =  Trim(htmlentities($_POST['alexa_back']));
$g_page_rank =  Trim(htmlentities($_POST['g_page_rank']));
$g_indexed_page =  Trim(htmlentities($_POST['g_indexed_page']));
$y_indexed_page =  Trim(htmlentities($_POST['y_indexed_page']));
$b_indexed_page =  Trim(htmlentities($_POST['b_indexed_page']));
$g_back =  Trim(htmlentities($_POST['g_back']));
$b_back =  Trim(htmlentities($_POST['b_back']));
$dmoz =  Trim(htmlentities($_POST['dmoz']));
$moz_rank =  Trim(htmlentities($_POST['moz_rank']));
$da =  Trim(htmlentities($_POST['da']));
$face_like =  Trim(htmlentities($_POST['face_like']));
$face_share =  Trim(htmlentities($_POST['face_share']));
$face_comment =  Trim(htmlentities($_POST['face_comment']));
$tweet = Trim(htmlentities($_POST['tweet']));
$gplus =  Trim(htmlentities($_POST['gplus']));
$pinterest =  Trim(htmlentities($_POST['pinterest']));
$linkedin =  Trim(htmlentities($_POST['linkedin']));
$stumbleupon =  Trim(htmlentities($_POST['stumbleupon']));
$domain_ip =  Trim(htmlentities($_POST['domain_ip']));
$country =  Trim(htmlentities($_POST['country']));
$isp =  Trim(htmlentities($_POST['isp']));
$blacklist = Trim(htmlentities($_POST['blacklist']));
$safe_browsing =  Trim(htmlentities($_POST['safe_browsing']));
$antivirus =  Trim(htmlentities($_POST['antivirus']));
$monthly_page_view =  Trim(htmlentities($_POST['monthly_page_view']));
$daily_page_view =  Trim(htmlentities($_POST['daily_page_view']));
$yearly_page_view =  Trim(htmlentities($_POST['yearly_page_view']));
$monthly_unique_visitors =  Trim(htmlentities($_POST['monthly_unique_visitors']));
$daily_unique_visitors =  Trim(htmlentities($_POST['daily_unique_visitors']));
$yearly_unique_visitors =  Trim(htmlentities($_POST['yearly_unique_visitors']));
$monthly_inc =  Trim(htmlentities($_POST['monthly_inc']));
$daily_inc =  Trim(htmlentities($_POST['daily_inc']));
$yearly_inc =  Trim(htmlentities($_POST['yearly_inc']));
$myimage =  Trim(htmlentities($_POST['myimage']));
$myimage = str_replace('../','',$myimage);
$site = $domain;
$site_worth = "How much is $site worth? ";

ob_start();                                                          
$content = '<style type="text/css">
<!--
table.tableau { text-align: left; }
table.tableau td { width: 15mm; font-family: courier; }
table.tableau th { width: 15mm; font-family: courier; }

.sam
{
    	list-style: none;
}
.sam li
{
    padding: 5px;
}
.ul1
{
	list-style: none;
}
.ul1 li
{
	color:#367FA9;
    text-align: center;
}
.ul2
{
	list-style: none;
}
.ul2 li
{
	color:#008D4C;
    text-align: center;
}
.ul3
{
	list-style: none;
}
.ul3 li
{
	color:#4A6A89;
    text-align: center;
}
h1
{
    color: #B9B9B9;
}
.sitename
{
    font-size: 20px;
    color: #FFFFFF;
}
.p {
    margin: 0 0 10px;
    color: #FFFFFF;
}
hr
{
  border: 0;
  width: 75%;
  color: #B9B9B9;
background-color: #B9B9B9;
height: 1px;
}
.row {
    margin-left: 10px;
    margin-right: -15px;
    
}
.col-sm-6 {
    width: 50%;
    float: left;
    padding: 20px 0 20px;
}
.home 
{
    background: url(http://'.$_SERVER['HTTP_HOST'].'/theme/default/img/img-icons-background.jpg) repeat scroll 0 0 rgba(0, 0, 0, 0);
    padding: 40px 0 40px;
    position: relative;
    border-radius: 4px;
}
.home .presentation img {
    max-height: 350px;
}
.home .presentation {
    top: 1px;
    right: 0;
    position: absolute;
    font-size: 15px;
}
.imagedropshadow {
    border: 1px solid #17c5a0;
    display: block;
}
.btn {
    -moz-user-select: none;
    background-image: none;
    border: 1px solid rgba(0, 0, 0, 0);
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857;
    margin-bottom: 0;
    padding: 6px 12px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
    text-decoration: none;
}
.btn.btn-primary {
    background-color: #3C8DBC;
    border-color: #367FA9;
}
.btn {
    border: 1px solid rgba(0, 0, 0, 0);
    border-radius: 3px;
    box-shadow: 0 -1px 0 0 rgba(0, 0, 0, 0.09) inset;
    font-weight: 500;
}
.btn {
    border: 0 none !important;
    box-shadow: 0 -3px 0 rgba(0, 0, 0, 0.3) inset;
    font-weight: 300;
}
.btn-primary {
    background-color: #2BABCF;
    border-color: #279ABA;
    color: #FFFFFF;
}

.label-success {
        background: none repeat scroll 0 0 #5CB85C;
}
.label-warning {
        background: none repeat scroll 0 0 #EB7E12;
}
.label-bad {
        background: none repeat scroll 0 0 #F56954;
}
.blabel-null {
        background: none repeat scroll 0 0 #FFFFFF;
}
.label-prm {
        background: none repeat scroll 0 0 #0073B7;
}
.label {
    position: relative;
    border-radius: 4px;
    text-align: center;
    color: #FFFFFF;
    font-size: 70%;
    font-weight: bold;
    padding: 3px 0 3px;
}
.blabel {
    position: relative;
    border-radius: 4px;
    text-align: center;
    color: #333333;
    font-weight: bold;
    padding: 3px 0 3px;
}
.code {
    position: relative;
    border-radius: 4px;
    color: #C7254E;
    font-size: 90%;
    padding: 2px 4px;
    white-space: nowrap;
}
.small
{
    font-size: 7px;
    text-align: right;
}
.badge {
    background-color: #0073b7;
    border-radius: 10px;
    color: #fff;
    display: inline-block;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    min-width: 10px;
    padding: 3px 7px;
    text-align: center;
    white-space: nowrap;
}
.bg-blue {
    background: none repeat scroll 0 0 #0073B7;
}
.bg-red {
    background: none repeat scroll 0 0 #f56954;
}
.bg-green {
    background: none repeat scroll 0 0 #00a65a;
}
.bg-olive {
    background: none repeat scroll 0 0 #3d9970;
}
.bg-orange {
    background: none repeat scroll 0 0 #ff851b;
}
.bg-purple {
    background: none repeat scroll 0 0 #932ab6;
}
.bg-maroon {
    background: none repeat scroll 0 0 #85144b;
}
-->
</style>
<page style="font-family: freeserif;">
<br><br><div style="text-align: center;"><h1>
'.$site_name.' </h1></div><br>

<div class="home"> 
<div class="row">
<div class="col-sm-6">
<div class="sitename"><b>'.ucfirst(Trim($site_worth)).'</b></div><br />
<p style="color: #FFFFFF;">Get complete information about your website, our unique algorithm will calculate and estimate the daily visitors, 
page, traffic details and social stats etc.. 
</p>
<div style="color: #FFFFFF;">  <br/>
<img src="http://'.$_SERVER['HTTP_HOST'].'/core/img/money.png" style="vertical-align: middle;" />
<b style="font-size: 19px;">$ '.$estimated_worth.'</b> <br/>
</div></div>

<div class="col-sm-6 presentation"><br /><br /><br />
<p> 
<img class="imagedropshadow" style="width: 250px; height: 188px;text-align: center;" src="http://'.$_SERVER['HTTP_HOST'].'/'.$myimage.'" alt="'.$site.'">
</p>
<small style="color: #FFFFFF; text-align: center;">Last updated on '.$last_date.'</small>
</div>
</div> 
</div>
<br />
<hr />
<br />
<b>Estimated Data Report:</b><br />
<table style="width: 100%;" >
	<tr>
		<td style="width: 23%;">
			<ul class="sam">
				<li>#</li>
                <li>Daily</li>
                <li>Monthly</li>
                <li>Yearly</li>
			</ul>
		</td>
		<td style="width: 25%;">
			<ul class="sam">
				<li style="text-align: center;">Pageviews</li>
				<li><div class="badge bg-blue">'.number_format($daily_page_view).'</div></li>
				<li><div class="badge bg-red">'.number_format($monthly_page_view).'</div></li>
				<li><div class="badge bg-green">'.number_format($yearly_page_view).'</div></li>
			</ul>
		</td>
		<td style="width: 23%;">
			<ul class="sam">
				<li style="text-align: center;">Unique Visitors</li>
				<li><div class="badge bg-blue">'.number_format($daily_unique_visitors).'</div></li>
				<li><div class="badge bg-red">'.number_format($monthly_unique_visitors).'</div></li>
				<li><div class="badge bg-green">'.number_format($yearly_unique_visitors).'</div></li>
			</ul>
		</td>
		<td style="width: 23%;">
			<ul class="sam">
				<li style="text-align: center;">Ad Income</li>
				<li><div class="badge bg-blue">$ '.number_format($daily_inc).'</div></li>
				<li><div class="badge bg-red">$ '.number_format($monthly_inc).'</div></li>
				<li><div class="badge bg-green">$ '.number_format($yearly_inc).'</div></li>
			</ul>
		</td>
        
	</tr>
</table>
<hr />
<br />
<b>General Information:</b><br />
<table style="width: 100%;" >
	<tr>
		<td style="width: 25%;">
			<ul class="sam">
				<li style="color: #3C8DBC;">Meta Tags</li>
                <li></li>
                <li>Title</li>
                <li>Description</li>
                <li>Keywords</li>
                <li></li>
                <li>Domain Age</li>
                <li>Server Response</li>
			</ul>
		</td>
		<td style="width: 75%;">
			<ul class="sam">
				<li style="color: #3C8DBC;">Info</li>
                <li></li>
				<li style="color: #6B962A;">'.$site_title.'</li>
				<li>'.$site_des.'</li>
				<li>'.$site_keyword.'</li>
                <li></li>
                <li>'.$domain_age.'</li>
                <li>'.$response_time.' Sec</li>
			</ul>
		</td>
  
	</tr>
</table>
<br />
<hr />
<br />
<div class="small">Report generated by '.$site_name.' | &copy; 2017 ProThemes.Biz</div>
</page>
<page style="font-family: freeserif;">
<br><br><div style="text-align: center;"><h1>
'.$site_name.' </h1></div><br><br>
<b>Alexa Information:</b><br />
<table style="width: 100%;" >
	<tr>
		<td style="width: 35%;">
			<ul class="sam">
				<li>#</li>
                <li>Global Rank</li>
                <li>Popularity at</li>
                <li>Regional Rank</li>
                <li>Backlinks</li>
			</ul>
		</td>
		<td style="width: 30%;">
			<ul class="sam">
				<li style="text-align: center;">Stats</li>
				<li><div class="badge bg-blue">'.$global_rank.'</div></li>
				<li><div class="badge bg-maroon">'.$alexa_pop.'</div></li>
				<li><div class="badge bg-olive">'.$regional_rank.'</div></li>
				<li><div class="badge bg-red">'.$alexa_back.'</div></li>
			</ul>
		</td>
  
	</tr>
    <tr>
  		<td style="width: 45%;">
            <img src="http://traffic.alexa.com/graph?w=300&h=230&o=f&c=1&y=t&b=ffffff&n=666666&r=2y&u='.$site.'" />
		</td>
		<td style="width: 45%;">
            <img src="http://traffic.alexa.com/graph?w=300&h=230&o=f&c=1&y=q&b=ffffff&n=666666&r=2y&u='.$site.'" />
		</td>
    </tr>
</table>
<br />
<hr />
<br />

<b>
Social Stats:</b><br /><br />
<table style="width: 100%;" >
	<tr>
		<td style="width: 30%; ">
          <div class="label label-prm"><b>'.$face_like.'</b><br />
         Facebook Likes</div>
		</td>
		<td style="width: 30%; ">
          <div class="label label-success"><b>'.$face_share.'</b><br />
          Facebook Share</div>
		</td>
		<td style="width: 30%; ">
          <div class="label label-bad"><b>'.$face_comment.'</b><br />
    Facebook Comments</div>
		</td>
	</tr> <br /><br />
    		<tr>
		<td style="width: 30%; ">
          <div class="label label-warning"><b>'.$gplus.'</b><br />
           PlusOnes</div>
		</td>
		<td style="width: 30%; ">
          <div class="label label-prm"><b>'.$pinterest.'</b><br />
         Pinterest </div>
		</td>
		<td style="width: 30%; ">
          <div class="label label-success"><b>'.$linkedin.'</b><br />
         StumbleUpon</div>
		</td>
	</tr> <br /> <br />
        	<tr>
		<td style="width: 30%; ">
          <div class="label label-success"><b>'.$tweet.'</b><br />
         Tweets</div>
		</td>
		<td style="width: 30%; ">
          <div class="label label-bad"><b>'.$linkedin.'</b><br />
        LinkedIn</div>
		</td>
		<td style="width: 30%; ">
          <div class="label label-prm"><b>'.$face_like.'</b><br />
         Facebook Likes</div>
		</td>
	</tr>
</table>
<br />
<hr />
<br />
<b>SEO Stats:</b><br />
<table style="width: 100%;" >
	<tr>
		<td style="width: 35%;">
			<ul class="sam">
				<li>Services</li>
                <li>Google Indexed Pages</li>
                <li>Yahoo Indexed Pages</li>
                <li>Bing Indexed Pages</li>
                <li>Moz Rank</li>
			</ul>
		</td>
		<td style="width: 30%;">
			<ul class="sam">
				<li style="text-align: center;">Value</li>
				<li><div class="badge bg-red">'.$g_indexed_page.'</div></li>
				<li><div class="badge bg-orange">'.$y_indexed_page.'</div></li>
				<li><div class="badge bg-blue">'.$b_indexed_page.'</div></li>
				<li><div class="badge bg-olive">'.$moz_rank.'</div></li>
			</ul>
		</td>
  
	</tr>
</table>
<br />
<hr />
<br />

<div class="small">Report generated by '.$site_name.' | &copy; 2017 ProThemes.Biz</div>
</page>
<page style="font-family: freeserif;">
<br><br><div style="text-align: center;"><h1>
'.$site_name.' </h1></div><br><br>

<b>SEO Stats:</b><br />
<table style="width: 100%;" >
	<tr>
		<td style="width: 35%;">
			<ul class="sam">
				<li>Services</li>
                <li>Backlinks</li>
                <li>Backlinks(Bing)</li>
                <li>DMOZ Directory</li>
                <li>Domain Authority</li>
			</ul>
		</td>
		<td style="width: 30%;">
			<ul class="sam">
				<li style="text-align: center;">Value</li>
				<li><div class="badge bg-blue">'.$alexa_back.'</div></li>
				<li><div class="badge bg-green">'.$b_back.'</div></li>
				<li><div class="badge bg-red">'.$dmoz.'</div></li>
				<li><div class="badge bg-purple">'.$da.'</div></li>
			</ul>
		</td>
  
	</tr>
</table>
<br />
<hr />
<br />
<b>
Host Information:</b><br /><br />
<table style="width: 100%; text-align: center;" >
	<tr>
		<td style="width: 20%; ">
        Donmain IP
		</td>
		<td style="width: 58%; color: #3C8DBC;">
        <b class="code">'.$domain_ip.'</b>
		</td>
	</tr> <br /> <br />
    	<tr>
		<td style="width: 20%;">
        Country
		</td>
		<td style="width: 58%;">
        <b class="code">'.$country.'</b>
		</td>
	</tr> <br /> <br />
        	<tr>
		<td style="width: 20%;">
        ISP
		</td>
		<td style="width: 58%;">
        <b class="code">'.$isp.'</b>
		</td>
	</tr>
</table>
<br />
<hr />
<br />
<b>
Your server IP is blacklisted?:</b><br /><br />

<p style="text-align: center;">Your server IP('.$domain_ip.') is '.$blacklist.'. <br />

Blacklist means involved in spamming or other unwanted online behavior, on your server IP address.</p>

<br />
<hr />
<br />

<b>
Malware detection:</b><br /><br />
<table style="width: 100%; text-align: center;" >
	<tr>
		<td style="width: 20%;">
        Safe Browsing
		</td>
		<td style="width: 58%;">
            '.$safe_browsing.'
		</td>
	</tr> <br /> <br />
    	<tr>
		<td style="width: 20%;">
        Antivirus Check
		</td>
		<td style="width: 58%;">
        '.$antivirus.'
		</td>
	</tr>
</table>
<br />
<hr />
<br />
<div class="small">Report generated by '.$site_name.' | &copy; 2017 ProThemes.Biz</div>
</page>';
	try
	{
		$html2pdf = new HTML2PDF('P','A4','en', true, 'UTF-8');
        $html2pdf->pdf->SetDisplayMode('real');
		$html2pdf->writeHTML($content);
        ob_end_clean();
		$html2pdf->Output($site.'.pdf');
	}
	catch(HTML2PDF_exception $e) 
    
    { 
        echo $e; 
    }
    
mysqli_close($con);
}
else
{
    die("Domain name not found");
}
}
else
{
    die("Something Went Wrong!");
}
?>