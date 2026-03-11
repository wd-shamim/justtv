<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class YoutubeController extends Controller
{
    /**
     * Main KillerPlayer UI page
     */
    public function killer()
    {
        return view('web.youtube.killerplayer');
    }

    /**
     * Inner embed page — this is what wraps YouTube.
     * Sets correct origin & referrer so Error 152/153 is avoided.
     */
    public function embed(Request $request)
    {
        $videoId  = $request->query('v',    '');
        $autoplay = $request->query('auto', '0');
        $loop     = $request->query('loop', '0');

        // $autoplay = '0';
        // $loop     = '1';

       Log::info("Embedding video: $videoId, autoplay: $autoplay, loop: $loop");

        return view('web.youtube.em', compact('videoId', 'autoplay', 'loop'));
    }
}
