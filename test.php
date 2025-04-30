<!DOCTYPE html>
<html>
<head>
    <title>Test Player</title>
    <script src="https://cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
    <style>
        html, body { margin: 0; padding: 0; height: 100%; }
        #player-container { width: 100%; height: 100%; }
    </style>
</head>
<body>
    <div id="player-container"></div>
    <script>
        var player = new Clappr.Player({
            source: "https://localhost/stream/nfs/premium652/mono.m3u8",
            parentId: "#player-container",
            autoPlay: true,
            mute: false,
            height: "100%",
            width: "100%",
            headers: {
                'Referer': 'https://media.trusthubmedia.com/'
            },
            disableErrorScreen: false,
            events: {
                onError: function(error) { console.error("Player Error:", error); },
                onStateChanged: function(state) { console.log("Player State:", state); }
            }
        });
    </script>
</body>
</html>