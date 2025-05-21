<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StreamProxyController extends Controller
{
    public function proxyStream($channelId)
    {
        $streamUrl = "https://thedaddy.to/embed/stream-{$channelId}.php";
        
        try {
            $response = Http::withHeaders([
                'Referer' => 'https://thedaddy.to/',
                'User-Agent' => request()->userAgent()
            ])->get($streamUrl);
            
            if ($response->successful()) {
                // Remove or modify ad-related scripts
                $content = $response->body();
                $content = preg_replace('/<script[^>]*madurird\.com[^>]*><\/script>/i', '', $content);
                
                return response($content)
                    ->header('Content-Type', 'text/html');
            }
        } catch (\Exception $e) {
            abort(500, 'Unable to fetch stream content');
        }
        
        abort(404, 'Stream not found');
    }
}
