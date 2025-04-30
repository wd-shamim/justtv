@extends('web.layout.master')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">All TV Channels</h1>
    
    @if(count($channels) > 0)
        <div class="row">
            @foreach($channels as $channel)
                @php
                    // Extract channel ID from full_link (format: https://daddylive.mp/stream/stream-126.php)
                    $urlParts = explode('-', $channel['full_link']);
                    $channelId = str_replace('.php', '', end($urlParts));
                @endphp
                
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <div class="card h-100 channel-card">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $channel['name'] }}</h5>
                            <a href="{{ route('viewlive', ['channelId' => $channelId]) }}" 
                            class="btn btn-sm btn-primary">
                                Watch Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning">No channels available at the moment. Please try again later.</div>
    @endif
</div>
@endsection