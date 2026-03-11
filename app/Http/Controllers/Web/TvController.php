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
    public function allchannel()
    {
        try {
            $channels = Cache::remember('all_channels', now()->addHours(1), function() {
                
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                    'Accept'     => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                ])->get('https://dlstreams.top/24-7-channels.php');

                if ($response->successful()) {
                    return $this->parseChannelsFromHtml($response->body());
                }
                
                // Log error if it fails in the future
                Log::error('Channel Fetch Failed', ['status' => $response->status()]);
                return [];
            });
            // dd($channels); // DEBUGGING: Check the structure of channels before passing to view
            // No more dd() here, just pass data to view
            return view('web.all_channels', compact('channels'));
                
        } catch (\Exception $e) {
            Log::error('Error fetching channels: ' . $e->getMessage());
            return view('web.all_channels', ['channels' => []]);
        }
    }
    
    private function parseChannelsFromHtml($html)
    {
        libxml_use_internal_errors(true);
        
        $dom = new DOMDocument();
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $channels = [];
        
        // RECHECKED QUERY: Matches the HTML structure provided
        $items = $xpath->query("//div[contains(@class, 'grid')]//a[contains(@class, 'card')]");

        // DEBUGGING: Log if no items found
        if ($items->length === 0) {
             Log::warning('Parser found 0 items. HTML structure might have changed or content is empty.');
        }

        foreach ($items as $item) {
            $link = $item->getAttribute('href');
            
            $title = $item->getAttribute('data-title');
            if (empty($title)) {
                $titleNode = $xpath->query(".//div[contains(@class, 'card__title')]", $item)->item(0);
                $title = $titleNode ? trim($titleNode->nodeValue) : 'Unknown Channel';
            }

            $id = null;
            $query = parse_url($link, PHP_URL_QUERY);
            if ($query) {
                parse_str($query, $params);
                $id = $params['id'] ?? null;
            }

            $channels[] = [
                'id'        => $id,
                'name'      => ucwords($title),
                'link'      => $link,
                'full_link' => 'https://dlstreams.top' . $link
            ];
        }
        
        return $channels;
    }
}