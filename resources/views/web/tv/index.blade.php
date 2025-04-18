@extends('web.layout.master')
@section('content')
<div class="channel-manager-container">
    <!-- Channel Navigation Section -->
    <section class="live-channel-nav">
        <div class="container">
            <div class="live-channel-nav-wrapper">
                <button class="live-channel-nav-arrow-btn left-arrow" aria-label="Scroll left">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="live-channel-scroll-container">
                    <div class="live-channel-scroll-items">
                        @foreach($channels as $channel)
                            <a href="{{ route('tv.show', $channel['id']) }}" 
                               class="live-channel-nav-item {{ $selectedChannel == $channel['id'] ? 'active' : '' }}">
                                <div class="live-channel-nav-icon">
                                    <img src="{{ $channel['logo'] }}" 
                                         alt="{{ $channel['name'] }}" 
                                         class="live-channel-nav-img">
                                </div>
                                <span class="live-channel-nav-name">{{ $channel['name'] }}</span>
                                @if($channel['is_live'])
                                    <span class="badge bg-danger ms-2">LIVE</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
                <button class="live-channel-nav-arrow-btn right-arrow" aria-label="Scroll right">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="live-main">
        <div class="container">
            <div class="row g-4">
                <!-- Left Column: Channel Activities -->
                <div class="col-lg-3">
                    @if($selectedChannel === 'all')
                        <div class="live-channel-activities">
                            <div class="channel-header">
                                <img src="https://img.zuzz.tv/assets/logo.png" 
                                     alt="All Channels"
                                     class="channel-logo">
                                <h3 class="channel-title">All Channels</h3>
                            </div>
                            <div class="activities-list">
                                @foreach($channels as $channel)
                                    @if($channel['id'] !== 'all')
                                        <div class="activity-item">
                                            <div class="channel-info mb-2">
                                                <img src="{{ $channel['logo'] }}"
                                                     alt="{{ $channel['name'] }}"
                                                     class="channel-logo-sm">
                                                <h4 class="channel-title-sm">{{ $channel['name'] }}</h4>
                                                @if($channel['is_live'])
                                                    <span class="badge bg-danger ms-2">LIVE</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="live-channel-activities">
                            <div class="channel-header">
                                <img src="{{ $currentChannel['logo'] }}"
                                     alt="{{ $currentChannel['name'] }}"
                                     class="channel-logo">
                                <h3 class="channel-title">{{ $currentChannel['name'] }}</h3>
                            </div>
                            
                            <div class="activities-list">
                                @foreach($channelActivities[$selectedChannel] as $activity)
                                    <div class="activity-item">
                                        <div class="activity-time">
                                            {{ date('H:i', strtotime($activity['time'])) }}
                                        </div>
                                        <div class="activity-details">
                                            <h4>{{ $activity['title'] }}</h4>
                                            <p>{{ date('l d F', strtotime($activity['date'])) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Video Player -->
                <div class="col-lg-9">
                    <div class="live-content-area">
                        @if($selectedChannel !== 'all')
                            <div class="live-video-container">
                                <video id="channelPlayer" class="video-js vjs-fluid vjs-default-skin w-100" 
                                       controls preload="auto" playsinline>
                                    <source src="{{ $currentChannel['stream_link'] }}" 
                                            type="application/x-mpegURL">
                                </video>
                                <!-- Fallback overlay for when autoplay is blocked -->
                                <div id="playOverlay" class="play-overlay" style="display: none;">
                                    <div class="play-button">▶</div>
                                </div>
                            </div>
                        @else
                            <div class="placeholder-container d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <i class="fas fa-tv fa-5x text-muted mb-3"></i>
                                    <h3>Select a channel to start streaming</h3>
                                    <p class="text-muted">Choose from the available channels on the left</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    .placeholder-container {
        height: 400px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    
    .live-video-container {
        background-color: #000;
        position: relative;
    }
    
    /* Style for the play overlay */
    .play-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10;
        cursor: pointer;
    }

    .play-button {
        font-size: 50px;
        color: white;
        padding: 20px 40px;
        border: 3px solid white;
        border-radius: 50%;
    }
</style>
@endpush

@push('scripts')
<!-- Video.js and HTTP Streaming (VHS) plugin -->
<script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
<script src="https://unpkg.com/@videojs/http-streaming@2.13.0/dist/videojs-http-streaming.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Only initialize if we have a player element
    const videoEl = document.getElementById('channelPlayer');
    if (!videoEl) return;
    
    // Initialize the player
    const player = videojs('channelPlayer', {
        html5: {
            vhs: {
                overrideNative: true,
                enableLowInitialPlaylist: true,
                smoothQualityChange: true
            }
        },
        autoplay: true,
        controls: true,
        liveui: true
    });
    
    // Try to autoplay (muted first to increase chances)
    player.muted(true);
    
    const playPromise = player.play();
    
    // Handle autoplay success/failure
    if (playPromise !== undefined) {
        playPromise.then(() => {
            // Autoplay worked! Now try to unmute
            player.muted(false).catch(e => {
                console.log("Couldn't unmute:", e);
            });
        }).catch(error => {
            // Autoplay was prevented
            console.log("Autoplay prevented:", error);
            showPlayOverlay();
        });
    }
    
    // Show the play overlay when autoplay fails
    function showPlayOverlay() {
        const overlay = document.getElementById('playOverlay');
        if (!overlay) return;
        
        overlay.style.display = 'flex';
        
        // Click handler for the overlay
        overlay.addEventListener('click', () => {
            player.play().then(() => {
                overlay.style.display = 'none';
                player.muted(false).catch(e => {
                    console.log("Couldn't unmute:", e);
                });
            }).catch(e => {
                console.log("Still can't play:", e);
            });
        }, { once: true });
    }
    
    // Error handling
    player.on('error', () => {
        const error = player.error();
        console.error('VideoJS Error:', error);
    });
});
</script>
@endpush