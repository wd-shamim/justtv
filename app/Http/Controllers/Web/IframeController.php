<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IframeController extends Controller
{
    public function embed($channelId)
    {
        if (!is_numeric($channelId)) {
            abort(400, 'Invalid channel ID');
        }

        return view('web.iframe.embed', [
            'channelId' => $channelId,
            'iframeUrl' => route('player', ['channelId' => $channelId])
        ]);
    }

    public function player($channelId)
    {
        if (!is_numeric($channelId)) {
            abort(400, 'Invalid channel ID');
        }

        return view('web.iframe.player', [
            'channelId' => $channelId,
            'premiumId' => "premium{$channelId}"
        ]);
    }
}
