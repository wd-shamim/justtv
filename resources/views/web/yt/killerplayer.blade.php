<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KillerPlayer Demo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex flex-col items-center justify-center min-h-screen p-4">
    
    <div class="text-center mb-10">
        <h1 class="text-white text-3xl font-bold">Laravel Video Player Clone</h1>
        <p class="text-gray-400 mt-2">Custom Container + Zoom/Crop Engine</p>
    </div>
    <iframe 
        style="display:block; margin:auto; width:742px; max-width:100%; aspect-ratio:1.7708830548926013;" 
        src="{{ route('player', ['id' => 'rlk9nNLl2ws']) }}" 
        frameborder="0" 
        allow="autoplay; gyroscope; picture-in-picture; accelerometer; clipboard-write; encrypted-media" 
        allowfullscreen="">
    </iframe>

    <div class="mt-8 bg-gray-800 p-4 rounded-lg max-w-2xl w-full">
        <p class="text-gray-300 text-sm">
            <span class="text-green-400 font-bold">Success:</span> The video above is served from your Laravel route (<code class="text-blue-400">/player/{id}</code>). It has no YouTube branding or related videos.
        </p>
    </div>
</body>
</html>