<!DOCTYPE html>
<html>
<head>
    <title>Embedded Player - Channel {{ $channelId }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: #000;
        }
        .embed-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .embed-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <div class="embed-container">
        <iframe src="{{ $iframeUrl }}" 
                frameborder="0" 
                allowfullscreen
                allow="autoplay; fullscreen"
                sandbox="allow-same-origin allow-scripts allow-popups allow-presentation">
        </iframe>
    </div>
</body>
</html>