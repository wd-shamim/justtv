<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="referrer" content="strict-origin-when-cross-origin"/>
    <title>KP Embed</title>
    <style>
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html, body { width:100%; height:100%; background:#000; overflow:hidden;
            font-family:system-ui,-apple-system,sans-serif; user-select:none; }
        #root { position:absolute; inset:0; background:#000; }

        /* ══ LAYER 1 — YouTube iframe ══
           200%/-50% crops YT chrome. pointer-events:none = no YT clicks ever. */
        #yt-wrap { position:absolute; inset:0; overflow:hidden; z-index:1; }
        #yt-engine { position:absolute; width:100%; height:200%; top:-50%; left:0;
            border:none; pointer-events:none; }

        /* ══ LAYER 2a — Thumbnail ══
           Shown ONLY on initial state (before first play).
           Custom → YT auto thumbnail → black.
           No transition on first play (instant hide so video shows immediately). */
        #thumbnail {
            position:absolute; inset:0; z-index:2; pointer-events:none;
            opacity:1; transition:none;
            background:#111 center/cover no-repeat;
        }
        #root.state-playing   #thumbnail,
        #root.state-buffering #thumbnail,
        #root.state-paused    #thumbnail,
        #root.state-ended     #thumbnail { opacity:0; }
        #root.state-initial   #thumbnail { opacity:1; }

        /* ══ LAYER 2b — Pause cover ══
           Shown ONLY when paused mid-playback (not on initial).
           Custom pause image → transparent (frozen frame shows through).
           Has smooth transition since we're mid-playback. */
        #pause-cover {
            position:absolute; inset:0; z-index:2; pointer-events:none;
            opacity:0; transition:opacity 0.25s ease;
            background:transparent center/cover no-repeat;
        }
        #root.state-paused #pause-cover { opacity:1; }

        /* ══ LAYER 3 — End screen ══
           Fades in over the playing video at endStartSec before end.
           Opacity driven by JS only. */
        #end-screen {
            position:absolute; inset:0; z-index:3; pointer-events:none;
            opacity:0; transition:opacity 0.6s ease;
            background:#000 center/cover no-repeat; overflow:hidden;
        }
        #end-screen video { position:absolute; inset:0; width:100%; height:100%;
            object-fit:cover; display:block; }

        /* ══ LAYER 4 — Shield ══ */
        #shield { position:absolute; inset:0; z-index:4; pointer-events:none; }

        /* ══ LAYER 5 — Branding ══
           Bottom-right, visible only while playing. */
        #branding {
            position:absolute; bottom:52px; right:14px; z-index:5;
            display:flex; align-items:center; gap:7px;
            opacity:0; pointer-events:none; transition:opacity 0.4s ease;
        }
        #root.state-playing #branding { opacity:1; }
        #branding img { height:28px; max-width:110px; object-fit:contain;
            border-radius:4px; filter:drop-shadow(0 1px 4px rgba(0,0,0,.7)); }
        #branding span { font-size:13px; font-weight:700; letter-spacing:0.3px;
            text-shadow:0 1px 6px rgba(0,0,0,.9); }

        /* ══ LAYER 6 — Player UI ══ */
        #player { position:absolute; inset:0; z-index:6; }
        #click-area { position:absolute; inset:0; cursor:pointer; }

        /* ── Centre button ── */
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
        #root.state-playing #centre-btn { opacity:0; transform:translate(-50%,-50%) scale(.88); pointer-events:none; }
        #root.state-playing.centre-flash #centre-btn { opacity:1; transform:translate(-50%,-50%) scale(1); }
        @keyframes centrePulse {
            0%  { transform:translate(-50%,-50%) scale(1); }
            35% { transform:translate(-50%,-50%) scale(1.22); }
            70% { transform:translate(-50%,-50%) scale(0.95); }
            100%{ transform:translate(-50%,-50%) scale(1); }
        }
        #centre-btn.pulse { animation:centrePulse .38s cubic-bezier(.34,1.56,.64,1); }

        /* ── Skip flash indicators (double-tap/key feedback) ── */
        .skip-flash {
            position:absolute; top:50%; width:80px; height:80px;
            border-radius:50%; background:rgba(255,255,255,0.15);
            display:flex; align-items:center; justify-content:center;
            flex-direction:column; gap:2px;
            opacity:0; pointer-events:none; transform:translateY(-50%);
            transition:opacity 0.15s;
        }
        #skip-back  { left:15%; }
        #skip-fwd   { right:15%; }
        .skip-flash svg   { width:22px; height:22px; fill:#fff; }
        .skip-flash span  { font-size:11px; color:#fff; font-weight:600; }
        .skip-flash.show  { opacity:1; }

        /* ── Spinner ── */
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

        /* ── Control bar ── */
        #bar {
            position:absolute; bottom:0; left:0; right:0;
            padding:36px 14px 12px;
            background:linear-gradient(transparent,rgba(0,0,0,.88) 52%);
            opacity:0; transform:translateY(4px); pointer-events:none;
            transition:opacity .3s ease, transform .3s ease;
        }
        /* Normal (non-fullscreen): show on hover or non-playing states */
        #player:hover #bar,
        #root.state-paused  #bar,
        #root.state-initial #bar,
        #root.state-ended   #bar { opacity:1; transform:translateY(0); pointer-events:auto; }

        /* Fullscreen playing: ONLY show when controls-visible (mouse moved recently) */
        #root.fs-playing #player:hover #bar { opacity:0; transform:translateY(4px); pointer-events:none; }
        #root.fs-playing.controls-visible #bar,
        #root.fs-playing.state-paused  #bar,
        #root.fs-playing.state-initial #bar,
        #root.fs-playing.state-ended   #bar { opacity:1; transform:translateY(0); pointer-events:auto; }

        /* Hide cursor in fullscreen when controls are hidden */
        #root.fs-playing:not(.controls-visible) { cursor:none; }
        #root.fs-playing:not(.controls-visible) #click-area { cursor:none; }

        /* ── Progress ── */
        .prog-wrap { width:100%; height:20px; display:flex; align-items:center;
            cursor:pointer; margin-bottom:8px; position:relative; }
        .prog-track { position:relative; width:100%; height:3px;
            background:rgba(255,255,255,.2); border-radius:3px;
            transition:height .15s; overflow:visible; }
        .prog-wrap:hover .prog-track { height:5px; }
        #prog-buf  { position:absolute; left:0; top:0; height:100%;
            background:rgba(255,255,255,.28); border-radius:3px; width:0%; }
        #prog-fill { position:absolute; left:0; top:0; height:100%;
            background:var(--accent,#e63946); border-radius:3px; width:0%; }
        #prog-thumb { position:absolute; top:50%; left:0%;
            width:13px; height:13px; border-radius:50%; background:#fff;
            transform:translate(-50%,-50%); opacity:0; pointer-events:none;
            transition:opacity .15s; }
        .prog-wrap:hover #prog-thumb { opacity:1; }
        #prog-tip { position:absolute; bottom:22px;
            background:rgba(0,0,0,.78); color:#fff;
            font-size:11px; padding:2px 8px; border-radius:4px;
            transform:translateX(-50%); opacity:0; pointer-events:none;
            white-space:nowrap; left:0%; }

        /* ── Row ── */
        .row { display:flex; align-items:center; gap:4px; }
        .ibtn { background:none; border:none; color:rgba(255,255,255,.88);
            cursor:pointer; width:34px; height:34px; border-radius:7px;
            display:flex; align-items:center; justify-content:center;
            transition:color .15s, background .15s; flex-shrink:0; }
        .ibtn:hover { color:#fff; background:rgba(255,255,255,.1); }
        .ibtn svg { width:19px; height:19px; }
        #time-display { font-size:12px; color:rgba(255,255,255,.82);
            font-variant-numeric:tabular-nums; letter-spacing:.3px;
            flex:1; padding-left:4px; }
        .vol-group { display:flex; align-items:center; gap:4px; }
        #vol-slider { -webkit-appearance:none; width:0; height:3px;
            background:rgba(255,255,255,.25); border-radius:3px;
            outline:none; cursor:pointer; transition:width .22s ease; }
        .vol-group:hover #vol-slider { width:64px; }
        #vol-slider::-webkit-slider-thumb { -webkit-appearance:none;
            width:11px; height:11px; border-radius:50%; background:#fff; cursor:pointer; }
        #vol-slider::-moz-range-thumb { width:11px; height:11px;
            border-radius:50%; background:#fff; border:none; cursor:pointer; }
    </style>
</head>
<body>
<div id="root" class="state-initial">

    {{-- LAYER 1: YouTube --}}
    <div id="yt-wrap">
        <iframe id="yt-engine" src=""
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </div>

    {{-- LAYER 2a: Thumbnail — shown on initial state only, before first play --}}
    <div id="thumbnail"></div>

    {{-- LAYER 2b: Pause cover — shown when paused mid-playback --}}
    {{-- $pauseImg=true: custom image. false: transparent (frozen frame). --}}
    <div id="pause-cover"
        @if($pauseImg && !empty($pauseVideoImg))
            style="background-image:url('{{ $pauseVideoImg }}');"
        @endif
    ></div>

    {{-- LAYER 3: End screen --}}
    <div id="end-screen"
        @if($endScreen && empty($endScreenVideo) && !empty($endScreenImg))
            style="background-image:url('{{ $endScreenImg }}');"
        @endif
    >
        @if($endScreen && !empty($endScreenVideo))
            <video id="end-video" src="{{ $endScreenVideo }}" muted playsinline preload="auto"></video>
        @endif
    </div>

    {{-- LAYER 4: Shield --}}
    <div id="shield"></div>

    {{-- LAYER 5: Branding --}}
    @if($branding)
    <div id="branding">
        @if(!empty($brandingLogo))
            <img src="{{ $brandingLogo }}" alt="{{ $brandingName ?? '' }}"/>
        @endif
        @if(!empty($brandingName))
            <span style="color:{{ $branding_color ?? '#fff' }};">{{ $brandingName }}</span>
        @endif
    </div>
    @endif

    {{-- LAYER 6: UI --}}
    <div id="player">
        <div id="click-area" onclick="onPlayerClick()"></div>
        <div id="spinner"></div>

        {{-- Skip flash indicators --}}
        <div id="skip-back" class="skip-flash">
            <svg viewBox="0 0 24 24"><path d="M12.5 3a9 9 0 1 0 9 9h-2a7 7 0 1 1-7-7v3l4-4-4-4v3Z"/></svg>
            <span id="skip-back-lbl">-5s</span>
        </div>
        <div id="skip-fwd" class="skip-flash">
            <svg viewBox="0 0 24 24"><path d="M11.5 3a9 9 0 1 1-9 9h2a7 7 0 1 0 7-7v3l4-4-4-4v3Z"/></svg>
            <span id="skip-fwd-lbl">+5s</span>
        </div>

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
                <button class="ibtn" onclick="togglePlay(event)" title="Play/Pause (Space)">
                    <svg id="play-ico" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </button>
                <button class="ibtn" onclick="doSkip(event,-5)" title="Back 5s (←)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="1 4 1 10 7 10"/>
                        <path d="M3.51 15a9 9 0 1 0 .49-4.95"/>
                        <text x="9" y="16" font-size="5.5" fill="currentColor" stroke="none" font-family="system-ui" font-weight="700" text-anchor="middle">5</text>
                    </svg>
                </button>
                <button class="ibtn" onclick="doSkip(event,5)" title="Forward 5s (→)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 4 23 10 17 10"/>
                        <path d="M20.49 15a9 9 0 1 1-.49-4.95"/>
                        <text x="11.5" y="16" font-size="5.5" fill="currentColor" stroke="none" font-family="system-ui" font-weight="700" text-anchor="middle">5</text>
                    </svg>
                </button>
                <span id="time-display">0:00 / 0:00</span>
                <div class="vol-group" onclick="event.stopPropagation()">
                    <button class="ibtn" onclick="toggleMute(event)" title="Mute (M)">
                        <svg id="vol-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                            <path id="vol-waves" d="M15.54 8.46a5 5 0 0 1 0 7.07M19.07 4.93a10 10 0 0 1 0 14.14"/>
                        </svg>
                    </button>
                    <input type="range" id="vol-slider" min="0" max="100" value="80"
                           oninput="setVolume(this.value)" onclick="event.stopPropagation()"/>
                </div>
                <button class="ibtn" onclick="toggleFullscreen(event)" title="Fullscreen (F)">
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
// ── PHP → JS ───────────────────────────────────────────────────────────
const VIDEO_ID       = @json($videoId);
const AUTOPLAY       = @json($autoplay);
const LOOP           = @json($loop);
const ORIGIN         = '{{ url('/') }}';
const ACCENT         = new URLSearchParams(location.search).get('accent') || '#e63946';
document.documentElement.style.setProperty('--accent', ACCENT);

// Thumbnail: custom > YT auto > black
const CUSTOM_THUMB   = @json(!empty($thumbnail_url) ? $thumbnail_url : null);
// End screen
const HAS_END_SCREEN = @json($endScreen);
const END_START_SEC  = @json($endScreen ? ($endStartSec ?? 5) : 0);
const HAS_END_VIDEO  = @json($endScreen && !empty($endScreenVideo));

// ── DOM refs ───────────────────────────────────────────────────────────
const root        = document.getElementById('root');
const thumbnail   = document.getElementById('thumbnail');   // initial poster only
const pauseCover  = document.getElementById('pause-cover'); // mid-playback pause only
const endScreen   = document.getElementById('end-screen');
const endVideo    = document.getElementById('end-video');
const ytEngine    = document.getElementById('yt-engine');

// ── Debug ──────────────────────────────────────────────────────────────
function dbg(level, msg, data) {
    window.parent.postMessage({ _kp_debug:true, level, msg, data:data||null, ts:Date.now() }, '*');
}
dbg('info', 'embed init', { VIDEO_ID, AUTOPLAY, LOOP, HAS_END_SCREEN, END_START_SEC, HAS_END_VIDEO });

// ── Thumbnail setup (initial poster only) ─────────────────────────────
// Shown on state-initial only. Hides instantly on first play (no transition)
// so the video appears without delay.
// Priority: CUSTOM_THUMB → YT auto-thumbnail → #111 black
(function setupThumbnail() {
    if (CUSTOM_THUMB) {
        thumbnail.style.backgroundImage = `url('${CUSTOM_THUMB}')`;
        dbg('info', 'thumbnail: custom URL');
        return;
    }
    const sizes = ['maxresdefault','sddefault','hqdefault','mqdefault'];
    let i = 0;
    (function tryNext() {
        if (i >= sizes.length) { dbg('warn','thumbnail: all YT sizes failed'); return; }
        const url = `https://i.ytimg.com/vi/${VIDEO_ID}/${sizes[i]}.jpg`;
        const img = new Image();
        img.onload = () => img.naturalWidth > 200
            ? (thumbnail.style.backgroundImage = `url('${url}')`, dbg('info','thumbnail: YT '+sizes[i]))
            : (i++, tryNext());
        img.onerror = () => { i++; tryNext(); };
        img.src = url;
    })();
})();

// ── Pause cover setup ─────────────────────────────────────────────────
// Shown on state-paused only (mid-playback pause).
// If $pauseImg=false the div stays transparent — frozen video frame shows through.
// Image already set via inline style in Blade if $pauseImg=true.
dbg('info', 'pauseCover bg: ' + (pauseCover.style.backgroundImage || 'transparent'));

// ── Build YT iframe src ────────────────────────────────────────────────
const p = new URLSearchParams({
    modestbranding:1, showinfo:0, rel:0, controls:0,
    disablekb:1, iv_load_policy:3, fs:0, cc_load_policy:0,
    playsinline:1, enablejsapi:1,
    autoplay:AUTOPLAY, loop:LOOP,
    origin:ORIGIN, widget_referrer:ORIGIN,
});
if (LOOP === '1') p.set('playlist', VIDEO_ID);
ytEngine.src = `https://www.youtube.com/embed/${VIDEO_ID}?${p}`;

// ── State ──────────────────────────────────────────────────────────────
let isPlaying = false, isMuted = false, seeking = false;
let curTime = 0, duration = 0;
let hideTimer = null, flashTimer = null, cursorTimer = null;
let endScreenActive = false;

// ── RAF interpolator ───────────────────────────────────────────────────
let rafId = null, anchor = { t:0, ms:0 };
function rafTick() {
    if (isPlaying && !seeking && duration > 0)
        drawProgress(Math.min(duration, anchor.t + (performance.now()-anchor.ms)/1000));
    rafId = requestAnimationFrame(rafTick);
}
function startRaf() { if (!rafId) rafId = requestAnimationFrame(rafTick); }
function stopRaf()  { if (rafId) { cancelAnimationFrame(rafId); rafId = null; } }
function anchorTime(t) { anchor = { t, ms:performance.now() }; curTime = t; }

// ── End screen ─────────────────────────────────────────────────────────
// endScreenActive = true means end screen is currently VISIBLE.
// It is shown when remaining <= END_START_SEC and hidden when
// user seeks back before that window. Can toggle multiple times.

// endScreenTimer: fires resetToInitial() 2s after main video stops (STOP trigger).
// Cleared if user hides end screen by seeking back.
let endScreenTimer = null;

function showEndScreen() {
    if (endScreenActive) return;
    endScreenActive = true;
    endScreen.style.transition = 'opacity 0.6s ease';
    endScreen.style.opacity    = '1';
    dbg('info', 'showEndScreen HAS_END_VIDEO=' + HAS_END_VIDEO);
    if (HAS_END_VIDEO && endVideo) {
        endVideo.currentTime = 0;
        endVideo.loop = false;
        endVideo.play()
            .then(() => dbg('success', 'end video playing'))
            .catch(err => dbg('error', 'end video failed: ' + err.message));
        // Don't rely on onended — the video may be longer than END_START_SEC.
        // resetToInitial is scheduled by scheduleEndReset() at STOP trigger instead.
    } else {
        // Image end screen — schedule reset after END_START_SEC
        dbg('info', 'end screen image, scheduling reset in ' + END_START_SEC + 's');
        scheduleEndReset(END_START_SEC * 1000);
    }
}

// Called at the STOP trigger (1s before main video ends).
// Resets 2s later — giving the end screen a moment to be seen.
function scheduleEndReset(ms) {
    clearTimeout(endScreenTimer);
    endScreenTimer = setTimeout(() => {
        dbg('info', 'endScreenTimer fired → resetToInitial');
        if (endScreenActive) resetToInitial();
    }, ms != null ? ms : 2000);
}

function pauseEndVideo() {
    if (HAS_END_VIDEO && endVideo && !endVideo.paused) {
        endVideo.pause();
        dbg('info', 'end video paused');
    }
}
function resumeEndVideo() {
    if (HAS_END_VIDEO && endVideo && endVideo.paused && endScreenActive) {
        endVideo.play().catch(() => {});
        dbg('info', 'end video resumed');
    }
}

function hideEndScreen() {
    if (!endScreenActive) return;
    endScreenActive = false;
    clearTimeout(endScreenTimer);
    endScreen.style.transition = 'opacity 0.4s ease';
    endScreen.style.opacity    = '0';
    dbg('info', 'hideEndScreen — main video resumes underneath');
    if (HAS_END_VIDEO && endVideo) {
        endVideo.pause();
        endVideo.currentTime = 0;
    }
}

function resetToInitial() {
    dbg('info', 'resetToInitial');
    hideEndScreen();
    ytSend('seekTo', [0, true]);
    ytSend('stopVideo');
    isPlaying = false;
    anchorTime(0); drawProgress(0);
    centreIco.innerHTML = ICO_PLAY;
    updatePlayIcon();
    thumbnail.style.transition = '';
    thumbnail.style.opacity    = '';
    setState('initial');
}

// ── End screen seek check ─────────────────────────────────────────────
// Call this after any user-initiated seek to show/hide end screen correctly.
function onSeekTo(t) {
    anchorTime(t);
    drawProgress(t);
    if (!HAS_END_SCREEN || !END_START_SEC || !duration) return;
    const remaining = duration - t;
    const inWindow  = remaining <= END_START_SEC && remaining > 1;
    if (inWindow  && !endScreenActive) { dbg('info','seek→endscreen show'); showEndScreen(); }
    if (!inWindow &&  endScreenActive) { dbg('info','seek→endscreen hide'); hideEndScreen(); }
}

// ── Listening handshake ────────────────────────────────────────────────
let listenTimer = null;
function sendListening() {
    if (ytEngine.contentWindow)
        ytEngine.contentWindow.postMessage(JSON.stringify({ event:'listening', id:1, channel:'widget' }), '*');
}
ytEngine.addEventListener('load', () => { sendListening(); listenTimer = setInterval(sendListening, 500); });

// ── Icons ──────────────────────────────────────────────────────────────
const centreIco = document.getElementById('centre-ico');
const centreBtn = document.getElementById('centre-btn');
const playIco   = document.getElementById('play-ico');
const ICO_PLAY   = '<path d="M8 5v14l11-7z"/>';
const ICO_PAUSE  = '<rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/>';
const ICO_REPLAY = '<path d="M1 4v6h6"/><path d="M3.51 15a9 9 0 1 0 .49-4.95"/>';

function setState(s) { root.className = 'state-' + s + (root.classList.contains('controls-visible') ? ' controls-visible' : ''); }
function updatePlayIcon() { playIco.innerHTML = isPlaying ? ICO_PAUSE : ICO_PLAY; }
function flashCentre(icon) {
    centreIco.innerHTML = icon === 'pause' ? ICO_PAUSE : icon === 'replay' ? ICO_REPLAY : ICO_PLAY;
    centreBtn.classList.remove('pulse'); void centreBtn.offsetWidth; centreBtn.classList.add('pulse');
    centreBtn.addEventListener('animationend', () => centreBtn.classList.remove('pulse'), { once:true });
    if (icon === 'pause') {
        clearTimeout(flashTimer); root.classList.add('centre-flash');
        flashTimer = setTimeout(() => root.classList.remove('centre-flash'), 700);
    }
}

// ── Fullscreen cursor + controls auto-hide ────────────────────────────
// In fullscreen while playing: hide controls + cursor after 3s idle.
// Any mouse move / click wakes them up again.
// Uses class "fs-playing" on root to activate the suppression CSS rules.

function updateFsClass() {
    if (document.fullscreenElement && isPlaying) {
        root.classList.add('fs-playing');
    } else {
        root.classList.remove('fs-playing');
        root.classList.remove('controls-visible');
        clearTimeout(cursorTimer);
    }
}

function wakeControls() {
    if (!document.fullscreenElement) return;
    root.classList.add('controls-visible');
    clearTimeout(cursorTimer);
    // Hide again after 3s if still playing
    cursorTimer = setTimeout(() => {
        if (isPlaying && document.fullscreenElement) {
            root.classList.remove('controls-visible');
        }
    }, 3000);
}

document.addEventListener('mousemove',  wakeControls);
document.addEventListener('mousedown',  wakeControls);
document.addEventListener('touchstart', wakeControls, { passive:true });

document.addEventListener('fullscreenchange', () => {
    updateFsClass();
    if (document.fullscreenElement) {
        // Just entered fullscreen — show controls briefly then hide
        wakeControls();
    }
    // Update icon
    document.getElementById('fs-ico').innerHTML = document.fullscreenElement
        ? `<path d="M8 3v3a2 2 0 0 1-2 2H3"/><path d="M21 8h-3a2 2 0 0 1-2-2V3"/><path d="M3 16h3a2 2 0 0 0 2 2v3"/><path d="M16 21v-3a2 2 0 0 0-2-2h-3"/>`
        : `<path d="M8 3H5a2 2 0 0 0-2 2v3"/><path d="M21 8V5a2 2 0 0 0-2-2h-3"/><path d="M3 16v3a2 2 0 0 0 2 2h3"/><path d="M16 21h3a2 2 0 0 0 2-2v-3"/>`;
});

// ── Keyboard shortcuts ─────────────────────────────────────────────────
// Space      → play/pause
// ← / →     → skip ±5s (each press = 5s, rapid double = 10s auto via accumulation)
// M          → mute toggle
// F          → fullscreen toggle
// ArrowUp/Dn → volume ±10
let keySkipAccum = 0, keySkipDir = 0, keySkipTimer = null;

document.addEventListener('keydown', e => {
    // Don't fire if user is typing in an input
    if (e.target !== document.body && e.target.tagName !== 'DIV') return;

    if (e.code === 'Space' || e.key === ' ') {
        e.preventDefault();
        togglePlay(null);
        return;
    }
    if (e.key === 'ArrowLeft') {
        e.preventDefault();
        triggerKeySkip(-5);
        return;
    }
    if (e.key === 'ArrowRight') {
        e.preventDefault();
        triggerKeySkip(5);
        return;
    }
    if (e.key === 'm' || e.key === 'M') { e.preventDefault(); toggleMute(null); return; }
    if (e.key === 'f' || e.key === 'F') { e.preventDefault(); toggleFullscreen(null); return; }
    if (e.key === 'ArrowUp')   { e.preventDefault(); nudgeVolume(10);  return; }
    if (e.key === 'ArrowDown') { e.preventDefault(); nudgeVolume(-10); return; }
});

// Accumulate rapid key presses so 2× ← = 10s, 3× = 15s etc.
// Commits the seek 300ms after last key press.
function triggerKeySkip(sec) {
    if (keySkipDir !== 0 && Math.sign(sec) !== keySkipDir) {
        // Direction changed — commit previous first
        commitKeySkip();
    }
    keySkipDir = Math.sign(sec);
    keySkipAccum += sec;
    // Update flash label to show accumulated amount
    updateSkipFlash(keySkipAccum);
    clearTimeout(keySkipTimer);
    keySkipTimer = setTimeout(commitKeySkip, 300);
}
function commitKeySkip() {
    if (keySkipAccum === 0) return;
    doSkipSec(keySkipAccum);
    keySkipAccum = 0; keySkipDir = 0;
}
function updateSkipFlash(sec) {
    const el = sec < 0 ? document.getElementById('skip-back') : document.getElementById('skip-fwd');
    const lbl = sec < 0 ? document.getElementById('skip-back-lbl') : document.getElementById('skip-fwd-lbl');
    lbl.textContent = (sec < 0 ? '' : '+') + sec + 's';
    el.classList.add('show');
    clearTimeout(el._hideTimer);
    el._hideTimer = setTimeout(() => el.classList.remove('show'), 600);
}

function nudgeVolume(delta) {
    const slider = document.getElementById('vol-slider');
    const v = Math.min(100, Math.max(0, (+slider.value) + delta));
    slider.value = v;
    setVolume(v);
}

// ── Play / Pause ───────────────────────────────────────────────────────
function onPlayerClick() { togglePlay(null); }
function onCentreClick() {
    if (root.classList.contains('state-ended')) { replayVideo(); return; }
    togglePlay(null);
}
function togglePlay(e) {
    if (e) e.stopPropagation();
    if (isPlaying) {
        ytSend('pauseVideo');
        isPlaying = false; setState('paused');
        flashCentre('play'); updatePlayIcon(); stopRaf();
        pauseEndVideo();
        updateFsClass();
    } else {
        ytSend('playVideo');
        isPlaying = true; setState('playing');
        flashCentre('pause'); updatePlayIcon();
        anchorTime(curTime); startRaf();
        resumeEndVideo();
        updateFsClass();
    }
}
function replayVideo() {
    hideEndScreen();
    ytSend('seekTo', [0, true]); ytSend('playVideo');
    isPlaying = true; setState('playing');
    flashCentre('pause'); updatePlayIcon();
    anchorTime(0); startRaf();
    thumbnail.style.transition = ''; thumbnail.style.opacity = '';
}

// ── Skip ──────────────────────────────────────────────────────────────
function doSkip(e, sec) {
    if (e) e.stopPropagation();
    updateSkipFlash(sec);
    doSkipSec(sec);
}
function doSkipSec(sec) {
    if (!duration) return;
    const t = Math.max(0, Math.min(duration, curTime + sec));
    ytSend('seekTo', [t, true]); onSeekTo(t);
}

// ── Volume ────────────────────────────────────────────────────────────
function toggleMute(e) {
    if (e) e.stopPropagation();
    isMuted ? (ytSend('unMute'), isMuted=false) : (ytSend('mute'), isMuted=true);
    updateVolIcon();
}
function setVolume(v) {
    ytSend('setVolume', [+v]); isMuted = +v===0;
    isMuted ? ytSend('mute') : ytSend('unMute'); updateVolIcon();
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
    document.fullscreenElement ? document.exitFullscreen()
        : (el.requestFullscreen||el.webkitRequestFullscreen).call(el);
}

// ── Progress bar ──────────────────────────────────────────────────────
const progEl    = document.getElementById('prog');
const progFill  = document.getElementById('prog-fill');
const progThumb = document.getElementById('prog-thumb');
const timeDisp  = document.getElementById('time-display');
const progBuf   = document.getElementById('prog-buf');
const progTip   = document.getElementById('prog-tip');

function drawProgress(t) {
    curTime = t;
    const pct = duration > 0 ? Math.min(100, (t/duration)*100) : 0;
    progFill.style.width = pct + '%';
    progThumb.style.left = pct + '%';
    timeDisp.textContent = fmt(t) + ' / ' + fmt(duration);
}
function pxToTime(x) {
    const r = progEl.getBoundingClientRect();
    return Math.min(1, Math.max(0, (x-r.left)/r.width)) * duration;
}
progEl.addEventListener('mousedown', e => {
    if (!duration) return;
    e.stopPropagation(); seeking = true; drawProgress(pxToTime(e.clientX));
    const move = ev => { if (seeking) drawProgress(pxToTime(ev.clientX)); };
    const up   = ev => {
        seeking = false; const t = pxToTime(ev.clientX);
        ytSend('seekTo',[t,true]); onSeekTo(t);
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
    progTip.style.left  = ((t/duration)*100) + '%';
    progTip.style.opacity = '1';
});
progEl.addEventListener('mouseleave', () => { progTip.style.opacity = '0'; });
progEl.addEventListener('touchstart', e => {
    if (!duration) return;
    e.preventDefault(); seeking = true; drawProgress(pxToTime(e.touches[0].clientX));
    const move = ev => { if (seeking) { ev.preventDefault(); drawProgress(pxToTime(ev.touches[0].clientX)); } };
    const end  = ev => {
        seeking = false; const t = pxToTime(ev.changedTouches[0].clientX);
        ytSend('seekTo',[t,true]); onSeekTo(t);
        document.removeEventListener('touchmove', move);
        document.removeEventListener('touchend', end);
    };
    document.addEventListener('touchmove', move, { passive:false });
    document.addEventListener('touchend', end);
}, { passive:false });

// ── postMessage handler ───────────────────────────────────────────────
window.addEventListener('message', e => {
    const d = e.data;
    if (d && typeof d === 'object' && !d._kp_debug && d.cmd) {
        if (d.cmd === 'play')   { ytSend('playVideo');  isPlaying=true;  setState('playing'); updatePlayIcon(); anchorTime(curTime); startRaf(); }
        if (d.cmd === 'pause')  { ytSend('pauseVideo'); isPlaying=false; setState('paused');  updatePlayIcon(); stopRaf(); }
        if (d.cmd === 'mute')   { ytSend('mute');   isMuted=true;  updateVolIcon(); }
        if (d.cmd === 'unmute') { ytSend('unMute'); isMuted=false; updateVolIcon(); }
        if (d.cmd === 'volume') { ytSend('setVolume',[+d.value]); document.getElementById('vol-slider').value=d.value; }
        if (d.cmd === 'seek' && duration>0) { ytSend('seekTo',[d.value,true]); onSeekTo(d.value); }
        if (d.cmd === 'accent') { document.documentElement.style.setProperty('--accent', d.value); }
        return;
    }
    if (typeof e.data !== 'string') return;
    if (e.origin !== 'https://www.youtube.com' && e.origin !== 'https://www.youtube-nocookie.com') return;
    let yt; try { yt = JSON.parse(e.data); } catch(_) { return; }
    if (!yt || !yt.event) return;

    if (yt.event === 'onReady') {
        dbg('success', 'YT ready');
        ytSend('setVolume', [80]);
        if (AUTOPLAY === '1') {
            ytSend('playVideo');
            isPlaying = true; setState('playing');
            flashCentre('pause'); updatePlayIcon();
            anchorTime(0); startRaf();
        }
        window.parent.postMessage(yt, '*');
    }

    if (yt.event === 'onStateChange') {
        const s = yt.info;
        if (s === 1) {
            thumbnail.style.transition = ''; thumbnail.style.opacity = '';
            isPlaying = true; setState('playing'); updatePlayIcon();
            anchorTime(curTime); startRaf();
            resumeEndVideo();
        }
        if (s === 2) {
            isPlaying = false; setState('paused');
            centreIco.innerHTML = ICO_PLAY; updatePlayIcon(); stopRaf();
            pauseEndVideo();
        }
        if (s === 0) {
            dbg('info', 'YT state=0, endScreenActive=' + endScreenActive);
            stopRaf(); isPlaying = false;
            if (LOOP === '1') {
                hideEndScreen();
                ytSend('seekTo',[0,true]); ytSend('playVideo');
                isPlaying=true; setState('playing');
                anchorTime(0); startRaf();
                thumbnail.style.transition=''; thumbnail.style.opacity='';
                return;
            }
            if (!endScreenActive) {
                // Safety net — near-end didn't fire (very short video)
                dbg('warn', 'state=0 safety net');
                HAS_END_SCREEN ? (setState('ended'), centreIco.innerHTML=ICO_REPLAY, updatePlayIcon(), drawProgress(duration), showEndScreen()) : resetToInitial();
            }
        }
        if (s === 3) setState('buffering');
        if (s === -1) { anchorTime(0); drawProgress(0); setState('initial'); hideEndScreen(); }
        dbg('yt', 'state→' + s);
        window.parent.postMessage(yt, '*');
    }

    if (yt.event === 'onError') {
        const errs = {2:'Invalid videoId',100:'Not found',101:'Embed disabled',150:'Embed disabled',152:'Origin rejected',153:'Config error'};
        dbg('error', `YT error ${yt.data}: ${errs[yt.data]||'unknown'}`);
        window.parent.postMessage(yt, '*');
    }

    if (yt.event === 'infoDelivery' && yt.info) {
        const info = yt.info;
        if (listenTimer) { clearInterval(listenTimer); listenTimer = null; }
        if (info.duration != null && info.duration > 0) duration = info.duration;
        if (info.currentTime != null && !seeking) {
            anchorTime(info.currentTime);
            if (!isPlaying) drawProgress(info.currentTime);

            if (duration > 0 && isPlaying && !seeking) {
                const remaining = duration - info.currentTime;
                const inEndWindow = HAS_END_SCREEN && END_START_SEC > 0 && remaining <= END_START_SEC;

                // SHOW: entered end-screen window → fade end screen over playing video
                if (inEndWindow && remaining > 1 && !endScreenActive) {
                    dbg('info', 'END SCREEN SHOW remaining=' + remaining.toFixed(2));
                    showEndScreen();
                }

                // HIDE: user seeked back OUT of the end-screen window
                if (!inEndWindow && endScreenActive) {
                    dbg('info', 'END SCREEN HIDE — seeked back to remaining=' + remaining.toFixed(2));
                    hideEndScreen();
                }

                // STOP: 1s before end → kill YT so suggestion cards never show
                if (remaining <= 1 && remaining > 0) {
                    dbg('info', 'STOP TRIGGER remaining=' + remaining.toFixed(2));
                    ytSend('stopVideo');
                    isPlaying = false; stopRaf();
                    drawProgress(duration);
                    setState('ended');
                    centreIco.innerHTML = ICO_REPLAY;
                    updatePlayIcon();
                    if (HAS_END_SCREEN) {
                        if (!endScreenActive) showEndScreen();
                        // Schedule reset 2s after end (regardless of end video length)
                        scheduleEndReset(2000);
                    } else {
                        resetToInitial();
                    }
                }
            }
        }
        if (info.videoLoadedFraction != null)
            progBuf.style.width = (info.videoLoadedFraction * 100) + '%';
        window.parent.postMessage(yt, '*');
    }
});

// ── ytSend ────────────────────────────────────────────────────────────
function ytSend(func, args) {
    if (ytEngine && ytEngine.contentWindow)
        ytEngine.contentWindow.postMessage(
            JSON.stringify({ event:'command', func, args:args||[], id:1, channel:'widget' }), '*');
}

// ── fmt ───────────────────────────────────────────────────────────────
function fmt(s) { s=Math.floor(s||0); return Math.floor(s/60)+':'+String(s%60).padStart(2,'0'); }
</script>
</body>
</html>