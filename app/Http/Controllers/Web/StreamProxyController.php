<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * StreamProxyController
 *
 * Add these routes to web.php:
 *
 *   Route::get('/proxy/stream/{id}', [StreamProxyController::class, 'stream'])
 *        ->name('proxy.stream')
 *        ->where('id', '[0-9]+');
 */
class StreamProxyController extends Controller
{
    private const UPSTREAM_BASE = 'https://dlstreams.top';

    private const UPSTREAM_CHAINS = [
        'https://dlstreams.top/embed/stream-%s.php',
        'https://thedaddy.to/embed/stream-%s.php',
        'https://daddylive.mp/embed/stream-%s.php',
    ];

    private const REQUEST_HEADERS = [
        'User-Agent'                => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
        'Accept'                    => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language'           => 'en-US,en;q=0.5',
        'Upgrade-Insecure-Requests' => '1',
        'Sec-Fetch-Dest'            => 'document',
        'Sec-Fetch-Mode'            => 'navigate',
        'Sec-Fetch-Site'            => 'none',
    ];

    private const AD_SCRIPT_PATTERNS = [
        'doubleclick', 'googlesyndication', 'googleadservices',
        'adservice\.google', 'pagead2', 'pubmatic\.com',
        'adnxs\.com', 'rubiconproject', 'openx\.net',
        'appnexus', 'criteo', 'taboola', 'outbrain',
        'revcontent', 'mgid\.com', 'exoclick', 'juicyads',
        'popcash', 'popads\.net', 'adsterra', 'propellerads',
        'hilltopads', 'trafficjunky', 'adskeeper', 'bidvertiser',
        'adcash', 'adf\.ly', 'pop\.dlstreams', 'pop\.thedaddy',
        'popunder', 'onclick\.io', 'anti-adblock', 'adblock-?detect',
        'prebid', 'gpt\.js', 'adsbygoogle', 'smartadserver',
        'spotx', 'ads\.js', 'ad\.js',
    ];

    private const AD_INLINE_PATTERNS = [
        'popunder', 'pop_under', 'clickunder', 'window\.open',
        'ExoLoader', 'AdsByExoClick', 'popMagic', 'monetag',
        'atOptions', 'invoke\.js', 'trafficStars',
    ];

    // ──────────────────────────────────────────────────────────────────

    public function stream(Request $request, string $id)
    {
        // Validate ID
        if (! ctype_digit($id)) {
            return $this->errorPage('Invalid Channel ID', "Channel ID must be numeric. Got: " . htmlspecialchars($id), [
                'fix' => 'Use a numeric channel ID like /proxy/stream/51',
            ]);
        }

        $attempts = [];
        $html     = null;
        $usedUrl  = null;
        $usedBase = null;

        // Try each upstream in order, collect full diagnostics on each attempt
        foreach (self::UPSTREAM_CHAINS as $tpl) {
            $url  = sprintf($tpl, $id);
            $base = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);
            $attempt = ['url' => $url, 'status' => null, 'error' => null, 'bytes' => 0];

            try {
                $resp = Http::timeout(15)
                    ->withHeaders(array_merge(self::REQUEST_HEADERS, [
                        'Referer' => $base . '/',
                        'Host'    => parse_url($url, PHP_URL_HOST),
                    ]))
                    ->get($url);

                $attempt['status'] = $resp->status();
                $attempt['bytes']  = strlen($resp->body());

                if ($resp->successful() && $attempt['bytes'] > 200) {
                    $attempt['result'] = 'OK';
                    $attempts[]        = $attempt;
                    $html              = $resp->body();
                    $usedUrl           = $url;
                    $usedBase          = $base;
                    break;
                } else {
                    $attempt['error'] = $resp->successful()
                        ? "Response too small ({$attempt['bytes']} bytes) — likely an error page"
                        : "HTTP {$attempt['status']} from upstream";
                    $attempt['result'] = 'FAIL';
                }

            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                $attempt['error']  = 'Connection failed: ' . $e->getMessage();
                $attempt['result'] = 'CONNECTION_ERROR';
            } catch (\Exception $e) {
                $attempt['error']  = get_class($e) . ': ' . $e->getMessage();
                $attempt['result'] = 'EXCEPTION';
            }

            $attempts[] = $attempt;
            Log::warning("StreamProxy [{$url}]: {$attempt['error']}");
        }

        // All upstreams failed — show developer error page
        if ($html === null) {
            return $this->errorPage(
                'All Upstream Sources Failed',
                "Could not fetch stream {$id} from any upstream server.",
                ['attempts' => $attempts, 'channel_id' => $id],
                [
                    'Check that the channel ID exists on dlstreams.top',
                    'Verify your server can reach the upstream (check firewall / outbound HTTP)',
                    'Run: curl -A "Mozilla/5.0" https://dlstreams.top/embed/stream-' . $id . '.php from your server',
                    'Check Laravel logs: storage/logs/laravel.log',
                    'The upstream site may be blocking server IPs — try adding a residential proxy in Http::withOptions()',
                ]
            );
        }

        // Clean HTML
        try {
            $clean = $this->cleanHtml($html, $usedBase);
        } catch (\Exception $e) {
            Log::error("StreamProxy cleanHtml failed: " . $e->getMessage());
            return $this->errorPage(
                'HTML Cleaning Failed',
                $e->getMessage(),
                ['url' => $usedUrl, 'trace' => $e->getTraceAsString()],
                ['This is a bug in StreamProxyController::cleanHtml()', 'Check the raw HTML from the upstream for unusual encoding']
            );
        }

        return response($clean, 200)
            ->header('Content-Type',  'text/html; charset=UTF-8')
            ->header('Cache-Control', 'no-store, no-cache')
            ->header('X-Proxy-Source', $usedUrl);
            // X-Frame-Options intentionally omitted:
            // This IS the iframe content — setting X-Frame-Options here
            // would prevent the browser from loading it inside our iframe.
    }

    /**
     * DEBUG ONLY — visit /proxy/debug/{id} in your browser to inspect:
     *   ?raw=1    → shows the raw upstream HTML before cleaning
     *   ?raw=0    → shows the cleaned HTML (default)
     *   ?info=1   → shows a JSON diagnostic (headers, size, upstream status)
     *
     * Remove this route in production!
     * Route: Route::get('/proxy/debug/{id}', [StreamProxyController::class, 'debug'])->where('id','[0-9]+');
     */
    public function debug(Request $request, string $id)
    {
        if (! ctype_digit($id)) abort(400);

        $url  = sprintf(self::UPSTREAM_CHAINS[0], $id);
        $base = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);

        try {
            $resp = Http::timeout(15)
                ->withHeaders(array_merge(self::REQUEST_HEADERS, ['Referer' => $base . '/']))
                ->get($url);
        } catch (\Exception $e) {
            return response()->json([
                'error'   => $e->getMessage(),
                'url'     => $url,
                'fix'     => 'Server cannot reach the upstream — check outbound HTTP / firewall',
            ], 502);
        }

        $rawHtml   = $resp->body();
        $rawBytes  = strlen($rawHtml);
        $rawStatus = $resp->status();

        if ($request->query('info') === '1') {
            return response()->json([
                'upstream_url'    => $url,
                'http_status'     => $rawStatus,
                'raw_bytes'       => $rawBytes,
                'content_type'    => $resp->header('Content-Type'),
                'upstream_server' => $resp->header('Server'),
                'fetch_ok'        => $resp->successful(),
                'body_preview'    => substr($rawHtml, 0, 500),
            ]);
        }

        if ($request->query('raw') === '1') {
            // Show raw upstream HTML — wrapped in a <pre> so the browser
            // displays it as text rather than rendering it
            $escaped = htmlspecialchars($rawHtml, ENT_QUOTES, 'UTF-8');
            return response(
                '<html><head><meta charset="UTF-8"><title>RAW upstream [' . $id . ']</title>'
                . '<style>body{background:#0a0e1a;color:#e2e8f0;font-family:monospace;font-size:12px;padding:20px;}'
                . '.meta{color:#64748b;margin-bottom:12px;}</style></head><body>'
                . '<div class="meta">Upstream: ' . htmlspecialchars($url) . ' | Status: ' . $rawStatus . ' | Bytes: ' . $rawBytes . '</div>'
                . '<pre>' . $escaped . '</pre></body></html>',
                200
            )->header('Content-Type', 'text/html; charset=UTF-8');
        }

        // Default: show cleaned HTML as plain text
        try {
            $clean   = $this->cleanHtml($rawHtml, $base);
            $escaped = htmlspecialchars($clean, ENT_QUOTES, 'UTF-8');
            $label   = 'CLEANED';
            $error   = '';
        } catch (\Exception $e) {
            $escaped = htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
            $label   = 'CLEANING ERROR';
            $error   = $e->getMessage();
        }

        return response(
            '<html><head><meta charset="UTF-8"><title>' . $label . ' proxy [' . $id . ']</title>'
            . '<style>body{background:#0a0e1a;color:#e2e8f0;font-family:monospace;font-size:12px;padding:20px;}'
            . '.meta{color:#64748b;margin-bottom:12px;}'
            . '.err{color:#f87171;margin-bottom:12px;}'
            . '.tabs{display:flex;gap:10px;margin-bottom:16px;}'
            . '.tab{padding:4px 12px;border-radius:4px;font-size:11px;text-decoration:none;border:1px solid #334155;color:#94a3b8;}'
            . '.tab:hover,.tab.active{background:#334155;color:#fff;}</style></head><body>'
            . '<div class="tabs">'
            . '<a class="tab" href="?raw=0">Cleaned HTML</a>'
            . '<a class="tab" href="?raw=1">Raw HTML</a>'
            . '<a class="tab" href="?info=1">Info / Headers</a>'
            . '<a class="tab" href="/proxy/stream/' . $id . '" target="_blank">Open in iframe ↗</a>'
            . '</div>'
            . '<div class="meta">Upstream: ' . htmlspecialchars($url) . ' | Status: ' . $rawStatus . ' | Raw: ' . $rawBytes . ' bytes | Cleaned: ' . strlen($clean ?? '') . ' bytes</div>'
            . ($error ? '<div class="err">⚠ Cleaning error: ' . htmlspecialchars($error) . '</div>' : '')
            . '<pre>' . $escaped . '</pre></body></html>',
            200
        )->header('Content-Type', 'text/html; charset=UTF-8');
    }


    // ══════════════════════════════════════════════════════════════════
    // HTML CLEANING
    // ══════════════════════════════════════════════════════════════════

    private function cleanHtml(string $html, string $base): string
    {
        $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        foreach (['stripExternalAdScripts', 'stripInlineAdScripts', 'stripAdIframes'] as $step) {
            try {
                $result = $this->{$step}($html);
                if ($result !== null) {
                    $html = $result;
                }
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning(
                    'StreamProxy: ' . $step . ' failed — ' . $e->getMessage() . ' — skipping step'
                );
            }
        }

        $html = preg_replace('/<meta[^>]+http-equiv=["\'\']?refresh["\'\']?[^>]*>/i', '', $html) ?? $html;
        $html = preg_replace('/<noscript>.*?<\/noscript>/is', '', $html) ?? $html;
        $html = $this->rewriteProtocolRelativeUrls($html);
        $html = $this->injectKillScript($html, $base);
        return $html;
    }

    private function stripExternalAdScripts(string $html): string
    {
        $group = $this->buildPatternGroup(self::AD_SCRIPT_PATTERNS);
        if ($group === '') return $html;
        return preg_replace(
            '/<script\b[^>]*\bsrc=["\'][^"\']*(?:' . $group . ')[^"\']*["\'][^>]*>.*?<\/script>/is',
            '<!-- [KP] ad script removed -->',
            $html
        ) ?? $html;
    }

    private function stripInlineAdScripts(string $html): string
    {
        $group = $this->buildPatternGroup(self::AD_INLINE_PATTERNS);
        if ($group === '') return $html;
        return preg_replace_callback(
            '/<script\b([^>]*)>(.*?)<\/script>/is',
            function ($m) use ($group) {
                if (preg_match('/\bsrc\s*=/i', $m[1])) return $m[0];
                if (preg_match('/(?:' . $group . ')/i', $m[2])) {
                    return '<!-- [KP] inline ad script removed -->';
                }
                $body = preg_replace('/window\s*\.\s*open\s*\([^)]*\)\s*;?/i', '0;', $m[2]) ?? $m[2];
                $body = preg_replace('/(?:window\s*\.\s*)?location\s*(?:\.\s*(?:assign|replace|href)\s*=|\s*=)[^;]+;/i', ';', $body) ?? $body;
                return '<script' . $m[1] . '>' . $body . '</script>';
            },
            $html
        ) ?? $html;
    }

    private function stripAdIframes(string $html): string
    {
        $group = $this->buildPatternGroup(self::AD_SCRIPT_PATTERNS);
        if ($group === '') return $html;
        return preg_replace(
            '/<iframe\b[^>]*\bsrc=["\'][^"\']*(?:' . $group . ')[^"\']*["\'][^>]*>.*?<\/iframe>/is',
            '<!-- [KP] ad iframe removed -->',
            $html
        ) ?? $html;
    }

    /**
     * Join patterns into a safe alternation group.
     * - Escapes the regex delimiter (/) in each pattern
     * - Validates each pattern individually; skips broken ones with a log warning
     */
    private function buildPatternGroup(array $patterns): string
    {
        $safe = [];
        foreach ($patterns as $p) {
            // Escape forward slashes (our delimiter) inside each pattern
            $escaped = str_replace('/', '\/', $p);
            // Test the pattern in isolation — skip it if it's invalid regex
            if (@preg_match('/' . $escaped . '/i', '') === false) {
                Log::warning("StreamProxy: skipping invalid regex pattern: {$p}");
                continue;
            }
            $safe[] = $escaped;
        }
        return implode('|', $safe);
    }

    private function rewriteProtocolRelativeUrls(string $html): string
    {
        return preg_replace_callback(
            '/\b(src|href)=(["\'])(\/\/[^"\']+)(["\'])/i',
            fn($m) => $m[1] . '=' . $m[2] . 'https:' . $m[3] . $m[4],
            $html
        );
    }

    private function injectKillScript(string $html, string $base): string
    {
        $baseTag = '<base href="' . rtrim($base, '/') . '/" target="_self">';
        $script  = $baseTag . $this->buildKillScript();

        if (preg_match('/<head[^>]*>/i', $html)) {
            return preg_replace('/(<head[^>]*>)/i', '$1' . $script, $html, 1);
        }

        if (preg_match('/<html[^>]*>/i', $html)) {
            return preg_replace('/(<html[^>]*>)/i', '$1<head>' . $script . '</head>', $html, 1);
        }

        return $script . $html;
    }

    private function buildKillScript(): string
    {
        return <<<'SCRIPT'
<script>
/* KillerPlayer — injected kill script */
(function(w,d){
    w.open    = function(){ return {focus:function(){},close:function(){},document:{write:function(){}}}; };
    w.alert   = function(){};
    w.confirm = function(){ return false; };
    w.prompt  = function(){ return null; };
    d.write   = function(){};
    d.writeln = function(){};

    try {
        Object.defineProperty(w,'location',{
            get:function(){ return location; },
            set:function(v){ console.debug('[KP] location redirect blocked:',v); },
            configurable:true
        });
    } catch(e){}

    const AD_DOMAINS=['doubleclick','googlesyndication','adnxs','exoclick','popcash',
        'popads','adsterra','propellerads','trafficjunky','juicyads','criteo',
        'taboola','outbrain','adcash','hilltopads','pubmatic','openx','rubiconproject'];

    const _ce = d.createElement.bind(d);
    d.createElement = function(tag){
        const el = _ce(tag);
        if(typeof tag==='string' && tag.toLowerCase()==='script'){
            let _src='';
            Object.defineProperty(el,'src',{
                get:()=>_src,
                set:function(v){
                    if(AD_DOMAINS.some(ad=>String(v).includes(ad))){ return; }
                    _src=v; el.setAttribute('src',v);
                },
                configurable:true
            });
        }
        return el;
    };

    function sweepAds(){
        d.querySelectorAll('*').forEach(function(el){
            try{
                const st=w.getComputedStyle(el);
                if((st.position==='fixed'||st.position==='absolute')&&parseInt(st.zIndex)>100){
                    if(!el.querySelector('video')&&el.tagName!=='VIDEO'){ el.remove(); return; }
                }
            }catch(e){}
            const id=(el.id||'').toLowerCase();
            const cls=typeof el.className==='string'?el.className.toLowerCase():'';
            const tokens=['popup','overlay','interstitial','advert','adsense','banner-ad',
                'ad-container','ad-wrap','sponsored','floating-ad','sticky-ad','preroll'];
            if(tokens.some(t=>id.includes(t)||cls.includes(t))){
                if(!el.querySelector('video')&&el.tagName!=='VIDEO') el.remove();
            }
        });
    }

    d.addEventListener('DOMContentLoaded',function(){
        sweepAds();
        setTimeout(sweepAds,800);
        setTimeout(sweepAds,2500);
        setTimeout(sweepAds,5000);
        const obs=new MutationObserver(function(muts){
            muts.forEach(function(m){
                m.addedNodes.forEach(function(node){
                    if(node.nodeType!==1)return;
                    if(node.tagName==='SCRIPT'){
                        const src=node.getAttribute('src')||'';
                        if(AD_DOMAINS.some(function(ad){return src.includes(ad);})){node.remove();return;}
                    }
                    try{
                        const st=w.getComputedStyle(node);
                        if(st.position==='fixed'&&parseInt(st.zIndex)>100){
                            if(!node.querySelector('video'))node.remove();
                        }
                    }catch(e){}
                });
            });
        });
        if(d.body) obs.observe(d.body,{childList:true,subtree:true});

        /* Fix body sizing so it fills the iframe */
        const s=d.createElement('style');
        s.textContent='html,body{margin:0!important;padding:0!important;width:100%!important;height:100%!important;overflow:hidden!important;background:#000!important;}';
        d.head.appendChild(s);
    });
}(window,document));
</script>
SCRIPT;
    }

    // ══════════════════════════════════════════════════════════════════
    // DEVELOPER ERROR PAGE
    // Rendered OUTSIDE the iframe — returned to the embed route so it
    // appears in the main page, not silently trapped inside the iframe.
    // ══════════════════════════════════════════════════════════════════

    private function errorPage(string $title, string $message, array $data = [], array $fixes = []): \Illuminate\Http\Response
    {
        $env = app()->environment();

        // In production, only show minimal error (no internal details)
        if ($env === 'production') {
            $html = $this->buildErrorHtml(
                $title,
                'Stream unavailable. Check Laravel logs for details.',
                [],
                ['Check storage/logs/laravel.log on the server']
            );
            Log::error("StreamProxy Error: {$title} — {$message}", $data);
            return response($html, 502)->header('Content-Type', 'text/html; charset=UTF-8');
        }

        // In local/staging: full debug output
        $html = $this->buildErrorHtml($title, $message, $data, $fixes);
        return response($html, 502)->header('Content-Type', 'text/html; charset=UTF-8');
    }

    private function buildErrorHtml(string $title, string $message, array $data, array $fixes): string
    {
        $dataRows = '';
        foreach ($data as $key => $value) {
            if ($key === 'attempts' && is_array($value)) {
                foreach ($value as $i => $attempt) {
                    $icon    = ($attempt['result'] ?? '') === 'OK' ? '✅' : '❌';
                    $status  = $attempt['status'] ? "HTTP {$attempt['status']}" : 'no response';
                    $bytes   = $attempt['bytes'] ? "{$attempt['bytes']} bytes" : '';
                    $err     = htmlspecialchars($attempt['error'] ?? '');
                    $url     = htmlspecialchars($attempt['url']);
                    $errHtml = $err ? '<br><span style="color:#f87171">' . $err . '</span>' : '';
                    $dataRows .= <<<ROW
                    <tr>
                        <td style="color:#888;padding:6px 12px 6px 0;vertical-align:top;white-space:nowrap">Attempt {$i}</td>
                        <td style="padding:6px 0;font-family:monospace;font-size:12px">
                            {$icon} <span style="color:#7dd3fc">{$url}</span><br>
                            <span style="color:#94a3b8">{$status} {$bytes}</span>
                            {$errHtml}
                        </td>
                    </tr>
ROW;
                }
            } elseif ($key === 'trace') {
                $v = htmlspecialchars((string)$value);
                $dataRows .= "<tr><td style='color:#888;padding:6px 12px 6px 0;vertical-align:top'>trace</td><td style='font-family:monospace;font-size:11px;color:#94a3b8;white-space:pre-wrap;word-break:break-all'>{$v}</td></tr>";
            } else {
                $v = htmlspecialchars(is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : (string)$value);
                $dataRows .= "<tr><td style='color:#888;padding:6px 12px 6px 0;vertical-align:top;white-space:nowrap'>{$key}</td><td style='font-family:monospace;font-size:12px;color:#e2e8f0'>{$v}</td></tr>";
            }
        }

        $fixItems = '';
        foreach ($fixes as $fix) {
            $f = htmlspecialchars($fix);
            $fixItems .= "<li style='margin:5px 0;color:#86efac'>{$f}</li>";
        }

        $env     = htmlspecialchars(app()->environment());
        $time    = now()->format('Y-m-d H:i:s T');
        $logPath = htmlspecialchars(storage_path('logs/laravel.log'));

        // Pre-compute blocks — no expressions allowed inside heredoc
        $dataRowsBlock = $dataRows
            ? '<div class="card"><div class="card-title">Diagnostic Details</div><table>' . $dataRows . '</table></div>'
            : '';
        $fixItemsBlock = $fixItems
            ? '<div class="card"><div class="card-title">How to fix</div><ul class="fix-list">' . $fixItems . '</ul></div>'
            : '';
        $channelId = htmlspecialchars($data['channel_id'] ?? '??');
        $curlCmd   = 'curl -v -A "Mozilla/5.0" "https://dlstreams.top/embed/stream-' . $channelId . '.php"';

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>StreamProxy Error</title>
<style>
  *{box-sizing:border-box;margin:0;padding:0}
  body{background:#0a0e1a;color:#e2e8f0;font-family:'Segoe UI',system-ui,sans-serif;
       min-height:100vh;padding:32px 20px;line-height:1.6}
  .wrap{max-width:760px;margin:0 auto}
  .badge{display:inline-flex;align-items:center;gap:6px;background:#7f1d1d;
         color:#fca5a5;font-size:11px;font-weight:700;letter-spacing:1.5px;
         padding:4px 10px;border-radius:4px;text-transform:uppercase;margin-bottom:18px}
  h1{font-size:22px;font-weight:700;color:#f1f5f9;margin-bottom:8px}
  .msg{color:#94a3b8;font-size:14px;margin-bottom:28px;padding:14px 16px;
       background:#0f172a;border-left:3px solid #ef4444;border-radius:0 6px 6px 0}
  .card{background:#0f172a;border:1px solid #1e293b;border-radius:10px;
        padding:20px 24px;margin-bottom:20px}
  .card-title{font-size:11px;font-weight:700;letter-spacing:1.5px;
               color:#475569;text-transform:uppercase;margin-bottom:14px}
  table{width:100%;border-collapse:collapse}
  .fix-list{list-style:none;padding:0}
  .fix-list li::before{content:'→ ';color:#4ade80}
  .meta{font-size:11px;color:#334155;margin-top:24px;display:flex;gap:20px;flex-wrap:wrap}
  .cmd{background:#020817;border:1px solid #1e293b;border-radius:6px;
       padding:10px 14px;font-family:monospace;font-size:12px;color:#7dd3fc;
       word-break:break-all;margin-top:8px}
</style>
</head>
<body>
<div class="wrap">
  <div class="badge">⚠ StreamProxy Error</div>
  <h1>{$title}</h1>
  <div class="msg">{$message}</div>

  {$dataRowsBlock}

  {$fixItemsBlock}

  <div class="card">
    <div class="card-title">Debug Commands</div>
    <p style="color:#64748b;font-size:13px;margin-bottom:8px">Run from your server to test upstream connectivity:</p>
    <div class="cmd">{$curlCmd}</div>
    <div class="cmd" style="margin-top:8px">tail -f {$logPath}</div>
  </div>

  <div class="meta">
    <span>Env: <b style="color:#e2e8f0">{$env}</b></span>
    <span>Channel: <b style="color:#e2e8f0">{$channelId}</b></span>
    <span>Time: <b style="color:#e2e8f0">{$time}</b></span>
    <span>Log: <b style="color:#e2e8f0">{$logPath}</b></span>
  </div>
</div>
</body>
</html>
HTML;
    }
}
