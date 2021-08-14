<?php

namespace App\Http\Controllers;

use Pdp\Rules;
use Pdp\Domain;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class ScreenShotApiController extends Controller
{
    public function api(Request $request)
    {
        $jsonApi['whoisDetail'] = null;
        $bucket                 = $request->bucket;
        $httpUrl                = trim($request->url);
        $sourceDomain           = parse_url($request->url);
        $scheme                 = $sourceDomain['scheme'];
        $domain                 = $sourceDomain['host']; // domain name with subdomain

        $publicSuffixList = Rules::fromPath(public_path('public_suffix_list.dat'));
        $domain           = Domain::fromIDNA2008($domain);
        $domain           = $publicSuffixList->resolve($domain);
        $domain           = $domain->registrableDomain()->toString(); // only verified domain name
        $httpDomain       = $scheme . '://' . $domain;

        if (!empty($bucket)) {

            Config::set('filesystems.disks.wasabi.bucket', $bucket);

            $file_headers = @get_headers($httpUrl);

            if (empty($file_headers) || false == $file_headers) {

                die;
            }

            $html = Http::get($httpUrl, [
                'allow_redirects' => true,
            ]);
            $code = $html->getStatusCode();
            $html = $html->body();

            if (!($code > 400)) {
                $response = new \DOMDocument();
                libxml_use_internal_errors(true); //disable libxml errors

                $response->loadHTML($html);
                libxml_clear_errors(); //remove errors for yucky html

                $response->preserveWhiteSpace = false;
                $response->saveHTML();

                $response_xpath = new \DOMXPath($response);
            } else {
                $html = "";
            }

            $charset     = (!empty(getCharset($html))) ? getCharset($html) : "";
            $robots      = (!empty(remote_file_exists($httpDomain . '/robots.txt'))) ? remote_file_exists($httpDomain . '/robots.txt') : "";
            $sitemap     = (!empty(remote_file_exists($httpDomain . '/sitemap.xml'))) ? remote_file_exists($httpDomain . '/sitemap.xml') : "";
            $excerpt     = (!empty(more($html))) ? more($html) : "";
            $title       = (!empty(getMeta($html, 'title'))) ? getMeta($html, 'title') : Str::slug($sourceDomain['path'], '-');
            $description = (!empty(getMeta($html, 'description'))) ? getMeta($html, 'description') : "";
            $keywords    = (!empty(getMeta($html, 'keywords'))) ? getMeta($html, 'keywords') : "";
            $metaH1      = (!empty(mb_substr_count($html, "<h1"))) ? mb_substr_count($html, "<h1") : "";
            $metaH2      = (!empty(mb_substr_count($html, "<h2"))) ? mb_substr_count($html, "<h1") : "";
            $metaH3      = (!empty(mb_substr_count($html, "<h3"))) ? mb_substr_count($html, "<h1") : "";

            $favicon      = getFavIcon($html);
            $faviconExist = @exif_imagetype($favicon);

            if (false !== $faviconExist) {
                if (strpos($http_response_header[0], "403") || strpos($http_response_header[0], "404") || strpos($http_response_header[0], "302") || strpos($http_response_header[0], "301")) {
                    $faviconName = 'noimage.png';
                } else {
                    $favicon       = file_get_contents($favicon);
                    $faviconName   = Str::slug($domain, '-') . '.png';
                    $faviconPath   = 'favicon/' . $faviconName;
                    $faviconStatus = Storage::disk('wasabi')->put($faviconPath, $favicon);
                }
            } else {
                $faviconName   = 'noimage.png';
                $faviconStatus = 2;
            }

            try {

                $base64Data = Browsershot::url($httpUrl)->base64Screenshot();
                $screenshot = base64_decode($base64Data);
            } catch (\Throwable $th) {
                throw $th;
                $screenshot = false;
            }
            if ($screenshot) {
                $thumbnail_name  = Str::slug($title, '-') . '.png';
                $thumbnailPath   = 'thumbnail/' . $thumbnail_name;
                $thumbnailStatus = Storage::disk('wasabi')->put($thumbnailPath, $screenshot);
            } else {
                $thumbnail_name  = 'noimage.png';
                $thumbnailStatus = 2;
            }
            if ($request->whois) {
                $httpDomain = 'http://' . $domain;
                $apiUrl     = config('app.url') . '/wrothmysite/core/bulkapi.php?sitelink=' . $domain;

                $jsonApi = Http::get($apiUrl);
                $code    = $jsonApi->getStatusCode();
                $jsonApi = $jsonApi->body();

                if (!($code > 400 || 'Domain name not valid!' == $jsonApi)) {
                    $jsonApi           = json_decode($jsonApi, true);
                    $jsonApi['status'] = true;
                    $jsonApi['code']   = $code;

                } else {
                    $jsonApi           = (is_array($jsonApi)) ? $jsonApi : ['result' => $jsonApi];
                    $jsonApi['status'] = false;
                    $jsonApi['code']   = $code;
                }
            }

            $pageDetail['description']     = $description;
            $pageDetail['title']           = $title;
            $pageDetail['charset']         = $charset;
            $pageDetail['robots']          = $robots;
            $pageDetail['sitemap']         = $sitemap;
            $pageDetail['excerpt']         = $excerpt;
            $pageDetail['keywords']        = $keywords;
            $pageDetail['metaH1']          = $metaH1;
            $pageDetail['metaH2']          = $metaH2;
            $pageDetail['metaH3']          = $metaH3;
            $pageDetail['faviconExist']    = $faviconExist;
            $pageDetail['thumbnail_name']  = $thumbnail_name;
            $pageDetail['faviconName']     = $faviconName;
            $pageDetail['faviconStatus']   = $faviconStatus;
            $pageDetail['thumbnailStatus'] = $thumbnailStatus;
            $pageDetail['httpUrl']         = $httpUrl;
            $pageDetail['bucket']          = $bucket;
            $pageDetail['base64Data']      = $base64Data;

            $final = array_merge($jsonApi, $pageDetail);

            return response()->json(mb_convert_encoding($final, 'UTF-8', 'UTF-8'));

        } else {
            $base64Data = Browsershot::url($httpUrl)
                ->base64Screenshot();
            return $base64Data;
        }

    }
}
