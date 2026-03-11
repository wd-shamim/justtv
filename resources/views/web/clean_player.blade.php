<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player</title>
    <style>
        body { margin: 0; padding: 0; overflow: hidden; background: #000; }
        
        .safe-container {
            position: relative;
            width: 100vw;
            height: 100vh;
        }

        /* The Iframe holding the external site */
        .external-frame {
            width: 100%;
            height: 100%;
            border: none;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        /* THE SHIELD: A transparent layer to block ad clicks */
        .click-shield {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: rgba(0,0,0,0.01); /* Almost invisible */
            cursor: pointer;
        }

        .hidden { display: none !important; }
    </style>
</head>
<body>

    <div class="safe-container" id="safe-container">
        <!-- The Iframe -->
        <!-- NO sandbox attribute to allow video to play -->
        <iframe 
            src="{{ $streamUrl }}" 
            class="external-frame" 
            id="dirty-frame"
            allowfullscreen
            referrerpolicy="no-referrer"
        ></iframe>

        <!-- The Shield: Blocks Clicks until user interacts -->
        <div class="click-shield" id="click-shield"></div>
    </div>

    <script>
        (function() {
            const shield = document.getElementById('click-shield');
            const iframe = document.getElementById('dirty-frame');
            let isInteracting = false;

            // -------------------------------------------------------
            // 1. POPUP BLOCKER (The "Trap")
            // -------------------------------------------------------
            // This stops new tabs from opening.
            // By defining this globally, we catch calls from the iframe too
            // if the iframe tries to escape.
            window.open = function(url, target, features) {
                console.log("Blocked popup: " + url);
                
                // SMART UNMUTE:
                // If the site tried to open a popup (usually an ad), 
                // the user probably clicked a "Play" or "Unmute" button.
                // We try to unmute the real video now.
                forceUnmute();
                
                return null; // Block the window
            };

            // -------------------------------------------------------
            // 2. CLICK HANDLING
            // -------------------------------------------------------
            
            // When user clicks our shield, we hide it and try to unmute
            if (shield) {
                shield.addEventListener('click', function(e) {
                    e.preventDefault();
                    shield.classList.add('hidden');
                    isInteracting = true;
                    forceUnmute();
                });
            }

            // -------------------------------------------------------
            // 3. THE "FORCE UNMUTE" FUNCTION
            // -------------------------------------------------------
            // This tries to find the video tag and unmute it.
            function forceUnmute() {
                try {
                    // Try to access the iframe document
                    const innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                    
                    // Find video tags
                    const videos = innerDoc.getElementsByTagName('video');
                    if (videos.length > 0) {
                        const video = videos[0];
                        
                        // Unmute
                        video.muted = false;
                        video.volume = 1.0;
                        
                        // Force Play
                        const playPromise = video.play();
                        if (playPromise !== undefined) {
                            playPromise.catch(error => {
                                console.log("Autoplay prevented, user must interact.");
                            });
                        }
                        console.log("Video Unmuted Successfully");
                    }
                } catch (e) {
                    console.warn("Cross-origin security blocked unmute. User must click unmute inside player.");
                }
            }

            // -------------------------------------------------------
            // 4. AD ELEMENT CLEANER (Optional Visual Clean)
            // -------------------------------------------------------
            // Watch for overlays added to the body (outside iframe)
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach((mutation) => {
                    mutation.addedNodes.forEach((node) => {
                        if (node.nodeType === 1) {
                            // Remove generic ad popups that might appear on our page
                            if (node.id.includes('ad') || node.className.includes('ad')) {
                                node.remove();
                            }
                        }
                    });
                });
            });
            observer.observe(document.body, { childList: true, subtree: true });

        })();
    </script>
</body>
</html>