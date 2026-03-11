<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DaddyController extends Controller
{
    public function viewlive($channelId)
    {
        if (!is_numeric($channelId)) {
            abort(400, 'Invalid channel ID');
        }

        $channelName = $this->getChannelName($channelId);

        return view('web.view_live', [
            'channelName' => $channelName,
            'channelId' => $channelId
        ]);
    }

    public function proxyStream($channelId)
    {
        $safeId = htmlspecialchars($channelId, ENT_QUOTES, 'UTF-8');
        
        // Sources to try
        $sources = [
            "https://dlstreams.top/embed/stream-{$safeId}.php",
            "https://widestream.io/embed/stream-{$safeId}.php",
        ];

        // Rotate User Agents to bypass simple bot detection
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0'
        ];

        $html = null;
        $effectiveUrl = null;

        foreach ($sources as $url) {
            try {
                $response = Http::timeout(10)
                    ->withHeaders([
                        'User-Agent' => $userAgents[array_rand($userAgents)],
                        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                        'Accept-Language' => 'en-US,en;q=0.5',
                        'Referer' => 'https://www.google.com/'
                    ])
                    ->get($url);

                if ($response->successful()) {
                    $content = $response->body();
                    
                    // Check for nested iframe
                    if (preg_match('/<iframe[^>]+src="(https?:\/\/[^"]*daddyhd\.php[^"]*)"/i', $content, $matches)) {
                        $nestedUrl = $matches[1];
                        
                        $nestedResponse = Http::timeout(10)
                            ->withHeaders([
                                'User-Agent' => $userAgents[array_rand($userAgents)],
                                'Referer' => $url 
                            ])
                            ->get($nestedUrl);

                        if ($nestedResponse->successful()) {
                            $html = $nestedResponse->body();
                            $effectiveUrl = $nestedUrl;
                            break;
                        }
                    } else {
                        // No nested iframe, use main content
                        $html = $content;
                        $effectiveUrl = $url;
                        break;
                    }
                }
            } catch (\Exception $e) {
                // Log error if needed: \Log::error($e->getMessage());
                continue;
            }
        }

        // If no HTML fetched, return a valid HTML error page (Not 404 header)
        if (!$html) {
            return response('<!DOCTYPE html><html><body style="background:#000;color:white;text-align:center;padding-top:20vh;"><h1>Stream Offline</h1><p>Server cannot connect to source. Try refreshing.</p></body></html>', 200);
        }

        // Minimal Cleaning (Remove Link tags that cause connection errors)
        $html = preg_replace('/<link[^>]*?>/i', '', $html);

        return response($html)
            ->header('Content-Type', 'text/html; charset=utf-8')
            ->header('Cache-Control', 'no-store, no-cache');
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