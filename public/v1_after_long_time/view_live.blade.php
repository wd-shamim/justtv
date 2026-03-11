@extends('web.layout.master')

@section('content')
<div class="container-fluid mt-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card mt-5 pt-5">
                <div class="card-header">
                    <h4>Now Playing: {{ $channelName }}</h4>
                </div>
                <div class="card-body p-0 bg-black">
                    
                    <div class="iframe-container" id="video-wrapper">
                        
                        <!-- ==================================================
                             THE MAGIC IFRAME 
                             1. referrerpolicy="no-referrer": Blocks ad servers from knowing where the user came from, often causing them to fail loading ads.
                             2. NO sandbox: Allows the video to play freely.
                             ================================================== -->
                        <iframe 
                            src="{{ $streamUrl }}"
                            id="stream-player"
                            frameborder="0"
                            allowfullscreen
                            scrolling="no"
                            allow="autoplay; encrypted-media; fullscreen; picture-in-picture"
                            referrerpolicy="no-referrer"
                        ></iframe>

                        <!-- CLICK SHIELD (To unmute/block initial ad clicks) -->
                        <!-- This sits ON TOP. It catches the first click to unmute, 
                             preventing the ad "button" from ever being clicked. -->
                        <div class="click-shield" id="click-shield">
                            <span class="play-icon">▶</span>
                        </div>
                    </div>

                    <!-- Custom Controls -->
                    <div class="custom-controls d-flex align-items-center p-2 bg-dark text-white">
                        <button id="btn-unmute" class="btn btn-sm btn-outline-light me-2" title="Unmute / Mute">
                            <i class="bi bi-volume-mute-fill"></i> Unmute
                        </button>
                        <input type="range" id="volume-slider" class="form-range me-3" min="0" max="1" step="0.1" value="1" style="width: 100px;">
                        
                        <button id="btn-fullscreen" class="btn btn-sm btn-outline-light ms-auto" title="Fullscreen">
                            <i class="bi bi-fullscreen"></i> Fullscreen
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Container */
    .iframe-container {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* 16:9 */
        background: #000;
        overflow: hidden;
    }

    /* Iframe */
    .iframe-container iframe#stream-player {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
        z-index: 1;
    }

    /* Click Shield */
    .click-shield {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10; 
        background: rgba(0,0,0,0.4); 
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.3s;
    }

    .play-icon {
        font-size: 4rem;
        color: white;
        opacity: 0.8;
    }
    
    .hidden { display: none !important; }

    /* Custom Controls */
    .custom-controls { border-top: 1px solid #333; }
</style>
@endpush

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.getElementById('video-wrapper');
    const shield = document.getElementById('click-shield');
    const btnUnmute = document.getElementById('btn-unmute');
    const btnFullscreen = document.getElementById('btn-fullscreen');
    const volumeSlider = document.getElementById('volume-slider');
    const iframe = document.getElementById('stream-player');

    // -------------------------------------------------------
    // 1. POPUP BLOCKER
    // -------------------------------------------------------
    // Prevent the page from opening new tabs (Popunder/Ads)
    window.open = function(url, target, features) {
        console.log("Blocked a popup attempt to: " + url);
        return null; // Block the window
    };

    if (shield) {
        shield.addEventListener('click', function() {
            hideShield();
            tryUnmutePlayer();
        });
    }

    function hideShield() {
        if (shield) shield.classList.add('hidden');
    }

    window.tryUnmutePlayer = function() {
        if (!iframe) return;

        // Try to unmute via JavaScript access
        try {
            const innerDoc = iframe.contentDocument || iframe.contentWindow.document;
            const videos = innerDoc.getElementsByTagName('video');
            if (videos.length > 0) {
                videos[0].muted = false;
                videos[0].volume = volumeSlider ? volumeSlider.value : 1;
                videos[0].play().catch(e => console.log("Play blocked", e));
                updateMuteButton(false);
            }
        } catch (e) {
            // Cross-origin fallback
            console.warn("Cross-origin restriction on mute. Sending postMessage.");
            iframe.contentWindow.postMessage({ type: 'unmute', muted: false }, '*');
            updateMuteButton(false);
        }
    };

    function updateMuteButton(isMuted) {
        if(btnUnmute) {
            btnUnmute.innerHTML = isMuted 
                ? '<i class="bi bi-volume-mute-fill"></i> Unmute' 
                : '<i class="bi bi-volume-up-fill"></i> Mute';
        }
    }

    // -------------------------------------------------------
    // 3. MANUAL CONTROLS
    // -------------------------------------------------------
    
    if (btnUnmute) {
        btnUnmute.addEventListener('click', function() {
            window.tryUnmutePlayer();
        });
    }

    if (volumeSlider) {
        volumeSlider.addEventListener('input', function() {
            try {
                const innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                const videos = innerDoc.getElementsByTagName('video');
                if (videos.length > 0) videos[0].volume = this.value;
            } catch (e) {
                iframe.contentWindow.postMessage({ type: 'volume', volume: this.value }, '*');
            }
        });
    }

    if (btnFullscreen) {
        btnFullscreen.addEventListener('click', function() {
            // Fullscreen the wrapper to include our controls
            const elem = wrapper;
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            }
        });
    }
});
</script>
@endpush