/*
 * ad-blocker-sw.js
 * Place at: public/ad-blocker-sw.js  (must be served from root scope)
 *
 * This Service Worker intercepts every fetch request the page makes
 * and blocks known ad/tracker domains by returning an empty 200 response.
 *
 * Since the embed iframe src (dlstreams.top) is cross-origin, the SW
 * on OUR origin cannot intercept requests INSIDE that iframe.
 * BUT — popup windows, redirects, and any resource the iframe tries
 * to load on OUR origin ARE intercepted.
 *
 * The real ad-kill happens via the <iframe allow="..."> + the
 * CSS+JS overlay trick in em.blade.php (see below).
 */

const VERSION = 'v1';

/* ── Ad domains to block ────────────────────────────────────────── */
const BLOCKED_DOMAINS = [
    'doubleclick.net',
    'googlesyndication.com',
    'googleadservices.com',
    'adservice.google.com',
    'pagead2.googlesyndication.com',
    'ads.pubmatic.com',
    'ib.adnxs.com',
    'secure.adnxs.com',
    'cdn.adnxs.com',
    'adbrite.com',
    'advertising.com',
    'adtechus.com',
    'valueclick.com',
    'yieldmanager.com',
    'yieldmanager.net',
    'rubiconproject.com',
    'openx.net',
    'openx.com',
    'appnexus.com',
    'casalemedia.com',
    'contextweb.com',
    'zedo.com',
    'undertone.com',
    'spotxchange.com',
    'spotx.tv',
    'adform.net',
    'smartadserver.com',
    'criteo.com',
    'criteo.net',
    'taboola.com',
    'outbrain.com',
    'revcontent.com',
    'mgid.com',
    'adnium.com',
    'trafficjunky.net',
    'exoclick.com',
    'juicyads.com',
    'plugrush.com',
    'popcash.net',
    'popads.net',
    'popcash.net',
    'hilltopads.net',
    'adsterra.com',
    'propellerads.com',
    'richpush.co',
    'pushcrew.com',
    'onesignal.com',
    'pushassist.com',
    'subscribers.com',
    'sendpulse.com',
    'adskeeper.co.uk',
    'bidvertiser.com',
    'clkmon.com',
    'trk.pjtracking.com',
    'adf.ly',
    'shrinkme.io',
    'linkvertise.com',
    'shorte.st',
    'bc.vc',
    'exe.io',
    'goo.gl',
    // stream-site specific ad networks (add more as discovered)
    'stream-tv-ad.com',
    'streamad.net',
    'embedads.net',
    'daddy-ads.com',
    'dlads.top',
    'dltrack.top',
    'dlstat.top',
    'pop.dlstreams.top',
    'ads.dlstreams.top',
];

/* ── Blocked URL path patterns ──────────────────────────────────── */
const BLOCKED_PATTERNS = [
    /\/ads?\//i,
    /\/ad\./i,
    /\/banner/i,
    /\/popup/i,
    /\/interstitial/i,
    /\/preroll/i,
    /\/midroll/i,
    /\/vast/i,
    /\/vpaid/i,
    /googletag/i,
    /adsbygoogle/i,
    /gpt\.js/i,
    /prebid/i,
    /adsense/i,
];

function shouldBlock(url) {
    try {
        const u = new URL(url);
        // Block by domain
        if (BLOCKED_DOMAINS.some(d => u.hostname === d || u.hostname.endsWith('.' + d))) {
            return true;
        }
        // Block by path pattern
        if (BLOCKED_PATTERNS.some(p => p.test(u.pathname + u.search))) {
            return true;
        }
    } catch (_) { /* invalid URL — ignore */ }
    return false;
}

/* Empty JS response for blocked script requests */
function emptyScript() {
    return new Response('/* blocked */', {
        status: 200,
        headers: { 'Content-Type': 'application/javascript' },
    });
}

/* Empty response for other blocked resources */
function emptyResponse() {
    return new Response('', {
        status: 200,
        headers: { 'Content-Type': 'text/plain' },
    });
}

self.addEventListener('install', e => {
    self.skipWaiting();
});

self.addEventListener('activate', e => {
    e.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', e => {
    const { request } = e;
    const url = request.url;

    if (shouldBlock(url)) {
        console.debug('[AdBlockSW] Blocked:', url);
        const isScript = request.destination === 'script'
            || /\.js(\?|$)/i.test(url);
        e.respondWith(isScript ? emptyScript() : emptyResponse());
        return;
    }

    /* Pass everything else through normally */
    e.respondWith(fetch(request));
});