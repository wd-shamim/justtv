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
                    
                    <div class="iframe-container">
                        <!-- 
                           THE MAGIC SANDBOX:
                           allow-scripts: Allows video player to run.
                           allow-same-origin: Allows video data to load.
                           allow-forms: Allows player controls.
                           
                           MISSING: allow-popups (This blocks new tabs)
                           MISSING: allow-top-navigation (This blocks redirects)
                        -->
                        <iframe 
                            src="{{ route('stream.proxy', ['channelId' => $channelId, 't' => time()]) }}" 
                            allowfullscreen 
                            scrolling="no"
                            referrerpolicy="no-referrer"
                            sandbox="allow-scripts allow-same-origin allow-forms"
                        ></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .iframe-container { position: relative; width: 100%; height: 0; padding-bottom: 56.25%; background: #000; }
    .iframe-container iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; }
</style>
@endpush