<?php

function get_title($str)
{
    $str = mb_strtoupper($str);

    if (!$str) {
        return "";
    }

    $doc = new \DOMDocument();
    // @$doc->loadHTML($str);
    $doc->loadHTML(mb_convert_encoding($str, 'HTML-ENTITIES', 'UTF-8'));

    $nodes = $doc->getElementsByTagName('title');

    if ($nodes->length > 0) {
        return $nodes->item(0)->nodeValue;
    }

    return "";
}

function getMetaTags($str)
{

    $pattern = '
~<\s*meta\s

# using lookahead to capture type to $1
(?=[^>]*?
\b(?:name|property|http-equiv)\s*=\s*
(?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
)

# capture content to $2
[^>]*?\bcontent\s*=\s*
(?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
[^>]*>

~ix';

    if (preg_match_all($pattern, $str, $out)) {
        return array_combine($out[1], $out[2]);
    }

    return array();
}

function getMeta($html, $tag)
{
    if ('title' == $tag) {
        return get_title($html);
    } else {
        $meta = getMetaTags($html);
        foreach ($meta as $key => $value) {
            if (mb_strtolower($key) == mb_strtolower($tag)) {
                return strip_tags($value);
            }
        }
    }
    return "";

}

function remote_file_exists($url)
{

    if (!empty($url)) {
        try {
            $html    = Http::get($url);
            $retcode = $html->status();
        } catch (\Throwable $th) {
            $retcode = 500;
        }

        if ($retcode > 400) {
            return 0;
        }
        if ('error' == $retcode) {
            return 0;
        }
        return 1;
    }
    return 0;

}

function more($string, $len = 500)
{

    $string = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $string);
    $string = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $string);
    $string = strip_tags($string);
    $string = ltrim(rtrim($string));

    if (mb_strlen($string) < $len) {
        return $string;
    }

    return ltrim(mb_substr($string, 0, $len)) . "...";
}

function getCharset($html)
{
    $charset   = "";
    $charset_a = array();
    $r         = "/charset=\"(.+?)\"/";

    preg_match($r, $html, $charset_a);

    if (!empty($charset_a[1])) {
        $charset = $charset_a[1];
    } else {
        $r = '@content="([\\w/]+)(;\\s+charset=([^\\s"]+))?@i';
        preg_match($r, $html, $charset_a);

        if (!empty($charset_a[3])) {
            $charset = $charset_a[3];
        }

    }
    return $charset;
}

function getDescription($html)
{
    $matches = array();
    preg_match('/<meta.*?name=("|\')description("|\').*?content=("|\')(.*?)("|\')/i', $html, $matches);
    if (count($matches) > 4) {
        return trim($matches[4]);
    }
    preg_match('/<meta.*?content=("|\')(.*?)("|\').*?name=("|\')description("|\')/i', $html, $matches);
    if (count($matches) > 2) {
        return trim($matches[2]);
    }
    return null;
}

function getFavIcon($html)
{
    if ('' == $html) {
        return false;
    }

    $doc = new \DOMDocument();
    if (empty($doc->loadHTML($html))) {
        return false;
    }

    $xml = simplexml_import_dom($doc);
    if (empty($xml)) {
        return false;
    }

    $arr = $xml->xpath('//link[@rel="shortcut icon"]');

    if (empty($arr[0]['href'])) {
        $arr = $xml->xpath('//link[@rel="icon"]');
    }

    if (empty($arr[0]['href'])) {
        $arr = $xml->xpath('//link[@rel="icon shortcut"]');
    }
    if (empty($arr[0]['href'])) {
        $arr[0]['href'] = null;
    }
    return $arr[0]['href'];

}

function get_domain($url)
{
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return $regs['domain'];
    }
    return false;
}
