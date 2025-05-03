<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DaddyController extends Controller
{
    public function viewlive($channelId)
    {
        if (!is_numeric($channelId)) {
            abort(400, 'Invalid channel ID');
        }

        // Try to get clean stream URL first
        $cleanStream = $this->getCleanStreamUrl($channelId);
        
        if ($cleanStream) {
            return view('web.view_live', [
                'streamUrl' => $cleanStream,
                'channelName' => $this->getChannelName($channelId),
                'channelId' => $channelId
            ]);
        }

        // If clean stream fails, use ad-blocked iframe method
        return view('web.view_live', [
            'channelId' => $channelId,
            'channelName' => $this->getChannelName($channelId),
            'useIframe' => true
        ]);
    }

    private function getCleanStreamUrl($channelId)
    {
        return Cache::remember("clean_stream_{$channelId}", 300, function() use ($channelId) {
            try {
                $response = Http::withHeaders([
                    'Referer' => 'https://thedaddy.to/',
                    'Origin' => 'https://thedaddy.to'
                ])->get("https://api.example.com/stream-source", [
                    'channel' => $channelId
                ]);

                return $response->successful() ? $response->json()['stream_url'] : null;
            } catch (\Exception $e) {
                return null;
            }
        });
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