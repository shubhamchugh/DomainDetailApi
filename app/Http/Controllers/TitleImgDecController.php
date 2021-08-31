<?php

namespace App\Http\Controllers;

use Spatie\Dns\Dns;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Image\Manipulations;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

class TitleImgDecController extends Controller
{
    public function Api(Request $request)
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

        if (true) {
            $url            = Str::slug($url, '-');
            $thumbnail_name = $url . '.png';
            $thumbnailPath  = 'scrape/thumbnail/' . $thumbnail_name;
            Storage::disk('wasabi')->put($thumbnailPath, $screenshot);
        } else {
            $thumbnail_name = 'noimage.png';
        }

        $thumbnail['imageName'] = $thumbnail_name;
        $seo                    = seoAnalyzer($httpUrl);
        $final                  = array_merge($seo, $thumbnail);

        return response()->json($final);
    }
}
