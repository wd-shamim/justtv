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