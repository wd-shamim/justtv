<!DOCTYPE html>
<html>
<head>
    <title>Streaming</title>
    <style>
        html, body { margin: 0; padding: 0; height: 100%; }
        iframe { width: 100%; height: 100%; border: 0; }
    </style>
</head>
<body>
    <iframe srcdoc='{!! addslashes($html) !!}' sandbox="allow-same-origin allow-scripts allow-forms allow-presentation allow-modals" allow="autoplay; encrypted-media"></iframe>
</body>
</html>
