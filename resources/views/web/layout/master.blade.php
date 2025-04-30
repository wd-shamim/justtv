<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZUZZ TV - Watch Sports Live</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/web/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
    <script>
        player = new Clappr.Player({
            source: "https://nfsnew.newkso.ru/nfs/premium652/mono.m3u8",
            parentId: "#clappr-container",
            autoPlay: true,
            mute: false,
            height: "100%",
            width: "100%",
            headers: {
                'Referer': 'https://your-live-domain.com', // Replace with live server domain
                'User-Agent': navigator.userAgent,
                'Authorization': 'Bearer your-token' // If a token is required
            },
            disableErrorScreen: false // Enable error screen for debugging
        });
    </script>
    @stack('styles')
    @livewireStyles
</head>

<body class="live-body">
    <!-- Header -->
     @include('web.layout.inc.header')

    <!-- Main Content -->
    <main class="live-main-content">
        @yield('content')
    </main>

    <!-- Mobile Toggle Button -->
    <button class="btn btn-outline-warning live-toggle-btn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay for Mobile Menu -->
    <div class="live-overlay"></div>

    @include('web.layout.inc.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/web/js/main.js') }}"></script>
    @stack('scripts')
    @livewireScripts
</body>
</html>
