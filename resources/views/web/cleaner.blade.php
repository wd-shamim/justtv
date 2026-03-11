<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream</title>
    <style>
        body { margin: 0; padding: 0; background: #000; overflow: hidden; }
        /* The container where we inject the clean page */
        #inject-container { width: 100vw; height: 100vh; border: none; }
        
        /* CSS Prison: Hide everything initially */
        body > * { opacity: 0; pointer-events: none; }
        
        /* Force Video to be visible */
        video { 
            opacity: 1 !important; 
            pointer-events: auto !important; 
            position: fixed !important; 
            top: 0 !important; left: 0 !important; 
            width: 100vw !important; height: 100vh !important; 
            z-index: 99999 !important; background: #000 !important;
            object-fit: contain !important;
        }
        
        /* Loading State */
        #loading-msg { 
            position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
            color: white; font-family: sans-serif; font-size: 1.5rem; z-index: 100;
        }
    </style>
</head>
<body>
    <div id="loading-msg">Loading Stream...</div>
    <div id="inject-container"></div>

    <script>
        (function() {
            const targetUrl = "{{ $targetUrl }}";
            const container = document.getElementById('inject-container');

            // 1. SECURITY TRAP: Disable popups and localhost connections immediately
            window.open = function() { return null; };
            
            const _fetch = window.fetch;
            window.fetch = function(url) {
                if (String(url).includes('127.0.0.1') || String(url).includes('localhost')) {
                    console.log("Blocked Localhost Fetch");
                    return new Promise(() => {}); // Silent fail
                }
                return _fetch.apply(this, arguments);
            };

            const _XHR = window.XMLHttpRequest;
            window.XMLHttpRequest = function() {
                const xhr = new _XHR();
                const _open = xhr.open;
                xhr.open = function(method, url) {
                    if (String(url).includes('127.0.0.1') || String(url).includes('localhost')) {
                        console.log("Blocked Localhost XHR");
                        throw new Error("Blocked"); 
                    }
                    return _open.apply(this, arguments);
                };
                return xhr;
            };

            // 2. FETCH THE PAGE (Bypassing Server Proxy)
            fetch(targetUrl, {
                cache: 'no-store',
                headers: { 'Referer': 'https://google.com/' }
            })
            .then(response => response.text())
            .then(html => {
                // 3. CLEAN THE HTML (String Replacement)
                // Remove known bad scripts/strings
                let cleanHtml = html;
                
                // Kill 127.0.0.1 references
                cleanHtml = cleanHtml.split('127.0.0.1').join('0.0.0.0');
                
                // Remove Link Prefetches (Causes of "Connecting..." errors)
                cleanHtml = cleanHtml.replace(/<link[^>]*>/gi, '');
                
                // Remove specific Ad Domains
                const badDomains = ['xadsmart.com', 'adsco.re', 'putlogguffaw.com', 'al5sm.com', 'histats.com'];
                badDomains.forEach(domain => {
                    const regex = new RegExp('<script[^>]*' + domain + '[^>]*>.*?</script>', 'gi');
                    cleanHtml = cleanHtml.replace(regex, '');
                });

                // 4. INJECT INTO PAGE
                document.getElementById('loading-msg').style.display = 'none';
                container.innerHTML = cleanHtml;
            })
            .catch(err => {
                console.error(err);
                document.getElementById('loading-msg').innerText = "Stream Failed to Load. Check Console.";
            });
        })();
    </script>
</body>
</html>