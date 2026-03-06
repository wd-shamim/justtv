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
                    
                    <!-- Video Area -->
                    @if(!empty($embedContent))
                        <div class="iframe-container" id="video-wrapper">
                            <!-- Click Shield (Blocks Ads) -->
                            
                            
                            <!-- Video Content -->
                            {!! $embedContent !!}
                        </div>
                    @else
                        <div class="alert alert-danger">Could not load stream content.</div>
                    @endif

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
    /* 1. Container Setup */
    .iframe-container {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
        background: #000;
        overflow: hidden;
    }

    /* 2. Iframe Styling */
    .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
        z-index: 1;
    }

    /* 3. The Click Shield */
    .iframe-container .click-shield {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10; 
        background: transparent;
        cursor: pointer;
        pointer-events: auto;
    }

    /* 4. Custom Control Bar */
    .custom-controls {
        border-top: 1px solid #333;
    }
    
    /* 5. SECURITY: Block specific ad elements ONLY */
    /* We hide injected divs/scripts/ifs that contain 'ad', 'pop', 'banner' etc */
    .iframe-container > script,
    .iframe-container > img,
    .iframe-container > iframe[src*="ad"],
    .iframe-container > iframe[src*="pop"],
    .iframe-container > iframe[src*="banner"],
    .iframe-container > div[id*="ad"],
    .iframe-container > div[class*="ad"],
    .iframe-container > div[class*="pop"],
    .iframe-container > div[class*="banner"] {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        z-index: -1 !important;
        pointer-events: none !important;
        height: 0 !important;
        width: 0 !important;
        overflow: hidden !important;
    }
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
    // 1. GLOBAL UNMUTE FUNCTION (Called by Controller's Shield)
    // -------------------------------------------------------
    window.tryUnmutePlayer = function() {
        if (!iframe) return;

        // Try to access the video inside the iframe
        try {
            const innerDoc = iframe.contentDocument || iframe.contentWindow.document;
            const videos = innerDoc.getElementsByTagName('video');
            
            if (videos.length > 0) {
                const video = videos[0];
                video.muted = false;
                video.volume = volumeSlider ? volumeSlider.value : 1;
                video.play().catch(e => console.log("Autoplay blocked", e));
                
                // Update button icon
                if(btnUnmute) btnUnmute.innerHTML = '<i class="bi bi-volume-up-fill"></i> Mute';
                
                // Hide the shield permanently after first successful interaction
                if(shield) shield.style.display = 'none';
            }
        } catch (e) {
            // Cross-Origin Blocked
            console.warn("Cross-origin mute blocked. Trying postMessage.");
            
            // Fallback: Send postMessage
            iframe.contentWindow.postMessage({ type: 'unmute', muted: false }, '*');
            
            // Hide shield anyway so user can interact with player controls if needed
            if(shield) shield.style.display = 'none';
        }
    };

    // -------------------------------------------------------
    // 2. AD BLOCKER (Mutation Observer)
    // -------------------------------------------------------
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                // If the added node is NOT our main iframe and NOT our shield, remove it.
                if (node !== iframe && node !== shield && node.id !== 'video-wrapper') {
                    if (node.nodeType === 1) { 
                        console.log("Blocked injected element:", node);
                        node.remove();
                    }
                }
            });
        });
    });

    if (wrapper) {
        observer.observe(wrapper, { childList: true, subtree: true });
    }

    // -------------------------------------------------------
    // 3. MANUAL CONTROLS
    // -------------------------------------------------------
    
    // Unmute Button
    if (btnUnmute) {
        btnUnmute.addEventListener('click', function() {
            window.tryUnmutePlayer();
        });
    }

    // Volume Slider
    if (volumeSlider) {
        volumeSlider.addEventListener('input', function() {
            try {
                const innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                const videos = innerDoc.getElementsByTagName('video');
                if (videos.length > 0) {
                    videos[0].volume = this.value;
                }
            } catch (e) {
                iframe.contentWindow.postMessage({ type: 'volume', volume: this.value }, '*');
            }
        });
    }

    // Fullscreen Button
    if (btnFullscreen) {
        btnFullscreen.addEventListener('click', function() {
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