<?php

use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Http;
use Spatie\SslCertificate\SslCertificate;
use MadeITBelgium\SeoAnalyzer\SeoFacade as SEO;
use MadeITBelgium\Wappalyzer\WappalyzerFacade as Wappalyzer;

function googleSafeApi($domain)
{
    $googleSafe = 'https://transparencyreport.google.com/safe-browsing/search?url=' . $domain;
    $result     = Browsershot::url($googleSafe)->waitUntilNetworkIdle()
        ->evaluate('document.querySelector("#scrolling-element > safe-browsing-report > ng-component > site-status-result > report-section > section > div > data-tile > div.value > i").textContent'); // returns 2
    if ('check_circle' === $result) {
        return 1; //  safe
    } else {
        return 0; // not safe
    }
}

function sslCertificate($domain)
{
    try {
        $certificate = SslCertificate::createForHostName($domain);

        $response['getDomain']             = $certificate->getDomain(); // returns "spatie.be"
        $response['getIssuer']             = $certificate->getIssuer(); // returns "Let's Encrypt Authority X3"
        $response['isValid']               = $certificate->isValid(); // returns true if the certificate is currently valid
        $response['validFromDate']         = $certificate->validFromDate()->toDateTimeString(); // returns a Carbon instance Carbon
        $response['expirationDate']        = $certificate->expirationDate()->toDateTimeString(); // returns a Carbon instance Carbon
        $response['lifespanInDays']        = $certificate->lifespanInDays(); // return the amount of days between  validFromDate and expirationDate
        $response['expirationdays']        = $certificate->expirationDate()->diffInDays(); // returns an int
        $response['getSignatureAlgorithm'] = $certificate->getSignatureAlgorithm(); // returns a string
        $response['getOrganization']       = $certificate->getOrganization(); // returns the organization name when available
        $response['getAdditionalDomains']  = $certificate->getAdditionalDomains(); // returns ["spatie.be", "www.spatie.be]
        $response['getFingerprint']        = $certificate->getFingerprint(); // returns a fingerprint for the certificate
        $response['getFingerprintSha256']  = $certificate->getFingerprintSha256(); // returns a SHA256 fingerprint
        return $response;
    } catch (\Throwable $th) {
        return array();
    }

}

function builtWith($domain)
{
    $analyze = Wappalyzer::analyze($domain);
    return $analyze;
}

function seoAnalyzer($domain)
{
    $analyze = SEO::analyze($domain);
    return $analyze;
}

function similarweb($domain)
{
    $domain = 'https://data.similarweb.com/api/v1/data?domain=' . $domain;

    $similarweb = Http::get($domain);
    $statusCode = $similarweb->getStatusCode();
    $result     = $similarweb->body();

    if (!($statusCode > 400)) {
        return $result;
    }

    return array();
}

function alexa_rank($url)
{
    $xml = simplexml_load_file("http://data.alexa.com/data?cli=10&url=" . $url);
    if (isset($xml->SD)) {
        $alexaData            = simplexml_load_file("http://data.alexa.com/data?cli=10&url=" . $url);
        $alexa['globalRank']  = isset($alexaData->SD->POPULARITY) ? $alexaData->SD->POPULARITY->attributes()->TEXT : 0;
        $alexa['CountryRank'] = isset($alexaData->SD->COUNTRY) ? $alexaData->SD->COUNTRY->attributes() : 0;
        return json_decode(json_encode($alexa), true);
    } else {
        return array();
    }
}

function remove_http($url)
{
    $disallowed = array('http://', 'https://');
    foreach ($disallowed as $d) {
        if (strpos($url, $d) === 0) {
            return str_replace($d, '', $url);
        }
    }
    return $url;
}
