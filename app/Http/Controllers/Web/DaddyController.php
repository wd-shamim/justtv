<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaddyController extends Controller
{
    private array $channelMap = [
        '51'  => 'ABC USA',
        '95'  => 'Example Channel',
    ];

    public function viewlive($channelId)
    {
        if (!is_numeric($channelId)) {
            abort(400, 'Invalid channel ID');
        }

        $channelName = $this->channelMap[$channelId] ?? "Channel {$channelId}";

        return view('web.dad.killerplayer', compact('channelName', 'channelId'));
    }

    public function embed(Request $request)
    {
        $channelId   = 51;
        $channelName = $request->query('name', $channelId ? "Channel {$channelId}" : 'Live TV');

        // ── Branding ──────────────────────────────────────────────
        // true  → bottom-right overlay visible only during playback.
        $branding       = true;
        $branding_color = '#f4a015';
        $brandingName   = 'Bego Star';
        $brandingLogo   = 'https://threeva.com/web/images/threeva_logo.svg';

        // ── Thumbnail / Poster ────────────────────────────────────
        // Shown before the stream loads. null = black.
        $thumbnail_url = null;

        return view('web.dad.em', compact(
            'channelId', 'channelName',
            'thumbnail_url',
            'branding', 'branding_color', 'brandingName', 'brandingLogo'
        ));
    }
}