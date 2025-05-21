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
                        @if(!empty($embedContent))
                            {!! $embedContent !!}
                        @else
                            <div class="alert alert-danger">
                                Could not load stream content. Please try again later.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom CSS for the page */
    .embed-responsive {
        position: relative;
        overflow: hidden;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
    }
    .embed-responsive iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    .custom-overlay {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
        z-index: 1000;
    }
</style>
@endpush

@push('scripts')
<script>
    // Custom JavaScript for the page
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Page loaded with channel ID: {{ $channelId }}');

        // Example: Add an overlay div dynamically
        const iframe = document.querySelector('.embed-responsive iframe');
        if (iframe) {
            const overlay = document.createElement('div');
            overlay.className = 'custom-overlay';
            overlay.textContent = 'Channel: {{ $channelName }}';
            iframe.parentElement.appendChild(overlay);
        }

        // Example: Try to interact with iframe (if same-origin or postMessage supported)
        try {
            const iframeWindow = iframe.contentWindow;
            // Note: This will fail if the iframe is cross-origin
            console.log('Iframe document:', iframeWindow.document);
        } catch (e) {
            console.error('Cannot access iframe content due to cross-origin restrictions:', e);
        }
    });

    // Example: Function to communicate with iframe (if it supports postMessage)
    function sendMessageToIframe(message) {
        const iframe = document.querySelector('.embed-responsive iframe');
        if (iframe) {
            iframe.contentWindow.postMessage(message, 'https://thedaddy.to');
        }
    }
</script>
@endpush