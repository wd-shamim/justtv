now everything's is fine only showing many ads even if click on/off video one click not working it's again and again direct to another website so fixed only this
Route::controller(DaddyController::class)->group(function () {
    Route::get('/view-live/{channelId}', 'viewlive')->name('viewlive')->where('channelId', '[0-9]+');
});

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DaddyController extends Controller
{
    public function viewlive($channelId)
    {
        if (!is_numeric($channelId)) {
            abort(400, 'Invalid channel ID');
        }

        $channelName = $this->getChannelName($channelId);
        $embedContent = $this->generateCleanIframe($channelId);

        return view('web.view_live', [
            'channelName' => $channelName,
            'channelId' => $channelId,
            'embedContent' => $embedContent
        ]);
    }

    private function generateCleanIframe($channelId)
    {
        // Direct iframe generation without sandbox
        return '<div class="embed-responsive embed-responsive-16by9">
            <iframe 
                src="https://thedaddy.to/embed/stream-'.$channelId.'.php"
                id="stream-player"
                class="embed-responsive-item"
                width="100%"
                height="500"
                frameborder="0"
                allowfullscreen
                scrolling="no"
                allow="autoplay; encrypted-media">
            </iframe>
        </div>';
    }

    private function getChannelName($channelId)
    {
        $channelMap = [
            '51' => 'ABC USA',
            '95' => 'Example Channel',
        ];
        return $channelMap[$channelId] ?? "Channel {$channelId}";
    }
}

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