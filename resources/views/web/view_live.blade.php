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