<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Remove margins so the video fills the iframe completely */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            background: #000;
        }
        /* The Zoom/Crop Trick to hide Top/Bottom bars */
        .crop-zoom {
            transform: translateY(-50%);
        }
    </style>
</head>
<body class="bg-black">
    
    <!-- The Cropping Container -->
    <div class="relative w-full h-full" style="overflow: clip;">
        
        <!-- 
           The YouTube Iframe
           height="200%" + top-1/2 + crop-zoom = Hidden Header/Footer
        -->
        <iframe 
            class="absolute top-1/2 left-0 w-full h-[200%] crop-zoom"
            src="https://www.youtube.com/embed/{{ $id }}?rel=0&modestbranding=1&autoplay=1&controls=1" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen>
        </iframe>
        
    </div>

</body>
</html>