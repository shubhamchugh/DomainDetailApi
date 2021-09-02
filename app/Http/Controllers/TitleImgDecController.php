<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use Spatie\Dns\Dns;
use Spatie\Image\Manipulations;

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

        if (!$screenshot) {
            $url            = Str::slug($url, '-');
            $thumbnail_name = $url . '.png';
            $thumbnailPath  = '/' . $thumbnail_name;
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
