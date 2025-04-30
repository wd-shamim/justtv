<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript">
        if(window === window.top) document.location = "/";
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
    <title>PREMIUM {{ $channelId }}</title>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #000;
        }
        #UnMutePlayer {
            position: absolute;
            right: 10px;
            top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .unmute-button {
            width: 100px;
            height: 80px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }
        .unmute-button img {
            width: 30px;
            height: 30px;
            margin-bottom: 5px;
        }
        .unmute-button span {
            font-size: 14px;
            color: #000;
        }
        .media-control .bar-scrubber {
            display: none;
        }
        body, #player {
            position: relative;
        }
        #player {
            z-index: 1;
        }
        #UnMutePlayer {
            z-index: 9999;
        }
    </style>
    
    <script>
        var allowedDomains = ["yourdomain.com"]; // Change to your domain
        
        function getHostname(url) {
            try {
                return new URL(url).hostname;
            } catch (e) {
                return "";
            }
        }
        
        var currentReferer = document.referrer;
        var refererHostname = getHostname(currentReferer);
        
        if (currentReferer === "" || allowedDomains.indexOf(refererHostname) === -1) {
            window.location = "/";
        }
    </script>
</head>
<body>
    <div id="player"></div>
    
    <div id="player-container">
        <div id="clappr-container" style="width: 100%; height: 100%;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
    <script>
        var player;
        var channelKey = "premium{{ $channelId }}";
        var m3u8Url = "https://zorroplay.xyz/ddvypremium.php?id={{ $channelId }}";
        
        // Initialize player
        function initPlayer() {
            showPlayerContainer();
            
            player = new Clappr.Player({
                source: m3u8Url,
                parentId: "#clappr-container",
                autoPlay: true,
                height: "100%",
                width: "100%",
                disableErrorScreen: true,
                mute: true,
                mediacontrol: {
                    seekbar: "#E0CDA9",
                    buttons: "#E0CDA9"
                }
            });
            
            player.on(Clappr.Events.PLAYER_READY, function() {
                document.getElementById('UnMutePlayer').style.display = 'flex';
            });
            
            player.on(Clappr.Events.PLAYER_ERROR, function(error) {
                console.error("Player error:", error);
                retryPlayer();
            });
        }
        
        function showPlayerContainer() {
            var container = document.getElementById("player-container");
            container.innerHTML = '<div id="clappr-container" style="width: 100%; height: 100%;"></div>';
        }
        
        function retryPlayer(retryCount = 0) {
            const maxRetries = 3;
            const retryDelay = 5000;
            
            if (retryCount >= maxRetries) {
                document.getElementById("player-container").innerHTML = `
                    <div style="color: white; text-align: center; padding: 20px;">
                        Failed to load stream after ${maxRetries} attempts. Please try again later.
                    </div>`;
                return;
            }
            
            setTimeout(() => {
                console.log(`Retrying player load... Attempt ${retryCount + 1}`);
                if (player) player.destroy();
                initPlayer();
            }, retryDelay);
        }
        
        function WSUnmute() {
            document.getElementById("UnMutePlayer").style.display = "none";
            player.setVolume(100);
            player.unmute();
        }
        
        // Initialize player when page loads
        document.addEventListener('DOMContentLoaded', initPlayer);
    </script>

    <div id="UnMutePlayer" style="display: none;">
        <button class="unmute-button" onclick="WSUnmute()">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZmlsbD0id2hpdGUiIGQ9Ik0zLDlIMXY2aDJsMywzdjBIM1Y5eiBNMTYuNSwxMmMwLTEuNzctMS4wMi0zLjI5LTIuNS00LjAzdjguMDVDMTUuNDgsMTUuMjksMTYuNSwxMy43NywxNi41LDEyeiBNMTQsMy4yM3YyLjA2YzIuODkuODYsNSwzLjU0LDUsNi43MXMtMi4xMSw1Ljg1LTUsNi43MXYyLjA2YzQuMDEtMS4yNSw3LTQuOTksNy05LjczUzE4LjAxLDQuNDgsMTQsMy4yM3oiLz48L3N2Zz4=" alt="Unmute">
            <span>Unmute</span>
        </button>
    </div>
</body>
</html>