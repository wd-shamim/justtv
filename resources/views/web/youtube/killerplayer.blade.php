<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>KillerPlayer</title>
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

        @keyframes shake {
            0%,100%{ transform:translateX(0); } 25%{ transform:translateX(-5px); } 75%{ transform:translateX(5px); }
        }
        .shake { animation:shake .3s; }

        /* Theme shell styles */
        .player-shell { transition:border-radius .4s, box-shadow .4s; }

        .theme-wistia  .player-shell { border-radius:16px; box-shadow:0 20px 70px rgba(230,57,70,.25),0 0 0 1px rgba(230,57,70,.15); }
        .theme-vimeo   .player-shell { border-radius:4px;  box-shadow:0 8px 40px rgba(26,183,234,.2); }
        .theme-viddler .player-shell { border-radius:0;    box-shadow:7px 7px 0 var(--accent),14px 14px 0 rgba(244,160,21,.18); }
        .theme-vzaar   .player-shell { border-radius:20px; box-shadow:0 0 0 2px var(--accent),0 20px 60px rgba(124,58,237,.3); }
        .theme-tara    .player-shell { border-radius:12px; box-shadow:0 0 50px rgba(16,185,129,.2),0 0 0 1px rgba(16,185,129,.25); }

        .theme-btn.active { border-color:var(--accent) !important; color:var(--accent) !important; }

        /* Debug */
        #debugPanel { font-family:'Courier New',monospace; }
        .log-info    { color:#60a5fa; }
        .log-success { color:#34d399; }
        .log-error   { color:#f87171; }
        .log-cmd     { color:#fbbf24; }
        .log-yt      { color:#a78bfa; }
        .log-warn    { color:#fb923c; }
        #debugLog { max-height:240px; overflow-y:auto; scroll-behavior:smooth; }
        #debugLog::-webkit-scrollbar { width:4px; }
        #debugLog::-webkit-scrollbar-thumb { background:#333; border-radius:2px; }
    </style>
</head>
<body class="bg-[#0d0d0d] text-[#f1f1f1] min-h-screen flex flex-col items-center px-5 py-10 theme-wistia">

    {{-- Header --}}
    <header class="text-center mb-8">
        <h1 class="font-bebas text-[clamp(2.4rem,7vw,4rem)] tracking-[4px] leading-none" style="color:var(--accent)">
            KillerPlayer
        </h1>
        <p class="text-[#555] text-xs mt-1.5 tracking-widest uppercase">No Ads · No Logo · No Limits</p>
    </header>

    {{-- URL Input --}}
    <div class="flex gap-2 w-full max-w-[720px] mb-5">
        <input type="text" id="ytUrl"
            placeholder="Paste YouTube URL…  e.g. https://youtu.be/tgbNymZ7vqY"
            class="flex-1 bg-[#1f1f1f] border border-[#2a2a2a] rounded-lg text-[#f1f1f1] text-sm px-4 py-3 outline-none transition-colors placeholder:text-[#444]"/>
        <button onclick="loadVideo()"
            class="font-bebas tracking-[2px] text-base px-6 py-3 rounded-lg text-white whitespace-nowrap hover:opacity-90 active:scale-95 transition-all"
            style="background:var(--accent)">LOAD</button>
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

    {{-- Player Shell — NO overflow-hidden so box-shadow/border-radius themes show fully --}}
    <div class="player-shell w-full max-w-[720px] bg-black relative" id="playerShell"
         style="border-radius:16px; box-shadow:0 28px 80px rgba(0,0,0,.7);">

        {{-- 16:9 aspect ratio wrapper — overflow:hidden ONLY here to clip video area --}}
        <div class="relative bg-black" style="padding-top:56.25%; border-radius:inherit; overflow:hidden;">

            {{-- Placeholder --}}
            <div id="placeholder"
                 class="absolute inset-0 z-10 flex flex-col items-center justify-center gap-4 bg-[#080808] transition-opacity duration-300">
                <svg width="54" height="54" viewBox="0 0 24 24" fill="none" class="opacity-20">
                    <circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="1.2"/>
                    <path d="M10 8l6 4-6 4V8z" fill="#fff"/>
                </svg>
                <span class="text-[#444] text-sm tracking-wide">Paste a YouTube URL above and hit LOAD</span>
            </div>

            {{-- Watermark --}}
            <div id="watermark"
                 class="absolute top-3 right-3.5 z-20 rounded-md px-3 py-1 font-bebas text-sm tracking-[2px] text-white/65 pointer-events-none opacity-0 transition-opacity"
                 style="background:rgba(0,0,0,.52); backdrop-filter:blur(8px)">MY BRAND</div>

            {{-- embed.blade iframe — Video.js skin + hidden YouTube engine inside --}}
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
                <label class="block text-[#555] text-[11px] uppercase tracking-wide mb-1.5">Watermark Text</label>
                <input type="text" id="wmInput" placeholder="MY BRAND" oninput="updateWM(this.value)"
                       class="w-full bg-[#1f1f1f] border border-[#2a2a2a] rounded-md text-[#f1f1f1] text-sm px-3 py-2 outline-none placeholder:text-[#444]"/>
            </div>
        </div>

        @php
            $toggles = [
                ['wm',   'togWM',   false, 'Show Watermark'],
                ['auto', 'togAuto', true,  'Autoplay on Load'],
                ['loop', 'togLoop', false, 'Loop Video'],
            ];
        @endphp
        @foreach($toggles as $i => [$key, $id, $default, $label])
        <div class="flex items-center justify-between py-2.5 {{ $i < count($toggles)-1 ? 'border-b border-[#1c1c1c]' : '' }}">
            <span class="text-sm text-[#f1f1f1]">{{ $label }}</span>
            <button id="{{ $id }}" onclick="toggleOpt('{{ $key }}')"
                    class="toggle-btn relative w-[38px] h-[20px] rounded-full border-none cursor-pointer {{ $default ? 'on' : '' }}"
                    style="background:{{ $default ? 'var(--accent)' : '#2e2e2e' }}">
            </button>
        </div>
        @endforeach
    </div>

    {{-- Debug Panel --}}
    <div class="w-full max-w-[720px] mt-5" id="debugPanel">
        <div class="flex items-center justify-between mb-2">
            <button onclick="toggleDebug()"
                    class="flex items-center gap-2 text-xs text-[#555] hover:text-white transition-colors font-mono">
                <span id="debugArrow">▶</span>
                <span>DEBUG PANEL</span>
                <span id="debugBadge" class="bg-[#1f1f1f] text-[#555] px-2 py-0.5 rounded text-[10px]">0 events</span>
            </button>
            <div class="flex gap-2">
                <button onclick="copyDebugLog()"
                        class="text-[10px] text-[#555] hover:text-white bg-[#1f1f1f] px-2 py-1 rounded font-mono transition-colors">COPY LOG</button>
                <button onclick="clearDebugLog()"
                        class="text-[10px] text-[#555] hover:text-white bg-[#1f1f1f] px-2 py-1 rounded font-mono transition-colors">CLEAR</button>
            </div>
        </div>

        <div id="debugBody" class="hidden bg-[#0a0a0a] border border-[#222] rounded-xl overflow-hidden">
            {{-- Status bar --}}
            <div class="flex flex-wrap gap-3 px-4 py-3 border-b border-[#1a1a1a] text-[11px] font-mono">
                <span class="text-[#555]">ORIGIN: <span class="text-[#34d399]">{{ url('/') }}</span></span>
                <span class="text-[#555]">EMBED ROUTE: <span class="text-[#60a5fa]">{{ route('killerplayer.embed') }}</span></span>
                <span class="text-[#555]">YT STATE: <span id="dbgState" class="text-white">—</span></span>
                <span class="text-[#555]">ERRORS: <span id="dbgErrorCount" class="text-[#f87171]">0</span></span>
            </div>
            <div class="flex flex-wrap gap-3 px-4 py-2 border-b border-[#1a1a1a] text-[11px] font-mono">
                <span class="text-[#555]">IFRAME: <span id="dbgIframe" class="text-[#555]">—</span></span>
                <span class="text-[#555]">YT READY: <span id="dbgReady" class="text-[#555]">—</span></span>
                <span class="text-[#555]">VIDEO ID: <span id="dbgVid" class="text-[#fbbf24]">—</span></span>
            </div>
            <div id="debugLog" class="px-4 py-3 text-[11px] font-mono space-y-1"></div>
            <div class="px-4 py-3 border-t border-[#1a1a1a] text-[11px] font-mono text-[#444] space-y-1">
                <div class="text-[#555] mb-1">ERROR CODES:</div>
                <div><span class="text-[#f87171]">2</span> — Invalid videoId</div>
                <div><span class="text-[#f87171]">100</span> — Video not found or private</div>
                <div><span class="text-[#f87171]">101/150</span> — Owner disabled embedding</div>
                <div><span class="text-[#f87171]">152</span> — Origin rejected — check APP_URL in <span class="text-white">.env</span> matches your domain</div>
                <div><span class="text-[#f87171]">153</span> — Player config error</div>
            </div>
        </div>
    </div>

<script>
    let innerFrame = null;
    let videoId    = null;
    let debugOpen  = false;
    let logCount   = 0;
    let errorCount = 0;
    let opts       = { wm:false, auto:true, loop:false };
    let curAccent  = '#e63946';

    // ── Debug logger ──
    function log(level, msg, data) {
        logCount++;
        document.getElementById('debugBadge').textContent = logCount + ' events';
        const colors = { info:'log-info', success:'log-success', error:'log-error', cmd:'log-cmd', yt:'log-yt', warn:'log-warn' };
        const time   = new Date().toLocaleTimeString('en',{hour12:false});
        const line   = document.createElement('div');
        line.className = 'flex gap-2 items-start leading-relaxed';
        line.innerHTML = `
            <span class="text-[#333] flex-shrink-0 w-[60px]">${time}</span>
            <span class="flex-shrink-0 w-[52px] uppercase ${colors[level]||'text-white'}">${level}</span>
            <span class="text-[#ccc] flex-1">${msg}</span>
            ${data ? `<span class="text-[#555] truncate max-w-[180px] text-[10px]">${JSON.stringify(data)}</span>` : ''}
        `;
        const el = document.getElementById('debugLog');
        el.appendChild(line);
        el.scrollTop = el.scrollHeight;
        if (level === 'error') {
            errorCount++;
            document.getElementById('dbgErrorCount').textContent = errorCount;
            if (!debugOpen) toggleDebug();
        }
    }

    function toggleDebug() {
        debugOpen = !debugOpen;
        document.getElementById('debugBody').classList.toggle('hidden', !debugOpen);
        document.getElementById('debugArrow').textContent = debugOpen ? '▼' : '▶';
    }
    function clearDebugLog() {
        document.getElementById('debugLog').innerHTML = '';
        logCount = 0; errorCount = 0;
        document.getElementById('debugBadge').textContent = '0 events';
        document.getElementById('dbgErrorCount').textContent = '0';
    }
    function copyDebugLog() {
        const lines = [...document.querySelectorAll('#debugLog > div')]
            .map(l => l.textContent.replace(/\s+/g,' ').trim()).join('\n');
        navigator.clipboard.writeText(lines).then(() => {
            event.target.textContent='COPIED!';
            setTimeout(()=>event.target.textContent='COPY LOG',1500);
        });
    }

    // ── Build embed URL — includes accent color so inner player matches theme ──
    function embedUrl(id) {
        const p = new URLSearchParams({
            v:      id,
            auto:   opts.auto  ? '1':'0',
            loop:   opts.loop  ? '1':'0',
            accent: curAccent,
        });
        return `{{ route('killerplayer.embed') }}?${p}`;
    }

    function extractId(url) {
        const m = url.match(/(?:v=|youtu\.be\/|embed\/|shorts\/)([A-Za-z0-9_-]{11})/);
        return m ? m[1] : (/^[A-Za-z0-9_-]{11}$/.test(url) ? url : null);
    }

    function loadVideo() {
        const raw = document.getElementById('ytUrl').value.trim();
        const id  = extractId(raw);
        const inp = document.getElementById('ytUrl');
        if (!id) {
            inp.classList.add('shake');
            setTimeout(()=>inp.classList.remove('shake'),400);
            log('error','Could not extract a valid YouTube video ID',{input:raw});
            return;
        }
        videoId = id;
        document.getElementById('dbgVid').textContent = id;
        log('info',`Loading video ID: ${id}`);
        spawnInner(id);
    }

    function spawnInner(id) {
        const slot = document.getElementById('iframeSlot');
        slot.innerHTML = '';

        const url = embedUrl(id);
        log('info','Spawning embed iframe',{url});

        innerFrame = document.createElement('iframe');
        innerFrame.src = url;
        innerFrame.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;border:none;';
        innerFrame.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen';
        innerFrame.allowFullscreen = true;
        innerFrame.setAttribute('referrerpolicy','strict-origin-when-cross-origin');
        innerFrame.addEventListener('load', () => {
            document.getElementById('dbgIframe').textContent = 'loaded ✓';
            document.getElementById('dbgIframe').className   = 'text-[#34d399]';
            log('success','embed iframe loaded');
        });
        slot.appendChild(innerFrame);

        document.getElementById('placeholder').classList.add('opacity-0','pointer-events-none');
    }

    // ── Receive messages from embed.blade ──
    window.addEventListener('message', function(e) {
        let d;
        try { d = typeof e.data==='string' ? JSON.parse(e.data) : e.data; } catch { return; }
        if (!d) return;

        // Debug messages from embed.blade
        if (d._kp_debug) {
            log(d.level, d.msg, d.data);
            return;
        }

        // YouTube player events
        if (d.event === 'onReady') {
            document.getElementById('dbgReady').textContent = 'ready ✓';
            document.getElementById('dbgReady').className   = 'text-[#34d399]';
            log('success','YouTube engine ready ✓');
        }
        if (d.event === 'onStateChange') {
            const labels = {'-1':'unstarted','0':'ended','1':'▶ playing','2':'⏸ paused','3':'⏳ buffering','5':'cued'};
            document.getElementById('dbgState').textContent = labels[d.info]||d.info;
            log('yt',`state → ${labels[d.info]||d.info}`);
        }
        if (d.event === 'onError') {
            const errors = {
                2:'Invalid videoId',100:'Not found/private',
                101:'Embedding disabled',150:'Embedding disabled',
                152:'Origin rejected — check APP_URL in .env',153:'Player config error',
            };
            log('error',`YouTube Error ${d.data}: ${errors[d.data]||'unknown'}`,{code:d.data});
        }
    });

    // ── Send command to embed iframe ──
    function sendInner(obj) {
        if (innerFrame && innerFrame.contentWindow)
            innerFrame.contentWindow.postMessage(obj,'*');
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
        // Push accent into the live embed iframe so progress bar color updates
        sendInner({ cmd:'accent', value:c });
        // If video is loaded, respawn with new accent
        // (only needed for full re-render — postMessage handles live update above)
    }

    function updateWM(t) {
        document.getElementById('watermark').textContent = t || 'MY BRAND';
    }

    function toggleOpt(key) {
        opts[key] = !opts[key];
        const ids = { wm:'togWM', auto:'togAuto', loop:'togLoop' };
        const btn = document.getElementById(ids[key]);
        btn.classList.toggle('on', opts[key]);
        btn.style.background = opts[key] ? 'var(--accent)' : '#2e2e2e';
        if (key === 'wm') {
            document.getElementById('watermark').classList.toggle('opacity-0',  !opts[key]);
            document.getElementById('watermark').classList.toggle('opacity-100', opts[key]);
        }
        if ((key==='auto'||key==='loop') && videoId) spawnInner(videoId);
    }

    document.getElementById('ytUrl').addEventListener('keydown', e => {
        if (e.key==='Enter') loadVideo();
    });

    log('info','KillerPlayer ready',{origin:'{{ url('/') }}'});
</script>
</body>
</html>