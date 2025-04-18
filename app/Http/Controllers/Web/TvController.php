<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TvController extends Controller
{
    public $channels = [
        [
            'id' => 'all',
            'name' => 'All Channels',
            'logo' => 'https://img.zuzz.tv/assets/logo.png',
            'is_live' => false,
            'stream_link' => ''
        ],
        [
            'id' => 1,
            'name' => 'CNBC',
            'logo' => 'https://img.zuzz.tv/assets/channels/QbrydM96AcVpeUjROcy5LjHEEaPmbmfIfaPJ7YGshkb2m2ub2f.png',
            'is_live' => true,
            'stream_link' => 'https://v1.thetvapp.to/hls/FoxBusiness/index.m3u8'
        ],
        [
            'id' => 2,
            'name' => 'MLB Network',
            'logo' => 'https://upload.wikimedia.org/wikipedia/en/thumb/a/ac/MLBNetworkLogo.svg/250px-MLBNetworkLogo.svg.png',
            'is_live' => true,
            'stream_link' => 'https://ddy6new.newkso.ru/ddy6/premium356/mono.m3u8'
        ]
    ];

    public $channelActivities = [
        1 => [
            [
                'title' => 'Market Watch',
                'time' => '14:00',
                'date' => '2024-04-12'
            ],
            [
                'title' => 'Squawk Box',
                'time' => '15:30',
                'date' => '2024-04-12'
            ]
        ],
        2 => [
            [
                'title' => 'Fox Business Today',
                'time' => '13:00',
                'date' => '2024-04-12'
            ],
            [
                'title' => 'Market Report',
                'time' => '16:00',
                'date' => '2024-04-12'
            ]
        ]
    ];

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
}
