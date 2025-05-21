<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IframeController extends Controller
{
    public function stream($channelId)
    {
        if (!is_numeric($channelId)) {
            abort(400, 'Invalid channel ID');
        }

        // You can fetch the actual stream content from the external source here
        $streamUrl = "https://thedaddy.to/embed/stream-{$channelId}.php";
        
        // Option 1: Proxy the content
        $response = Http::get($streamUrl);
        
        // Option 2: Redirect to the actual stream
        // return redirect($streamUrl);
        dd($response);
        
        // For Option 1:
        return response($response->body())
            ->header('Content-Type', $response->header('Content-Type'));
    }
}