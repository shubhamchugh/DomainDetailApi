<?php

namespace App\Http\Controllers;

use Spatie\Dns\Dns;
use Illuminate\Http\Request;
use Spatie\Image\Manipulations;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;
use Spatie\SslCertificate\SslCertificate;
use Stevebauman\Location\Facades\Location;

class ApiForSitesLikeTFController extends Controller
{
    public function api(Request $request)
    {

        $bucket  = $request->bucket;
        $httpUrl = trim($request->url);
        $url     = remove_http($httpUrl);
        $dns     = new Dns($httpUrl);

        try {
            $screenshot = Browsershot::url($httpUrl)->ignoreHttpsErrors()->fit(Manipulations::FIT_CONTAIN, 460, 306)->screenshot();
        } catch (\Throwable $th) {
            //throw $th;
            $screenshot = false;
        }

        if ($screenshot) {
            $thumbnail_name = $url . '.png';
            $thumbnailPath  = 'scrape/thumbnail/' . $thumbnail_name;
            Storage::disk('wasabi')->put($thumbnailPath, $screenshot);
        } else {
            $thumbnail_name = 'noimage.png';
        }

        $alexaRank      = alexa_rank($httpUrl);
        $record['dns']  = $dns->getRecords(); // returns all available dns records
        $seo            = seoAnalyzer($httpUrl);
        $builtWith      = builtWith($httpUrl);
        $sslCertificate = sslCertificate($httpUrl);
        $location       = json_decode(json_encode(Location::get(gethostbyname($url))), true);
        $final          = array_merge($alexaRank, $record, $seo, $builtWith, $sslCertificate, $location);
        return response()->json($final);
    }
}
