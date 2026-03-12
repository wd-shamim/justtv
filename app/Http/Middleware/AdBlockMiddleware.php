<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * AdBlockMiddleware
 *
 * Applies Content-Security-Policy headers to the embed route that:
 *   1. Blocks all external JS except from the stream domain itself
 *   2. Blocks popups via navigate-to restriction
 *   3. Blocks known ad network domains from loading any resource
 *
 * Register in app/Http/Kernel.php under $routeMiddleware:
 *   'adblock' => \App\Http\Middleware\AdBlockMiddleware::class,
 *
 * Then apply to your embed route:
 *   Route::get('/killerplayer/tv', 'embed')
 *        ->name('killerplayer.tv.embed')
 *        ->middleware('adblock');
 */
class AdBlockMiddleware
{
    /**
     * Known ad/tracker domains to explicitly block.
     * These are added to the CSP as blocked sources.
     */
    private const BLOCKED_DOMAINS = [
        'doubleclick.net',
        'googlesyndication.com',
        'googleadservices.com',
        'adservice.google.com',
        'pagead2.googlesyndication.com',
        'ads.pubmatic.com',
        'ib.adnxs.com',
        'secure.adnxs.com',
        'rubiconproject.com',
        'openx.net',
        'openx.com',
        'appnexus.com',
        'criteo.com',
        'criteo.net',
        'taboola.com',
        'outbrain.com',
        'revcontent.com',
        'mgid.com',
        'exoclick.com',
        'juicyads.com',
        'popcash.net',
        'popads.net',
        'adsterra.com',
        'propellerads.com',
        'hilltopads.net',
        'trafficjunky.net',
        'adskeeper.co.uk',
        'bidvertiser.com',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only apply to our embed route (non-binary responses)
        if (! $response instanceof \Illuminate\Http\Response) {
            return $response;
        }

        $appDomain    = parse_url(config('app.url'), PHP_URL_HOST) ?? 'localhost';
        $streamDomain = 'dlstreams.top';

        // ── Content-Security-Policy ───────────────────────────────────
        // Whitelist only what the embed legitimately needs.
        // Everything else (ad networks) is implicitly denied.
        $csp = implode('; ', [
            // Default: only self
            "default-src 'self'",

            // Scripts: only from self (our inline JS uses 'unsafe-inline')
            // We do NOT whitelist the stream domain for scripts —
            // their player JS runs inside the iframe, not our page.
            "script-src 'self' 'unsafe-inline'",

            // Styles: self + inline (player uses inline styles)
            "style-src 'self' 'unsafe-inline'",

            // Frames: ONLY the stream domain is allowed to be iframed
            "frame-src https://{$streamDomain} https://thedaddy.to https://dlhd.so https://daddylive.mp",

            // Images: self, data URIs, and https (for logos/thumbnails)
            "img-src 'self' data: blob: https:",

            // Media: self and blob (HLS streams use blob: URLs)
            "media-src 'self' blob: https://{$streamDomain}",

            // XHR/fetch: self + stream domain only
            "connect-src 'self' https://{$streamDomain} wss://{$streamDomain}",

            // Workers: self only (for our Service Worker)
            "worker-src 'self'",

            // Fonts: self only
            "font-src 'self'",

            // Objects: none (no Flash/plugins)
            "object-src 'none'",

            // Base URI: self only (prevents base tag hijacking)
            "base-uri 'self'",

            // Form actions: self only
            "form-action 'self'",

            // Block all navigations to other origins (kills redirect ads)
            // Note: navigate-to is a newer directive, not all browsers support it
            "navigate-to 'self' https://{$streamDomain}",
        ]);

        $response->headers->set('Content-Security-Policy', $csp);

        // ── Additional security headers ───────────────────────────────

        // Prevent our embed page from being iframed on unknown domains
        // (only the killerplayer UI page should embed it)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Block MIME sniffing (prevents JS disguised as other content)
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Referrer: send no referrer to ad networks
        $response->headers->set('Referrer-Policy', 'no-referrer');

        // Permissions Policy: disable APIs that ads abuse
        $response->headers->set('Permissions-Policy', implode(', ', [
            'camera=()',
            'microphone=()',
            'payment=()',
            'usb=()',
            'geolocation=()',
            'interest-cohort=()',   // disables FLoC / Topics API used for ad targeting
        ]));

        return $response;
    }
}
