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

        /* ═══════════════════════════════════════
           LAYER 1 — YouTube iframe
           200% height / -50% top = crops YT chrome
           overflow:hidden = clips end cards
           pointer-events:none = no YT clicks ever
        ═══════════════════════════════════════ */
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

        /* ═══════════════════════════════════════
           LAYER 2 — Pause/end cover
           Thumbnail shown when not playing.
           Hides YT suggestions & branding.
        ═══════════════════════════════════════ */
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

        /* ═══════════════════════════════════════
           LAYER 3 — Shield
        ═══════════════════════════════════════ */
        #shield { position:absolute; inset:0; z-index:3; pointer-events:none; }

        /* ═══════════════════════════════════════
           LAYER 4 — Our UI
        ═══════════════════════════════════════ */
        #player { position:absolute; inset:0; z-index:4; }
        #click-area { position:absolute; inset:0; cursor:pointer; }

        /* Centre button */
        #centre-btn {
            position:absolute; top:50%; left:50%;
            transform:translate(-50%,-50%) scale(1);
            width:72px; height:72px; border-radius:50%;
            background:rgba(0,0,0,0.62);
            backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px);
            border:2px solid rgba(255,255,255,0.18);
            display:flex; align-items:center; justify-content:center;
            opacity:0; pointer-events:none;
            transition:opacity .28s ease, transform .28s ease, background .18s;
            cursor:pointer;
        }
        #centre-btn svg { width:30px; height:30px; fill:#fff; transition:transform .15s; }
        #centre-btn:hover { background:rgba(0,0,0,0.82); }
        #centre-btn:hover svg { transform:scale(1.08); }
        #root.state-initial #centre-btn,
        #root.state-paused  #centre-btn,
        #root.state-ended   #centre-btn { opacity:1; pointer-events:auto; }
        #root.state-playing #centre-btn { opacity:0; transform:translate(-50%,-50%) scale(0.88); pointer-events:none; }
        #root.state-playing.centre-flash #centre-btn { opacity:1; transform:translate(-50%,-50%) scale(1); }
        @keyframes centrePulse {
            0%  { transform:translate(-50%,-50%) scale(1); }
            35% { transform:translate(-50%,-50%) scale(1.22); }
            70% { transform:translate(-50%,-50%) scale(0.95); }
            100%{ transform:translate(-50%,-50%) scale(1); }
        }
        #centre-btn.pulse { animation:centrePulse .38s cubic-bezier(.34,1.56,.64,1); }

        /* Spinner */
        #spinner {
            position:absolute; top:50%; left:50%;
            transform:translate(-50%,-50%);
            width:44px; height:44px; border-radius:50%;
            border:3px solid rgba(255,255,255,0.12);
            border-top-color:var(--accent,#e63946);
            opacity:0; pointer-events:none;
            transition:opacity .2s; animation:spin .85s linear infinite;
        }
        #root.state-buffering #spinner { opacity:1; }
        #root.state-buffering #centre-btn { opacity:0; pointer-events:none; }
        @keyframes spin { to { transform:translate(-50%,-50%) rotate(360deg); } }

        /* Control bar */
        #bar {
            position:absolute; bottom:0; left:0; right:0;
            padding:36px 14px 12px;
            background:linear-gradient(transparent,rgba(0,0,0,.88) 52%);
            opacity:0; transform:translateY(4px); pointer-events:none;
            transition:opacity .3s ease, transform .3s ease;
        }
        #player:hover #bar,
        #root.state-paused  #bar,
        #root.state-initial #bar,
        #root.state-ended   #bar { opacity:1; transform:translateY(0); pointer-events:auto; }

        /* Progress */
        .prog-wrap {
            width:100%; height:20px;
            display:flex; align-items:center;
            cursor:pointer; margin-bottom:8px; position:relative;
        }
        .prog-track {
            position:relative; width:100%; height:3px;
            background:rgba(255,255,255,.2); border-radius:3px;
            transition:height .15s; overflow:visible;
        }
        .prog-wrap:hover .prog-track { height:5px; }
        #prog-buf {
            position:absolute; left:0; top:0; height:100%;
            background:rgba(255,255,255,.28); border-radius:3px; width:0%;
        }
        #prog-fill {
            position:absolute; left:0; top:0; height:100%;
            background:var(--accent,#e63946); border-radius:3px; width:0%;
        }
        #prog-thumb {
            position:absolute; top:50%; left:0%;
            width:13px; height:13px; border-radius:50%; background:#fff;
            transform:translate(-50%,-50%); opacity:0; pointer-events:none;
            transition:opacity .15s;
        }
        .prog-wrap:hover #prog-thumb { opacity:1; }
        #prog-tip {
            position:absolute; bottom:22px;
            background:rgba(0,0,0,.78); color:#fff;
            font-size:11px; padding:2px 8px; border-radius:4px;
            transform:translateX(-50%); opacity:0; pointer-events:none;
            white-space:nowrap; left:0%;
        }

        /* Row */
        .row { display:flex; align-items:center; gap:4px; }
        .ibtn {
            background:none; border:none; color:rgba(255,255,255,.88);
            cursor:pointer; width:34px; height:34px; border-radius:7px;
            display:flex; align-items:center; justify-content:center;
            transition:color .15s, background .15s; flex-shrink:0;
        }
        .ibtn:hover { color:#fff; background:rgba(255,255,255,.1); }
        .ibtn svg { width:19px; height:19px; }
        #time-display {
            font-size:12px; color:rgba(255,255,255,.82);
            font-variant-numeric:tabular-nums; letter-spacing:.3px;
            flex:1; padding-left:4px;
        }
        .vol-group { display:flex; align-items:center; gap:4px; }
        #vol-slider {
            -webkit-appearance:none; width:0; height:3px;
            background:rgba(255,255,255,.25); border-radius:3px;
            outline:none; cursor:pointer; transition:width .22s ease;
        }
        .vol-group:hover #vol-slider { width:64px; }
        #vol-slider::-webkit-slider-thumb {
            -webkit-appearance:none; width:11px; height:11px;
            border-radius:50%; background:#fff; cursor:pointer;
        }
        #vol-slider::-moz-range-thumb {
            width:11px; height:11px; border-radius:50%;
            background:#fff; border:none; cursor:pointer;
        }
    </style>
</head>
<body>
<div id="root" class="state-initial">

    {{-- LAYER 1: YouTube — original structure untouched --}}
    <div id="yt-wrap">
        <iframe id="yt-engine" src=""
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin">
        </iframe>
    </div>

    {{-- LAYER 2: Pause cover --}}
    <div id="pause-cover"></div>

    {{-- LAYER 3: Shield --}}
    <div id="shield"></div>

    {{-- LAYER 4: UI --}}
    <div id="player">
        <div id="click-area" onclick="onPlayerClick()"></div>
        <div id="spinner"></div>

        <div id="centre-btn" onclick="onCentreClick()">
            <svg id="centre-ico" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
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
                    <svg id="play-ico" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </button>

                <button class="ibtn" onclick="skip(event,-10)" title="-10s">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="1 4 1 10 7 10"/>
                        <path d="M3.51 15a9 9 0 1 0 .49-4.95"/>
                        <text x="9" y="16" font-size="5.5" fill="currentColor" stroke="none" font-family="system-ui" font-weight="700" text-anchor="middle">10</text>
                    </svg>
                </button>

                <button class="ibtn" onclick="skip(event,10)" title="+10s">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 4 23 10 17 10"/>
                        <path d="M20.49 15a9 9 0 1 1-.49-4.95"/>
                        <text x="11.5" y="16" font-size="5.5" fill="currentColor" stroke="none" font-family="system-ui" font-weight="700" text-anchor="middle">10</text>
                    </svg>
                </button>

                <span id="time-display">0:00 / 0:00</span>

                <div class="vol-group" onclick="event.stopPropagation()">
                    <button class="ibtn" onclick="toggleMute(event)" title="Mute">
                        <svg id="vol-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                            <path id="vol-waves" d="M15.54 8.46a5 5 0 0 1 0 7.07M19.07 4.93a10 10 0 0 1 0 14.14"/>
                        </svg>
                    </button>
                    <input type="range" id="vol-slider" min="0" max="100" value="80"
                           oninput="setVolume(this.value)" onclick="event.stopPropagation()"/>
                </div>

                <button class="ibtn" onclick="toggleFullscreen(event)" title="Fullscreen">
                    <svg id="fs-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 3H5a2 2 0 0 0-2 2v3"/>
                        <path d="M21 8V5a2 2 0 0 0-2-2h-3"/>
                        <path d="M3 16v3a2 2 0 0 0 2 2h3"/>
                        <path d="M16 21h3a2 2 0 0 0 2-2v-3"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

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
const ytEngine   = document.getElementById('yt-engine');

// ── Debug ──────────────────────────────────────────────────────────────
function dbg(level, msg, data) {
    window.parent.postMessage({ _kp_debug:true, level, msg, data:data||null, ts:Date.now() }, '*');
}

// ── Thumbnail for pause cover ──────────────────────────────────────────
(function() {
    const sizes = ['maxresdefault','sddefault','hqdefault','mqdefault'];
    let i = 0;
    function next() {
        if (i >= sizes.length) return;
        const url = `https://i.ytimg.com/vi/${VIDEO_ID}/${sizes[i]}.jpg`;
        const img = new Image();
        img.onload = () => img.naturalWidth > 200
            ? (pauseCover.style.backgroundImage = `url('${url}')`)
            : (i++, next());
        img.onerror = () => (i++, next());
        img.src = url;
    }
    next();
})();

// ── Build iframe src ───────────────────────────────────────────────────
const p = new URLSearchParams({
    modestbranding:1, showinfo:0, rel:0, controls:0,
    disablekb:1, iv_load_policy:3, fs:0, cc_load_policy:0,
    playsinline:1, enablejsapi:1,
    autoplay: AUTOPLAY, loop: LOOP,
    origin: ORIGIN, widget_referrer: ORIGIN,
});
if (LOOP === '1') p.set('playlist', VIDEO_ID);
ytEngine.src = `https://www.youtube.com/embed/${VIDEO_ID}?${p}`;

// ── State ──────────────────────────────────────────────────────────────
let isPlaying = false, isMuted = false, seeking = false;
let curTime = 0, duration = 0;
let hideTimer = null, flashTimer = null;

// ── RAF interpolator ───────────────────────────────────────────────────
// YouTube's infoDelivery fires ~every 1s. Between those updates we use
// requestAnimationFrame + performance.now() to interpolate smoothly.
let rafId = null;
let anchor = { t: 0, ms: 0 }; // last confirmed YT time + wall clock at that moment

function rafTick() {
    if (isPlaying && !seeking && duration > 0) {
        const t = Math.min(duration, anchor.t + (performance.now() - anchor.ms) / 1000);
        drawProgress(t);
    }
    rafId = requestAnimationFrame(rafTick);
}
function startRaf() { if (!rafId) rafId = requestAnimationFrame(rafTick); }
function stopRaf()  { if (rafId) { cancelAnimationFrame(rafId); rafId = null; } }

// Call this whenever we get a confirmed time from YouTube.
// Resets the interpolation anchor so elapsed time counts from here.
function anchorTime(t) { anchor = { t, ms: performance.now() }; curTime = t; }

// ── THE LISTENING HANDSHAKE ────────────────────────────────────────────
// After sending this exact JSON to the iframe, YouTube begins streaming
// infoDelivery events (currentTime, duration, videoLoadedFraction…).
// Must include id + channel to match YT's internal widget protocol.
// We repeat every 500ms until the first infoDelivery confirms receipt.
let listenTimer = null;

function sendListening() {
    if (ytEngine.contentWindow) {
        ytEngine.contentWindow.postMessage(
            JSON.stringify({ event:'listening', id:1, channel:'widget' }),
            '*'
        );
    }
}

ytEngine.addEventListener('load', () => {
    dbg('info', 'iframe loaded — starting listening handshake');
    sendListening();
    listenTimer = setInterval(sendListening, 500);
});

// ── Icons ──────────────────────────────────────────────────────────────
const centreIco = document.getElementById('centre-ico');
const centreBtn = document.getElementById('centre-btn');
const playIco   = document.getElementById('play-ico');
const ICO_PLAY  = '<path d="M8 5v14l11-7z"/>';
const ICO_PAUSE = '<rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/>';

function setState(s) { root.className = 'state-' + s; }
function updatePlayIcon() { playIco.innerHTML = isPlaying ? ICO_PAUSE : ICO_PLAY; }

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

// ── Play / Pause ───────────────────────────────────────────────────────
function onPlayerClick() { togglePlay(null); }
function onCentreClick() { togglePlay(null); }

function togglePlay(e) {
    if (e) e.stopPropagation();
    if (isPlaying) {
        ytSend('pauseVideo');
        isPlaying = false; setState('paused');
        flashCentre('play'); updatePlayIcon(); stopRaf();
    } else {
        ytSend('playVideo');
        isPlaying = true; setState('playing');
        flashCentre('pause'); updatePlayIcon();
        scheduleHide(); anchorTime(curTime); startRaf();
    }
}
function scheduleHide() { clearTimeout(hideTimer); hideTimer = setTimeout(()=>{}, 2500); }

// ── Skip ──────────────────────────────────────────────────────────────
function skip(e, sec) {
    if (e) e.stopPropagation();
    if (!duration) return;
    const t = Math.max(0, Math.min(duration, curTime + sec));
    ytSend('seekTo', [t, true]);
    anchorTime(t);   // reset interpolation from new position
    drawProgress(t);
}

// ── Volume ────────────────────────────────────────────────────────────
function toggleMute(e) {
    if (e) e.stopPropagation();
    isMuted ? (ytSend('unMute'), isMuted=false) : (ytSend('mute'), isMuted=true);
    updateVolIcon();
}
function setVolume(v) {
    ytSend('setVolume', [+v]); isMuted = +v===0;
    isMuted ? ytSend('mute') : ytSend('unMute');
    updateVolIcon();
}
function updateVolIcon() {
    document.getElementById('vol-waves').setAttribute('d', isMuted
        ? 'M23 9l-6 6M17 9l6 6'
        : 'M15.54 8.46a5 5 0 0 1 0 7.07M19.07 4.93a10 10 0 0 1 0 14.14');
    document.getElementById('vol-ico').style.opacity = isMuted ? '0.45' : '1';
}

// ── Fullscreen ────────────────────────────────────────────────────────
function toggleFullscreen(e) {
    if (e) e.stopPropagation();
    const el = document.getElementById('root');
    document.fullscreenElement
        ? document.exitFullscreen()
        : (el.requestFullscreen||el.webkitRequestFullscreen).call(el);
}
document.addEventListener('fullscreenchange', () => {
    document.getElementById('fs-ico').innerHTML = document.fullscreenElement
        ? `<path d="M8 3v3a2 2 0 0 1-2 2H3"/><path d="M21 8h-3a2 2 0 0 1-2-2V3"/><path d="M3 16h3a2 2 0 0 0 2 2v3"/><path d="M16 21v-3a2 2 0 0 0-2-2h-3"/>`
        : `<path d="M8 3H5a2 2 0 0 0-2 2v3"/><path d="M21 8V5a2 2 0 0 0-2-2h-3"/><path d="M3 16v3a2 2 0 0 0 2 2h3"/><path d="M16 21h3a2 2 0 0 0 2-2v-3"/>`;
});

// ── Progress bar ──────────────────────────────────────────────────────
const progEl   = document.getElementById('prog');
const progFill = document.getElementById('prog-fill');
const progThumb= document.getElementById('prog-thumb');
const timeDisp = document.getElementById('time-display');
const progBuf  = document.getElementById('prog-buf');
const progTip  = document.getElementById('prog-tip');

function drawProgress(t) {
    curTime = t;
    const pct = duration > 0 ? Math.min(100, (t / duration) * 100) : 0;
    progFill.style.width  = pct + '%';
    progThumb.style.left  = pct + '%';
    timeDisp.textContent  = fmt(t) + ' / ' + fmt(duration);
}

function pxToTime(x) {
    const r = progEl.getBoundingClientRect();
    return Math.min(1, Math.max(0, (x - r.left) / r.width)) * duration;
}

progEl.addEventListener('mousedown', e => {
    if (!duration) return;
    e.stopPropagation(); seeking = true;
    drawProgress(pxToTime(e.clientX));
    const move = ev => { if (seeking) drawProgress(pxToTime(ev.clientX)); };
    const up   = ev => {
        seeking = false;
        const t = pxToTime(ev.clientX);
        ytSend('seekTo', [t, true]); anchorTime(t); drawProgress(t);
        document.removeEventListener('mousemove', move);
        document.removeEventListener('mouseup', up);
    };
    document.addEventListener('mousemove', move);
    document.addEventListener('mouseup', up);
});
progEl.addEventListener('mousemove', e => {
    if (!duration) return;
    const t = pxToTime(e.clientX);
    progTip.textContent = fmt(t);
    progTip.style.left = ((t/duration)*100) + '%';
    progTip.style.opacity = '1';
});
progEl.addEventListener('mouseleave', () => { progTip.style.opacity = '0'; });
progEl.addEventListener('touchstart', e => {
    if (!duration) return;
    e.preventDefault(); seeking = true;
    drawProgress(pxToTime(e.touches[0].clientX));
    const move = ev => { if (seeking) { ev.preventDefault(); drawProgress(pxToTime(ev.touches[0].clientX)); } };
    const end  = ev => {
        seeking = false;
        const t = pxToTime(ev.changedTouches[0].clientX);
        ytSend('seekTo', [t, true]); anchorTime(t); drawProgress(t);
        document.removeEventListener('touchmove', move);
        document.removeEventListener('touchend', end);
    };
    document.addEventListener('touchmove', move, { passive:false });
    document.addEventListener('touchend', end);
}, { passive:false });

// ── postMessage handler ───────────────────────────────────────────────
window.addEventListener('message', e => {

    // Commands from outer shell
    const d = e.data;
    if (d && typeof d === 'object' && !d._kp_debug && d.cmd) {
        if (d.cmd === 'play')   { ytSend('playVideo');  isPlaying=true;  setState('playing'); updatePlayIcon(); anchorTime(curTime); startRaf(); }
        if (d.cmd === 'pause')  { ytSend('pauseVideo'); isPlaying=false; setState('paused');  updatePlayIcon(); stopRaf(); }
        if (d.cmd === 'mute')   { ytSend('mute');   isMuted=true;  updateVolIcon(); }
        if (d.cmd === 'unmute') { ytSend('unMute'); isMuted=false; updateVolIcon(); }
        if (d.cmd === 'volume') { ytSend('setVolume',[+d.value]); document.getElementById('vol-slider').value=d.value; }
        if (d.cmd === 'seek' && duration > 0) { ytSend('seekTo',[d.value,true]); anchorTime(d.value); drawProgress(d.value); }
        if (d.cmd === 'accent') { document.documentElement.style.setProperty('--accent', d.value); }
        return;
    }

    // Only strings from YouTube (cross-origin iframes have e.source === null,
    // so we filter by origin instead of e.source)
    if (typeof e.data !== 'string') return;
    if (e.origin !== 'https://www.youtube.com' && e.origin !== 'https://www.youtube-nocookie.com') return;

    let yt;
    try { yt = JSON.parse(e.data); } catch(_) { return; }
    if (!yt || !yt.event) return;

    // onReady
    if (yt.event === 'onReady') {
        dbg('success', 'YT ready');
        ytSend('setVolume', [80]);
        if (AUTOPLAY === '1') {
            ytSend('playVideo');
            isPlaying = true; setState('playing');
            flashCentre('pause'); updatePlayIcon();
            scheduleHide(); anchorTime(0); startRaf();
        }
        window.parent.postMessage(yt, '*');
    }

    // onStateChange
    if (yt.event === 'onStateChange') {
        const s = yt.info;
        if (s === 1) {
            isPlaying = true; setState('playing'); updatePlayIcon();
            scheduleHide(); anchorTime(curTime); startRaf();
        }
        if (s === 2) {
            isPlaying = false; setState('paused');
            centreIco.innerHTML = ICO_PLAY; updatePlayIcon(); stopRaf();
        }
        if (s === 0) {
            isPlaying = false; setState('ended');
            centreIco.innerHTML = ICO_PLAY; updatePlayIcon();
            stopRaf(); anchorTime(0); drawProgress(0);
            if (LOOP === '1') {
                ytSend('playVideo'); isPlaying = true;
                setState('playing'); scheduleHide(); startRaf();
            }
        }
        if (s === 3) setState('buffering');
        if (s === -1) { anchorTime(0); drawProgress(0); setState('initial'); }
        dbg('yt', 'state→' + s);
        window.parent.postMessage(yt, '*');
    }

    // onError
    if (yt.event === 'onError') {
        const errs = {2:'Invalid videoId',100:'Not found',101:'Embed disabled',150:'Embed disabled',152:'Origin rejected',153:'Config error'};
        dbg('error', `YT error ${yt.data}: ${errs[yt.data]||'unknown'}`);
        window.parent.postMessage(yt, '*');
    }

    // ── infoDelivery ─────────────────────────────────────────────────
    // Activated by the "listening" handshake. YouTube streams this every
    // ~1s during playback with currentTime, duration, videoLoadedFraction.
    // We use currentTime as a sync anchor — RAF interpolates between updates.
    if (yt.event === 'infoDelivery' && yt.info) {
        const info = yt.info;

        // Kill listening interval — stream is confirmed active
        if (listenTimer) { clearInterval(listenTimer); listenTimer = null; dbg('success','infoDelivery active'); }

        if (info.duration != null && info.duration > 0) {
            duration = info.duration;
        }

        // Sync anchor from YouTube's confirmed currentTime
        // Skip if user is dragging the seek bar
        if (info.currentTime != null && !seeking) {
            anchorTime(info.currentTime);
            // If paused, draw immediately (RAF isn't running)
            if (!isPlaying) drawProgress(info.currentTime);
        }

        if (info.videoLoadedFraction != null) {
            progBuf.style.width = (info.videoLoadedFraction * 100) + '%';
        }

        window.parent.postMessage(yt, '*');
    }
});

// ── Send command ──────────────────────────────────────────────────────
function ytSend(func, args) {
    if (ytEngine && ytEngine.contentWindow) {
        ytEngine.contentWindow.postMessage(
            JSON.stringify({ event:'command', func, args:args||[], id:1, channel:'widget' }),
            '*'
        );
    }
}

// ── Format m:ss ───────────────────────────────────────────────────────
function fmt(s) {
    s = Math.floor(s||0);
    return Math.floor(s/60) + ':' + String(s%60).padStart(2,'0');
}
</script>
</body>
</html>