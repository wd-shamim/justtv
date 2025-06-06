<html lang="en">
<head>
    <script type="text/javascript">
        if (window === window.top) document.location = "/";
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
    <title>PREMIUM 805</title>
    @Include('web.iframe.script_css')
</head>
<body>
    <div id="player"></div>
    <meta charset="UTF-8">
    <title>Player</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        /* Outer container covers the entire viewport */
        #player-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg, #0d0d0d, #3a3a3a);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Loader styling */
        #loader {
            text-align: center;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #loader .spinner {
            width: 80px;
            height: 80px;
            border: 10px solid rgba(255, 255, 255, 0.3);
            border-top: 10px solid #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        <blade keyframes|%20spin%20%7B%0D>0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }


        #loader .text {
            margin-top: 15px;
            font-size: 20px;
        }

        #clappr-container {
            width: 100%;
            height: 100%;
            position: relative;
        }

    </style>

    <div id="player-container">
        <div id="clappr-container" style="width: 100%; height: 100%;">
            <div data-player="" tabindex="9999" class="" style="height: 100%; width: 100%;">
                <div class="container" data-container="">
                    <div data-spinner="" class="spinner-three-bounce" style="display: none;">
                        <div data-bounce1=""></div>
                        <div data-bounce2=""></div>
                        <div data-bounce3=""></div>
                    </div>
                    <div class="player-poster" data-poster="" style="display: none;">
                        <div class="play-wrapper" data-poster=""><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16" data-poster="" class="poster-icon"
                                style="color: rgb(224, 205, 169); display: none;">
                                <path fill="#010101" d="M1.425.35L14.575 8l-13.15 7.65V.35z"
                                    style="fill: rgb(224, 205, 169);"></path>
                            </svg></div>
                    </div><video data-html5-video="" muted="true" preload="metadata"
                        src="blob:https://zorroplay.xyz/72791ace-a134-47b7-8c88-3bcf71555bc5"></video>
                </div>
                <div class="media-control live media-control-hide" data-media-control="" style="">
                    <div class="media-control-background" data-background=""></div>
                    <div class="media-control-layer" data-controls="">
                        <div class="media-control-center-panel" data-media-control="">
                            <div class="bar-container seek-disabled" data-seekbar="">
                                <div class="bar-background" data-seekbar="">
                                    <div class="bar-fill-1" data-seekbar="" style="left: 0%; width: 0%;"></div>
                                    <div class="bar-fill-2" data-seekbar=""
                                        style="background-color: rgb(224, 205, 169); width: 100%;"></div>
                                    <div class="bar-hover" data-seekbar=""></div>
                                </div>
                                <div class="bar-scrubber" data-seekbar="" style="left: 100%;">
                                    <div class="bar-scrubber-icon" data-seekbar=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="media-control-left-panel" data-media-control="">
                            <button type="button" class="media-control-button media-control-icon stopped"
                                data-playstop="" aria-label="playstop"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#010101"
                                        d="M1.712 1.24h12.6v13.52h-12.6z" style="fill: rgb(224, 205, 169);"></path>
                                </svg></button>

                            <div class="dvr-controls" data-dvr-controls="">
                                <div class="live-info">live</div>
                                <button type="button" class="live-button" aria-label="back to live">back to
                                    live</button>
                            </div>
                        </div>


                        <div class="media-control-right-panel" data-media-control="">
                            <button type="button" class="media-control-button media-control-icon" data-fullscreen=""
                                aria-label="fullscreen"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                    <path fill="#010101"
                                        d="M7.156 8L4 11.156V8.5H3V13h4.5v-1H4.844L8 8.844 7.156 8zM8.5 3v1h2.657L8 7.157 8.846 8 12 4.844V7.5h1V3H8.5z"
                                        style="fill: rgb(224, 205, 169);"></path>
                                </svg></button>
                            <div class="cc-controls" data-cc-controls=""><button type="button"
                                    class="cc-button media-control-button media-control-icon" data-cc-button=""
                                    aria-label="cc-button"><svg version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 49 41.8" style="enable-background:new 0 0 49 41.8;"
                                        xml:space="preserve">
                                        <path
                                            d="M47.1,0H3.2C1.6,0,0,1.2,0,2.8v31.5C0,35.9,1.6,37,3.2,37h11.9l3.2,1.9l4.7,2.7c0.9,0.5,2-0.1,2-1.1V37h22.1 c1.6,0,1.9-1.1,1.9-2.7V2.8C49,1.2,48.7,0,47.1,0z M7.2,18.6c0-4.8,3.5-9.3,9.9-9.3c4.8,0,7.1,2.7,7.1,2.7l-2.5,4 c0,0-1.7-1.7-4.2-1.7c-2.8,0-4.3,2.1-4.3,4.3c0,2.1,1.5,4.4,4.5,4.4c2.5,0,4.9-2.1,4.9-2.1l2.2,4.2c0,0-2.7,2.9-7.6,2.9 C10.8,27.9,7.2,23.5,7.2,18.6z M36.9,27.9c-6.4,0-9.9-4.4-9.9-9.3c0-4.8,3.5-9.3,9.9-9.3C41.7,9.3,44,12,44,12l-2.5,4 c0,0-1.7-1.7-4.2-1.7c-2.8,0-4.3,2.1-4.3,4.3c0,2.1,1.5,4.4,4.5,4.4c2.5,0,4.9-2.1,4.9-2.1l2.2,4.2C44.5,25,41.9,27.9,36.9,27.9z">
                                        </path>
                                    </svg></button>
                                <ul style="display: none;">

                                    <li><a href="#" data-cc-select="-1">Disabled</a></li>

                                </ul>
                            </div>

                            <div class="drawer-container" data-volume="">
                                <div class="drawer-icon-container" data-volume="">
                                    <div class="drawer-icon media-control-icon muted" data-volume=""><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" clip-rule="evenodd" fill="#010101"
                                                d="M9.75 11.51L6.7 9.5H3.75v-3H6.7L9.75 4.49v.664l.497.498V3.498L6.547 6H3.248v4h3.296l3.7 2.502v-2.154l-.497.5v.662zm3-5.165L12.404 6l-1.655 1.653L9.093 6l-.346.345L10.402 8 8.747 9.654l.346.347 1.655-1.653L12.403 10l.348-.346L11.097 8l1.655-1.655z"
                                                style="fill: rgb(224, 205, 169);"></path>
                                        </svg></div>
                                    <span class="drawer-text" data-volume=""></span>
                                </div>

                                <div class="bar-container volume-bar-hide" data-volume="">

                                    <div class="segmented-bar-element" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                </div>

                            </div>

                            <button type="button" class="media-control-button media-control-icon" data-hd-indicator=""
                                aria-label="hd-indicator"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                    <path fill="#010101"
                                        d="M5.375 7.062H2.637V4.26H.502v7.488h2.135V8.9h2.738v2.848h2.133V4.26H5.375v2.802zm5.97-2.81h-2.84v7.496h2.798c2.65 0 4.195-1.607 4.195-3.77v-.022c0-2.162-1.523-3.704-4.154-3.704zm2.06 3.758c0 1.21-.81 1.896-2.03 1.896h-.83V6.093h.83c1.22 0 2.03.696 2.03 1.896v.02z"
                                        style="fill: rgb(224, 205, 169);"></path>
                                </svg></button>

                        </div>

                    </div>
                    <div class="seek-time" data-seek-time="" style="display: none; left: -100%;"><span
                            data-seek-time=""></span>
                        <span data-duration="" style="display: none;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the Clappr player library -->
    <script src="https://cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>

    <script>
        var player;

        // Extract the channel key using PHP.
        // For example, if $embed = "https://masxs.mizhls.ru/lb/wikinhl1/index.m3u8",
        // then channelKey will be "wikinhl1".
        var channelKey = "premium805";
        console.log("Channel Key:", channelKey);

        // Function: Remove loader and create a container for the player.
        function showPlayerContainer() {
            var outer = document.getElementById("player-container");
            // Remove loader
            var loader = document.getElementById("loader");
            if (loader) {
                loader.parentNode.removeChild(loader);
            }
            // Create (or ensure) the player container exists.
            var playerDiv = document.getElementById("clappr-container");
            if (!playerDiv) {
                playerDiv = document.createElement("div");
                playerDiv.id = "clappr-container";
                playerDiv.style.width = "100%";
                playerDiv.style.height = "100%";
                outer.appendChild(playerDiv);
            }
        }

        // Fetch the server key from your server_lookup.php.
        fetch('/server_lookup.php?channel_id=' + channelKey)
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (!data.server_key) {
                    document.getElementById("player-container").innerHTML = "ID premium805 might be dead!";
                    console.error("No server_key received from server_lookup.php");
                    return;
                }
                var serverKey = data.server_key;
                console.log("Server Key:", serverKey);

                // Build the final m3u8 URL using the server key.
                var m3u8Url = (serverKey === "top1/cdn") ?
                    "https://top1.newkso.ru/top1/cdn/" + channelKey + "/mono.m3u8" :
                    "https://" + serverKey + "new.newkso.ru/" + serverKey + "/" + channelKey + "/mono.m3u8";
                console.log("Final m3u8Url:", m3u8Url);

                // Remove the loader and create the Clappr player container.
                showPlayerContainer();

                // Initialize the Clappr player inside the "clappr-container".
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

                // Optional: Error handling with retry.
                player.on(Clappr.Events.PLAYER_ERROR, function (error) {
                    console.error("Player error:", error);
                    var retryCount = 0,
                        maxRetries = 3,
                        retryDelay = 10000;
                    var retryInterval = setInterval(function () {
                        if (retryCount < maxRetries) {
                            console.log("Retrying player load... Attempt " + (retryCount + 1));
                            player.load(player.options.source.trim());
                            player.play();
                            player.unmute();
                            player.setVolume(100);
                            retryCount++;
                        } else {
                            console.error(
                                "Max retry attempts reached. Please check the stream source.");
                            clearInterval(retryInterval);
                        }
                    }, retryDelay);
                });
            })
            .catch(function (error) {
                console.error("Error during server lookup:", error);
                document.getElementById("player-container").innerHTML = "ID premium805 might be dead!!";
            });

    </script>

    <script type="text/javascript">
        function WSUnmute() {
            document.getElementById("UnMutePlayer").style.display = "none";
            player.setVolume(100);
        }

    </script>



    <div id="UnMutePlayer" style="display: flex;">
        <button class="unmute-button" onclick="WSUnmute()">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Speaker_Icon.svg" alt="Unmute">
            <span>Unmute</span>
        </button>
    </div>


</body>

</html>