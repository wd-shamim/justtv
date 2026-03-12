<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    /**
     * Main KillerPlayer UI page
     */
    public function killer()
    {
        return view('web.youtube.killerplayer');
    }
    public function embed(Request $request)
    {
        $videoId  = $request->query('v',    '');
        $autoplay = $request->query('auto', '0');
        $loop     = $request->query('loop', '0');

        // ── Thumbnail ─────────────────────────────────────────────
        // Shown as the initial poster before the user presses play.
        // null → JS will auto-fetch the best available YouTube thumbnail.
        $thumbnail_url = 'https://miro.medium.com/v2/1*hdNDopVDEJ1gJAFHJvlsNQ.jpeg';

        // ── Pause cover ───────────────────────────────────────────
        // Separate from thumbnail. Shown when the video is paused mid-playback.
        // true  → replace frozen frame with $pauseVideoImg
        // false → show frozen video frame (no cover overlay)
        $pauseImg      = true;
        $pauseVideoImg = $pauseImg
            ? ''
            : null;

        // ── End screen ────────────────────────────────────────────
        // true  → show custom content starting $endStartSec before video ends,
        //         overlaid on top of the still-playing video.
        // false → reset to initial state 1s before end (no end cards shown).
        $endScreen      = true;
        $endStartSec    = 30;
        $endScreenVideo = 'https://cdn.pixabay.com/video/2026/02/17/335040_large.mp4';
        $endScreenImg   = 'https://images.pexels.com/photos/15221698/pexels-photo-15221698.jpeg';

        // ── Branding ──────────────────────────────────────────────
        // true  → bottom-right overlay visible only during playback.
        // false → nothing shown.
        $branding       = true;
        $branding_color = '#f4a015';
        $brandingName   = '';
        $brandingLogo   = 'https://threeva.com/web/images/threeva_logo.svg';

        return view('web.youtube.em', compact(
            'videoId', 'autoplay', 'loop',
            'thumbnail_url',
            'pauseImg', 'pauseVideoImg',
            'endScreen', 'endStartSec', 'endScreenVideo', 'endScreenImg',
            'branding', 'branding_color', 'brandingName', 'brandingLogo'
        ));
    }
}