@extends('web.layout.master')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">All TV Channels</h1>
    
    @if(count($channels) > 0)
        <div class="row">
            @foreach($channels as $channel)
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <div class="card h-100 channel-card">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $channel['name'] }}</h5>
                            <!-- Use the ID directly from the array -->
                            @if($channel['id'])
                            <a href="{{ route('viewlive', ['channelId' => $channel['id']]) }}" 
                               class="btn btn-sm btn-primary">
                                Watch Now
                            </a>
                            @else
                            <span class="text-muted small">ID Missing</span>
                            @endif
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