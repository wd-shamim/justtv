    <script>
        window.addEventListener('beforeunload', function (event) {
            event.preventDefault();
            event.returnValue = '';
        });

    </script>
    <script>
        window.addEventListener('beforeunload', function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();
        });

    </script>
    <script>
        var blockedDomains = ['madurird.com', 'example.net'];
        var allElements = document.getElementsByTagName('*');
        for (var i = 0; i < allElements.length; i++) {
            var element = allElements[i];
            var src = element.src || element.href;
            if (src) {
                for (var j = 0; j < blockedDomains.length; j++) {
                    if (src.indexOf(blockedDomains[j]) > -1) {
                        element.parentNode.removeChild(element);
                        break;
                    }
                }
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Remove iframes with specific attributes or IDs
            var iframes = document.querySelectorAll('iframe');
            iframes.forEach(function(iframe) {
                // Check if the iframe source is from an ad network
                if (iframe.src.includes('madurird.com')) {
                    iframe.parentNode.removeChild(iframe); // Remove the iframe
                    // Remove the iframe
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Remove iframes with specific attributes or IDs
            var iframes = document.querySelectorAll('iframe');
            iframes.forEach(function(iframe) {
                // Check if the iframe source is from an ad network
                if (iframe.src.includes('madurird.com')) {
                    iframe.parentNode.removeChild(iframe); // Remove the iframe
                }
            });
        });
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Remove iframes with specific attributes or IDs
        var iframes = document.querySelectorAll('iframe');
        iframes.forEach(function(iframe) {
            // Check if the iframe source is from an ad network
            if (iframe.src.includes('madurird.com')) {
                iframe.parentNode.removeChild(iframe); // Remove the iframe
            }
        });
    });
</script>
