<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>KillerPlayer — Live TV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { bebas:['"Bebas Neue"','sans-serif'], dm:['"DM Sans"','sans-serif'] } } }
        }
    </script>
    <style>
        :root { --accent: #e63946; }
        body { font-family:'DM Sans',sans-serif; }

        .toggle-btn { transition:background .2s; }
        .toggle-btn::after {
            content:''; position:absolute; width:14px; height:14px;
            background:#fff; border-radius:50%; top:3px; left:3px; transition:left .2s;
        }
        .toggle-btn.on::after { left:21px; }

        /* Live pulse dot */
        @keyframes livepulse { 0%,100%{ opacity:1; } 50%{ opacity:.35; } }
        .live-dot { animation:livepulse 1.5s ease-in-out infinite; }

        /* Theme shell */
        .player-shell { transition:border-radius .4s, box-shadow .4s; }
        .theme-wistia  .player-shell { border-radius:16px; box-shadow:0 20px 70px rgba(230,57,70,.25),0 0 0 1px rgba(230,57,70,.15); }
        .theme-vimeo   .player-shell { border-radius:4px;  box-shadow:0 8px 40px rgba(26,183,234,.2); }
        .theme-viddler .player-shell { border-radius:0;    box-shadow:7px 7px 0 var(--accent),14px 14px 0 rgba(244,160,21,.18); }
        .theme-vzaar   .player-shell { border-radius:20px; box-shadow:0 0 0 2px var(--accent),0 20px 60px rgba(124,58,237,.3); }
        .theme-tara    .player-shell { border-radius:12px; box-shadow:0 0 50px rgba(16,185,129,.2),0 0 0 1px rgba(16,185,129,.25); }
        .theme-btn.active { border-color:var(--accent) !important; color:var(--accent) !important; }

        /* Channel grid */
        .ch-card { transition:border-color .2s, background .2s; }
        .ch-card:hover { border-color:var(--accent) !important; }
        .ch-card.active { border-color:var(--accent) !important; background:#1a1212 !important; }
    </style>
</head>
<body class="bg-[#0d0d0d] text-[#f1f1f1] min-h-screen flex flex-col items-center px-5 py-10 theme-wistia">

    {{-- Header --}}
    <header class="text-center mb-8">
        <h1 class="font-bebas text-[clamp(2.4rem,7vw,4rem)] tracking-[4px] leading-none" style="color:var(--accent)">
            KillerPlayer
        </h1>
        <div class="flex items-center justify-center gap-2 mt-1.5">
            <span class="live-dot w-2 h-2 rounded-full bg-red-500 inline-block"></span>
            <p class="text-[#555] text-xs tracking-widest uppercase">Live TV · No Ads · No Limits</p>
        </div>
    </header>

    {{-- Channel ID Input --}}
    <div class="flex gap-2 w-full max-w-[720px] mb-5">
        <input type="number" id="chInput"
            placeholder="Enter channel ID…  e.g. 51"
            value="{{ $channelId ?? '' }}"
            class="flex-1 bg-[#1f1f1f] border border-[#2a2a2a] rounded-lg text-[#f1f1f1] text-sm px-4 py-3 outline-none transition-colors placeholder:text-[#444]"/>
        <button onclick="loadChannel()"
            class="font-bebas tracking-[2px] text-base px-6 py-3 rounded-lg text-white whitespace-nowrap hover:opacity-90 active:scale-95 transition-all"
            style="background:var(--accent)">WATCH</button>
    </div>

    {{-- Quick Channel Grid --}}
    <div class="flex gap-2 flex-wrap justify-center max-w-[720px] w-full mb-6" id="chGrid">
        @php
            $quickChannels = [
                ['51',  'ABC USA'],
                ['95',  'Example Ch'],
            ];
        @endphp
        @foreach($quickChannels as [$chId, $chLabel])
        <button
            class="ch-card bg-[#1f1f1f] border-2 border-transparent rounded-full text-[#555] text-xs font-medium px-4 py-1.5 tracking-wide transition-all hover:text-white {{ isset($channelId) && $channelId == $chId ? 'active text-white' : '' }}"
            data-ch="{{ $chId }}" onclick="selectChannel(this)">
            {{ $chLabel }}
        </button>
        @endforeach
    </div>

    {{-- Theme Picker --}}
    <div class="flex gap-2 flex-wrap justify-center max-w-[720px] w-full mb-6">
        @foreach([
            ['wistia',  '#e63946', 'Wistia'],
            ['vimeo',   '#1ab7ea', 'Vimeo'],
            ['viddler', '#f4a015', 'Viddler'],
            ['vzaar',   '#7c3aed', 'Vzaar'],
            ['tara',    '#10b981', 'Tara'],
        ] as [$key, $color, $label])
        <button
            class="theme-btn bg-[#1f1f1f] border-2 border-transparent rounded-full text-[#555] text-xs font-medium px-4 py-1.5 tracking-wide transition-all hover:text-white hover:border-[#3a3a3a] {{ $key === 'wistia' ? 'active' : '' }}"
            data-theme="theme-{{ $key }}" data-color="{{ $color }}" onclick="setTheme(this)">
            {{ $label }}
        </button>
        @endforeach
    </div>

    {{-- Player Shell --}}
    <div class="player-shell w-full max-w-[720px] bg-black relative" id="playerShell"
         style="border-radius:16px; box-shadow:0 28px 80px rgba(0,0,0,.7);">

        {{-- 16:9 aspect wrapper --}}
        <div class="relative bg-black" style="padding-top:56.25%; border-radius:inherit; overflow:hidden;">

            {{-- Placeholder --}}
            <div id="placeholder"
                 class="absolute inset-0 z-10 flex flex-col items-center justify-center gap-4 bg-[#080808] transition-opacity duration-300">
                <svg width="54" height="54" viewBox="0 0 24 24" fill="none" class="opacity-20">
                    <rect x="2" y="7" width="20" height="15" rx="2" stroke="#fff" stroke-width="1.2"/>
                    <path d="M17 2L12 7 7 2" stroke="#fff" stroke-width="1.2" stroke-linecap="round"/>
                </svg>
                <span class="text-[#444] text-sm tracking-wide">Enter a channel ID above and hit WATCH</span>
            </div>

            {{-- Now Playing badge --}}
            <div id="nowPlaying"
                 class="absolute top-3 left-3.5 z-20 hidden items-center gap-2 rounded-md px-3 py-1 font-bebas text-sm tracking-[2px] text-white/80 pointer-events-none"
                 style="background:rgba(0,0,0,.52); backdrop-filter:blur(8px)">
                <span class="live-dot w-2 h-2 rounded-full bg-red-500 inline-block"></span>
                <span id="nowPlayingText">LIVE</span>
            </div>

            {{-- Embed slot --}}
            <div id="iframeSlot" class="absolute inset-0"></div>
        </div>
    </div>

    {{-- Settings Panel --}}
    <div class="w-full max-w-[720px] mt-5 bg-[#161616] rounded-xl p-5 border border-[#222]">
        <h3 class="font-bebas tracking-[2.5px] text-[#555] text-sm mb-4">Player Settings</h3>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-[#555] text-[11px] uppercase tracking-wide mb-1.5">Accent Color</label>
                <input type="color" id="colorPick" value="#e63946" oninput="setAccent(this.value)"
                       class="w-full h-9 rounded-md border border-[#2a2a2a] bg-[#1f1f1f] cursor-pointer p-0.5"/>
            </div>
            <div>
                <label class="block text-[#555] text-[11px] uppercase tracking-wide mb-1.5">Channel Name Override</label>
                <input type="text" id="chNameOverride" placeholder="Auto"
                       class="w-full bg-[#1f1f1f] border border-[#2a2a2a] rounded-md text-[#f1f1f1] text-sm px-3 py-2 outline-none placeholder:text-[#444]"/>
            </div>
        </div>
        <div class="flex items-center justify-between py-2.5">
            <span class="text-sm text-[#f1f1f1]">Show Now Playing Badge</span>
            <button id="togBadge" onclick="toggleOpt('badge')"
                    class="toggle-btn on relative w-[38px] h-[20px] rounded-full border-none cursor-pointer"
                    style="background:var(--accent)">
            </button>
        </div>
    </div>

    {{-- Current Channel Info --}}
    <div class="w-full max-w-[720px] mt-5 bg-[#161616] rounded-xl p-5 border border-[#222]" id="chInfo" style="display:none">
        <h3 class="font-bebas tracking-[2.5px] text-[#555] text-sm mb-3">Now Watching</h3>
        <div class="flex items-center gap-3">
            <span class="live-dot w-3 h-3 rounded-full bg-red-500 inline-block flex-shrink-0"></span>
            <div>
                <div id="chInfoName" class="text-white font-semibold text-sm"></div>
                <div id="chInfoId" class="text-[#555] text-xs mt-0.5"></div>
            </div>
            <a id="chDirectLink" href="#" target="_blank"
               class="ml-auto text-[10px] text-[#555] hover:text-white bg-[#1f1f1f] px-2 py-1 rounded font-mono transition-colors">
                DIRECT LINK ↗
            </a>
        </div>
    </div>

<script>
    let curChannelId   = null;
    let curChannelName = null;
    let opts           = { badge: true };
    let curAccent      = '#e63946';
    let innerFrame     = null;

    // ── Auto-load if channelId passed from controller ──
    @if(isset($channelId) && $channelId)
    window.addEventListener('DOMContentLoaded', () => {
        loadChannelById('{{ $channelId }}', '{{ $channelName }}');
    });
    @endif

    function selectChannel(btn) {
        document.querySelectorAll('.ch-card').forEach(b => b.classList.remove('active','text-white'));
        btn.classList.add('active','text-white');
        document.getElementById('chInput').value = btn.dataset.ch;
        loadChannelById(btn.dataset.ch, btn.textContent.trim());
    }

    function loadChannel() {
        const id = document.getElementById('chInput').value.trim();
        if (!id || isNaN(id)) {
            document.getElementById('chInput').classList.add('border-red-500');
            setTimeout(() => document.getElementById('chInput').classList.remove('border-red-500'), 1200);
            return;
        }
        const nameOverride = document.getElementById('chNameOverride').value.trim();
        loadChannelById(id, nameOverride || null);
    }

    function loadChannelById(id, name) {
        curChannelId   = id;
        curChannelName = name || `Channel ${id}`;
        spawnEmbed(id, curChannelName);
        updateChInfo(id, curChannelName);
    }

    function embedUrl(id, name) {
        const p = new URLSearchParams({
            ch:     id,
            name:   name || `Channel ${id}`,
            accent: curAccent,
        });
        return `{{ route('killerplayer.tv.embed') }}?${p}`;
    }

    function spawnEmbed(id, name) {
        const slot = document.getElementById('iframeSlot');
        slot.innerHTML = '';

        innerFrame = document.createElement('iframe');
        innerFrame.src = embedUrl(id, name);
        innerFrame.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;border:none;';
        innerFrame.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen';
        innerFrame.allowFullscreen = true;
        innerFrame.setAttribute('scrolling', 'no');
        slot.appendChild(innerFrame);

        document.getElementById('placeholder').classList.add('opacity-0','pointer-events-none');

        if (opts.badge) {
            const np = document.getElementById('nowPlaying');
            np.classList.remove('hidden');
            np.classList.add('flex');
            document.getElementById('nowPlayingText').textContent = (name || `CH ${id}`).toUpperCase();
        }
    }

    function updateChInfo(id, name) {
        document.getElementById('chInfo').style.display = '';
        document.getElementById('chInfoName').textContent = name;
        document.getElementById('chInfoId').textContent  = `Channel ID: ${id}`;
        document.getElementById('chDirectLink').href     = `https://thedaddy.to/embed/stream-${id}.php`;

        // Highlight matching quick channel card
        document.querySelectorAll('.ch-card').forEach(b => {
            b.classList.toggle('active',   b.dataset.ch === String(id));
            b.classList.toggle('text-white', b.dataset.ch === String(id));
        });
        document.getElementById('chInput').value = id;
    }

    // ── Theme ──
    const ALL_THEMES = ['theme-wistia','theme-vimeo','theme-viddler','theme-vzaar','theme-tara'];
    function setTheme(btn) {
        ALL_THEMES.forEach(t => document.body.classList.remove(t));
        document.querySelectorAll('.theme-btn').forEach(b => b.classList.remove('active'));
        document.body.classList.add(btn.dataset.theme);
        btn.classList.add('active');
        setAccent(btn.dataset.color);
        document.getElementById('colorPick').value = btn.dataset.color;
    }
    function setAccent(c) {
        curAccent = c;
        document.documentElement.style.setProperty('--accent', c);
        if (innerFrame && innerFrame.contentWindow)
            innerFrame.contentWindow.postMessage({ cmd:'accent', value:c }, '*');
    }

    function toggleOpt(key) {
        opts[key] = !opts[key];
        const ids = { badge:'togBadge' };
        const btn = document.getElementById(ids[key]);
        btn.classList.toggle('on', opts[key]);
        btn.style.background = opts[key] ? 'var(--accent)' : '#2e2e2e';
        if (key === 'badge') {
            const np = document.getElementById('nowPlaying');
            if (opts.badge && curChannelId) {
                np.classList.remove('hidden'); np.classList.add('flex');
            } else {
                np.classList.add('hidden'); np.classList.remove('flex');
            }
        }
    }

    document.getElementById('chInput').addEventListener('keydown', e => {
        if (e.key === 'Enter') loadChannel();
    });
</script>
</body>
</html>