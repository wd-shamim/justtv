<?php
namespace App\Livewire;

use Livewire\Component;

class ChannelManager extends Component
{
    public $selectedChannel = null;
    public $isPlaying = false;
    public $isLoading = false;
    public $streamError = null;
    
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
        ],
        [
            'id' => 3,
            'name' => 'ESPN',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/ESPN_Logo.svg/250px-ESPN_Logo.svg.png',
            'is_live' => true,
            'stream_link' => 'https://example.com/hls/ESPN/index.m3u8'
        ],
        [
            'id' => 4,
            'name' => 'CNN',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/CNN.svg/250px-CNN.svg.png',
            'is_live' => true,
            'stream_link' => 'https://example.com/hls/CNN/index.m3u8'
        ],
        [
            'id' => 5,
            'name' => 'HBO',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/HBO_logo.svg/250px-HBO_logo.svg.png',
            'is_live' => false,
            'stream_link' => 'https://example.com/hls/HBO/index.m3u8'
        ],
        [
            'id' => 6,
            'name' => 'National Geographic',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/National_Geographic_logo.svg/250px-National_Geographic_logo.svg.png',
            'is_live' => true,
            'stream_link' => 'https://example.com/hls/NatGeo/index.m3u8'
        ],
        [
            'id' => 7,
            'name' => 'Discovery Channel',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Discovery_Channel_logo.svg/250px-Discovery_Channel_logo.svg.png',
            'is_live' => true,
            'stream_link' => 'https://example.com/hls/Discovery/index.m3u8'
        ],
        [
            'id' => 8,
            'name' => 'Nickelodeon',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Nickelodeon_logo.svg/250px-Nickelodeon_logo.svg.png',
            'is_live' => true,
            'stream_link' => 'https://example.com/hls/Nickelodeon/index.m3u8'
        ],
        [
            'id' => 9,
            'name' => 'BBC News',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/62/BBC_News_2019.svg/250px-BBC_News_2019.svg.png',
            'is_live' => true,
            'stream_link' => 'https://example.com/hls/BBCNews/index.m3u8'
        ],
        [
            'id' => 10,
            'name' => 'MTV',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/MTV_Logo.svg/250px-MTV_Logo.svg.png',
            'is_live' => true,
            'stream_link' => 'https://example.com/hls/MTV/index.m3u8'
        ],
        [
            'id' => 11,
            'name' => 'TNT',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/TNT_Logo_2016.svg/250px-TNT_Logo_2016.svg.png',
            'is_live' => true,
            'stream_link' => 'https://example.com/hls/TNT/index.m3u8'
        ],
        [
            'id' => 12,
            'name' => 'Food Network',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Food_Network_logo.svg/250px-Food_Network_logo.svg.png',
            'is_live' => true,
            'stream_link' => 'https://example.com/hls/FoodNetwork/index.m3u8'
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
        ],
        3 => [
            [
                'title' => 'NBA Highlights',
                'time' => '18:00',
                'date' => '2025-04-18'
            ],
            [
                'title' => 'SportsCenter',
                'time' => '20:00',
                'date' => '2025-04-18'
            ]
        ],
        4 => [
            [
                'title' => 'World News Tonight',
                'time' => '17:00',
                'date' => '2025-04-18'
            ],
            [
                'title' => 'The Situation Room',
                'time' => '19:00',
                'date' => '2025-04-18'
            ]
        ],
        5 => [
            [
                'title' => 'Movie Premiere: The Last Kingdom',
                'time' => '21:00',
                'date' => '2025-04-18'
            ],
            [
                'title' => 'HBO Documentary',
                'time' => '23:00',
                'date' => '2025-04-18'
            ]
        ],
        6 => [
            [
                'title' => 'Wildlife of Africa',
                'time' => '16:00',
                'date' => '2025-04-18'
            ],
            [
                'title' => 'Cosmos Exploration',
                'time' => '18:30',
                'date' => '2025-04-18'
            ]
        ],
        7 => [
            [
                'title' => 'Shark Week Preview',
                'time' => '19:00',
                'date' => '2025-04-18'
            ],
            [
                'title' => 'MythBusters',
                'time' => '20:30',
                'date' => '2025-04-18'
            ]
        ],
        8 => [
            [
                'title' => 'SpongeBob Marathon',
                'time' => '14:00',
                'date' => '2025-04-18'
            ],
            [
                'title' => 'PAW Patrol',
                'time' => '16:00',
                'date' => '2025-04-18'
            ]
        ],
        9 => [
            [
                'title' => 'Global News Update',
                'time' => '15:00',
                'date' => '2025-04-18'
            ],
            [
                'title' => 'BBC Panorama',
                'time' => '17:30',
                'date' => '2025-04-18'
            ]
        ],
        10 => [
            [
                'title' => 'MTV Music Awards Recap',
                'time' => '20:00',
                'date' => '2025-04-18'
            ],
            [
                'title' => 'Reality Show Premiere',
                'time' => '22:00',
                'date' => '2025-04-18'
            ]
        ],
        11 => [
            [
                'title' => 'NBA Playoffs',
                'time' => '19:00',
                'date' => '2025-04-18'
            ],
            [
                'title' => 'Action Movie Night',
                'time' => '21:30',
                'date' => '2025-04-18'
            ]
        ],
        12 => [
            [
                'title' => 'Chopped',
                'time' => '18:00',
                'date' => '2025-04-18'
            ],
            [
                'title' => 'Diners, Drive-Ins and Dives',
                'time' => '19:30',
                'date' => '2025-04-18'
            ]
        ]
    ];

    public function mount()
    {
        // Set default channel if none selected
        if (is_null($this->selectedChannel)) {
            $this->selectedChannel = 'all';
        }
    }

    public function selectChannel($channelId)
    {
        $this->selectedChannel = $channelId;
        $this->isPlaying = false;
        $this->streamError = null;
        
        // Dispatch event to reset player
        $this->dispatch('streamStopped');
    }

    public function startStreaming($channelId)
    {
        $this->isLoading = true;
        $this->streamError = null;
        $this->isPlaying = false;
    
        try {
            if ($channelId === 'all') {
                throw new \Exception("Please select a specific channel to stream.");
            }
    
            $channel = collect($this->channels)->firstWhere('id', $channelId);
    
            if (!$channel) {
                throw new \Exception("Channel not found.");
            }
    
            if (empty($channel['stream_link'])) {
                throw new \Exception("Stream link not available for this channel.");
            }
    
            $this->selectedChannel = $channelId;
            $this->isPlaying = true;
            
            $this->dispatch('streamStarted');
    
        } catch (\Exception $e) {
            $this->streamError = $e->getMessage();
            $this->isPlaying = false;
        } finally {
            $this->isLoading = false;
        }
    }
    
    private function checkStreamAvailability($url)
    {
        $headers = @get_headers($url);
        return $headers && strpos($headers[0], '200') !== false;
    }

    public function stopStreaming()
    {
        $this->isPlaying = false;
        $this->dispatch('streamStopped');
    }

    public function render()
    {
        return view('livewire.channel-manager');
    }
}