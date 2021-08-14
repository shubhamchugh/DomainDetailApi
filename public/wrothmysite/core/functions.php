<?php

/*
* @author Balaji
* @name: Worth My Site PHP Script
* @copyright 2020 ProThemes.Biz
*
*/

// Disable Errors
error_reporting(1);

function isValidSite($site) {
    return !preg_match('/^[a-z0-9\-]+\.[a-z]{2,100}(\.[a-z]{2,14})?$/i', $site);
}

function isValidUsername($str) {
    return !preg_match('/[^A-Za-z0-9.#\\-$]/', $str);
}

function isValidEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function str_contains($haystack, $needle, $ignoreCase = false) {
    if ($ignoreCase)
    {
        $haystack = strtolower($haystack);
        $needle = strtolower($needle);
    }
    $needlePos = strpos($haystack, $needle);
    return ($needlePos === false ? false : ($needlePos + 1));
}

function clean_url($site) {
    $site = strtolower($site);
    $site = str_replace(array(
        'http://',
        'https://',
        'www.',
        '/'), '', $site);
    return $site;
}

function checkOnline($site) {
    $curlInit = curl_init($site);
    curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($curlInit, CURLOPT_HEADER, true);
    curl_setopt($curlInit, CURLOPT_NOBODY, true);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($curlInit);
    $GLOBALS['rtime'] = curl_getinfo($curlInit);
    curl_close($curlInit);
    if ($response)
        return true;
    return false;
}

if(!function_exists('simpleCurlGET')) {
    function simpleCurlGET($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }
}

function alexaGET($url, $getSite){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, Array("GETSITE:".$getSite));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $html=curl_exec($ch);
    curl_close($ch);
    return $html;
}

function alexaRank($site){

    $apiData = alexaGET('https://pdftoworder.com/core/library/get.php', $site);
    $xml = simplexml_load_string($apiData);

    $a = $xml->SD[1]->POPULARITY;
    if ($a != null) {
        $alexa_rank = $xml->SD[1]->POPULARITY->attributes()->TEXT;
        $alexa_rank = ($alexa_rank==null ? 'No Global Rank' : $alexa_rank);
    } else {
        $alexa_rank = 'No Global Rank';
    }

    $a1 = $xml->SD[1]->COUNTRY;
    if ($a1 != null) {
        $alexa_pop = $xml->SD[1]->COUNTRY->attributes()->NAME;
        $regional_rank = $xml->SD[1]->COUNTRY->attributes()->RANK;
        $alexa_pop = ($alexa_pop==null ? 'None' : $alexa_pop);
        $regional_rank = ($regional_rank==null ? 'None' : $regional_rank);

    } else {
        $alexa_pop = 'None';
        $regional_rank = 'None';
    }

    $outData = simpleCurlGET("https://www.alexa.com/siteinfo/$site");
    $back = explode('<span class="big data">',$outData);
    $back = explode('</span>',$back[1]);
    $alexa_back = $back[0];

    $alexa_back = ($alexa_back==null ? '0' : $alexa_back);
    return array($alexa_rank,$alexa_pop,$regional_rank,$alexa_back);
}

function StrToNum($Str, $Check, $Magic) {
    $Int32Unit = 4294967296;

    $length = strlen($Str);
    for ($i = 0; $i < $length; $i++)
    {
        $Check *= $Magic;
        if ($Check >= $Int32Unit)
        {
            $Check = ($Check - $Int32Unit * (int)($Check / $Int32Unit));
            $Check = ($Check < -2147483648) ? ($Check + $Int32Unit) : $Check;
        }
        $Check += ord($Str{$i});
    }
    return $Check;
}

function HashURL($String) {
    $Check1 = StrToNum($String, 0x1505, 0x21);
    $Check2 = StrToNum($String, 0, 0x1003F);

    $Check1 >>= 2;
    $Check1 = (($Check1 >> 4) & 0x3FFFFC0) | ($Check1 & 0x3F);
    $Check1 = (($Check1 >> 4) & 0x3FFC00) | ($Check1 & 0x3FF);
    $Check1 = (($Check1 >> 4) & 0x3C000) | ($Check1 & 0x3FFF);

    $T1 = (((($Check1 & 0x3C0) << 4) | ($Check1 & 0x3C)) << 2) | ($Check2 & 0xF0F);
    $T2 = (((($Check1 & 0xFFFFC000) << 4) | ($Check1 & 0x3C00)) << 0xA) | ($Check2 &
        0xF0F0000);

    return ($T1 | $T2);
}

function CheckHash($Hashnum) {
    $CheckByte = 0;
    $Flag = 0;

    $HashStr = sprintf('%u', $Hashnum);
    $length = strlen($HashStr);

    for ($i = $length - 1; $i >= 0; $i--)
    {
        $Re = $HashStr{$i};
        if (1 === ($Flag % 2))
        {
            $Re += $Re;
            $Re = (int)($Re / 10) + ($Re % 10);
        }
        $CheckByte += $Re;
        $Flag++;
    }

    $CheckByte %= 10;
    if (0 !== $CheckByte)
    {
        $CheckByte = 10 - $CheckByte;
        if (1 === ($Flag % 2))
        {
            if (1 === ($CheckByte % 2))
            {
                $CheckByte += 9;
            }
            $CheckByte >>= 1;
        }
    }

    return '7' . $CheckByte . $HashStr;
}
$pss[0] = 'c';
$pss[1] = 'i';
$pss[2] = 'l';

function getch($url) {
    return CheckHash(HashURL($url));
}

function getRecent($con, $count = 5) {
    $limit = $count ? "limit $count" : "";
    $query = "SELECT *
FROM site_history
ORDER BY id DESC
LIMIT 0 , $count";
    $result = mysqli_query($con, $query);
    return $result;
}

function google_page_rank($url) {
    //Page Rank - officially discontinued
    $ch = getch($url);
    $fp = fsockopen('toolbarqueries.google.com', 80, $errno, $errstr, 30);
    if ($fp)
    {
        $out = "GET /tbr?client=navclient-auto&ch=$ch&features=Rank&q=info:$url HTTP/1.1\r\n";
        $out .= "User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:28.0) Gecko/20100101 Firefox/28.0\r\n";
        $out .= "Host: toolbarqueries.google.com\r\n";
        $out .= "Connection: Close\r\n\r\n";
        fwrite($fp, $out);
        while (!feof($fp))
        {
            $data = fgets($fp, 128);
            //echo $data;
            $pos = strpos($data, "Rank_");
            if ($pos === false)
            {
            } else
            {
                $pager = substr($data, $pos + 9);
                $pager = trim($pager);
                $pager = str_replace("\n", '', $pager);
                return $pager;
            }
        }
        fclose($fp);
    }
}

function lcme($path) {
    unlink($path);
}

function host_info($site) {
    $ch = curl_init('http://www.iplocationfinder.com/' . clean_url($site));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Cookie: consent=2019-02-05T07%3A36%3A27.654Z'));
    curl_setopt($ch, CURLOPT_USERAGENT,
        'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $data = curl_exec($ch);
    preg_match('~ISP.*<~', $data, $isp);
    preg_match('~Country.*<~', $data, $country);
    preg_match('~IP:.*<~', $data, $ip);

    $country = explode(':', strip_tags($country[0]));
    $country = trim(str_replace('Hide your IP address and Location here', '', $country[1]));
    if ($country == '')
        $country = 'Not Available';

    $isp = explode(':', strip_tags($isp[0]));
    $isp = trim($isp[1]);
    if ($isp == '')
        $isp = 'Not Available';

    $ip = $ip[0];
    $ip = trim(str_replace(array(
        'IP:',
        '<',
        '/label>',
        '/th>td>',
        '/td>'), '', $ip));
    if ($ip == '')
        $ip = 'Not Available';
    $data = $ip . "::" . $country . "::" . $isp . "::";
    return $data;
}

function seoMoz($site,$accessID,$secretKey){

    $expires = time() + 300;
    $SignInStr = $accessID. "\n" .$expires;
    $binarySignature = hash_hmac('sha1', $SignInStr, $secretKey, true);
    $SafeSignature = urlencode(base64_encode($binarySignature));
    $objURL = "http://".$site;
    $cols = "103079231488";
    $flags = "103079215108";
    $reqUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/".urlencode($objURL)."?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$SafeSignature;
    $opts = array(
        CURLOPT_RETURNTRANSFER => true
        );
    $curlhandle = curl_init($reqUrl);
    curl_setopt_array($curlhandle, $opts);
    $content = curl_exec($curlhandle);
    curl_close($curlhandle);
    $resObj = json_decode($content);
    //1 -> MozRank 2 -> Domain Authority 3 -> Page Authority
    return array (round($resObj->{'umrp'},2),round($resObj->{'pda'},2),round($resObj->{'upa'},2));
}

function googleBack($site){
    $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=link:" . $site .
        "&filter=0";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_NOBODY, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $json = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($json, true);
    $check = $data['responseDetails'];
    if (str_contains($check, "Suspected"))
    {
        $ip = explode(".", $_SERVER['SERVER_ADDR']);
        $ip = $ip[0] . "." . $ip[1] . "." . rand(0, 255) . "." . rand(0, 255);
        $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=link:" . $site .
            "&filter=0&userip=" . $ip;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $json = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($json, true);
    }
    if ($data['responseStatus'] == 200)
    {
        $data = $data['responseData']['cursor']['resultCount'];
        if ($data == '')
            $data = 0;
        return $data;
    } else
        return "0";
}

function pro_ss($site) {
    return file_get_contents($site);
}

function avgCheck($host) {
    
    $avgUrl = 'http://www.avgthreatlabs.com/website-safety-reports/domain/'.$host;
         return '1';
    $avgData = curlGET($avgUrl,'http://www.avgthreatlabs.com');
    $avgData = explode('<div class="rating',$avgData);
    $avgData = explode('">',$avgData[1]);
    $resStats = Trim(strtolower($avgData[0]));

    if($resStats == 'green')
        return '1';
    elseif($resStats == 'yellow')
        return '2';
    elseif($resStats == 'orange')
        return '2';
    elseif($resStats == 'red')
        return '3';
    else
        return '0';
}

function googleIndex($site) {
    $searchQuery = urlencode("site:$site");
    $googleDomains = array('google.com', 'google.ad', 'google.ae', 'google.com.af', 'google.com.ag', 'google.com.ai', 'google.al', 'google.am', 'google.co.ao', 'google.com.ar', 'google.as', 'google.at', 'google.com.au', 'google.az', 'google.ba', 'google.com.bd', 'google.be', 'google.bf', 'google.bg', 'google.com.bh', 'google.bi', 'google.bj', 'google.com.bn', 'google.com.bo', 'google.com.br', 'google.bs', 'google.bt', 'google.co.bw', 'google.by', 'google.com.bz', 'google.ca', 'google.cd', 'google.cf', 'google.cg', 'google.ch', 'google.ci', 'google.co.ck', 'google.cl', 'google.cm', 'google.cn', 'google.com.co', 'google.co.cr', 'google.com.cu', 'google.cv', 'google.com.cy', 'google.cz', 'google.de', 'google.dj', 'google.dk', 'google.dm', 'google.com.do', 'google.dz', 'google.com.ec', 'google.ee', 'google.com.eg', 'google.es', 'google.com.et', 'google.fi', 'google.com.fj', 'google.fm', 'google.fr', 'google.ga', 'google.ge', 'google.gg', 'google.com.gh', 'google.com.gi', 'google.gl', 'google.gm', 'google.gp', 'google.gr', 'google.com.gt', 'google.gy', 'google.com.hk', 'google.hn', 'google.hr', 'google.ht', 'google.hu', 'google.co.id', 'google.ie', 'google.co.il', 'google.im', 'google.co.in', 'google.iq', 'google.is', 'google.it', 'google.je', 'google.com.jm', 'google.jo', 'google.co.jp', 'google.co.ke', 'google.com.kh', 'google.ki', 'google.kg', 'google.co.kr', 'google.com.kw', 'google.kz', 'google.la', 'google.com.lb', 'google.li', 'google.lk', 'google.co.ls', 'google.lt', 'google.lu', 'google.lv', 'google.com.ly', 'google.co.ma', 'google.md', 'google.me', 'google.mg', 'google.mk', 'google.ml', 'google.com.mm', 'google.mn', 'google.ms', 'google.com.mt', 'google.mu', 'google.mv', 'google.mw', 'google.com.mx', 'google.com.my', 'google.co.mz', 'google.com.na', 'google.com.nf', 'google.com.ng', 'google.com.ni', 'google.ne', 'google.nl', 'google.no', 'google.com.np', 'google.nr', 'google.nu', 'google.co.nz', 'google.com.om', 'google.com.pa', 'google.com.pe', 'google.com.pg', 'google.com.ph', 'google.com.pk', 'google.pl', 'google.pn', 'google.com.pr', 'google.ps', 'google.pt', 'google.com.py', 'google.com.qa', 'google.ro', 'google.ru', 'google.rw', 'google.com.sa', 'google.com.sb', 'google.sc', 'google.se', 'google.com.sg', 'google.sh', 'google.si', 'google.sk', 'google.com.sl', 'google.sn', 'google.so', 'google.sm', 'google.sr', 'google.st', 'google.com.sv', 'google.td', 'google.tg', 'google.co.th', 'google.com.tj', 'google.tk', 'google.tl', 'google.tm', 'google.tn', 'google.to', 'google.com.tr', 'google.tt', 'google.com.tw', 'google.co.tz', 'google.com.ua', 'google.co.ug', 'google.co.uk', 'google.com.uy', 'google.co.uz', 'google.com.vc', 'google.co.ve', 'google.vg', 'google.co.vi', 'google.com.vn', 'google.vu', 'google.ws', 'google.rs', 'google.co.za', 'google.co.zm', 'google.co.zw', 'google.cat');
    $random_domain = array_rand($googleDomains,1);
    $googleDomain = $googleDomains[$random_domain];
    
    $googleUrl = 'https://www.' . $googleDomain . '/search?hl=en&q=' . $searchQuery;
    $pageData = curlGET_Text($googleUrl);
    $count = explode('>About',$pageData);
    $count  = explode('<nobr>',$count[1]);
    $count = $count[0];
    $count = filter_var($count, FILTER_SANITIZE_NUMBER_INT);
    if ($count == '')
        $count = 0;
    return number_format($count);
}
function curlGET_Text($url){
    $cookie=tempnam("/tmp","CURLCOOKIE");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);  
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	curl_setopt($ch, CURLOPT_HEADER,0); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_AUTOREFERER,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER,array ("Accept: text/plain"));
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0');
	$html=curl_exec($ch);
    curl_close($ch);
    return $html;
}
function bingBack($link) {
    $link = "http://www.bing.com/search?q=link%3A" . trim($link) .
        "&go=&qs=n&sk=&sc=8-5&form=QBLH";
    $source = file_get_contents($link);
    $s = explode('<span class="sb_count">', $source);
    $s = explode('</span>', $s[1]);
    $s = explode('results', $s[0]);
    $s = Trim($s[0]);
    if ($s == '')
    {
        $s = 0;
    }
    return $s;
}

function bingIndex($site) {
    $link = "http://www.bing.com/search?q=site:%s";
    $link = sprintf($link, $site);
    $source = file_get_contents($link);
    $s = explode('<span class="sb_count">', $source);
    $s = explode('</span>', $s[1]);
    $s = explode('results', $s[0]);
    $s = Trim($s[0]);
    $s = str_replace('Resultaten','',$s);
    if ($s == '')
    {
        $s = 0;
    }
    return $s;
}

function dec($pps, $sev) {
    $pps = base64_decode($pps);
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $sev, $pps, MCRYPT_MODE_ECB, $iv);
}

function yahooIndex($site) {
    $url = "http://search.yahoo.com/bin/search?p=site:$site";
    if (!$res = file_get_contents($url))
        return 0;
    preg_match('#<span[^>]*>[^<]*results<\/span[^>]*>#i', $res, $matches);
    return isset($matches[0]) ? (float)preg_replace("#\D#", "", $matches[0]) : 0;
}

function dmozCheck($site) {
    $mydata = file_get_contents("http://www.dmoz.org/search?q=$site");
    return strpos($mydata, "DMOZ Categories") ? "Listed" : "Not Listed";
}

function dnsblookup($ip) {
    $dnsbl_lookup = array(
        "dnsbl-1.uceprotect.net",
        "dnsbl-2.uceprotect.net",
        "dnsbl-3.uceprotect.net",
        "dnsbl.dronebl.org",
        "dnsbl.sorbs.net",
        "zen.spamhaus.org");
    if ($ip)
    {
        $reverse_ip = implode(".", array_reverse(explode(".", $ip)));
        foreach ($dnsbl_lookup as $host)
        {
            if (checkdnsrr($reverse_ip . "." . $host . ".", "A"))
            {
                $listed .= $reverse_ip . '.' . $host . ' blacklisted';
            }
        }
    }
    if ($listed)
    {
        return $listed;
    } else
    {
        return 'not blacklisted';
    }
}

function getHeaders($site) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $site);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT,
        'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    return curl_exec($ch);
}

function getHttp($headers) {
    $headers = explode("\r\n", $headers);
    $http_code = explode(' ', $headers[0]);
    return (int)trim($http_code[1]);
}

function robocheck($site) {
    if ($site{strlen($site) - 1} != '/')
        $site .= '/';
    $site .= 'robots.txt';
    $headers = explode("\r\n", getHeaders($site));

    if (!empty($headers[0]))
    {
        $httpcode = getHttp($headers[0]);
        if ($httpcode == 200 || $httpcode == 500 || $httpcode == 301 || $httpcode == 302 ||
            $httpcode == 403)
        {
            $site = "www.$site";
            $headers = explode("\r\n", getHeaders($site));

            if (!empty($headers[0]))
            {
                $httpcode = getHttp($headers[0]);
                if ($httpcode == 200 || $httpcode == 500 || $httpcode == 301 || $httpcode == 302 ||
                    $httpcode == 403)
                {
                    return 1;
                } else
                {
                    return 0;
                }
            } else
            {
                return 0;
            }
        } else
        {
            return 0;
        }
    } else
    {
        return 0;
    }
}

function sitemap_check($site) {
    if ($site{strlen($site) - 1} != '/')
        $site .= '/';
    $site .= 'sitemap.xml';
    $headers = explode("\r\n", getHeaders($site));

    if (!empty($headers[0]))
    {
        $httpcode = getHttp($headers[0]);
        if ($httpcode == 200 || $httpcode == 500 || $httpcode == 301 || $httpcode == 302 ||
            $httpcode == 403)
        {
            $site = "www.$site";
            $headers = explode("\r\n", getHeaders($site));

            if (!empty($headers[0]))
            {
                $httpcode = getHttp($headers[0]);
                if ($httpcode == 200 || $httpcode == 500 || $httpcode == 301 || $httpcode == 302 ||
                    $httpcode == 403)
                {
                    return 1;
                } else
                {
                    return 0;
                }
            } else
            {
                return 0;
            }
        } else
        {
            return 0;
        }
    } else
    {
        return 0;
    }
}

define('SAFE_API_KEY', "AIzaSyDzLJL3bihm7si5GwCQGelqhMiQRdaNiFQ");
define('SAFE_CLIENT', 'checkURLapp');
define('SAFE_APP_VER', '1.0');

function get_data($url) {
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($ch);
    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return array('status' => $httpStatus, 'data' => $data);
}

function send_response($input){
    if (!empty($input)) {
        $urlToCheck = urlencode($input);

        $url = 'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . SAFE_API_KEY;

        $postData = '{
    "client": {
     "clientId": "' . SAFE_CLIENT . '",
     "clientVersion": "' . SAFE_APP_VER . '"
    },
    "threatInfo": {
     "threatTypes":      ["THREAT_TYPE_UNSPECIFIED","MALWARE", "SOCIAL_ENGINEERING","UNWANTED_SOFTWARE","POTENTIALLY_HARMFUL_APPLICATION"],
     "platformTypes":    ["LINUX"],
     "threatEntryTypes": ["URL"],
     "threatEntries":    [
      {"url": "http://'.$urlToCheck.'"}
     ]
  }
}';
        $responseJson = get_data($url, $postData);
        $response = json_decode($responseJson);

        if (property_exists($response, 'matches')) {
            return json_encode(array('status' => 200, 'checkedUrl' => $urlToCheck, 'message' => 'The website is blacklisted as "' . str_replace("_", " ", $response->matches[0]->threatType) . '".'));
        } else {
            return json_encode(array('status' => 204, 'checkedUrl' => $urlToCheck, 'message' => 'The website is not blacklisted and looks safe to use.'));
        }

    }else {
        return json_encode(array(
                               'status' => 401, 'checkedUrl' => '', 'message' => 'Please enter URL.'));
    }
}

function curlGET($url,$ref_url = "http://www.google.com/",$agent = "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0"){
    $cookie=tempnam("/tmp","CURLCOOKIE");
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent );
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 100);
	curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/html; charset=utf-8","Accept: */*"));
    curl_setopt($ch, CURLOPT_VERBOSE, True);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_REFERER, $ref_url);
	$html=curl_exec($ch);
    curl_close($ch);
    return $html;
}

function check_mal($site) {
    $checkMalware = send_response($site);
    $checkMalware = json_decode($checkMalware, true);
    $malwareStatus = $checkMalware['status'];
    return $malwareStatus;
}

class socialCount
{
    private $url;
    
    function __construct($url){
        $this->url = urlencode($this->clean_with_www($url));
        $this->timeout = 20;
    }
    
    function clean_with_www($site) {
        $site = strtolower($site);
        $site = str_replace(array(
            'http://',
            'https://'), '', $site);
        return $site;
    }
    
    function getDataCurl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        $response = curl_exec($ch);
        if (curl_error($ch))
        {
            return '0';
        }
        return $response;
    }

    function getFb() {
        $this->url = str_replace('www.','',$this->url);
        $json_string = $this->getDataCurl('http://demo.atozseotools.com/fb/' .
            $this->url);
        $json = json_decode($json_string, true);

        $share_count = $json[1];
        $like_count = $json[0];
        $comment_count = $json[2];
        $val = array($share_count, $like_count, $comment_count);
        return $val;
    }
    
    function getTweets() {
        $json_string = $this->getDataCurl('http://api.prothemes.biz/tweets.php?site=http://www.' .
            $this->url);
        $json = Trim($json_string);
        return $json;
    }

    function getLinkedin() {
        $json_string = file_get_contents("http://www.linkedin.com/countserv/count/share?url=$this->url&format=json");
        $json = json_decode($json_string, true);
        return isset($json['count']) ? intval($json['count']) : 0;
    }
    
    function getDelicious() {
        $json_string = $this->getDataCurl('http://feeds.delicious.com/v2/json/urlinfo/data?url=' .
            $this->url);
        $json = json_decode($json_string, true);
        return isset($json[0]['total_posts']) ? intval($json[0]['total_posts']) : 0;
    }
    
    function getPlusones() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://clients6.google.com/rpc");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"http://' .
            rawurldecode($this->url) .
            '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        $response = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($response, true);
        return isset($json[0]['result']['metadata']['globalCounts']['count']) ? intval($json[0]['result']['metadata']['globalCounts']['count']) :
            0;
    }

    function getStumble() {
        $json_string = $this->getDataCurl('http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' .
            $this->url);
        $json = json_decode($json_string, true);
        return isset($json['result']['views']) ? intval($json['result']['views']) : 0;
    }

    function getPinterest() {
        $purl = 'http://' . $this->url;
        $purl = sprintf('http://api.pinterest.com/v1/urls/count.json?url=%s', $purl);
        $response = $this->getDataCurl($purl);
        $response = str_replace(array('(', ')'), '', $response);
        $response = str_replace("receiveCount", '', $response);
        if (!$json = json_decode($response, true))
            return 0;
        return isset($json['count']) ? (int)$json['count'] : 0;
    }
}

function price($alexa_global_rank, $backlinks, $moz_rank, $google_index_pages, $facebook_like, $tweets_count, $age) {
    
    //Filter Values
    $alexa_global_rank = filter_var($alexa_global_rank, FILTER_SANITIZE_NUMBER_INT);
    $backlinks = filter_var($backlinks, FILTER_SANITIZE_NUMBER_INT);
    $moz_rank = round(filter_var($moz_rank, FILTER_SANITIZE_NUMBER_INT));
    $google_index_pages = filter_var($google_index_pages, FILTER_SANITIZE_NUMBER_INT); 
    $facebook_like = filter_var($facebook_like, FILTER_SANITIZE_NUMBER_INT); 
    $tweets_count = filter_var($tweets_count, FILTER_SANITIZE_NUMBER_INT);
        
    //Parse Age
    $age = strtolower($age);
    if (strpos($age, "years") == true) {
        $age_s = explode("years", $age);
        $age_s = Trim($age_s[0]);
        $age_s = (int)($age_s == "" ? '0' : $age_s);
    } else {
        $age_s = 0;
    }
    
    //Fix 
    $google_index_pages = (int)($google_index_pages == '' ? '0' : $google_index_pages);
    $moz_rank = $moz_rank == '' ? '0' : $moz_rank;
    $facebook_like = (int)($facebook_like == '' ? '0' : $facebook_like);
    $tweets_count = (int)($tweets_count == '' ? '0' : $tweets_count);
    $backlinks = (int)($backlinks == '' ? '0' : $backlinks);
    $alexa_global_rank = (int)($alexa_global_rank == '' ? '0' : $alexa_global_rank);
    
    //Calculate Worth 
    $p1 = 0;
    if ($moz_rank == 0)
        $p1 = 10 * 2;

    if ($moz_rank == 1)
        $p1 = 100 * 2; 

    if ($moz_rank == 2)
        $p1 = 200 * 2;

    if ($moz_rank == 3)
        $p1 = 300 * 2;

    if ($moz_rank == 4)
        $p1 = 400 * 2;

    if ($moz_rank == 5)
        $p1 = 500 * 2;

    if ($moz_rank == 6)
        $p1 = 600 * 2;

    if ($moz_rank == 7)
        $p1 = 700 * 2;

    if ($moz_rank == 8)
        $p1 = 800 * 2;

    if ($moz_rank == 9)
        $p1 = 900 * 2;

    if ($moz_rank == 10)
        $p1 = 1000 * 2;

    if ($alexa_global_rank <= 0)
    {
        $al = '20000000';
    } else
    {
        $al = $alexa_global_rank;
    }
    if ($backlinks == '0')
    {
        $back = '1';
    } else
    {
        $back = $backlinks;
    }
    if ($google_index_pages < 100)
    {
        $bonus5 = '1000';
    } elseif ($google_index_pages < 1000)
    {
        $bonus5 = '10000';
    } elseif ($google_index_pages < 3000)
    {
        $bonus5 = '15000';
    } elseif ($google_index_pages < 6000)
    {
        $bonus5 = '35000';
    } elseif ($google_index_pages < 10000)
    {
        $bonus5 = '135000';
    } elseif ($google_index_pages > 10000)
    {
        $bonus5 = '300000';
    }
    if ($avg_virus_check == '1')
    {
        $bonus4 = '10000';
    }
    if ($facebook_like == 0)
    {
        $bonus1 = 0;
    } elseif ($facebook_like <= 50)
    {
        $bonus1 = 10;
    } elseif ($facebook_like <= 100)
    {
        $bonus1 = 100;
    } elseif ($facebook_like <= 1000)
    {
        $bonus1 = 1000;
    } elseif ($facebook_like > 1000)
    {
        $bonus1 = 6000;
    }
    if ($tweets_count == 0)
    {
        $bonus2 = 0;
    } elseif ($tweets_count <= 50)
    {
        $bonus2 = 10;
    } elseif ($tweets_count <= 100)
    {
        $bonus2 = 100;
    } elseif ($tweets_count <= 1000)
    {
        $bonus2 = 1000;
    } elseif ($tweets_count > 1000)
    {
        $bonus2 = 6000;
    }

    if ($alexa_global_rank == 0)
    {
        $bonus_pick = 0;
    } elseif ($alexa_global_rank < 10)
    {
        $bonus_pick = '10000000000';
    } elseif ($alexa_global_rank < 50)
    {
        $bonus_pick = '5000000000';
    } elseif ($alexa_global_rank < 100)
    {
        $bonus_pick = '1000000000';
    } elseif ($alexa_global_rank < 200)
    {
        $bonus_pick = '100000000';
    } elseif ($alexa_global_rank < 500)
    {
        $bonus_pick = '5000000';
    } elseif ($alexa_global_rank < 1000)
    {
        $bonus_pick = '1000000';
    } elseif ($alexa_global_rank < 10000)
    {
        $bonus_pick = '100000';
    }

    if ($age_s < 1)
    {
        $bonus3 = '100';
    } elseif ($age_s <= 3)
    {
        $bonus3 = '500';
    } elseif ($age_s <= 6)
    {
        $bonus3 = '1000';
    } elseif ($age_s <= 7)
    {
        $bonus3 = '2000';
    } elseif ($age_s <= 9)
    {
        $bonus3 = '5000';
    } elseif ($age_s <= 10)
    {
        $bonus3 = '10000';
    } elseif ($age_s <= 12)
    {
        $bonus3 = '20000';
    } elseif ($age_s >= 13)
    {
        $bonus3 = '5000000';
    }

    $p2 = 2000000 / $al / $p1 * 5;
    $p3 = $backlinks * $back;
    $p4 = $google_index_pages / $back;
    $p5 = $p1 + $p2 + $p3 + $p4;

    if ($alexa_global_rank != 0 && $alexa_global_rank < 10000)
    {
        $price = (($p5 / 1.5 - 133) + $bonus1 + $bonus2 + $bonus3 + $bonus4 + $bonus5 +
            $bonus_pick) * 3;
    } elseif ($alexa_global_rank != 0 && $alexa_global_rank < 150000)
    {
        $price = (($p5 / 1.5 - 133) + $bonus1 + $bonus2 + $bonus3 + $bonus4 + $bonus5 +
            $bonus_pick) * 2;
    } elseif ($alexa_global_rank != 0 && $alexa_global_rank < 200000)
    {
        $price = (($p5 / 1.5 - 133) + $bonus1 + $bonus2 + $bonus3 + $bonus4 + $bonus5 +
            $bonus_pick) * 1.5;
    } else {
        if ($age_s == '0')
        {
            $price = ($p5 / 1.5 - 133);
        } elseif ($age_s <= 5)
        {
            $price = ($p5 / 1.5 - 133) + 200;
        } elseif ($age_s <= 9)
        {
            $price = ($p5 / 1.5 - 133) + 400;
        } elseif ($age_s > 9)
        {
            $price = ($p5 / 1.5 - 133) + 1000;
        } else {
            $price = ($p5 / 1.5 - 133) + 1500;
        }

    }
    
    //Minimum Amount Fix
    $price = ($price < 1 ? 100 : $price);
    $price = ($price < 100 ? 200 : $price);
    
    $price = round($price);
    return $price;
}

function addToSitemap($site, $con) {
    // Load Sitemap Option
    $query = "Select * From sitemap_options WHERE id='1'";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result))
    {
        $priority = $row['priority'];
        $changefreq = $row['changefreq'];
    }

    $c_date = date('Y-m-d');
    $site_data = file_get_contents("../sitemap.xml");
    $site_data = str_replace("</urlset>", "", $site_data);
    $server_name = "http://" . $_SERVER['SERVER_NAME'] . "/" . $site;
    $c_sitemap = '
 <url>
        <loc>' . $server_name . '</loc>
        <priority>' . $priority . '</priority>
        <changefreq>' . $changefreq . '</changefreq>
        <lastmod>' . $c_date . '</lastmod>
</url>
</urlset>';
    $full_map = $site_data . $c_sitemap;
    file_put_contents("../sitemap.xml", $full_map);
}

function delDir($dir) {
    $files = array_diff(scandir($dir), array('.', '..'));

    foreach ($files as $file)
    {
        (is_dir("$dir/$file")) ? delDir("$dir/$file") : unlink("$dir/$file");
    }

    return 1;
}

function getTopSites($con, $offset, $per_page) {
    $sql = "select * from domains_data ORDER BY estimated_worth *1 DESC LIMIT $offset, $per_page";
    $result = mysqli_query($con, $sql);
    return $result;
}

function socialGetCenterText($str1,$str2,$data,$count=1){
    $data = explode($str1,$data);
    $data = explode($str2,$data[$count]);
    return Trim($data[0]);
}

function clearSocialData($data){
    $data = str_replace(array(',','.','-','+','_', ' ', '$', '%', '<', '>','<br>','?','/','!','@','#','~',"'",'"'), '', $data);
    return intval(trim($data));
}

function socialCurlGET($url,$ref_url = "http://www.google.com/",$agent = "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0"){
    $cookie=tempnam("/tmp","CURLCOOKIE");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 100);
    curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/html; charset=utf-8","Accept: */*"));
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_REFERER, $ref_url);
    $html=curl_exec($ch);
    curl_close($ch);
    return $html;
}

function socialSimpleCurlGET($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $html=curl_exec($ch);
    curl_close($ch);
    return $html;
}

function getSocialData($source){
    $matches = array();
    $fbCount = 0;
    $fbLink = $twiLink = $instaLink = '';
    $fbData = $tData = $iData = '-';
    $fbMatch = '#https?\://(?:www\.)?facebook\.com/(\d+|[A-Za-z0-9\.]+)/?#';
    $twiMatch = '#https?\://(?:www\.)?twitter\.com/(\d+|[A-Za-z0-9\.]+)/?#';
    $instaMatch = '#https?\://(?:www\.)?instagram\.com/(\d+|[A-Za-z0-9\.]+)/?#';

    preg_match_all($fbMatch,$source,$matches);

    if(isset($matches[1])){

        if(isset($matches[1][0]) && $matches[1][0] != ''){
            if($matches[1][0] === 'sharer'){
                if(isset($matches[1][1]))
                    $fbLink = $matches[0][1];
            }else{
                $fbLink = $matches[0][0];
            }
        }

        if($fbLink != ''){
            $fbData = "<a style=\"color: #222222\" target=\"_blank\" href=\"$fbLink\" rel=\"nofollow\">".ucfirst($matches[1][0])."</a>";
            $fxdata = socialCurlGET($fbLink);
            if($fxdata != '') {
                if (preg_match_all('/>([0-9,]+) people like this</i', $fxdata, $matches))
                    $fbCount = clearSocialData($matches[1][0]);
                else
                    $fbCount = clearSocialData(socialGetCenterText('_4bl9"><div>', ' ', $fxdata));
                if($fbCount != '' && $fbCount != 0) {
                    $fbCount = number_format($fbCount);
                    $fbData .= " <br><small>(Likes: $fbCount)</small>";
                }
            }
        }
    }


    preg_match_all($twiMatch,$source,$matches);
    if(isset($matches[1])){
        if(isset($matches[1][0]) && $matches[1][0] != ''){
            if($matches[1][0] === 'share' || $matches[1][0] === 'intent' ){
                if(isset($matches[1][1]))
                    $twiLink = $matches[0][1];
            }else{
                $twiLink = $matches[0][0];
            }
        }
    }

    if($twiLink != '')
        $tData = "<a style=\"color: #222222\" target=\"_blank\" href=\"$twiLink\" rel=\"nofollow\">".ucfirst($matches[1][0])."</a>";


    preg_match_all($instaMatch,$source,$matches);
    if(isset($matches[1])){
        if(isset($matches[1][0]) && $matches[1][0] != '')
            $instaLink = $matches[0][0];
    }

    if($instaLink != '')
        $iData = "<a style=\"color: #222222\" target=\"_blank\" href=\"$instaLink\" rel=\"nofollow\">".ucfirst($matches[1][0])."</a>";

    return array('fb' => $fbData, 'twit' => $tData, 'insta' => $iData);
}