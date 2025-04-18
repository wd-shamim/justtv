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
                            <div class="live-channel-nav-item {{ $selectedChannel === $channel['id'] ? 'active' : '' }}" 
                                wire:click="selectChannel('{{ $channel['id'] }}')">
                                <div class="live-channel-nav-icon">
                                    <img src="{{ $channel['logo'] }}" alt="{{ $channel['name'] }}" class="live-channel-nav-img">
                                </div>
                                <span class="live-channel-nav-name">{{ $channel['name'] }}</span>
                                @if($channel['is_live'])
                                    <span class="badge bg-danger ms-2">LIVE</span>
                                @endif
                            </div>
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
                    @if($selectedChannel)
                        @if($selectedChannel === 'all')
                            <div class="live-channel-activities">
                                <div class="channel-header">
                                    <img src="https://img.zuzz.tv/assets/logo.png" alt="All Channels" class="channel-logo">
                                    <h3 class="channel-title">All Channels</h3>
                                </div>
                                <div class="activities-list">
                                    @foreach($channels as $channel)
                                        @if($channel['id'] !== 'all')
                                            <div class="activity-item">
                                                <div class="channel-info mb-2">
                                                    <img src="{{ $channel['logo'] }}" alt="{{ $channel['name'] }}" class="channel-logo-sm">
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
                        @elseif(isset($channelActivities[$selectedChannel]))
                            @php
                                $currentChannel = collect($channels)->firstWhere('id', $selectedChannel);
                            @endphp
                            <div class="live-channel-activities">
                                <div class="channel-header">
                                    <img src="{{ $currentChannel['logo'] }}" alt="{{ $currentChannel['name'] }}" class="channel-logo">
                                    <h3 class="channel-title">{{ $currentChannel['name'] }}</h3>
                                </div>
                                
                                @if(!$isPlaying)
                                    <button class="btn btn-warning w-100 mb-3" wire:click="startStreaming('{{ $selectedChannel }}')" 
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove>
                                            <i class="fas fa-play me-2"></i> Watch Now
                                        </span>
                                        <span wire:loading>
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </span>
                                    </button>
                                @else
                                    <button class="btn btn-danger w-100 mb-3" wire:click="stopStreaming">
                                        <i class="fas fa-stop me-2"></i> Stop
                                    </button>
                                @endif
                                
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
                    @endif
                </div>

                <!-- Right Column: Video Player -->
                <div class="col-lg-9">
                    <div class="live-content-area">
                        @if($streamError)
                            <div class="alert alert-danger">
                                {{ $streamError }}
                                <button class="btn btn-sm btn-warning float-end" wire:click="startStreaming('{{ $selectedChannel }}')">
                                    Retry
                                </button>
                            </div>
                        @endif
                        @if($isPlaying && $selectedChannel && $selectedChannel !== 'all')
                            @php
                                $currentChannel = collect($channels)->firstWhere('id', $selectedChannel);
                            @endphp
                            @if($currentChannel)
                                <div class="live-video-container">
                                    @if($isPlaying && $selectedChannel && $selectedChannel !== 'all')
                                        <video id="my_video_1" class="video-js vjs-default-skin vjs-fluid" 
                                            controls preload="auto" playsinline webkit-playsinline>
                                            @if($isPlaying && $selectedChannel && $selectedChannel !== 'all')
                                                <source src="{{ $currentChannel['stream_link'] }}" type="application/x-mpegURL">
                                            @endif
                                        </video>
                                    @endif
                                </div>
                            @endif
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
@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        let player = null;

        function initializePlayer() {
            // Dispose existing player if any
            if (player) {
                player.dispose();
                player = null;
            }

            // Only initialize if we should be playing
            if (@this.isPlaying && @this.selectedChannel && @this.selectedChannel !== 'all') {
                player = videojs('my_video_1', {
                    fluid: true,
                    html5: {
                        hls: {
                            overrideNative: true,
                            withCredentials: false
                        }
                    },
                    autoplay: true,
                    muted: false, // Required for autoplay in most browsers
                    liveui: true
                });

                // Handle autoplay restrictions
                const playPromise = player.play();

                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.log('Autoplay prevented:', error);
                        // Show play button overlay
                        document.getElementById('playOverlay').style.display = 'flex';
                    });
                }
            }
        }

        // Initialize when stream starts
        Livewire.on('streamStarted', () => {
            setTimeout(initializePlayer, 100);
        });

        // Clean up when stream stops
        Livewire.on('streamStopped', () => {
            if (player) {
                player.dispose();
                player = null;
            }
        });

        // Initialize on page load if needed
        initializePlayer();

        // Reinitialize when Livewire updates the DOM
        Livewire.hook('message.processed', () => {
            if (@this.isPlaying) {
                setTimeout(initializePlayer, 100);
            }
        });
    });
</script>
@endpush


