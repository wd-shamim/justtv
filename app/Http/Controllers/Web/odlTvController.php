<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use DOMDocument;
use DOMXPath;

class TvController extends Controller
{
    public function index()
    {
        return view('web.tv.index', [
            'channels' => $this->channels,
            'channelActivities' => $this->channelActivities,
            'selectedChannel' => 'all'
        ]);
    }

    public function show($channelId)
    {
        $channel = collect($this->channels)->firstWhere('id', $channelId == 'all' ? 'all' : (int)$channelId);
        
        if (!$channel) {
            abort(404);
        }

        return view('web.tv.show', [
            'channels' => $this->channels,
            'channelActivities' => $this->channelActivities,
            'currentChannel' => $channel,
            'selectedChannel' => $channelId
        ]);
    }


    public function allchannel()
    {
        try {
            $channels = Cache::remember('all_channels', now()->addHours(1), function() {
                $response = Http::get('https://dlstreams.top/24-7-channels.php');
                
                if ($response->successful()) {
                    return $this->parseChannelsFromHtml($response->body());
                }
                return [];
            });
            
            return view('web.all_channels', compact('channels'));
            
        } catch (\Exception $e) {
            Log::error('Error fetching channels: ' . $e->getMessage());
            return view('web.all_channels', ['channels' => []]);
        }
    }
    
    private function parseChannelsFromHtml($html)
    {
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);
        
        $channels = [];
        $items = $xpath->query("//div[contains(@class, 'grid-item')]");
        
        foreach ($items as $item) {
            $linkElement = $xpath->query(".//a", $item)->item(0);
            if (!$linkElement) continue;
            
            $nameElement = $xpath->query(".//a//strong", $item)->item(0);
            
            $channels[] = [
                'name' => $nameElement ? $nameElement->nodeValue : 'Unknown Channel',
                'link' => $linkElement->getAttribute('href'),
                'full_link' => 'https://dlstreams.top' . $linkElement->getAttribute('href')
            ];
        }
        
        return $channels;
    }

    
    public function viewlive($channelId)
    {
        if (!is_numeric($channelId)) {
            abort(400, 'Invalid channel ID');
        }
    
        $channelPageUrl = "https://dlstreams.top/stream/stream-{$channelId}.php";
        $channelName = $this->getChannelName($channelId);
        $isM3u8 = false;
        $filteredContent = null;
    
        try {
            $response = Http::timeout(10)->get($channelPageUrl);
            if ($response->successful()) {
                $html = $response->body();
    
                // Parse HTML with DOMDocument
                $doc = new DOMDocument();
                @$doc->loadHTML($html); // Suppress warnings about malformed HTML
    
                // Remove ad-related elements
                $this->removeAdElements($doc);
    
                // Extract the wrapper div
                $wrapper = $doc->getElementById('wrapper');
                if ($wrapper) {
                    $filteredContent = $doc->saveHTML($wrapper);
                    // Sanitize the content to remove any remaining scripts
                    $filteredContent = $this->sanitizeContent($filteredContent);
                } else {
                    \Log::debug('Wrapper div not found in HTML');
                }
            } else {
                \Log::debug('Failed to fetch URL: ' . $response->status());
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching stream URL: ' . $e->getMessage());
        }
    
        return view('web.view_live', [
            'streamUrl' => $channelPageUrl,
            'channelName' => $channelName,
            'channelId' => $channelId,
            'isM3u8' => $isM3u8,
            'filteredContent' => $filteredContent
        ]);
    }
    
    private function removeAdElements(DOMDocument $doc)
    {
        // Remove <script> tags
        $scripts = $doc->getElementsByTagName('script');
        while ($scripts->length > 0) {
            $script = $scripts->item(0);
            $script->parentNode->removeChild($script);
        }
    
        // Remove <a> tags with external URLs
        $links = $doc->getElementsByTagName('a');
        while ($links->length > 0) {
            $link = $links->item(0);
            $href = $link->getAttribute('href');
            if ($href && !str_contains($href, 'dlstreams.top')) { // Remove non-daddylive links
                $link->parentNode->removeChild($link);
            } else {
                break; // Avoid infinite loop if no external links
            }
        }
    
        // Remove common ad-related divs (by class or ID)
        $adSelectors = [
            'div[class*="ad"]',
            'div[id*="ad"]',
            'div[class*="banner"]',
            'div[id*="banner"]',
            'div[class*="pop"]',
            'div[id*="pop"]'
        ];
        foreach ($adSelectors as $selector) {
            $xpath = new DOMXPath($doc);
            $elements = $xpath->query('//' . $selector);
            foreach ($elements as $element) {
                $element->parentNode->removeChild($element);
            }
        }
    }
    
    private function sanitizeContent($html)
    {
        // Use HTMLPurifier to sanitize the content
        if (class_exists(\HTMLPurifier::class)) {
            $config = \HTMLPurifier_Config::createDefault();
            $config->set('HTML.SafeIframe', true);
            $config->set('URI.SafeIframeRegexp', '%^https?://(daddylive\.mp|.*)%');
            $purifier = new \HTMLPurifier($config);
            return $purifier->purify($html);
        }
        return $html; // Fallback if HTMLPurifier is not installed
    }
    
    private function getChannelName($channelId)
    {
        $channelMap = [
            '51' => 'ABC USA',
            '126' => 'Example Channel',
        ];
        
        return $channelMap[$channelId] ?? "Channel {$channelId}";
    }
}
