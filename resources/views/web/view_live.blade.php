@extends('web.layout.master')

@section('content')
<div class="container-fluid mt-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card mt-5 pt-5">
                <div class="card-header">
                    <h4>Now Playing: {{ $channelName }}</h4>
                </div>
                <div class="card-body p-0">
                    <div class="embed-responsive embed-responsive-16by9">
                        @isset($streamUrl)
                            <!-- Clean HLS Player -->
                            <div id="hls-player" style="width:100%;height:500px;"></div>
                        @else
                            <!-- Ad-Blocked Iframe -->
                            <div id="adblock-iframe-container" style="width:100%;height:500px;position:relative;">
                                <iframe id="adblock-iframe" 
                                        src="about:blank"
                                        data-src="https://thedaddy.to/embed/stream-{{ $channelId }}.php"
                                        style="width:100%;height:100%;border:none;"></iframe>
                                <div id="iframe-overlay" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:9998;pointer-events:none;"></div>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Iframe Container */
    #adblock-iframe-container {
        overflow: hidden;
    }
    
    /* Hide common ad elements */
    #adblock-iframe {
        position: relative;
        z-index: 1;
    }
    
    /* Player Styles */
    #hls-player {
        background-color: #000;
    }
    
    /* Loading Spinner */
    .loading-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 4px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top: 4px solid white;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        z-index: 10000;
    }
    
    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
</style>
@endpush

@push('scripts')
@isset($streamUrl)
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
// Clean HLS Player Implementation
document.addEventListener('DOMContentLoaded', function() {
    const video = document.createElement('video');
    const hls = new Hls();
    
    hls.loadSource("{{ $streamUrl }}");
    hls.attachMedia(video);
    
    video.controls = true;
    video.style.width = '100%';
    video.style.height = '100%';
    
    document.getElementById('hls-player').appendChild(video);
    
    hls.on(Hls.Events.MANIFEST_PARSED, function() {
        video.play().catch(e => {
            video.muted = true;
            video.play();
        });
    });
});
</script>
@else
<script>
// Advanced Iframe Ad Blocking Without Sandbox
document.addEventListener('DOMContentLoaded', function() {
    const iframe = document.getElementById('adblock-iframe');
    const container = document.getElementById('adblock-iframe-container');
    const overlay = document.getElementById('iframe-overlay');
    
    // Show loading spinner
    const spinner = document.createElement('div');
    spinner.className = 'loading-spinner';
    container.appendChild(spinner);
    
    // Function to clean iframe content
    function cleanIframeContent() {
        try {
            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            
            // Remove ad elements
            const adSelectors = [
                'div[class*="ad"]',
                'div[id*="ad"]',
                'iframe',
                'object',
                'embed',
                'script[src*="ads"]',
                'link[href*="ads"]'
            ];
            
            adSelectors.forEach(selector => {
                const elements = iframeDoc.querySelectorAll(selector);
                elements.forEach(el => {
                    // Preserve the video player iframe
                    if (!(el.id === 'player' || el.classList.contains('video-player'))) {
                        el.remove();
                    }
                });
            });
            
            // Block right-click menu
            iframeDoc.addEventListener('contextmenu', e => e.preventDefault());
            
            // Prevent new window opens
            iframeDoc.querySelectorAll('a[target="_blank"]').forEach(link => {
                link.target = '_self';
            });
            
            return true;
        } catch (e) {
            console.log('Limited ad blocking due to CORS');
            return false;
        }
    }
    
    // Load iframe after slight delay
    setTimeout(() => {
        iframe.src = iframe.dataset.src;
        
        // Check periodically for ads
        const checkInterval = setInterval(() => {
            if (cleanIframeContent()) {
                spinner.remove();
                overlay.style.display = 'none'; // Show the iframe
                clearInterval(checkInterval);
            }
        }, 300);
        
        // Final cleanup after 3 seconds
        setTimeout(() => {
            spinner.remove();
            overlay.style.display = 'none';
            clearInterval(checkInterval);
        }, 3000);
        
        // Event listener for iframe messages
        window.addEventListener('message', function(e) {
            // Block ad-related messages
            if (e.data && typeof e.data === 'string' && 
                (e.data.includes('ad') || e.data.includes('Ad'))) {
                e.stopImmediatePropagation();
            }
        });
        
    }, 500);
});
</script>
@endisset
@endpush