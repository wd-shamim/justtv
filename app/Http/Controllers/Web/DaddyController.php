<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaddyController extends Controller
{
    public function viewlive($channelId)
    {
        if (!is_numeric($channelId)) {
            abort(400, 'Invalid channel ID');
        }

        $channelName = $this->getChannelName($channelId);
        $embedContent = $this->generateIframe($channelId);

        return view('web.view_live', [
            'channelName' => $channelName,
            'channelId' => $channelId,
            'embedContent' => $embedContent
        ]);
    }

    private function generateIframe($channelId)
    {
        // Security: Sanitize the ID just in case, though the route check helps
        $safeId = htmlspecialchars($channelId, ENT_QUOTES, 'UTF-8');

        // We return a clean HTML string.
        // 1. The Shield has an onclick to unmute the video.
        // 2. We do NOT add 'sandbox' attributes here, as they often block video playback from external providers.
        return '
        <div class="iframe-container" id="video-wrapper">
            <!-- The Video Iframe -->
            <iframe 
                src="https://dlstreams.top/embed/stream-'.$safeId.'.php"
                id="stream-player"
                frameborder="0"
                allowfullscreen
                scrolling="no"
                allow="autoplay; encrypted-media; fullscreen; picture-in-picture">
            </iframe>

            <!-- Click Shield: Blocks Ad Clicks AND triggers unmute on click -->
            <div class="click-shield" id="click-shield" onclick="tryUnmutePlayer()" style="cursor:pointer;"></div>
        </div>';
    }

    private function getChannelName($channelId)
    {
        $channelMap = [
            '51' => 'ABC USA',
            '95' => 'Example Channel',
        ];
        
        // Security: Ensure the name is safe to output
        $name = $channelMap[$channelId] ?? "Channel {$channelId}";
        return htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    }
}