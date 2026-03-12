<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="referrer" content="no-referrer-when-downgrade"/>
    <title>KP Live Embed</title>
    <style>
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html, body { width:100%; height:100%; background:#000; overflow:hidden;
            font-family:system-ui,-apple-system,sans-serif; user-select:none; }
        #root { position:absolute; inset:0; background:#000; }

        #stream-wrap { position:absolute; z-index:1; overflow:hidden; }
        #stream-engine {
            position:absolute; top:0; left:0;
            width:100%; height:100%;
            border:none; display:block;
        }

        #thumbnail {
            position:absolute; inset:0; z-index:2; pointer-events:none;
            opacity:1; background:#111 center/cover no-repeat;
            transition:opacity 0.4s ease;
        }
        #root.state-playing #thumbnail,
        #root.state-loaded  #thumbnail { opacity:0; pointer-events:none; }

        #shield { position:absolute; inset:0; z-index:3; pointer-events:none; }

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

        #player { position:absolute; inset:0; z-index:6; }
        #click-area { position:absolute; inset:0; cursor:pointer; }

        /* ── Error overlay ── */
        #error-overlay {
            position:absolute; inset:0; z-index:20;
            background:#0a0e1a;
            display:none; flex-direction:column;
            align-items:flex-start; justify-content:center;
            padding:28px 32px; overflow-y:auto;
        }
        #error-overlay.visible { display:flex; }
        .err-badge {
            display:inline-flex; align-items:center; gap:6px;
            background:#7f1d1d; color:#fca5a5;
            font-size:10px; font-weight:700; letter-spacing:1.5px;
            padding:3px 9px; border-radius:4px; text-transform:uppercase; margin-bottom:14px;
        }
        .err-title { font-size:17px; font-weight:700; color:#f1f5f9; margin-bottom:8px; }
        .err-msg {
            color:#94a3b8; font-size:12px; margin-bottom:20px;
            padding:10px 14px; background:#0f172a;
            border-left:3px solid #ef4444; border-radius:0 5px 5px 0;
            width:100%; word-break:break-word;
        }
        .err-section { font-size:10px; font-weight:700; letter-spacing:1.5px;
            color:#475569; text-transform:uppercase; margin-bottom:8px; }
        .err-attempts { width:100%; margin-bottom:20px; }
        .err-attempt {
            display:flex; align-items:flex-start; gap:10px;
            padding:8px 0; border-bottom:1px solid #1e293b;
            font-size:11px;
        }
        .err-attempt:last-child { border-bottom:none; }
        .err-attempt .url { color:#7dd3fc; font-family:monospace; word-break:break-all; }
        .err-attempt .detail { color:#64748b; margin-top:2px; }
        .err-attempt .detail.fail { color:#f87171; }
        .err-fixes { list-style:none; width:100%; margin-bottom:20px; }
        .err-fixes li { font-size:11px; color:#86efac; padding:3px 0; }
        .err-fixes li::before { content:'→  '; color:#4ade80; }
        .err-cmd {
            background:#020817; border:1px solid #1e293b; border-radius:5px;
            padding:8px 12px; font-family:monospace; font-size:11px; color:#7dd3fc;
            word-break:break-all; width:100%; margin-bottom:8px;
        }
        .err-meta { font-size:10px; color:#334155; margin-top:16px; display:flex; gap:16px; flex-wrap:wrap; }
        .err-btn {
            margin-top:20px; background:#1e293b; border:1px solid #334155;
            color:#94a3b8; font-size:11px; padding:7px 14px; border-radius:5px;
            cursor:pointer; transition:background .15s;
        }
        .err-btn:hover { background:#334155; color:#fff; }

        /* ── Live badge ── */
        #live-badge {
            position:absolute; top:14px; left:14px;
            display:flex; align-items:center; gap:6px;
            background:rgba(0,0,0,.6); backdrop-filter:blur(8px);
            border-radius:6px; padding:4px 10px;
            font-size:11px; font-weight:700; letter-spacing:1.5px;
            color:#fff; pointer-events:none;
            opacity:0; transition:opacity 0.3s ease;
        }
        #root.state-playing #live-badge,
        #root.state-loaded  #live-badge { opacity:1; }
        @keyframes livepulse { 0%,100%{ opacity:1; } 50%{ opacity:.3; } }
        #live-dot { width:7px; height:7px; border-radius:50%; background:#e63946;
            animation:livepulse 1.5s ease-in-out infinite; }

        #unmute-btn {
            position:absolute; top:14px; right:14px;
            display:flex; align-items:center; gap:6px;
            background:rgba(230,57,70,0.92); backdrop-filter:blur(8px);
            border-radius:6px; padding:5px 12px;
            font-size:11px; font-weight:700; letter-spacing:1px;
            color:#fff; cursor:pointer; border:none;
            opacity:0; pointer-events:none;
            transition:opacity 0.3s ease; z-index:10;
        }
        #unmute-btn.visible { opacity:1; pointer-events:auto; }
        #unmute-btn svg { width:15px; height:15px; fill:none; stroke:#fff;
            stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }

        #spinner {
            position:absolute; top:50%; left:50%;
            transform:translate(-50%,-50%);
            width:48px; height:48px; border-radius:50%;
            border:3px solid rgba(255,255,255,.12);
            border-top-color:var(--accent,#e63946);
            opacity:0; pointer-events:none;
            transition:opacity .2s; animation:spin .85s linear infinite;
        }
        #root.state-loading #spinner { opacity:1; }
        @keyframes spin { to { transform:translate(-50%,-50%) rotate(360deg); } }

        #centre-btn {
            position:absolute; top:50%; left:50%;
            transform:translate(-50%,-50%);
            width:72px; height:72px; border-radius:50%;
            background:rgba(0,0,0,0.62);
            backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px);
            border:2px solid rgba(255,255,255,0.18);
            display:flex; align-items:center; justify-content:center;
            opacity:1; pointer-events:auto; cursor:pointer;
            transition:opacity .28s ease, background .18s;
        }
        #centre-btn svg { width:30px; height:30px; fill:#fff; }
        #centre-btn:hover { background:rgba(0,0,0,.82); }
        #root.state-playing #centre-btn,
        #root.state-loading #centre-btn { opacity:0; pointer-events:none; }

        #bar {
            position:absolute; bottom:0; left:0; right:0;
            padding:36px 14px 12px;
            background:linear-gradient(transparent,rgba(0,0,0,.88) 52%);
            opacity:0; transform:translateY(4px); pointer-events:none;
            transition:opacity .3s ease, transform .3s ease;
        }
        #player:hover #bar,
        #root.state-initial #bar { opacity:1; transform:translateY(0); pointer-events:auto; }
        #root.fs-hide #bar  { opacity:0 !important; pointer-events:none !important; }
        #root.fs-show #bar  { opacity:1 !important; pointer-events:auto  !important; }
        #root.fs-hide { cursor:none; }
        #root.fs-hide * { cursor:none; }

        .row { display:flex; align-items:center; gap:4px; }
        .ibtn { background:none; border:none; color:rgba(255,255,255,.88);
            cursor:pointer; width:34px; height:34px; border-radius:7px;
            display:flex; align-items:center; justify-content:center;
            transition:color .15s, background .15s; flex-shrink:0; }
        .ibtn:hover { color:#fff; background:rgba(255,255,255,.1); }
        .ibtn svg { width:19px; height:19px; }
        #ch-display { font-size:12px; color:rgba(255,255,255,.82);
            letter-spacing:.3px; flex:1; padding-left:6px; }
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

    <div id="stream-wrap">
        <iframe
            id="stream-engine"
            src=""
            allowfullscreen
            scrolling="no"
            allow="autoplay; encrypted-media; picture-in-picture; fullscreen"
            style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;display:block;">
        </iframe>
    </div>

    <div id="thumbnail"
        @if(!empty($thumbnail_url))
            style="background-image:url('{{ $thumbnail_url }}');"
        @endif
    ></div>

    <div id="shield"></div>

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

    {{-- Developer error overlay — shown when proxy returns non-200 --}}
    <div id="error-overlay">
        <div class="err-badge">⚠ Proxy Error</div>
        <div class="err-title" id="err-title">Stream Error</div>
        <div class="err-msg" id="err-msg"></div>

        <div class="err-section" id="err-attempts-label" style="display:none">Upstream Attempts</div>
        <div class="err-attempts" id="err-attempts"></div>

        <div class="err-section" id="err-fixes-label" style="display:none">How to Fix</div>
        <ul class="err-fixes" id="err-fixes"></ul>

        <div class="err-section">Debug</div>
        <div class="err-cmd" id="err-curl"></div>
        <div class="err-cmd" id="err-log"></div>

        <div class="err-meta" id="err-meta"></div>
        <button class="err-btn" onclick="retryStream()">↺ Retry</button>
    </div>

    <div id="player">
        <div id="click-area" onclick="onPlayerClick()"></div>
        <div id="spinner"></div>
        <div id="live-badge">
            <span id="live-dot"></span>
            <span id="live-label">LIVE</span>
        </div>
        <button id="unmute-btn" onclick="triggerUnmute(event)">
            <svg viewBox="0 0 24 24">
                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                <path d="M15.54 8.46a5 5 0 0 1 0 7.07M19.07 4.93a10 10 0 0 1 0 14.14"/>
            </svg>
            UNMUTE
        </button>
        <div id="centre-btn" onclick="startStream()">
            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
        </div>
        <div id="bar">
            <div class="row">
                <button class="ibtn" onclick="toggleStream(event)" title="Play/Stop (Space)">
                    <svg id="play-ico" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </button>
                <button class="ibtn" onclick="refreshStream(event)" title="Refresh (R)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="1 4 1 10 7 10"/>
                        <path d="M3.51 15a9 9 0 1 0 .49-4.95"/>
                    </svg>
                </button>
                <span id="ch-display">{{ $channelName ?? 'Live Stream' }}</span>
                <div class="vol-group" onclick="event.stopPropagation()">
                    <button class="ibtn" onclick="toggleMute(event)" title="Mute (M)">
                        <svg id="vol-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
                            <path id="vol-waves" d="M15.54 8.46a5 5 0 0 1 0 7.07M19.07 4.93a10 10 0 0 1 0 14.14"/>
                        </svg>
                    </button>
                    <input type="range" id="vol-slider" min="0" max="100" value="100"
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
const CHANNEL_ID   = @json($channelId);
const CHANNEL_NAME = @json($channelName);
const ACCENT       = new URLSearchParams(location.search).get('accent') || '#e63946';
document.documentElement.style.setProperty('--accent', ACCENT);

const root         = document.getElementById('root');
const streamEngine = document.getElementById('stream-engine');
const streamWrap   = document.getElementById('stream-wrap');
const shield       = document.getElementById('shield');
const liveLabel    = document.getElementById('live-label');
const playIco      = document.getElementById('play-ico');
const unmuteBtn    = document.getElementById('unmute-btn');
const errorOverlay = document.getElementById('error-overlay');

let isPlaying = false, isMuted = false, cursorTimer = null, unmuteTimer = null;

const STREAM_URL  = id => `/proxy/stream/${id}`;
const ICO_PLAY    = '<path d="M8 5v14l11-7z"/>';
const ICO_STOP    = '<rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/>';

function setState(s) {
    const fs = [...root.classList].filter(c => c.startsWith('fs-'));
    root.className = ['state-' + s, ...fs].join(' ');
}

// ── Ad crop ───────────────────────────────────────────────────────────
let AD_TOP = 52, AD_BOTTOM = 93, AD_SIDE = 0;

function applyAdCrop() {
    streamWrap.style.cssText = `
        position:absolute;
        top:-${AD_TOP}px; left:-${AD_SIDE}px;
        width:calc(100% + ${AD_SIDE * 2}px);
        height:calc(100% + ${AD_TOP + AD_BOTTOM}px);
        overflow:hidden; z-index:1;
    `;
    streamEngine.style.cssText =
        'position:absolute;top:0;left:0;width:100%;height:100%;border:none;display:block;';
}
applyAdCrop();

// ── Shield ────────────────────────────────────────────────────────────
function shieldOn(ms) {
    shield.style.pointerEvents = 'auto';
    clearTimeout(shield._t);
    shield._t = setTimeout(() => { shield.style.pointerEvents = 'none'; }, ms);
}

// ══════════════════════════════════════════════════════════════════════
// ERROR OVERLAY
// Before loading the iframe, we HEAD-check the proxy URL first.
// If it returns non-200 we fetch the error HTML and parse it into
// the overlay — fully visible to the developer without any browser
// console diving.
// ══════════════════════════════════════════════════════════════════════
function hideError() {
    errorOverlay.classList.remove('visible');
}

async function checkProxyAndLoad(id) {
    const url = STREAM_URL(id);

    setState('loading');
    hideError();
    hideUnmuteBtn();

    // ── Step 1: HEAD-check the proxy route (lightweight — no body download)
    try {
        const check = await fetch(url, { method: 'HEAD', redirect: 'follow' });
        if (!check.ok) {
            // Non-200: do a GET to fetch the error HTML our controller renders
            const errResp = await fetch(url, { method: 'GET', redirect: 'follow' });
            const errHtml = await errResp.text();
            parseAndShowError(errHtml, url, id);
            setState('initial');
            return;
        }
    } catch (fetchErr) {
        showError(
            'Proxy Route Not Reachable',
            fetchErr.message || 'fetch() failed — the /proxy/stream route may not be registered.',
            [{ url, result: 'NETWORK_ERROR', error: fetchErr.message, status: null, bytes: 0 }],
            [
                "Add route in web.php: Route::get('/proxy/stream/{id}', [StreamProxyController::class, 'stream'])",
                'Run: php artisan route:list | grep proxy',
                'Check your web server error log',
            ]
        );
        setState('initial');
        return;
    }

    // ── Step 2: Attach onload BEFORE setting src so we never miss the event
    // Clear any lingering listeners from a previous load attempt
    clearIframeListeners();

    // Safety timeout — if load never fires within 30s, show an error
    _loadTimeout = setTimeout(() => {
        if (!isPlaying) {
            clearIframeListeners();
            showError(
                'Stream Load Timeout',
                'The proxy returned HTTP 200 but the iframe never fired its load event after 30 seconds.',
                [{ url, result: 'TIMEOUT', error: 'iframe load event did not fire', status: null, bytes: 0 }],
                [
                    'Open DevTools → Network tab → filter "proxy" — check what the response looks like',
                    'The proxied HTML may contain a JS error blocking page finish',
                    'Check storage/logs/laravel.log for PHP errors during HTML cleaning',
                    'Run: php artisan route:list | grep proxy',
                ]
            );
            setState('initial');
        }
    }, 30000);

    _loadListener = function () {
        clearIframeListeners();
        isPlaying = true;
        setState('playing');
        playIco.innerHTML = ICO_STOP;
        liveLabel.textContent = CHANNEL_NAME ? CHANNEL_NAME.toUpperCase() : 'LIVE';
        applyAdCrop();
        shieldOn(3000);

        // Re-apply body sizing inside the proxied (same-origin) document
        try {
            const idoc = streamEngine.contentDocument;
            if (idoc && idoc.head) {
                const s = idoc.createElement('style');
                s.textContent = 'html,body{margin:0!important;padding:0!important;width:100%!important;height:100%!important;overflow:hidden!important;background:#000!important;}';
                idoc.head.appendChild(s);
            }
        } catch (e) { /* cross-origin fallback */ }

        clearTimeout(unmuteTimer);
        unmuteTimer = setTimeout(() => { showUnmuteBtn(); autoClickUnmute(); }, 1500);
    };

    _errorListener = function () {
        clearIframeListeners();
        showError(
            'iframe Load Error',
            'The browser reported an error loading the proxied stream page.',
            [{ url, result: 'IFRAME_ERROR', error: 'iframe fired onerror event', status: null, bytes: 0 }],
            [
                'Check the proxy response in DevTools → Network tab',
                'Verify the route returns valid HTML with Content-Type: text/html',
            ]
        );
        setState('initial');
    };

    streamEngine.addEventListener('load',  _loadListener);
    streamEngine.addEventListener('error', _errorListener);

    // ── Step 3: Now set src — listener is already attached above
    streamEngine.src = '';           // force reset first
    shieldOn(4000);
    requestAnimationFrame(() => {    // yield one frame so the empty-src reset settles
        streamEngine.src = url;
    });
}

function parseAndShowError(html, url, id) {
    // Extract text content from the error HTML our controller renders
    const parser = new DOMParser();
    const doc    = parser.parseFromString(html, 'text/html');

    const title   = doc.querySelector('h1')?.textContent || 'Proxy Error';
    const msgEl   = doc.querySelector('.msg');
    const msg     = msgEl?.textContent?.trim() || 'Proxy returned an error. See details below.';

    // Parse attempt rows
    const attempts = [];
    doc.querySelectorAll('tr').forEach(tr => {
        const cells = tr.querySelectorAll('td');
        if (cells.length >= 2 && cells[0].textContent.startsWith('Attempt')) {
            const lines = cells[1].innerText.split('\n').map(s => s.trim()).filter(Boolean);
            attempts.push({
                url:    lines[0]?.replace(/^[✅❌]\s*/, '') || '',
                result: lines[0]?.startsWith('✅') ? 'OK' : 'FAIL',
                detail: lines.slice(1).join(' — '),
            });
        }
    });

    const fixes = [...doc.querySelectorAll('.fix-list li')].map(li => li.textContent.replace(/^→\s*/, ''));

    showError(title, msg, attempts, fixes, id);
}

function showError(title, msg, attempts, fixes, id) {
    document.getElementById('err-title').textContent = title;
    document.getElementById('err-msg').textContent   = msg;

    // Attempts
    const attEl    = document.getElementById('err-attempts');
    const attLabel = document.getElementById('err-attempts-label');
    attEl.innerHTML = '';
    if (attempts && attempts.length) {
        attLabel.style.display = '';
        attempts.forEach(a => {
            const icon   = a.result === 'OK' ? '✅' : '❌';
            const detail = a.detail || a.error || '';
            attEl.insertAdjacentHTML('beforeend', `
                <div class="err-attempt">
                    <span>${icon}</span>
                    <div>
                        <div class="url">${a.url || ''}</div>
                        ${detail ? `<div class="detail fail">${detail}</div>` : ''}
                    </div>
                </div>
            `);
        });
    } else {
        attLabel.style.display = 'none';
    }

    // Fixes
    const fixEl    = document.getElementById('err-fixes');
    const fixLabel = document.getElementById('err-fixes-label');
    fixEl.innerHTML = '';
    if (fixes && fixes.length) {
        fixLabel.style.display = '';
        fixes.forEach(f => fixEl.insertAdjacentHTML('beforeend', `<li>${f}</li>`));
    } else {
        fixLabel.style.display = 'none';
    }

    // Debug commands
    const chId = id || CHANNEL_ID || '??';
    document.getElementById('err-curl').textContent =
        `curl -v -A "Mozilla/5.0" "https://dlstreams.top/embed/stream-${chId}.php"`;
    document.getElementById('err-log').textContent =
        `tail -f storage/logs/laravel.log`;

    document.getElementById('err-meta').textContent =
        `Channel ID: ${chId}  |  Time: ${new Date().toLocaleString()}`;

    errorOverlay.classList.add('visible');
}

// ── Stream control ────────────────────────────────────────────────────
function startStream() {
    if (!CHANNEL_ID) {
        showError('No Channel ID', 'CHANNEL_ID is empty. Pass ?ch=51 in the URL.', [], [
            'Example: /killerplayer/tv?ch=51',
            'Check DaddyController::embed() is setting $channelId correctly',
        ]);
        return;
    }
    checkProxyAndLoad(CHANNEL_ID);
}

function retryStream() {
    hideError();
    startStream();
}

// Track the current load listener so we can remove it cleanly on stop/refresh
let _loadListener  = null;
let _errorListener = null;
let _loadTimeout   = null;

function clearIframeListeners() {
    if (_loadListener)  { streamEngine.removeEventListener('load',  _loadListener);  _loadListener  = null; }
    if (_errorListener) { streamEngine.removeEventListener('error', _errorListener); _errorListener = null; }
    clearTimeout(_loadTimeout);
    _loadTimeout = null;
}

function stopStream() {
    clearIframeListeners();
    streamEngine.src = '';
    isPlaying = false; isMuted = false;
    setState('initial');
    playIco.innerHTML = ICO_PLAY;
    hideUnmuteBtn();
    hideError();
    shield.style.pointerEvents = 'none';
    updateVolIcon();
}

function toggleStream(e) {
    if (e) e.stopPropagation();
    isPlaying ? stopStream() : startStream();
}

function refreshStream(e) {
    if (e) e.stopPropagation();
    if (!CHANNEL_ID) return;
    isPlaying = false;
    clearIframeListeners();
    checkProxyAndLoad(CHANNEL_ID);
}

function onPlayerClick() { if (!isPlaying) startStream(); }

// ── Unmute ────────────────────────────────────────────────────────────
const UNMUTE_X = 0.50, UNMUTE_Y = 0.85;
function autoClickUnmute() {
    const r  = streamEngine.getBoundingClientRect();
    const cx = r.left + r.width  * UNMUTE_X;
    const cy = r.top  + r.height * UNMUTE_Y;
    const ca = document.getElementById('click-area');
    ca.style.pointerEvents    = 'none';
    shield.style.pointerEvents = 'none';
    ['pointerdown','mousedown','pointerup','mouseup','click'].forEach(t =>
        streamEngine.dispatchEvent(new MouseEvent(t, {
            bubbles:true, cancelable:true, view:window,
            clientX:cx, clientY:cy, screenX:cx, screenY:cy,
            buttons: t.includes('down') ? 1 : 0,
        }))
    );
    setTimeout(() => { ca.style.pointerEvents = ''; }, 200);
}
function showUnmuteBtn() {
    unmuteBtn.classList.add('visible');
    clearTimeout(unmuteBtn._t);
    unmuteBtn._t = setTimeout(hideUnmuteBtn, 7000);
}
function hideUnmuteBtn() { unmuteBtn.classList.remove('visible'); }
function triggerUnmute(e) {
    if (e) e.stopPropagation();
    autoClickUnmute(); hideUnmuteBtn();
    isMuted = false; streamEngine.style.opacity = '1'; updateVolIcon();
}

// ── Volume ────────────────────────────────────────────────────────────
function toggleMute(e) {
    if (e) e.stopPropagation();
    isMuted = !isMuted;
    streamEngine.style.opacity = isMuted ? '0' : '1';
    updateVolIcon();
}
function setVolume(v) { isMuted = +v === 0; updateVolIcon(); }
function updateVolIcon() {
    document.getElementById('vol-waves').setAttribute('d', isMuted
        ? 'M23 9l-6 6M17 9l6 6'
        : 'M15.54 8.46a5 5 0 0 1 0 7.07M19.07 4.93a10 10 0 0 1 0 14.14');
    document.getElementById('vol-ico').style.opacity = isMuted ? '0.45' : '1';
}

// ── Fullscreen ────────────────────────────────────────────────────────
function toggleFullscreen(e) {
    if (e) e.stopPropagation();
    document.fullscreenElement
        ? document.exitFullscreen()
        : (root.requestFullscreen || root.webkitRequestFullscreen).call(root);
}
document.addEventListener('fullscreenchange', () => {
    document.getElementById('fs-ico').innerHTML = document.fullscreenElement
        ? `<path d="M8 3v3a2 2 0 0 1-2 2H3"/><path d="M21 8h-3a2 2 0 0 1-2-2V3"/><path d="M3 16h3a2 2 0 0 0 2 2v3"/><path d="M16 21v-3a2 2 0 0 0-2-2h-3"/>`
        : `<path d="M8 3H5a2 2 0 0 0-2 2v3"/><path d="M21 8V5a2 2 0 0 0-2-2h-3"/><path d="M3 16v3a2 2 0 0 0 2 2h3"/><path d="M16 21h3a2 2 0 0 0 2-2v-3"/>`;
    if (document.fullscreenElement) fsShow(); else fsClear();
});
function fsShow() {
    root.classList.remove('fs-hide'); root.classList.add('fs-show');
    clearTimeout(cursorTimer);
    if (isPlaying && document.fullscreenElement) cursorTimer = setTimeout(fsHide, 3000);
}
function fsHide() { clearTimeout(cursorTimer); root.classList.remove('fs-show'); root.classList.add('fs-hide'); }
function fsClear() { clearTimeout(cursorTimer); root.classList.remove('fs-show','fs-hide'); }
function wakeControls() { if (document.fullscreenElement) fsShow(); }
document.addEventListener('mousemove',  wakeControls);
document.addEventListener('mousedown',  wakeControls);
document.addEventListener('touchstart', wakeControls, {passive:true});
document.addEventListener('keydown',    wakeControls);

document.addEventListener('keydown', e => {
    if (e.target !== document.body && e.target.tagName !== 'DIV') return;
    if (e.code==='Space'||e.key===' ') { e.preventDefault(); toggleStream(null); }
    if (e.key==='f'||e.key==='F')      { e.preventDefault(); toggleFullscreen(null); }
    if (e.key==='m'||e.key==='M')      { e.preventDefault(); toggleMute(null); }
    if (e.key==='r'||e.key==='R')      { e.preventDefault(); refreshStream(null); }
    if (e.key==='u'||e.key==='U')      { e.preventDefault(); triggerUnmute(null); }
});

window.addEventListener('message', e => {
    const d = e.data; if (!d || typeof d !== 'object') return;
    if (d.cmd==='accent')  document.documentElement.style.setProperty('--accent', d.value);
    if (d.cmd==='mute')    { isMuted=true; streamEngine.style.opacity='0'; updateVolIcon(); }
    if (d.cmd==='unmute')  triggerUnmute(null);
    if (d.cmd==='stop')    stopStream();
    if (d.cmd==='play')    startStream();
    if (d.cmd==='refresh') refreshStream(null);
    if (d.cmd==='adcrop') {
        if (d.top    !== undefined) AD_TOP    = d.top;
        if (d.bottom !== undefined) AD_BOTTOM = d.bottom;
        if (d.side   !== undefined) AD_SIDE   = d.side;
        applyAdCrop();
    }
});
</script>
</body>
</html>