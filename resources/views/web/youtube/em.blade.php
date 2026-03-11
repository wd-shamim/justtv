<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="referrer" content="strict-origin-when-cross-origin"/>
    <title>KP Embed</title>
    <style>
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        html, body {
            width:100%; height:100%;
            background:#000;
            overflow:hidden;
            font-family: system-ui, -apple-system, sans-serif;
            user-select: none;
        }

        /* ═══════════════════════════════════════════════════
           ROOT — everything lives here, fullscreen targets this
        ═══════════════════════════════════════════════════ */
        #root {
            position: absolute;
            inset: 0;
            background: #000;
        }

        /* ═══════════════════════════════════════════════════
           LAYER 1 — YouTube iframe (video engine only)
           • 200% height / -50% top = crops top & bottom YT bars
           • overflow:hidden on #yt-wrap = clips end-screen cards
           • pointer-events:none = YouTube NEVER receives clicks
        ═══════════════════════════════════════════════════ */
        #yt-wrap {
            position: absolute;
            inset: 0;
            overflow: hidden;
            z-index: 1;
        }
        #yt-engine {
            position: absolute;
            width: 100%;
            height: 200%;
            top: -50%;
            left: 0;
            border: none;
            pointer-events: none;
        }

        /* ═══════════════════════════════════════════════════
           LAYER 2 — Pause / end suggestion blocker
           Shows video thumbnail when not playing so YouTube's
           suggestion grid, title bar bleed, and branding are
           hidden. Fades to transparent the moment play starts.
        ═══════════════════════════════════════════════════ */
        #pause-cover {
            position: absolute;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            opacity: 1;  /* starts visible — hides initial YT branding */
            transition: opacity 0.25s ease;
            background: #000 center/cover no-repeat;
        }
        #root.state-playing   #pause-cover,
        #root.state-buffering #pause-cover { opacity: 0; }
        #root.state-initial   #pause-cover,
        #root.state-paused    #pause-cover,
        #root.state-ended     #pause-cover { opacity: 1; }

        /* ═══════════════════════════════════════════════════
           LAYER 3 — Transparent shield
           Sits above YouTube, below our UI.
           Ensures no YouTube overlay can ever intercept a click.
        ═══════════════════════════════════════════════════ */
        #shield {
            position: absolute;
            inset: 0;
            z-index: 3;
            pointer-events: none;
        }

        /* ═══════════════════════════════════════════════════
           LAYER 4 — Our player UI
        ═══════════════════════════════════════════════════ */
        #player {
            position: absolute;
            inset: 0;
            z-index: 4;
        }

        /* ── Clickable area (whole player) ── */
        #click-area {
            position: absolute;
            inset: 0;
            cursor: pointer;
        }

        /* ═══════════════════════════════════════════════════
           BIG CENTRE BUTTON
        ═══════════════════════════════════════════════════ */
        #centre-btn {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%) scale(1);
            width: 72px; height: 72px;
            border-radius: 50%;
            background: rgba(0,0,0,0.62);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 2px solid rgba(255,255,255,0.18);
            display: flex; align-items: center; justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.28s ease, transform 0.28s ease, background 0.18s;
            cursor: pointer;
        }
        #centre-btn svg {
            width: 30px; height: 30px;
            fill: #fff;
            transition: transform 0.15s;
        }
        #centre-btn:hover { background: rgba(0,0,0,0.82); }
        #centre-btn:hover svg { transform: scale(1.08); }

        #root.state-initial #centre-btn,
        #root.state-paused  #centre-btn,
        #root.state-ended   #centre-btn {
            opacity: 1;
            pointer-events: auto;
        }
        #root.state-playing #centre-btn {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.88);
            pointer-events: none;
        }
        #root.state-playing.centre-flash #centre-btn {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        @keyframes centrePulse {
            0%   { transform: translate(-50%,-50%) scale(1); }
            35%  { transform: translate(-50%,-50%) scale(1.22); }
            70%  { transform: translate(-50%,-50%) scale(0.95); }
            100% { transform: translate(-50%,-50%) scale(1); }
        }
        #centre-btn.pulse {
            animation: centrePulse 0.38s cubic-bezier(0.34,1.56,0.64,1);
        }

        /* ═══════════════════════════════════════════════════
           BUFFERING SPINNER
        ═══════════════════════════════════════════════════ */
        #spinner {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 44px; height: 44px;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,0.12);
            border-top-color: var(--accent, #e63946);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
            animation: spin 0.85s linear infinite;
        }
        #root.state-buffering #spinner { opacity: 1; }
        #root.state-buffering #centre-btn { opacity: 0; pointer-events: none; }
        @keyframes spin { to { transform: translate(-50%,-50%) rotate(360deg); } }

        /* ═══════════════════════════════════════════════════
           CONTROL BAR
        ═══════════════════════════════════════════════════ */
        #bar {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 36px 14px 12px;
            background: linear-gradient(transparent, rgba(0,0,0,0.88) 52%);
            opacity: 0;
            transform: translateY(4px);
            pointer-events: none;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        #player:hover #bar,
        #root.state-paused  #bar,
        #root.state-initial #bar,
        #root.state-ended   #bar {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        /* ── Progress track ── */
        .prog-wrap {
            width: 100%;
            height: 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-bottom: 8px;
            position: relative;
        }
        .prog-track {
            position: relative;
            width: 100%;
            height: 3px;
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
            transition: height 0.15s;
            overflow: visible;
        }
        .prog-wrap:hover .prog-track { height: 5px; }

        #prog-buf {
            position: absolute; left:0; top:0; height:100%;
            background: rgba(255,255,255,0.28);
            border-radius: 3px;
            width: 0%;
        }
        #prog-fill {
            position: absolute; left:0; top:0; height:100%;
            background: var(--accent, #e63946);
            border-radius: 3px;
            width: 0%;
            transition: background 0.3s;
        }
        #prog-thumb {
            position: absolute; top:50%; left:0%;
            width: 13px; height: 13px;
            border-radius: 50%;
            background: #fff;
            transform: translate(-50%, -50%);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.15s;
        }
        .prog-wrap:hover #prog-thumb { opacity: 1; }

        #prog-tip {
            position: absolute;
            bottom: 22px;
            background: rgba(0,0,0,0.78);
            color: #fff;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 4px;
            transform: translateX(-50%);
            opacity: 0;
            pointer-events: none;
            white-space: nowrap;
            left: 0%;
        }

        /* ── Bottom row ── */
        .row {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .ibtn {
            background: none;
            border: none;
            color: rgba(255,255,255,0.88);
            cursor: pointer;
            width: 34px; height: 34px;
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            transition: color 0.15s, background 0.15s;
            flex-shrink: 0;
        }
        .ibtn:hover { color:#fff; background: rgba(255,255,255,0.1); }
        .ibtn svg { width:19px; height:19px; }

        #time-display {
            font-size: 12px;
            color: rgba(255,255,255,0.82);
            font-variant-numeric: tabular-nums;
            letter-spacing: 0.3px;
            flex: 1;
            padding-left: 4px;
        }

        .vol-group { display:flex; align-items:center; gap:4px; }
        #vol-slider {
            -webkit-appearance: none;
            width: 0;
            height: 3px;
            background: rgba(255,255,255,0.25);
            border-radius: 3px;
            outline: none;
            cursor: pointer;
            transition: width 0.22s ease;
        }
        .vol-group:hover #vol-slider { width: 64px; }
        #vol-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 11px; height: 11px;
            border-radius: 50%;
            background: #fff;
            cursor: pointer;
        }
        #vol-slider::-moz-range-thumb {
            width: 11px; height: 11px;
            border-radius: 50%;
            background: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div id="root" class="state-initial">

    {{-- LAYER 1: YouTube iframe (original approach — no crop change) --}}
    <div id="yt-wrap">
        <iframe id="yt-engine" src=""
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin">
        </iframe>
    </div>

    {{-- LAYER 2: Pause cover — hides YT suggestions/branding when not playing --}}
    <div id="pause-cover"></div>

    {{-- LAYER 3: Transparent shield --}}
    <div id="shield"></div>

    {{-- LAYER 4: Our custom player UI --}}
    <div id="player">

        <div id="click-area" onclick="onPlayerClick()"></div>

        <div id="spinner"></div>

        <div id="centre-btn" onclick="onCentreClick()">
            <svg id="centre-ico" viewBox="0 0 24 24">
                <path d="M8 5v14l11-7z"/>
            </svg>
        </div>

        <div id="bar">

            <div class="prog-wrap" id="prog">
                <div class="prog-track">
                    <div id="prog-buf"></div>
                    <div id="prog-fill"></div>
                    <div id="prog-thumb"></div>
                    <div id="prog-tip">0:00</div>
                </div>
            </div>

            <div class="row">

                <button class="ibtn" onclick="togglePlay(event)" title="Play/Pause">
                    <svg id="play-ico" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </button>

                <button class="ibtn" onclick="skip(event,-10)" title="-10s">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="1 4 1 10 7 10"/>
                        <path d="M3.51 15a9 9 0 1 0 .49-4.95"/>
                        <text x="9" y="16" font-size="5.5" fill="currentColor" stroke="none"
                              font-family="system-ui" font-weight="700" text-anchor="middle">10</text>
                    </svg>
                </button>

                <button class="ibtn" onclick="skip(event,10)" title="+10s">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 4 23 10 17 10"/>
                        <path d="M20.49 15a9 9 0 1 1-.49-4.95"/>
                        <text x="11.5" y="16" font-size="5.5" fill="currentColor" stroke="none"
                              font-family="system-ui" font-weight="700" text-anchor="middle">10</text>
                    </svg>
                </button>

                <span id="time-display">0:00 / 0:00</span>

                <div class="vol-group" onclick="event.stopPropagation()">
                    <button class="ibtn" onclick="toggleMute(event)" title="Mute">
                        <svg id="vol-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                            <path id="vol-waves" d="M15.54 8.46a5 5 0 0 1 0 7.07M19.07 4.93a10 10 0 0 1 0 14.14"/>
                        </svg>
                    </button>
                    <input type="range" id="vol-slider" min="0" max="100" value="80"
                           oninput="setVolume(this.value)"
                           onclick="event.stopPropagation()"/>
                </div>

                <button class="ibtn" onclick="toggleFullscreen(event)" title="Fullscreen">
                    <svg id="fs-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 3H5a2 2 0 0 0-2 2v3"/>
                        <path d="M21 8V5a2 2 0 0 0-2-2h-3"/>
                        <path d="M3 16v3a2 2 0 0 0 2 2h3"/>
                        <path d="M16 21h3a2 2 0 0 0 2-2v-3"/>
                    </svg>
                </button>

            </div>{{-- .row --}}
        </div>{{-- #bar --}}
    </div>{{-- #player --}}
</div>{{-- #root --}}

<script>
// ── Config from Laravel ────────────────────────────────────────────────
const VIDEO_ID = @json($videoId);
const AUTOPLAY = @json($autoplay);
const LOOP     = @json($loop);
const ORIGIN   = '{{ url('/') }}';
const ACCENT   = new URLSearchParams(location.search).get('accent') || '#e63946';
document.documentElement.style.setProperty('--accent', ACCENT);

const root       = document.getElementById('root');
const pauseCover = document.getElementById('pause-cover');

// ── Debug broadcaster ──────────────────────────────────────────────────
function dbg(level, msg, data) {
    window.parent.postMessage({ _kp_debug:true, level, msg, data:data||null, ts:Date.now() }, '*');
}
dbg('info', 'embed loaded', { VIDEO_ID, AUTOPLAY, LOOP, ORIGIN });

// ── Load thumbnail for pause cover ────────────────────────────────────
// Tries best quality first, falls back down the chain.
// This image shows whenever paused/ended/initial — hides YT suggestions.
(function loadThumb() {
    const sizes = ['maxresdefault', 'sddefault', 'hqdefault', 'mqdefault'];
    let i = 0;
    function tryNext() {
        if (i >= sizes.length) { pauseCover.style.background = '#000'; return; }
        const url = `https://i.ytimg.com/vi/${VIDEO_ID}/${sizes[i]}.jpg`;
        const img = new Image();
        img.onload = function() {
            // ytimg returns a tiny grey tile (120×90) for missing sizes — skip it
            if (img.naturalWidth > 200) {
                pauseCover.style.backgroundImage = `url('${url}')`;
            } else { i++; tryNext(); }
        };
        img.onerror = function() { i++; tryNext(); };
        img.src = url;
    }
    tryNext();
})();

// ── Build YouTube iframe src ───────────────────────────────────────────
const ytParams = new URLSearchParams({
    modestbranding:  1,
    showinfo:        0,
    rel:             0,
    controls:        0,
    disablekb:       1,
    iv_load_policy:  3,
    fs:              0,
    cc_load_policy:  0,
    playsinline:     1,
    enablejsapi:     1,   // ← required for postMessage API + infoDelivery events
    autoplay:        AUTOPLAY,
    loop:            LOOP,
    origin:          ORIGIN,
    widget_referrer: ORIGIN,
    aoriginsup:      1,
    aorigins:        ORIGIN,
    gporigin:        ORIGIN + '/',
});
// playlist must only be set when looping — empty string = "Video unavailable"
if (LOOP === '1') ytParams.set('playlist', VIDEO_ID);

const ytFrame = document.getElementById('yt-engine');
ytFrame.src = `https://www.youtube.com/embed/${VIDEO_ID}?${ytParams}`;
ytFrame.addEventListener('load', () => dbg('success', 'YT iframe loaded'));

// ── Player state ───────────────────────────────────────────────────────
let isPlaying  = false;
let isMuted    = false;
let curTime    = 0;   // seconds — synced from infoDelivery, ticked locally
let duration   = 0;   // seconds — set once from infoDelivery
let seeking    = false;
let hideTimer  = null;
let flashTimer = null;

// ── Local progress ticker ──────────────────────────────────────────────
// infoDelivery gives us currentTime when YT decides to send it (unreliable
// cadence). We use it to SYNC our local ticker, which then runs every 250ms
// to keep the bar smooth. On seek/skip we reset the ticker base.
let tickId  = null;
let tickBase = { t: 0, ms: 0 }; // { t: seconds at base, ms: performance.now() at base }

function startTick() {
    if (tickId) return;
    syncTickBase(curTime);
    tickId = setInterval(tickProgress, 250);
}
function stopTick() {
    clearInterval(tickId);
    tickId = null;
}
function syncTickBase(t) {
    tickBase = { t, ms: performance.now() };
    curTime  = t;
}
function tickProgress() {
    if (!isPlaying || seeking || duration <= 0) return;
    const elapsed = (performance.now() - tickBase.ms) / 1000;
    curTime = Math.min(duration, tickBase.t + elapsed);
    updateProgress();
}

// ── State machine ──────────────────────────────────────────────────────
function setState(s) { root.className = 'state-' + s; }

// ── Icons ──────────────────────────────────────────────────────────────
const centreIco = document.getElementById('centre-ico');
const centreBtn = document.getElementById('centre-btn');
const playIco   = document.getElementById('play-ico');
const ICO_PLAY  = '<path d="M8 5v14l11-7z"/>';
const ICO_PAUSE = '<rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/>';

function flashCentre(icon) {
    centreIco.innerHTML = icon === 'pause' ? ICO_PAUSE : ICO_PLAY;
    centreBtn.classList.remove('pulse');
    void centreBtn.offsetWidth;
    centreBtn.classList.add('pulse');
    centreBtn.addEventListener('animationend', () => centreBtn.classList.remove('pulse'), { once: true });
    if (icon === 'pause') {
        clearTimeout(flashTimer);
        root.classList.add('centre-flash');
        flashTimer = setTimeout(() => root.classList.remove('centre-flash'), 700);
    }
}
function updatePlayIcon() {
    playIco.innerHTML = isPlaying ? ICO_PAUSE : ICO_PLAY;
}

// ── Click / toggle ────────────────────────────────────────────────────
function onPlayerClick() { togglePlay(null); }
function onCentreClick() { togglePlay(null); }

function togglePlay(e) {
    if (e) e.stopPropagation();
    if (isPlaying) {
        ytSend('pauseVideo');
        isPlaying = false;
        setState('paused');
        flashCentre('play');
        updatePlayIcon();
        stopTick();
    } else {
        ytSend('playVideo');
        isPlaying = true;
        setState('playing');
        flashCentre('pause');
        updatePlayIcon();
        scheduleHide();
        startTick();
    }
}

function scheduleHide() {
    clearTimeout(hideTimer);
    hideTimer = setTimeout(() => {}, 2500);
}

// ── Skip ──────────────────────────────────────────────────────────────
function skip(e, sec) {
    if (e) e.stopPropagation();
    if (!duration) return;
    // clamp to [0, duration]
    const t = Math.max(0, Math.min(duration, curTime + sec));
    ytSend('seekTo', [t, true]);
    syncTickBase(t);   // reset ticker base so it counts from new position
    updateProgress();
}

// ── Volume ────────────────────────────────────────────────────────────
function toggleMute(e) {
    if (e) e.stopPropagation();
    if (isMuted) { ytSend('unMute'); isMuted = false; }
    else         { ytSend('mute');   isMuted = true;  }
    updateVolIcon();
}
function setVolume(v) {
    ytSend('setVolume', [+v]);
    isMuted = +v === 0;
    if (isMuted) ytSend('mute'); else ytSend('unMute');
    updateVolIcon();
}
function updateVolIcon() {
    const waves = document.getElementById('vol-waves');
    if (isMuted) {
        waves.setAttribute('d', 'M23 9l-6 6M17 9l6 6');
        document.getElementById('vol-ico').style.opacity = '0.45';
    } else {
        waves.setAttribute('d', 'M15.54 8.46a5 5 0 0 1 0 7.07M19.07 4.93a10 10 0 0 1 0 14.14');
        document.getElementById('vol-ico').style.opacity = '1';
    }
}

// ── Fullscreen ────────────────────────────────────────────────────────
function toggleFullscreen(e) {
    if (e) e.stopPropagation();
    const el = document.getElementById('root');
    if (!document.fullscreenElement) {
        (el.requestFullscreen || el.webkitRequestFullscreen).call(el)
            .catch(err => dbg('warn', 'Fullscreen failed', { err: err.message }));
    } else {
        document.exitFullscreen();
    }
}
document.addEventListener('fullscreenchange', () => {
    const ico = document.getElementById('fs-ico');
    ico.innerHTML = document.fullscreenElement
        ? `<path d="M8 3v3a2 2 0 0 1-2 2H3"/>
           <path d="M21 8h-3a2 2 0 0 1-2-2V3"/>
           <path d="M3 16h3a2 2 0 0 0 2 2v3"/>
           <path d="M16 21v-3a2 2 0 0 0-2-2h-3"/>`
        : `<path d="M8 3H5a2 2 0 0 0-2 2v3"/>
           <path d="M21 8V5a2 2 0 0 0-2-2h-3"/>
           <path d="M3 16v3a2 2 0 0 0 2 2h3"/>
           <path d="M16 21h3a2 2 0 0 0 2-2v-3"/>`;
});

// ── Progress bar — render ─────────────────────────────────────────────
function updateProgress() {
    const pct = duration > 0 ? Math.min(100, (curTime / duration) * 100) : 0;
    document.getElementById('prog-fill').style.width  = pct + '%';
    document.getElementById('prog-thumb').style.left  = pct + '%';
    document.getElementById('time-display').textContent = fmt(curTime) + ' / ' + fmt(duration);
}

// ── Progress bar — seek (mouse) ───────────────────────────────────────
const progEl = document.getElementById('prog');

progEl.addEventListener('mousedown', function(e) {
    if (!duration) return;
    e.stopPropagation();
    seeking = true;
    doSeek(e.clientX);
    const onMove = ev => { if (seeking) doSeek(ev.clientX); };
    const onUp   = ev => {
        const t = pxToTime(ev.clientX);
        ytSend('seekTo', [t, true]);
        syncTickBase(t);
        seeking = false;
        document.removeEventListener('mousemove', onMove);
        document.removeEventListener('mouseup',   onUp);
    };
    document.addEventListener('mousemove', onMove);
    document.addEventListener('mouseup',   onUp);
});

progEl.addEventListener('mousemove', function(e) {
    if (!duration) return;
    const t   = pxToTime(e.clientX);
    const tip = document.getElementById('prog-tip');
    tip.textContent   = fmt(t);
    tip.style.left    = ((t / duration) * 100) + '%';
    tip.style.opacity = '1';
});
progEl.addEventListener('mouseleave', function() {
    document.getElementById('prog-tip').style.opacity = '0';
});

// ── Progress bar — seek (touch) ───────────────────────────────────────
progEl.addEventListener('touchstart', function(e) {
    if (!duration) return;
    e.preventDefault();
    seeking = true;
    doSeek(e.touches[0].clientX);
    const onMove = ev => { if (seeking) { ev.preventDefault(); doSeek(ev.touches[0].clientX); } };
    const onEnd  = ev => {
        const t = pxToTime(ev.changedTouches[0].clientX);
        ytSend('seekTo', [t, true]);
        syncTickBase(t);
        seeking = false;
        document.removeEventListener('touchmove', onMove);
        document.removeEventListener('touchend',  onEnd);
    };
    document.addEventListener('touchmove', onMove, { passive: false });
    document.addEventListener('touchend',  onEnd);
}, { passive: false });

function pxToTime(clientX) {
    const rect = progEl.getBoundingClientRect();
    return Math.min(1, Math.max(0, (clientX - rect.left) / rect.width)) * duration;
}
function doSeek(clientX) {
    curTime = pxToTime(clientX);
    updateProgress();
}

// ── postMessage handler ───────────────────────────────────────────────
window.addEventListener('message', function(e) {
    const d = e.data;

    // ── Commands from outer killerplayer shell ──
    if (d && typeof d === 'object' && !d._kp_debug && d.cmd) {
        if (d.cmd === 'play')   { ytSend('playVideo');  isPlaying=true;  setState('playing'); updatePlayIcon(); startTick(); }
        if (d.cmd === 'pause')  { ytSend('pauseVideo'); isPlaying=false; setState('paused');  updatePlayIcon(); stopTick();  }
        if (d.cmd === 'mute')   { ytSend('mute');   isMuted=true;  updateVolIcon(); }
        if (d.cmd === 'unmute') { ytSend('unMute'); isMuted=false; updateVolIcon(); }
        if (d.cmd === 'volume') {
            ytSend('setVolume', [+d.value]);
            document.getElementById('vol-slider').value = d.value;
        }
        if (d.cmd === 'seek' && duration > 0) {
            ytSend('seekTo', [d.value, true]);
            syncTickBase(d.value);
            updateProgress();
        }
        if (d.cmd === 'accent') {
            document.documentElement.style.setProperty('--accent', d.value);
        }
        return;
    }

    // ── Events from YouTube iframe ──
    if (typeof e.data !== 'string') return;
    let yt;
    try { yt = JSON.parse(e.data); } catch (_) { return; }
    if (!yt || !yt.event) return;

    // onReady
    if (yt.event === 'onReady') {
        dbg('success', 'YouTube engine ready ✓');
        ytSend('setVolume', [80]);
        if (AUTOPLAY === '1') {
            ytSend('playVideo');
            isPlaying = true;
            setState('playing');
            flashCentre('pause');
            updatePlayIcon();
            scheduleHide();
            startTick();
        }
        window.parent.postMessage(yt, '*');
    }

    // onStateChange
    if (yt.event === 'onStateChange') {
        const s = yt.info;
        if (s === 1) {  // playing
            isPlaying = true;
            setState('playing');
            updatePlayIcon();
            scheduleHide();
            startTick();
        }
        if (s === 2) {  // paused
            isPlaying = false;
            setState('paused');
            centreIco.innerHTML = ICO_PLAY;
            updatePlayIcon();
            stopTick();
        }
        if (s === 0) {  // ended — reset curTime so skip starts clean on replay
            isPlaying = false;
            curTime   = 0;
            setState('ended');
            centreIco.innerHTML = ICO_PLAY;
            updatePlayIcon();
            stopTick();
            updateProgress();
            if (LOOP === '1') {
                ytSend('playVideo');
                isPlaying = true;
                syncTickBase(0);
                setState('playing');
                scheduleHide();
                startTick();
            }
        }
        if (s === 3) setState('buffering');
        if (s === -1) { // unstarted / restarted — reset
            curTime = 0;
            syncTickBase(0);
            setState('initial');
            updateProgress();
        }
        const labels = {'-1':'unstarted','0':'ended','1':'playing','2':'paused','3':'buffering','5':'cued'};
        dbg('yt', `state → ${labels[s] !== undefined ? labels[s] : s}`);
        window.parent.postMessage(yt, '*');
    }

    // onError
    if (yt.event === 'onError') {
        const errs = {
            2:'Invalid videoId', 100:'Not found/private',
            101:'Embedding disabled', 150:'Embedding disabled',
            152:'Origin rejected — check APP_URL in .env', 153:'Player config error',
        };
        dbg('error', `YouTube error ${yt.data}: ${errs[yt.data]||'unknown'}`, { code: yt.data });
        window.parent.postMessage(yt, '*');
    }

    // infoDelivery — YouTube sends currentTime + duration here during playback.
    // We use this to SYNC our local ticker (corrects drift every time YT sends it).
    // We never rely on it as the sole source — the ticker fills in between.
    if (yt.event === 'infoDelivery' && yt.info) {
        const info = yt.info;

        // Sync duration as soon as we get it
        if (info.duration != null && info.duration > 0 && duration !== info.duration) {
            duration = info.duration;
            dbg('info', 'duration: ' + fmt(duration));
            updateProgress();
        }

        // Sync currentTime — only update ticker base, don't overwrite during seek
        if (info.currentTime != null && !seeking) {
            // Only resync if drift > 1s to avoid jitter from stale YT messages
            if (Math.abs(info.currentTime - curTime) > 1 || !isPlaying) {
                syncTickBase(info.currentTime);
                updateProgress();
            }
        }

        // Buffer bar
        if (info.videoLoadedFraction != null) {
            document.getElementById('prog-buf').style.width =
                (info.videoLoadedFraction * 100) + '%';
        }

        window.parent.postMessage(yt, '*');
    }
});

// ── Send command to YouTube iframe ────────────────────────────────────
function ytSend(func, args) {
    const eng = document.getElementById('yt-engine');
    if (eng && eng.contentWindow)
        eng.contentWindow.postMessage(
            JSON.stringify({ event: 'command', func, args: args || [] }), '*'
        );
}

// ── Format seconds → m:ss ─────────────────────────────────────────────
function fmt(s) {
    s = Math.floor(s || 0);
    return Math.floor(s / 60) + ':' + String(s % 60).padStart(2, '0');
}
</script>
</body>
</html>