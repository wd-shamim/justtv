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
    .media-control[data-media-control] {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 9249273498234823462846234 !important;
    pointer-events: none;
    background :red !important;
}
</style>
 @endpush
 @push('scripts')
 <script>
        var iframes = document.getElementsByTagName('iframe');
        console.log(iframes);

        following code removes ads with undesired pictures and blocking elements that appear above the web page

        (function removeAdvertisementAndBlockingElements () {
            $('.inRek').remove();
            $('.mgbox').remove();
            
            Array.from(document.getElementsByTagName("img")).forEach(function (e) {
                if (!e.src.includes(window.location.host)) {
                    e.remove()
                }
            });    
            
            Array.from(document.getElementsByTagName("div")).forEach(function (e) {
                var currentZIndex = parseInt(document.defaultView.getComputedStyle(e, null).zIndex);
                if (currentZIndex > 999) {
                    console.log(parseInt(currentZIndex));
                    e.remove()
                }
            });
        })();
 </script>
 <script type="text/javascript">
document.write('<scr' + 'ipt language="javascript" type="text/javascript" src="http://1294937123.us.mixmarket.biz/uni/us/1294937123/?div=mix_block_1294937123&r=' + escape(document.referrer) + '&rnd=' + Math.round(Math.random() * 100000) + '" charset="windows-1251"><' + '/scr' + 'ipt>');
</script><script language="javascript" type="text/javascript" src="http://1294937123.us.mixmarket.biz/uni/us/1294937123/?div=mix_block_1294937123&amp;r=http%3A//stackoverflow.com/questions/39240278/block-ads-with-html-js&amp;rnd=39740" charset="windows-1251"></script>
</td></tr></tbody></table>
 @endpush