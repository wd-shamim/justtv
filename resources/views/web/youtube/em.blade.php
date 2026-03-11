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
           HIDDEN DATA IFRAME
           controls=1 so YouTube reliably sends infoDelivery
           (currentTime + duration) every ~250ms.
           Completely invisible — 1×1px, off-screen, muted, no
           interaction. Only purpose: feed us accurate time data.
        ═══════════════════════════════════════════════════ */
        #yt-data {
            position: fixed;
            top: -9999px;
            left: -9999px;
            width: 1px;
            height: 1px;
            opacity: 0;
            pointer-events: none;
            border: none;
        }

        /* ═══════════════════════════════════════════════════
           LAYER 2 — Pause cover
           Shows video thumbnail when not playing.
           Hides YT suggestions/branding on pause & end.
        ═══════════════════════════════════════════════════ */
        #pause-cover {
            position: absolute;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            opacity: 1;
            transition: opacity 0.25s ease;
            background: #000 center/cover no-repeat;
        }
        #root.state-playing   #pause-cover,
        #root.state-buffering #pause-cover { opacity: 0; }
        #root.state-initial   #pause-cover,
        #root.state-paused    #pause-cover,
        #root.state-ended     #pause-cover { opacity: 1; }

        /* ═══════════════════════════════════════════════════
           LAYER 3 — Shield + UI
        ═══════════════════════════════════════════════════ */
        #shield {
            position: absolute;
            inset: 0;
            z-index: 3;
            pointer-events: none;
        }

        #player {
            position: absolute;
            inset: 0;
            z-index: 4;
        }

        #click-area {
            position: absolute;
            inset: 0;
            cursor: pointer;
        }

        /* ── Centre button ── */
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
        #centre-btn svg { width:30px; height:30px; fill:#fff; transition:transform 0.15s; }
        #centre-btn:hover { background: rgba(0,0,0,0.82); }
        #centre-btn:hover svg { transform: scale(1.08); }

        #root.state-initial #centre-btn,
        #root.state-paused  #centre-btn,
        #root.state-ended   #centre-btn { opacity:1; pointer-events:auto; }
        #root.state-playing #centre-btn { opacity:0; transform:translate(-50%,-50%) scale(0.88); pointer-events:none; }
        #root.state-playing.centre-flash #centre-btn { opacity:1; transform:translate(-50%,-50%) scale(1); }

        @keyframes centrePulse {
            0%   { transform: translate(-50%,-50%) scale(1); }
            35%  { transform: translate(-50%,-50%) scale(1.22); }
            70%  { transform: translate(-50%,-50%) scale(0.95); }
            100% { transform: translate(-50%,-50%) scale(1); }
        }
        #centre-btn.pulse { animation: centrePulse 0.38s cubic-bezier(0.34,1.56,0.64,1); }

        /* ── Spinner ── */
        #spinner {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 44px; height: 44px;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,0.12);
            border-top-color: var(--accent, #e63946);
            opacity: 0; pointer-events: none;
            transition: opacity 0.2s;
            animation: spin 0.85s linear infinite;
        }
        #root.state-buffering #spinner { opacity: 1; }
        #root.state-buffering #centre-btn { opacity: 0; pointer-events: none; }
        @keyframes spin { to { transform: translate(-50%,-50%) rotate(360deg); } }

        /* ── Control bar ── */
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
        #root.state-ended   #bar { opacity:1; transform:translateY(0); pointer-events:auto; }

        /* ── Progress ── */
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
            border-radius: 3px; width: 0%;
        }
        #prog-fill {
            position: absolute; left:0; top:0; height:100%;
            background: var(--accent, #e63946);
            border-radius: 3px; width: 0%;
            transition: background 0.3s;
        }
        #prog-thumb {
            position: absolute; top:50%; left:0%;
            width: 13px; height: 13px;
            border-radius: 50%; background: #fff;
            transform: translate(-50%, -50%);
            opacity: 0; pointer-events: none;
            transition: opacity 0.15s;
        }
        .prog-wrap:hover #prog-thumb { opacity: 1; }

        #prog-tip {
            position: absolute; bottom: 22px;
            background: rgba(0,0,0,0.78); color: #fff;
            font-size: 11px; padding: 2px 8px;
            border-radius: 4px; transform: translateX(-50%);
            opacity: 0; pointer-events: none;
            white-space: nowrap; left: 0%;
        }

        /* ── Row ── */
        .row { display:flex; align-items:center; gap:4px; }

        .ibtn {
            background: none; border: none;
            color: rgba(255,255,255,0.88);
            cursor: pointer; width: 34px; height: 34px;
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
            flex: 1; padding-left: 4px;
        }

        .vol-group { display:flex; align-items:center; gap:4px; }
        #vol-slider {
            -webkit-appearance: none;
            width: 0; height: 3px;
            background: rgba(255,255,255,0.25);
            border-radius: 3px; outline: none; cursor: pointer;
            transition: width 0.22s ease;
        }
        .vol-group:hover #vol-slider { width: 64px; }
        #vol-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 11px; height: 11px;
            border-radius: 50%; background: #fff; cursor: pointer;
        }
        #vol-slider::-moz-range-thumb {
            width: 11px; height: 11px;
            border-radius: 50%; background: #fff; border: none; cursor: pointer;
        }
    </style>
</head>
<body>
<div id="root" class="state-initial">

    {{-- LAYER 1: Visible YouTube iframe — original structure, untouched --}}
    <div id="yt-wrap">
        <iframe id="yt-engine" src=""
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin">
        </iframe>
    </div>

    {{-- HIDDEN DATA IFRAME: controls=1 so YouTube sends reliable infoDelivery
         (currentTime + duration every ~250ms). Muted, 1×1px, off-screen. --}}
    <iframe id="yt-data" src=""
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        referrerpolicy="strict-origin-when-cross-origin">
    </iframe>

    {{-- LAYER 2: Pause cover — hides YT branding/suggestions --}}
    <div id="pause-cover"></div>

    {{-- LAYER 3: Shield --}}
    <div id="shield"></div>

    {{-- LAYER 4: Our UI --}}
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

            </div>
        </div>{{-- #bar --}}
    </div>{{-- #player --}}
</div>{{-- #root --}}

<script>
// ── Config ─────────────────────────────────────────────────────────────
const VIDEO_ID = @json($videoId);
const AUTOPLAY = @json($autoplay);
const LOOP     = @json($loop);
const ORIGIN   = '{{ url('/') }}';
const ACCENT   = new URLSearchParams(location.search).get('accent') || '#e63946';
document.documentElement.style.setProperty('--accent', ACCENT);

const root       = document.getElementById('root');
const pauseCover = document.getElementById('pause-cover');

// ── Debug ──────────────────────────────────────────────────────────────
function dbg(level, msg, data) {
    window.parent.postMessage({ _kp_debug:true, level, msg, data:data||null, ts:Date.now() }, '*');
}
dbg('info', 'embed loaded', { VIDEO_ID, AUTOPLAY, LOOP });

// ── Thumbnail for pause cover ──────────────────────────────────────────
(function loadThumb() {
    const sizes = ['maxresdefault','sddefault','hqdefault','mqdefault'];
    let i = 0;
    function next() {
        if (i >= sizes.length) { pauseCover.style.background = '#111'; return; }
        const url = `https://i.ytimg.com/vi/${VIDEO_ID}/${sizes[i]}.jpg`;
        const img = new Image();
        img.onload = () => { if (img.naturalWidth > 200) { pauseCover.style.backgroundImage = `url('${url}')`; } else { i++; next(); } };
        img.onerror = () => { i++; next(); };
        img.src = url;
    }
    next();
})();

// ── Shared iframe params ───────────────────────────────────────────────
const baseParams = {
    modestbranding: 1, showinfo: 0, rel: 0,
    disablekb: 1, iv_load_policy: 3, fs: 0,
    cc_load_policy: 0, playsinline: 1,
    enablejsapi: 1,
    origin:          ORIGIN,
    widget_referrer: ORIGIN,
    aoriginsup: 1, aorigins: ORIGIN, gporigin: ORIGIN + '/',
};

// ── VISIBLE iframe — controls=0, the player the user sees ─────────────
const visParams = new URLSearchParams({
    ...baseParams,
    controls: 0,
    autoplay: AUTOPLAY,
    loop:     LOOP,
    mute:     0,
});
if (LOOP === '1') visParams.set('playlist', VIDEO_ID);

const ytEngine = document.getElementById('yt-engine');
ytEngine.src = `https://www.youtube.com/embed/${VIDEO_ID}?${visParams}`;

// ── HIDDEN DATA iframe — controls=1, muted, synced ────────────────────
// controls=1 causes YouTube to send infoDelivery events with currentTime
// and duration reliably every ~250ms during playback. We use ONLY these
// events to drive our progress bar. The iframe is muted & hidden.
const dataParams = new URLSearchParams({
    ...baseParams,
    controls: 1,       // must be 1 — this is what triggers reliable infoDelivery
    autoplay: AUTOPLAY,
    loop:     LOOP,
    mute:     1,       // always muted — user never hears it
});
if (LOOP === '1') dataParams.set('playlist', VIDEO_ID);

const ytData = document.getElementById('yt-data');
ytData.src = `https://www.youtube.com/embed/${VIDEO_ID}?${dataParams}`;

// ── Player state ───────────────────────────────────────────────────────
let isPlaying  = false;
let isMuted    = false;
let curTime    = 0;
let duration   = 0;
let seeking    = false;
let hideTimer  = null;
let flashTimer = null;

// Track which iframe each postMessage came from
// so we know whether to update state or just progress data
function isDataFrame(e) { return e.source === ytData.contentWindow; }
function isVisFrame(e)  { return e.source === ytEngine.contentWindow; }

// ── Send command to BOTH iframes (keeps them in sync) ─────────────────
function sendBoth(func, args) {
    const msg = JSON.stringify({ event:'command', func, args: args||[] });
    if (ytEngine.contentWindow) ytEngine.contentWindow.postMessage(msg, '*');
    if (ytData.contentWindow)   ytData.contentWindow.postMessage(msg, '*');
}
// Send only to visible iframe (e.g. volume — data iframe is always muted)
function sendVis(func, args) {
    const msg = JSON.stringify({ event:'command', func, args: args||[] });
    if (ytEngine.contentWindow) ytEngine.contentWindow.postMessage(msg, '*');
}
// Send only to data iframe
function sendData(func, args) {
    const msg = JSON.stringify({ event:'command', func, args: args||[] });
    if (ytData.contentWindow) ytData.contentWindow.postMessage(msg, '*');
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
    centreBtn.addEventListener('animationend', () => centreBtn.classList.remove('pulse'), { once:true });
    if (icon === 'pause') {
        clearTimeout(flashTimer);
        root.classList.add('centre-flash');
        flashTimer = setTimeout(() => root.classList.remove('centre-flash'), 700);
    }
}
function updatePlayIcon() { playIco.innerHTML = isPlaying ? ICO_PAUSE : ICO_PLAY; }

// ── Play / Pause ───────────────────────────────────────────────────────
function onPlayerClick() { togglePlay(null); }
function onCentreClick() { togglePlay(null); }

function togglePlay(e) {
    if (e) e.stopPropagation();
    if (isPlaying) {
        sendBoth('pauseVideo');
        isPlaying = false;
        setState('paused');
        flashCentre('play');
        updatePlayIcon();
    } else {
        sendBoth('playVideo');
        isPlaying = true;
        setState('playing');
        flashCentre('pause');
        updatePlayIcon();
        scheduleHide();
    }
}
function scheduleHide() {
    clearTimeout(hideTimer);
    hideTimer = setTimeout(() => {}, 2500);
}

// ── Skip — send to both iframes so data iframe stays in sync ──────────
function skip(e, sec) {
    if (e) e.stopPropagation();
    if (!duration) return;
    const t = Math.max(0, Math.min(duration, curTime + sec));
    sendBoth('seekTo', [t, true]);
    curTime = t;
    updateProgress();
}

// ── Volume — only visible iframe (data is always muted) ───────────────
function toggleMute(e) {
    if (e) e.stopPropagation();
    if (isMuted) { sendVis('unMute'); isMuted = false; }
    else         { sendVis('mute');   isMuted = true;  }
    updateVolIcon();
}
function setVolume(v) {
    sendVis('setVolume', [+v]);
    isMuted = +v === 0;
    if (isMuted) sendVis('mute'); else sendVis('unMute');
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

// ── Progress bar — seek ───────────────────────────────────────────────
const progEl = document.getElementById('prog');

function pxToTime(clientX) {
    const rect = progEl.getBoundingClientRect();
    return Math.min(1, Math.max(0, (clientX - rect.left) / rect.width)) * duration;
}

progEl.addEventListener('mousedown', (e) => {
    if (!duration) return;
    e.stopPropagation();
    seeking = true;
    curTime = pxToTime(e.clientX);
    updateProgress();
    const onMove = ev => { if (seeking) { curTime = pxToTime(ev.clientX); updateProgress(); } };
    const onUp   = ev => {
        seeking = false;
        const t = pxToTime(ev.clientX);
        sendBoth('seekTo', [t, true]);
        curTime = t;
        updateProgress();
        document.removeEventListener('mousemove', onMove);
        document.removeEventListener('mouseup',   onUp);
    };
    document.addEventListener('mousemove', onMove);
    document.addEventListener('mouseup',   onUp);
});

progEl.addEventListener('mousemove', (e) => {
    if (!duration) return;
    const t   = pxToTime(e.clientX);
    const tip = document.getElementById('prog-tip');
    tip.textContent   = fmt(t);
    tip.style.left    = ((t / duration) * 100) + '%';
    tip.style.opacity = '1';
});
progEl.addEventListener('mouseleave', () => {
    document.getElementById('prog-tip').style.opacity = '0';
});

// Touch
progEl.addEventListener('touchstart', (e) => {
    if (!duration) return;
    e.preventDefault();
    seeking = true;
    curTime = pxToTime(e.touches[0].clientX);
    updateProgress();
    const onMove = ev => { if (seeking) { ev.preventDefault(); curTime = pxToTime(ev.touches[0].clientX); updateProgress(); } };
    const onEnd  = ev => {
        seeking = false;
        const t = pxToTime(ev.changedTouches[0].clientX);
        sendBoth('seekTo', [t, true]);
        curTime = t;
        updateProgress();
        document.removeEventListener('touchmove', onMove);
        document.removeEventListener('touchend',  onEnd);
    };
    document.addEventListener('touchmove', onMove, { passive:false });
    document.addEventListener('touchend',  onEnd);
}, { passive:false });

// ── postMessage handler ───────────────────────────────────────────────
window.addEventListener('message', function(e) {
    const d = e.data;

    // Commands from outer killerplayer shell
    if (d && typeof d === 'object' && !d._kp_debug && d.cmd) {
        if (d.cmd === 'play')   { sendBoth('playVideo');  isPlaying=true;  setState('playing'); updatePlayIcon(); }
        if (d.cmd === 'pause')  { sendBoth('pauseVideo'); isPlaying=false; setState('paused');  updatePlayIcon(); }
        if (d.cmd === 'mute')   { sendVis('mute');   isMuted=true;  updateVolIcon(); }
        if (d.cmd === 'unmute') { sendVis('unMute'); isMuted=false; updateVolIcon(); }
        if (d.cmd === 'volume') { sendVis('setVolume', [+d.value]); document.getElementById('vol-slider').value = d.value; }
        if (d.cmd === 'seek' && duration > 0) { sendBoth('seekTo', [d.value, true]); curTime = d.value; updateProgress(); }
        if (d.cmd === 'accent') { document.documentElement.style.setProperty('--accent', d.value); }
        return;
    }

    if (typeof e.data !== 'string') return;
    let yt;
    try { yt = JSON.parse(e.data); } catch (_) { return; }
    if (!yt || !yt.event) return;

    // ── onReady ──
    // Both iframes fire onReady. Track which one is ready.
    if (yt.event === 'onReady') {
        if (isVisFrame(e)) {
            dbg('success', 'visible iframe ready');
            sendVis('setVolume', [80]);
            if (AUTOPLAY === '1') {
                // Visible iframe autoplay already set via param — just update state
                isPlaying = true;
                setState('playing');
                flashCentre('pause');
                updatePlayIcon();
                scheduleHide();
            }
            window.parent.postMessage(yt, '*');
        }
        if (isDataFrame(e)) {
            dbg('success', 'data iframe ready');
            // Always keep data iframe muted
            sendData('mute');
            sendData('setVolume', [0]);
        }
    }

    // ── onStateChange ──
    // Only drive UI state from the VISIBLE iframe events.
    // Data iframe state changes are ignored for UI — we only want its time data.
    if (yt.event === 'onStateChange' && isVisFrame(e)) {
        const s = yt.info;
        if (s === 1) {
            isPlaying = true;
            setState('playing');
            updatePlayIcon();
            scheduleHide();
        }
        if (s === 2) {
            isPlaying = false;
            setState('paused');
            centreIco.innerHTML = ICO_PLAY;
            updatePlayIcon();
        }
        if (s === 0) {
            isPlaying = false;
            curTime   = 0;
            setState('ended');
            centreIco.innerHTML = ICO_PLAY;
            updatePlayIcon();
            updateProgress();
            if (LOOP === '1') {
                sendBoth('playVideo');
                isPlaying = true;
                setState('playing');
                scheduleHide();
            }
        }
        if (s === 3) setState('buffering');
        if (s === -1) { curTime = 0; updateProgress(); setState('initial'); }

        const labels = {'-1':'unstarted','0':'ended','1':'playing','2':'paused','3':'buffering','5':'cued'};
        dbg('yt', 'vis state → ' + (labels[s] !== undefined ? labels[s] : s));
        window.parent.postMessage(yt, '*');
    }

    // ── onError ──
    if (yt.event === 'onError' && isVisFrame(e)) {
        const errs = { 2:'Invalid videoId', 100:'Not found/private', 101:'Embedding disabled', 150:'Embedding disabled', 152:'Origin rejected', 153:'Player config error' };
        dbg('error', `YouTube error ${yt.data}: ${errs[yt.data]||'unknown'}`, { code: yt.data });
        window.parent.postMessage(yt, '*');
    }

    // ── infoDelivery — FROM DATA IFRAME ONLY ──────────────────────────
    // controls=1 on the data iframe causes YouTube to push currentTime and
    // duration every ~250ms during playback. This is the reliable data source
    // we were missing. We use it exclusively to update our progress bar.
    if (yt.event === 'infoDelivery' && yt.info && isDataFrame(e)) {
        const info = yt.info;

        if (info.duration != null && info.duration > 0) {
            duration = info.duration;
        }
        if (info.currentTime != null && !seeking) {
            curTime = info.currentTime;
            updateProgress();
        }
        if (info.videoLoadedFraction != null) {
            document.getElementById('prog-buf').style.width =
                (info.videoLoadedFraction * 100) + '%';
        }
    }

    // Also accept infoDelivery from visible iframe as fallback
    if (yt.event === 'infoDelivery' && yt.info && isVisFrame(e)) {
        const info = yt.info;
        if (info.duration != null && info.duration > 0 && duration === 0) {
            duration = info.duration;
            updateProgress();
        }
    }
});

// ── Format seconds → m:ss ─────────────────────────────────────────────
function fmt(s) {
    s = Math.floor(s || 0);
    return Math.floor(s / 60) + ':' + String(s % 60).padStart(2, '0');
}
</script>
</body>
</html>