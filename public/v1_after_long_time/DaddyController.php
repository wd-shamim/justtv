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
        
        // Generate the clean URL
        $streamUrl = "https://dlstreams.top/embed/stream-" . htmlspecialchars($channelId, ENT_QUOTES, 'UTF-8') . ".php";

        return view('web.view_live', [
            'channelName' => $channelName,
            'channelId' => $channelId,
            'streamUrl' => $streamUrl
        ]);
    }

    private function getChannelName($channelId)
    {
        $channelMap = [
            '51' => 'ABC USA',
            '95' => 'Example Channel',
        ];
        
        return $channelMap[$channelId] ?? "Channel {$channelId}";
    }
}