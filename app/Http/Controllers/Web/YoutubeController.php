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

    /**
     * Inner embed — wraps YouTube with the full custom KillerPlayer.
     *
     * Variables passed to Blade:
     * ──────────────────────────────────────────────────────────────
     * $videoId        string   YouTube video ID
     * $autoplay       string   '0' | '1'
     * $loop           string   '0' | '1'
     *
     * $thumbnail_url  string|null   Custom thumbnail shown on initial load.
     *                               null → auto-load best YouTube thumbnail.
     *
     * $pauseImg       bool          Show a custom image when paused?
     * $pauseVideoImg  string|null   URL of custom pause image.
     *                               null/false → show frozen video frame on pause.
     *                               NOTE: pauseVideoImg and thumbnail_url are
     *                               independent — thumbnail is the initial poster,
     *                               pauseVideoImg replaces the frame while paused.
     *
     * $endScreen      bool          Show custom end screen before video ends?
     * $endStartSec    int           Seconds before end to start showing end screen.
     * $endScreenVideo string|null   MP4 URL (first priority over image).
     * $endScreenImg   string|null   Fallback image URL.
     *                               false/$endScreen=false → reset to initial at 1s.
     *
     * $branding       bool          Show branding overlay during playback?
     * $branding_color string        CSS color for branding text (e.g. '#f4a015').
     * $brandingName   string        Brand name text.
     * $brandingLogo   string|null   Logo image URL (shown alongside name).
     */
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
        $brandingName   = 'Bego Star';
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