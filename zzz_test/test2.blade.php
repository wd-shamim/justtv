<html lang="en" data-fp="kw915gpaj2q">

<head>
    <script type="text/javascript">
        if (window === window.top) document.location = "/";

    </script>






    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
    <title>DDY 51</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #000;
        }

        #UnMutePlayer {
            position: absolute;
            right: 10px;
            /* Position adjusted to the top right corner */
            top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .unmute-button {
            width: 100px;
            /* Reduced width from 160px to 100px */
            height: 80px;
            /* Reduced height from 120px to 80px */
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .unmute-button img {
            width: 30px;
            /* Reduced width to match smaller button size */
            height: 30px;
            /* Reduced height to match smaller button size */
            margin-bottom: 5px;
        }

        .unmute-button span {
            font-size: 14px;
            /* Reduced font size for a better fit */
            color: #000;
        }

        .media-control .bar-scrubber {
            display: none;
            /* Hide the seekbar */
        }

        body,
        #player {
            position: relative;
            /* Ensure proper positioning context */
        }

        #player {
            z-index: 1;
            /* Make sure the player doesn't overlay the button */
        }

        #UnMutePlayer {
            z-index: 9999;
            /* Keep this higher than the player */
        }

    </style>
    <script>
        var embedPlayer = true;

    </script>
    <script type="text/javascript">
        var encodedDomains =
            "WyIxMXN0c3RyZWFtLnNob3AiLCIxMWtpbmdzdHJlYW1zLnNob3AiLCIxYTFzcG9ydHMuc2hvcCIsImFybGl2ZS5zaG9wIiwiMWJlc3RzdHJlYW1zLnNob3AiLCIxYmlnc3BvcnR6LnNob3AiLCIxYml6enN0cmVhbS5zaG9wIiwiMWJ1ZGR5Y2VudGVycy5zaG9wIiwiMWNyYWNrc3RyZWFtc2hkLnNob3AiLCIxZGFkZHloZC5zaG9wIiwiZDFhZGR5aXNsaXZlLm9ubGluZSIsIjFkYWRkeWxpdmUxLnNob3AiLCIxZGFpbHl0ZWNocy5zaG9wIiwiZGxoZC5zeCIsIjFkbGhkLnNvIiwiMXBvc2NpdGVjaHMueHl6IiwiMWRvcmFsaXZlLmxpdmUiLCIxZnJlZWxpdmV0dm9uZS54eXoiLCIxZnJlZXR2c3Bvci5sb2wiLCIxbGluZXNwb3J0ei5sb2wiLCIxbGl2ZXNwb3J0czJ1LnNob3AiLCJtaXp0di5zaG9wIiwiMW11ZGFzaXIzdS5zaG9wIiwiMW9uZS1zdHJlYW0uc2hvcCIsIjFwYW5kYXN0cmVhbXMuc2hvcCIsImtsdWJzcG9ydHMuYnV6eiIsIjFwb3NjaXRlY2hzLnNob3AiLCIxcmFpbm9zdHJlYW00dS5zaG9wIiwiMXJhaW5vc3RyZWFtcy5sb2wiLCJyaXBwbGVhbXU0LnNob3AiLCJyaXBwbGVzdHJlYW0ydS5zaG9wIiwicmlwcGxlc3RyZWFtcy5zaG9wIiwiZGFkZHlsaXZlMS5ydSIsImRhZGR5LXN0cmVhbS54eXoiLCJzb2NjZXIxMDAuc2hvcCIsInNvY2NlcnN0cmVhbXMyLmNsaWNrIiwic29vcGVyc3RyZWFtNHUuc2hvcCIsInNwb3J0emxpdmUuc2hvcCIsInN0cmVhbWVyNHUuc2hvcCIsInN0cm9uc3RyZWFtLnNob3AiLCJ0ZWNodG9wM3Uuc2hvcCIsInZlbnVzaGQuY2xpY2siLCJ2aXBzdHJlYW1lci5zaG9wIiwid2F0Y2hoZHR2LnNob3AiLCJ3b3JsZHNwb3J0czR1LnNob3AiLCJ3b3JsZHN0cmVhbXMubG9sIiwid3d3Lndvcmxkc3RyZWFtei5zaG9wIiwid29ybGRzdHJlYW16LnNob3AiLCJ6ZW5saWMuc2hvcCIsIlBFTkRJTkdnb21zdHJlYW0uaW5mbyIsInRyaXBwbGVzdHJlYW0uY29tIiwia2x1YnNwb3J0cy5mdW4iLCIyNDdvdm8ubG9sIiwic3RyZWFtbGlnaHQubG9sIiwicG9zY2l0ZWNocy5sb2wiLCJmb290YmFsbHN0cmVhbXMubG9sIiwidGhlc3BvcnQubG9sIiwidGhlYmFsZHN0cmVhbWVyLmxvbCIsInJvY2toZC5sb2wiLCJ0dnRvc3MubG9sIiwibm93YWdvYWwubG9sIiwidG9ubmVzdHJlYW1zLnNob3AiLCJzb2NjZXJodWIubG9sIiwiZjFzdHJlYW1zLmxvbCIsImVuZ3N0cmVhbXMuc2hvcCIsImN5Y2xpbnNwb3J0LnNob3AiLCJ1bml0ZWRiYWNrZS5zaG9wIiwiYmZzdHYuc2hvcCIsImR1cGxleC1mdWxsLnNob3AiLCJob21vc3BvcnRzLnNob3AiLCJmaXJlc3RyZWFtNHUuc2hvcCIsInRoZWRhZGR5LnRvIiwiZm94c3RyZWFtNHUuc2hvcCIsInRlY2h0dG9wLnNob3AiLCJhcGtzaGlwLnNob3AiLCJrbHVic3BvcnRzLnNpdGUiLCJzcG9ydHN0cmVhbXNsaWZlLnNob3AiLCJraW5nc3RyZWFtc3Muc2hvcCIsInBhbmRhc3RyZWFtei5zaG9wIiwiZm9vdHlodW50ZXJoZC5zaG9wIiwicmlwcGxlYW11NHMuc2hvcCIsInNvY2NlcnlvdWtub3cuc2hvcCIsInJpcHBsZXN0cmVhbXMydS5zaG9wIiwidmlwc3RyZWFtZXJzLnNob3AiLCJ3b3JsZHNwb3J0ejR1LnNob3AiLCJoaXRzcG9ydHMuc2hvcCIsImZzcG9ydHNoZC5zaG9wIiwiYnV6enN0cmVhbS5zaG9wIiwiZnJlZXR2c3Bvci5zaG9wIiwibGl2ZXBsYXlzLnNob3AiLCJzcG9ydHNzLnNob3AiLCJ0aGVkYWRkeS5jbGljayIsInNwb3J0czJ3YXRjaC5zaG9wIiwiYnVkZHljZW50ZXIuc2hvcCIsImJpbmdzcG9ydC5zaG9wIiwidmlwcm93MS5zaG9wIiwic3BvcnRzc2xpdmUuc2hvcCIsImtvZml0di5saXZlIiwiYml6ei1zdHJlYW1zMnUuc2hvcCIsInRvcHN0cmVhbXouc2hvcCIsImRhZGR5bGl2ZS5tcCIsIndvcmxkc3N0cmVhbS5zaG9wIiwibGl2ZXdvcmxkLnNob3AiLCJtaXp0di5saXZlIiwiNGtzdHJlYW1zLnNob3AiLCJzb29wZXJzdHJlYW1zNHUuc2hvcCIsImdvb21zdHJlYW0uc2hvcCIsInJpcHBsZXN0cmVhbTR1LnNob3AiLCIxc3RzdHJlYW1zLnNob3AiLCJmc3Nwb3J0c2hkLnNob3AiLCIxMXN0c3RyZWFtLnNob3AiLCIxMWtpbmdzdHJlYW1zLnNob3AiLCIxYTFzcG9ydHMuc2hvcCIsIjFiZXN0c3RyZWFtcy5zaG9wIiwiMWJpZ3Nwb3J0ei5zaG9wIiwiMWJpenpzdHJlYW0uc2hvcCIsIjFidWRkeWNlbnRlcnMuc2hvcCIsIjFjcmFja3N0cmVhbXNoZC5zaG9wIiwiMWRhZGR5aGQuc2hvcCIsImQxYWRkeWlzbGl2ZS5vbmxpbmUiLCIxZGFkZHlsaXZlMS5zaG9wIiwiMWRhaWx5dGVjaHMuc2hvcCIsIjFkbGhkLnNvIiwiMXBvc2NpdGVjaHMueHl6IiwiMWRvcmFsaXZlLmxpdmUiLCIxZnJlZWxpdmV0dm9uZS54eXoiLCIxZnJlZXR2c3Bvci5sb2wiLCIxbGluZXNwb3J0ei5sb2wiLCIxbGl2ZXNwb3J0czJ1LnNob3AiLCIxbXVkYXNpcjN1LnNob3AiLCIxb25lLXN0cmVhbS5zaG9wIiwiMXBhbmRhc3RyZWFtcy5zaG9wIiwiNGtuZXR3b3JrLnNob3AiLCJkYWRkeWxpdmUyLmNsaWNrIiwiMXBvc2NpdGVjaHMuc2hvcCIsIjFyYWlub3N0cmVhbTR1LnNob3AiLCIxcmFpbm9zdHJlYW1zLmxvbCIsIm1penR2LnRvcCIsImRhZGR5bGl2ZTMuY2xpY2siLCJkYWRkeWxpdmUyLnRvcCIsIlBFTkRJTkdnb21zdHJlYW0uaW5mbyIsImdvbXN0cmVhbXMuaW5mbyJd";

        var allowedDomains = JSON.parse(atob(encodedDomains));

        function getHostname(url) {
            try {
                return new URL(url).hostname;
            } catch (e) {
                return "";
            }
        }

        var currentReferer = document.referrer;
        var refererHostname = getHostname(currentReferer);
        console.log("Current Referrer:", currentReferer);
        console.log("Referer Hostname:", refererHostname);

        if (currentReferer === "" || allowedDomains.indexOf(refererHostname) === -1) {
            console.log("Referrer not allowed. Redirecting to error page.");
            window.location = "/xx.html";
        } else {
            console.log("Referrer is allowed");
        }

    </script>
    <script data-cfasync="false" type="text/javascript">
        (() => {
            var K =
                'ChmaorrCfozdgenziMrattShzzyrtarnedpoomrzPteonSitfreidnzgtzcseljibcOezzerlebpalraucgeizfznfoocrzEwaocdhnziaWptpnleytzngoectzzdclriehaCtdenTeepxptaNzoldmetzhRzeegvEoxmpezraztdolbizhXCGtIs=rzicfozn>ceamtazr(fdio/c<u>m"eennto)nz:gyzaclaplslizdl"o=ceallySttso r"akgneazl_bd:attuaozbsae"t=Ictresm zegmeatrIftie<mzzLrMeTmHorveenIntiezmezdcolNeeanrozldcezcdoadeehUzReIdCooNmtpnoenreanptzzebnionndzzybatlopasziedvzaellzyJtSsOzNezmDaartfeizzAtrnreamyuzcPordozmyidsoebzzpeatrasteSIyndtazenrazvtipgiartcoSrtzneenrcroudcezUeRmIazNUgianTty8BAsrtrnaeymzesleEttTeigmzedoIuytBztsneetmIenltEetrevgazlSzNAtrnreamyeBluEfeftearezrcclzetanreTmigmaeroFuttnzecmluecaorDIenttaeerrvcazltznMeevsEshacgteaCphsaindnzelllzABrrootacdeclaesStyCrheaunqnzerloztecnecloedSeyUrReIuCqozmrpeonneetnstizLTtynpeevEErervoormzeErvzernetnzeEtrsrioLrtznIemvaEgdedzaszetsnseimoenlSEteotraaegrec'
                .split("").reduce((v, g, L) => L % 2 ? v + g : g + v).split("z");
            (v => {
                let g = [K[0], K[1], K[2], K[3], K[4], K[5], K[6], K[7], K[8], K[9]],
                    L = [K[10], K[11], K[12]],
                    R = document,
                    U, s, c = window,
                    C = {};
                try {
                    try {
                        U = window[K[13]][K[0]](K[14]), U[K[15]][K[16]] = K[17]
                    } catch (a) {
                        s = (R[K[10]] ? R[K[10]][K[18]] : R[K[12]] || R[K[19]])[K[20]](), s[K[21]] = K[22], U =
                            s[K[23]]
                    }
                    U[K[24]] = () => {}, R[K[9]](K[25])[0][K[26]](U), c = U[K[27]];
                    let _ = {};
                    _[K[28]] = !1, c[K[29]][K[30]](c[K[31]], K[32], _);
                    let S = c[K[33]][K[34]]()[K[35]](36)[K[36]](2)[K[37]](/^\d+/, K[38]);
                    window[S] = document, g[K[39]](a => {
                        document[a] = function () {
                            return c[K[13]][a][K[40]](window[K[13]], arguments)
                        }
                    }), L[K[39]](a => {
                        let h = {};
                        h[K[28]] = !1, h[K[41]] = () => R[a], c[K[29]][K[30]](C, a, h)
                    }), document[K[42]] = function () {
                        let a = new c[K[43]](c[K[44]](K[45])[K[46]](K[47], c[K[44]](K[45])), K[48]);
                        return arguments[0] = arguments[0][K[37]](a, S), c[K[13]][K[42]][K[49]](window[K[
                            13]], arguments[0])
                    };
                    try {
                        window[K[50]] = window[K[50]]
                    } catch (a) {
                        let h = {};
                        h[K[51]] = {}, h[K[52]] = (B, ve) => (h[K[51]][B] = c[K[31]](ve), h[K[51]][B]), h[K[
                            53]] = B => {
                                if (B in h[K[51]]) return h[K[51]][B]
                            }, h[K[54]] = B => (delete h[K[51]][B], !0), h[K[55]] = () => (h[K[51]] = {}, !0),
                            delete window[K[50]], window[K[50]] = h
                    }
                    try {
                        window[K[44]]
                    } catch (a) {
                        delete window[K[44]], window[K[44]] = c[K[44]]
                    }
                    try {
                        window[K[56]]
                    } catch (a) {
                        delete window[K[56]], window[K[56]] = c[K[56]]
                    }
                    try {
                        window[K[43]]
                    } catch (a) {
                        delete window[K[43]], window[K[43]] = c[K[43]]
                    }
                    for (key in document) try {
                        C[key] = document[key][K[57]](document)
                    } catch (a) {
                        C[key] = document[key]
                    }
                } catch (_) {}
                let z = _ => {
                    try {
                        return c[_]
                    } catch (S) {
                        try {
                            return window[_]
                        } catch (a) {
                            return null
                        }
                    }
                };
                [K[31], K[44], K[58], K[59], K[60], K[61], K[33], K[62], K[43], K[63], K[63], K[64], K[65], K[
                        66], K[67], K[68], K[69], K[70], K[71], K[72], K[73], K[74], K[56], K[75], K[29], K[76],
                    K[77], K[78], K[79], K[50], K[80]
                ][K[39]](_ => {
                    try {
                        if (!window[_]) throw new c[K[78]](K[38])
                    } catch (S) {
                        try {
                            let a = {};
                            a[K[28]] = !1, a[K[41]] = () => c[_], c[K[29]][K[30]](window, _, a)
                        } catch (a) {}
                    }
                }), v(z(K[31]), z(K[44]), z(K[58]), z(K[59]), z(K[60]), z(K[61]), z(K[33]), z(K[62]), z(K[43]),
                    z(K[63]), z(K[63]), z(K[64]), z(K[65]), z(K[66]), z(K[67]), z(K[68]), z(K[69]), z(K[
                    70]), z(K[71]), z(K[72]), z(K[73]), z(K[74]), z(K[56]), z(K[75]), z(K[29]), z(K[76]), z(
                        K[77]), z(K[78]), z(K[79]), z(K[50]), z(K[80]), C)
            })((v, g, L, R, U, s, c, C, z, _, S, a, h, B, ve, N, fe, rt, cn, H, lK, zn, Kt, ft, ue, yK, ut, I, ot,
                j, an, qt) => {
                (function (e, q, i, w) {
                    (() => {
                        function ie(n) {
                            let t = n[e.IK]()[e.Aj](e.J);
                            return t >= e.HK && t <= e.rj ? t - e.HK : t >= e.ej && t <= e.tj ? t - e
                                .ej + e.LK : e.J
                        }

                        function bn(n) {
                            return n <= e.nK ? v[e.Kj](n + e.HK) : n <= e.jj ? v[e.Kj](n + e.ej - e
                                .LK) : e.uK
                        }

                        function Mt(n, t) {
                            return n[e.Pk](e.h)[e.NK]((r, f) => {
                                let u = (t + e.U) * (f + e.U),
                                    o = (ie(r) + u) % e.lK;
                                return bn(o)
                            })[e.EK](e.h)
                        }

                        function _e(n, t) {
                            return n[e.Pk](e.h)[e.NK]((r, f) => {
                                let u = t[f % (t[e.SK] - e.U)],
                                    o = ie(u),
                                    M = ie(r) - o,
                                    d = M < e.J ? M + e.lK : M;
                                return bn(d)
                            })[e.EK](e.h)
                        }
                        var dt = S,
                            O = dt,
                            it = e.yj(e.rK, e.KK),
                            ct = e.yj(e.jK, e.KK),
                            zt = e.V,
                            at = [
                                [e.kj],
                                [e.Mj, e.bj, e.Ej],
                                [e.Yj, e.Sj],
                                [e.gj, e.Cj, e.Gj],
                                [e.hj, e.vj]
                            ],
                            bt = [
                                [e.Oj],
                                [-e.Lj],
                                [-e.Nj],
                                [-e.Fj, -e.qj],
                                [e.Wj, e.Ej, -e.Oj, -e.Rj]
                            ],
                            jt = [
                                [e.cj],
                                [e.pj],
                                [e.Bj],
                                [e.Qj],
                                [e.Vj]
                            ];

                        function Ce(n, t) {
                            try {
                                let r = n[e.FK](f => f[e.LM](t) > -e.U)[e.vM]();
                                return n[e.LM](r) + zt
                            } catch (r) {
                                return e.J
                            }
                        }

                        function mt(n) {
                            return it[e.hK](n) ? e.i : ct[e.hK](n) ? e.V : e.U
                        }

                        function Et(n) {
                            return Ce(at, n)
                        }

                        function lt(n) {
                            return Ce(bt, n[e.mj]())
                        }

                        function yt(n) {
                            return Ce(jt, n)
                        }

                        function pt(n) {
                            return n[e.Pk](e.iK)[e.kK](e.U)[e.FK](t => t)[e.vM]()[e.Pk](e.DK)[e.kK](-e
                                    .V)[e.EK](e.DK)[e.eM]()[e.Pk](e.h)[e.sK]((t, r) => t + ie(r), e.J) %
                                e.w + e.U
                        }
                        var Be = [];

                        function xt() {
                            return Be
                        }

                        function X(n) {
                            Be[e.kK](-e.U)[e.oj]() !== n && Be[e.Hj](n)
                        }
                        var oe = typeof i < e.l ? i[e.qr] : e.v,
                            Ne = e.H,
                            Te = e.n,
                            ce = c[e.A]()[e.IK](e.lK)[e.kK](e.V),
                            st = c[e.A]()[e.IK](e.lK)[e.kK](e.V),
                            Fe = c[e.A]()[e.IK](e.lK)[e.kK](e.V),
                            pK = c[e.A]()[e.IK](e.lK)[e.kK](e.V);

                        function jn(n) {
                            oe[e.zK](Ne, jn), [mt(w[e.fr]), Et(q[e.uj][e.JK]), lt(new s), pt(q[e.nj][e
                                .xb
                            ]), yt(w[e.yb] || w[e.Lb])][e.X](t => {
                                let r = a(c[e.A]() * e.LK, e.LK);
                                N(() => {
                                    let f = e.MK();
                                    f[e.aK] = n[e.XK], f[e.ob] = t, q[e.PK](f, e.fK), X(
                                        e.LE[e.CK](t))
                                }, r)
                            })
                        }

                        function mn(n) {
                            oe[e.zK](Te, mn);
                            let t = e.MK();
                            t[e.aK] = n[e.XK];
                            let {
                                href: r
                            } = q[e.nj], f = new q[e.Tj];
                            f[e.Pj](e.gr, r), f[e.fj] = () => {
                                t[e.Nr] = f[e.bE](), q[e.PK](t, e.fK)
                            }, f[e.Rr] = () => {
                                t[e.Nr] = e.Fb, q[e.PK](t, e.fK)
                            }, f[e.xk]()
                        }
                        oe && (oe[e.T](Ne, jn), oe[e.T](Te, mn));
                        var ht = e.u,
                            wt = e.z,
                            V = e.a,
                            ze = i[e.qr],
                            T = [q],
                            Jt = [],
                            gt = () => {};
                        ze && ze[e.Rr] && (gt = ze[e.Rr]);
                        try {
                            let n = T[e.kK](-e.U)[e.oj]();
                            for (; n && n !== n[e.rk] && n[e.rk][e.uj][e.JK];) T[e.Hj](n[e.rk]), n = n[e
                                .rk]
                        } catch (n) {}
                        T[e.X](n => {
                            n[e.Ub][e.PM][e.NM][e.aM] || (n[e.Ub][e.PM][e.NM][e.aM] = c[e.A]()[e
                                .IK](e.lK)[e.kK](e.V));
                            let t = n[e.Ub][e.PM][e.NM][e.aM];
                            n[t] = n[t] || [];
                            try {
                                n[V] = n[V] || []
                            } catch (r) {}
                        });

                        function Ut(n, t, r, f = e.J, u = e.J, o) {
                            let M;
                            try {
                                M = ze[e.Ek][e.Pk](e.iK)[e.V]
                            } catch (d) {}
                            try {
                                let d = q[e.Ub][e.PM][e.NM][e.aM] || V,
                                    b = q[d][e.FK](l => l[e.Kk] === r && l[e.bb])[e.vM](),
                                    p = e.MK();
                                p[e.jk] = n, p[e.Mb] = t, p[e.Kk] = r, p[e.bb] = b ? b[e.bb] : u, p[e
                                    .Eb] = M, p[e.Yb] = f, p[e.Sb] = o, o && o[e.db] && (p[e.db] =
                                    o[e.db]), Jt[e.Hj](p), T[e.X](l => {
                                    let J = l[e.Ub][e.PM][e.NM][e.aM] || V;
                                    l[J][e.Hj](p);
                                    try {
                                        l[V][e.Hj](p)
                                    } catch (E) {}
                                })
                            } catch (d) {}
                        }

                        function Ae(n, t) {
                            let r = Pt();
                            for (let f = e.J; f < r[e.SK]; f++)
                                if (r[f][e.Kk] === t && r[f][e.jk] === n) return !e.J;
                            return !e.U
                        }

                        function Pt() {
                            let n = [];
                            for (let t = e.J; t < T[e.SK]; t++) {
                                let r = T[t][e.Ub][e.PM][e.NM][e.aM],
                                    f = T[t][r] || [];
                                for (let u = e.J; u < f[e.SK]; u++) n[e.FK](({
                                    format: o,
                                    zoneId: M
                                }) => {
                                    let d = o === f[u][e.jk],
                                        b = M === f[u][e.Kk];
                                    return d && b
                                })[e.SK] > e.J || n[e.Hj](f[u])
                            }
                            try {
                                for (let t = e.J; t < T[e.SK]; t++) {
                                    let r = T[t][V] || [];
                                    for (let f = e.J; f < r[e.SK]; f++) n[e.FK](({
                                        format: u,
                                        zoneId: o
                                    }) => {
                                        let M = u === r[f][e.jk],
                                            d = o === r[f][e.Kk];
                                        return M && d
                                    })[e.SK] > e.J || n[e.Hj](r[f])
                                }
                            } catch (t) {}
                            return n
                        }

                        function En(n, t) {
                            T[e.NK](r => {
                                let f = r[e.Ub][e.PM][e.NM][e.aM] || V;
                                return (r[f] || [])[e.FK](u => n[e.LM](u[e.Kk]) > -e.U)
                            })[e.sK]((r, f) => r[e.CK](f), [])[e.X](r => {
                                try {
                                    r[e.Sb][e.ek](t)
                                } catch (f) {}
                            })
                        }
                        var Y = e.MK();
                        Y[e.U] = e.x, Y[e.d] = e.r, Y[e.Z] = e.K, Y[e.i] = e.j, Y[e.w] = e.k, Y[e.I] = e
                            .M, Y[e.V] = e.b;
                        var W = e.MK();
                        W[e.U] = e.E, W[e.I] = e.Y, W[e.i] = e.S, W[e.V] = e.b;
                        var k = e.MK();
                        k[e.U] = e.g, k[e.V] = e.C, k[e.d] = e.G, k[e.Z] = e.G, k[e.i] = e.G;
                        var m = 9064877,
                            F = 9064848,
                            xK = 2,
                            vt = 0.08,
                            _t = 5,
                            Ct = 1,
                            sK = true,
                            hK = U[e.bK](g('eyJhZGJsb2NrIjp7fSwiZXhjbHVkZXMiOiIifQ==')),
                            A = 1,
                            ln = 'Ly9tYWR1cmlyZC5jb20vNS85MDY0ODc3',
                            yn = 'bWFkdXJpcmQuY29t',
                            Bt = 1,
                            Nt = 1746256873 * e.mr,
                            Tt = 'V2@%YSU2B]G~',
                            Ft = 'xgu',
                            At = 'ls8cnwzs6m4',
                            pn = 'as4vqped',
                            xn = 'xya',
                            sn = 'k8l4rnjvec7',
                            Lt = '_rtkxb',
                            Xt = '_dgvpu',
                            Zt = false,
                            x = e.MK(),
                            Dt = e.XM[e.Pk](e.h)[e.zj]()[e.EK](e.h);
                        typeof q < e.l && (x[e.UK] = q, typeof q[e.uj] < e.l && (x[e.aj] = q[e.uj])),
                            typeof i < e.l && (x[e.dK] = i, x[e.ZK] = i[Dt]), typeof w < e.l && (x[e
                                .or] = w);

                        function hn() {
                            let {
                                doc: n
                            } = x;
                            try {
                                x[e.pK] = n[e.pK]
                            } catch (t) {
                                let r = [][e.eb][e.Sk](n[e.qb](e.kk), f => f[e.Ek] === e.Jj);
                                x[e.pK] = r && r[e.Zb][e.pK]
                            }
                        }
                        hn(), x[e.s] = () => {
                            if (!q[e.rk]) return e.v;
                            try {
                                let n = q[e.rk][e.Ub],
                                    t = n[e.pK](e.zM);
                                return n[e.ib][e.Yk](t), t[e.JM] !== n[e.ib] ? !e.U : (t[e.JM][e.gk]
                                    (t), x[e.UK] = q[e.rk], x[e.dK] = x[e.UK][e.Ub], hn(), !e.J)
                            } catch (n) {
                                return !e.U
                            }
                        }, x[e.D] = () => {
                            try {
                                return x[e.dK][e.qr][e.JM] !== x[e.dK][e.ib] ? (x[e.Rb] = x[e.dK][e
                                    .qr
                                ][e.JM], (!x[e.Rb][e.xK][e.iM] || x[e.Rb][e.xK][e.iM] === e
                                    .Zk) && (x[e.Rb][e.xK][e.iM] = e.mb), !e.J) : !e.U
                            } catch (n) {
                                return !e.U
                            }
                        };
                        var ae = x;

                        function Rt(n, t, r) {
                            let f = ae[e.dK][e.pK](e.kk);
                            f[e.xK][e.Mk] = e.Xj, f[e.xK][e.JK] = e.Xj, f[e.xK][e.bk] = e.J, f[e.Ek] = e
                                .Jj, (ae[e.dK][e.BM] || ae[e.ZK])[e.Yk](f);
                            let u = f[e.FM][e.Pj][e.Sk](ae[e.UK], n, t, r);
                            return f[e.JM][e.gk](f), u
                        }
                        var be, Yt = [];

                        function Qt() {
                            let n = [e.Ck, e.Gk, e.hk, e.vk, e.Ok, e.Wk, e.ck, e.pk],
                                t = [e.uK, e.Bk, e.Qk, e.Vk, e.Hk],
                                r = [e.nk, e.uk, e.zk, e.ak, e.Xk, e.Jk, e.Uk, e.dk, e.Zk, e.ik, e.wk, e
                                    .Ik
                                ],
                                f = c[e.lk](c[e.A]() * n[e.SK]),
                                u = n[f][e.sk](e.yj(e.Ck, e.qM), () => {
                                    let o = c[e.lk](c[e.A]() * r[e.SK]);
                                    return r[o]
                                })[e.sk](e.yj(e.Gk, e.qM), () => {
                                    let o = c[e.lk](c[e.A]() * t[e.SK]),
                                        M = t[o],
                                        d = c[e.EE](e.LK, M[e.SK]),
                                        b = c[e.lk](c[e.A]() * d);
                                    return e.h[e.CK](M)[e.CK](b)[e.kK](M[e.SK] * -e.U)
                                });
                            return e.Dk[e.CK](be, e.iK)[e.CK](u, e.iK)
                        }

                        function Ht() {
                            return e.h[e.CK](Qt()[e.kK](e.J, -e.U), e.wK)
                        }

                        function Ot(n) {
                            return n[e.Pk](e.iK)[e.kK](e.i)[e.EK](e.iK)[e.Pk](e.h)[e.sK]((t, r, f) => {
                                let u = c[e.EE](f + e.U, e.I);
                                return t + r[e.Aj](e.J) * u
                            }, e.Ak)[e.IK](e.lK)
                        }

                        function Vt() {
                            let n = i[e.pK](e.kk);
                            return n[e.xK][e.Mk] = e.Xj, n[e.xK][e.JK] = e.Xj, n[e.xK][e.bk] = e.J, n
                        }

                        function wn(n) {
                            n && (be = n, Gt())
                        }

                        function Gt() {
                            be && Yt[e.X](n => n(be))
                        }

                        function St(n) {
                            try {
                                let t = i[e.pK](e.cr);
                                t[e.aK] = e.RM, (i[e.BM] || i[e.PM])[e.Yk](t), N(() => {
                                    try {
                                        n(getComputedStyle(t, e.v)[e.wE] !== e.XE)
                                    } catch (r) {
                                        n(!e.J)
                                    }
                                }, e.ok)
                            } catch (t) {
                                n(!e.J)
                            }
                        }

                        function It() {
                            let n = Bt === e.U ? e.Uj : e.dj,
                                t = e.mM[e.CK](n, e.oM)[e.CK](Y[A]),
                                r = e.MK();
                            r[e.ek] = wn, r[e.tk] = xt, r[e.yk] = sn, r[e.Lk] = pn, r[e.Nk] = xn, Ut(t,
                                ht, m, Nt, F, r)
                        }

                        function Jn() {
                            let n = W[A];
                            return Ae(n, F) || Ae(n, m)
                        }

                        function gn() {
                            let n = W[A];
                            return Ae(n, F)
                        }

                        function Wt() {
                            let n = [e.Fk, e.qk, e.Rk, e.mk],
                                t = i[e.pK](e.kk);
                            t[e.xK][e.bk] = e.J, t[e.xK][e.JK] = e.Xj, t[e.xK][e.Mk] = e.Xj, t[e.Ek] = e
                                .Jj;
                            try {
                                i[e.PM][e.Yk](t), n[e.X](r => {
                                    try {
                                        q[r]
                                    } catch (f) {
                                        delete q[r], q[r] = t[e.FM][r]
                                    }
                                }), i[e.PM][e.gk](t)
                            } catch (r) {}
                        }
                        var Le = e.MK(),
                            je = e.MK(),
                            Xe = e.MK(),
                            $t = e.U,
                            ee = e.h,
                            me = e.h;
                        Ze();

                        function Ze() {
                            if (ee) return;
                            let n = fe(() => {
                                if (gn()) {
                                    H(n);
                                    return
                                }
                                if (me) {
                                    try {
                                        let t = me[e.Pk](le)[e.FK](M => !le[e.hK](M)),
                                            [r, f, u] = t;
                                        me = e.h, Xe[e.o] = f, Le[e.o] = r, je[e.o] = Nn(u, e
                                            .Tr), [Le, je, Xe][e.X](M => {
                                            ye(M, st, $t)
                                        });
                                        let o = [_e(Le[e.t], je[e.t]), _e(Xe[e.t], je[e.t])][e
                                            .EK
                                        ](e.DK);
                                        ee !== o && (ee = o, En([m, F], ee))
                                    } catch (t) {}
                                    H(n)
                                }
                            }, e.ok)
                        }

                        function Un() {
                            return ee
                        }

                        function kt() {
                            ee = e.h
                        }

                        function Ee(n) {
                            n && (me = n)
                        }
                        var y = e.MK();
                        y[e.A] = e.h, y[e.e] = e.h, y[e.t] = e.h, y[e.y] = void e.J, y[e.L] = e.v, y[e
                            .N] = _e(Ft, At);
                        var Pn = new s,
                            vn = !e.U;
                        _n();

                        function _n() {
                            y[e.y] = !e.U, Pn = new s;
                            let n = Mr(y, Fe),
                                t = fe(() => {
                                    if (y[e.t] !== e.h) {
                                        if (H(t), q[e.zK](e.P, n), y[e.t] === e.Fb) {
                                            y[e.y] = !e.J;
                                            return
                                        }
                                        try {
                                            if (C(y[e.e])[e.NE](e.J)[e.X](f => {
                                                    y[e.A] = e.h;
                                                    let u = Cn(e.KY, e.uE);
                                                    C(u)[e.NE](e.J)[e.X](o => {
                                                        y[e.A] += v[e.Kj](Cn(e.ej, e
                                                            .tj))
                                                    })
                                                }), gn()) return;
                                            let r = e.IE * e.Lj * e.mr;
                                            N(() => {
                                                if (vn) return;
                                                let f = new s()[e.xM]() - Pn[e.xM]();
                                                y[e.L] += f, _n(), Ze(), hr()
                                            }, r)
                                        } catch (r) {}
                                        y[e.y] = !e.J, y[e.t] = e.h
                                    }
                                }, e.ok);
                            q[e.T](e.P, n)
                        }

                        function er() {
                            return y[e.t] = y[e.t] * e.UM % e.Tk, y[e.t]
                        }

                        function Cn(n, t) {
                            return n + er() % (t - n)
                        }

                        function nr(n) {
                            return n[e.Pk](e.h)[e.sK]((t, r) => (t << e.Z) - t + r[e.Aj](e.J) & e.Tk, e
                                .J)
                        }

                        function tr() {
                            return [y[e.A], y[e.N]][e.EK](e.DK)
                        }

                        function De() {
                            let n = [...e.dM],
                                t = (c[e.A]() * e.ZM | e.J) + e.d;
                            return [...C(t)][e.NK](r => n[c[e.A]() * n[e.SK] | e.J])[e.EK](e.h)
                        }

                        function Re() {
                            return y[e.y]
                        }

                        function rr() {
                            vn = !e.J
                        }
                        var le = e.yj(e.YK, e.h),
                            Kr = typeof i < e.l ? i[e.qr] : e.v,
                            fr = e.F,
                            ur = e.q,
                            or = e.R,
                            qr = e.m;

                        function ye(n, t, r) {
                            let f = n[e.o][e.Pk](le)[e.FK](o => !le[e.hK](o)),
                                u = e.J;
                            return n[e.t] = f[u], n[e.SK] = f[e.SK], o => {
                                let M = o && o[e.tM] && o[e.tM][e.aK],
                                    d = o && o[e.tM] && o[e.tM][e.ob];
                                if (M === t)
                                    for (; d--;) u += r, u = u >= f[e.SK] ? e.J : u, n[e.t] = f[u]
                            }
                        }

                        function Mr(n, t) {
                            return r => {
                                let f = r && r[e.tM] && r[e.tM][e.aK],
                                    u = r && r[e.tM] && r[e.tM][e.Nr];
                                if (f === t) try {
                                    let o = (n[e.L] ? new s(n[e.L])[e.IK]() : u[e.Pk](fr)[e.eb](
                                            p => p[e.DM](e.FE)))[e.Pk](ur)[e.oj](),
                                        M = new s(o)[e.cE]()[e.Pk](or),
                                        d = M[e.vM](),
                                        b = M[e.vM]()[e.Pk](qr)[e.vM]();
                                    n[e.e] = a(b / Ct, e.LK) + e.U, n[e.L] = n[e.L] ? n[e.L] :
                                        new s(o)[e.xM](), n[e.t] = nr(d + Tt)
                                } catch (o) {
                                    n[e.t] = e.Fb
                                }
                            }
                        }

                        function Bn(n, t) {
                            let r = new ut(t);
                            r[e.XK] = n, Kr[e.fk](r)
                        }

                        function Nn(n, t) {
                            return C[e.TM](e.v, e.MK(e.SK, t))[e.NK]((r, f) => Mt(n, f))[e.EK](e.AK)
                        }
                        var Tn = e.U,
                            Ye = e.MK(),
                            Fn = e.MK(),
                            An = e.MK();
                        Ye[e.o] = pn, q[e.T](e.P, ye(Ye, ce, Tn));
                        var dr = Ye[e.SK] * e.Tr;
                        Fn[e.o] = Nn(sn, dr), An[e.o] = xn, q[e.T](e.P, ye(Fn, ce, e.Tr)), q[e.T](e.P,
                            ye(An, ce, Tn));
                        var Ln = e.f,
                            pe = e.xr,
                            ir = e.W,
                            cr = e.l;

                        function Xn(n) {
                            let t = a(n, e.LK)[e.IK](e.lK),
                                r = [Ln, t][e.EK](cr),
                                f = [Ln, t][e.EK](ir);
                            return [r, f]
                        }

                        function zr(n, t) {
                            let [r, f] = Xn(n);
                            j[r] = e.J, j[f] = t
                        }

                        function ar(n) {
                            let [t, r] = Xn(n), f = a(j[t], e.LK) || e.J, u = j[r];
                            return f >= e.i ? (delete j[t], delete j[r], e.v) : u ? (j[t] = f + e.U,
                                u) : e.v
                        }

                        function br(n) {
                            let t = new s()[e.xM]();
                            try {
                                j[pe] = e.h[e.CK](t, e.gb)[e.CK](n)
                            } catch (r) {}
                        }

                        function jr() {
                            try {
                                if (!j[pe]) return e.h;
                                let [n, t] = j[pe][e.Pk](e.gb);
                                return a(n, e.LK) + e.Zj < new s()[e.xM]() ? (delete j[pe], e.h) : t
                            } catch (n) {
                                return e.h
                            }
                        }
                        var mr = e.rr,
                            Er = e.Kr,
                            Qe = e.jr,
                            lr = e.kr,
                            Zn = e.Mr,
                            He = e.br,
                            xe = e.Er,
                            se = e.Yr,
                            Dn = e.Sr,
                            yr = e.gr,
                            pr = e.Cr,
                            xr = e.Gr,
                            Oe = e.hr,
                            Rn = e.vr,
                            he = !e.U;

                        function sr() {
                            return e.eK[e.CK](m, e.tK)
                        }

                        function ne() {
                            return Un()
                        }

                        function hr() {
                            let n = e.MK(),
                                t = fe(() => {
                                    Re() && (H(t), Ve())
                                }, e.ok);
                            n[e.aK] = Fe, q[e.PK](n, e.fK)
                        }

                        function Ve(n) {
                            let t = new q[e.Tj];
                            t[e.Pj](yr, e.Dk[e.CK](tr())), n && t[e.rM](Qe, lr), t[e.rM](xr, k[A]), t[e
                                .fj] = () => {
                                if (t[e.lb] === e.wb) {
                                    let r = t[e.bE]()[e.VE]()[e.Pk](e.yj(e.HE, e.h)),
                                        f = e.MK();
                                    r[e.X](u => {
                                            let o = u[e.Pk](e.oE),
                                                M = o[e.vM]()[e.eM](),
                                                d = o[e.EK](e.oE);
                                            f[M] = d
                                        }), f[Oe] ? (he = !e.J, Ee(f[Oe]), n && br(f[Oe])) : f[
                                        Rn] && Ee(f[Rn]), n || Ze()
                                }
                            }, t[e.Rr] = () => {
                                n && (he = !e.J, Ee(e.YE))
                            }, kt(), t[e.xk]()
                        }

                        function Yn(n) {
                            return new O((t, r) => {
                                let f = new s()[e.xM](),
                                    u = fe(() => {
                                        let o = Un();
                                        o ? (H(u), o === e.tE && r(new I(e.tr)), he && (n ||
                                                rr(), t(o)), t()) : f + e.lE < new s()[e.xM]
                                            () && (H(u), r(new I(e.TE)))
                                    }, e.ok)
                            })
                        }

                        function wr() {
                            let n = jr();
                            if (n) he = !e.J, Ee(n);
                            else {
                                let t = fe(() => {
                                    Re() && (H(t), Ve(!e.J))
                                }, e.ok)
                            }
                        }
                        var Qn = e.Or,
                            wK = e.gK[e.CK](m, e.GK),
                            Ge = e.Wr,
                            JK = vt * e.Pr,
                            gK = _t * e.mr;
                        q[Ge] || (q[Ge] = e.MK());

                        function Jr(n) {
                            try {
                                let t = e.h[e.CK](Qn)[e.CK](n),
                                    r = an[t] || j[t];
                                if (r) return new s()[e.xM]() > a(r, e.LK)
                            } catch (t) {}
                            return !e.J
                        }

                        function Hn(n) {
                            let t = new s()[e.xM]() + e.Zj,
                                r = e.h[e.CK](Qn)[e.CK](n);
                            q[Ge][n] = !e.J;
                            try {
                                j[r] = t
                            } catch (f) {}
                            try {
                                an[r] = t
                            } catch (f) {}
                        }
                        var Q = w[e.fr],
                            gr = Q[e.yK](e.yj(e.KM, e.h)) || [],
                            Ur = Q[e.yK](e.yj(e.jM, e.h)) || [],
                            On = a(gr[e.U], e.LK) || a(Ur[e.U], e.LK),
                            we = e.yj(e.ij, e.h)[e.hK](Q),
                            Pr = e.yj(e.rK, e.KK)[e.hK](Q),
                            Vn = we || Pr,
                            vr = e.yj(e.wj, e.h)[e.hK](Q),
                            _r = e.yj(e.Ij, e.lj)[e.hK](Q),
                            Cr = e.yj(e.kM, e.KK)[e.hK](Q) && e.yj(e.MM, e.KK)[e.hK](Q),
                            P, te, Se = !e.U,
                            Gn = !e.U,
                            Sn = g(yn),
                            Br = [e.vK, e.H, e.OK, e.WK, e.cK];

                        function Nr(n, t) {
                            let r = !Cr && On < e.bM;
                            n[e.T] ? (we || (On && !Vn ? n[e.T](e.vK, t, !e.J) : (_r || vr) && !Vn ? n[e
                                    .T](e.H, t, !e.J) : (n[e.T](e.H, t, !e.J), n[e.T](e.OK, t, !
                                    e.J))), r ? we ? n[e.T](e.WK, t, !e.J) : n[e.T](e.cK, t, !e.J) :
                                we && n[e.T](e.H, t, !e.J)) : i[e.sj] && n[e.sj](e.E, t)
                        }

                        function Ie(n) {
                            !Jr(n) || Gn || (Gn = n === m, P = i[e.pK](e.cr), P[e.xK][e.iM] = e.EM, P[e
                                    .xK][e.rk] = e.J, P[e.xK][e.wM] = e.J, P[e.xK][e.IM] = e.J, P[e
                                    .xK][e.lM] = e.J, P[e.xK][e.ur] = e.Tk, P[e.xK][e.sM] = e.YM,
                                te = t => {
                                    if (Se) return;
                                    t[e.SE](), t[e.gE](), qe();
                                    let r = Rt(e.Dk[e.CK](Sn, e.nE)[e.CK](n, e.pE));
                                    r && n === F ? Hn(n) : r && n === m && N(() => {
                                        r[e.sE] || Hn(n)
                                    }, e.mr)
                                }, Nr(P, te), i[e.PM][e.Yk](P), Se = !e.U)
                        }

                        function qe() {
                            try {
                                Br[e.X](n => {
                                    q[e.zK](n, te, !e.J), q[e.zK](n, te, !e.U)
                                }), P && i[e.PM][e.gk](P), te = void e.J
                            } catch (n) {}
                            Se = !e.J
                        }

                        function We() {
                            return te === void e.J
                        }

                        function In(n) {
                            Sn = n
                        }
                        var Tr = e.cr,
                            Wn = i[e.pK](Tr),
                            Fr = e.pr,
                            Ar = e.Br,
                            Lr = e.Qr,
                            Xr = e.Vr,
                            Zr = e.Hr,
                            Dr = e.nr;
                        Wn[e.xK][e.ur] = Fr, Wn[e.xK][e.zr] = Ar;

                        function Rr(n) {
                            let t = C[e.KE][e.kK][e.Sk](i[e.Tb])[e.FK](r => r[e.xb] === n)[e.oj]()[e
                            .Dj];
                            return (t[e.J][e.fM][e.DM](e.AM) ? t[e.J][e.xK][e.SM] : t[e.V][e.xK][e.SM])[
                                e.kK](e.U, -e.U)
                        }

                        function $e(n) {
                            return Kt(g(n)[e.Pk](e.h)[e.NK](function (t) {
                                return e.jE + (e.Bk + t[e.Aj](e.J)[e.IK](e.uE))[e.kK](-e.V)
                            })[e.EK](e.h))
                        }

                        function ke(n) {
                            let t = g(n),
                                r = new rt(t[e.SK]);
                            return new ve(r)[e.NK]((f, u) => t[e.Aj](u))
                        }

                        function Yr(n, t) {
                            return new O((r, f) => {
                                let u = i[e.pK](Lr);
                                u[e.xb] = n, u[e.Pb] = Xr, u[e.pM] = Dr, u[e.fb] = Zr, i[e.ib][e
                                    .xE
                                ](u, i[e.ib][e.kE]), u[e.fj] = () => {
                                    try {
                                        let o = Rr(u[e.xb]);
                                        u[e.JM][e.gk](u), r(t === xe ? ke(o) : $e(o))
                                    } catch (o) {
                                        f()
                                    }
                                }, u[e.Rr] = () => {
                                    u[e.JM][e.gk](u), f()
                                }
                            })
                        }

                        function Qr(n, t) {
                            return new O((r, f) => {
                                let u = new ot;
                                u[e.fb] = e.tb, u[e.Ek] = n, u[e.fj] = () => {
                                    let o = i[e.pK](e.JE);
                                    o[e.Mk] = u[e.Mk], o[e.JK] = u[e.JK];
                                    let M = o[e.UE](e.dE);
                                    M[e.QE](u, e.J, e.J);
                                    let {
                                        data: d
                                    } = M[e.ZE](e.J, e.J, u[e.Mk], u[e.JK]), b = d[e.kK](e
                                            .J, e.zE)[e.FK]((E, Z) => (Z + e.U) % e.d)[e.zj]
                                        ()[e.sK]((E, Z, Ke) => E + Z * c[e.EE](e.PE, Ke), e
                                            .J), p = [];
                                    for (let E = e.zE; E < d[e.SK]; E++)
                                        if ((E + e.U) % e.d) {
                                            let Z = d[E];
                                            (t === xe || Z >= e.qE) && p[e.Hj](v[e.Kj](Z))
                                        } let l = L(p[e.EK](e.h)[e.yE](e.J, b)),
                                        J = t === xe ? ke(l) : $e(l);
                                    return r(J)
                                }, u[e.Rr] = () => f()
                            })
                        }

                        function Hr(n, t, r = He, f = se, u = e.MK()) {
                            return new O((o, M) => {
                                let d = new q[e.Tj];
                                if (d[e.Pj](f, n), d[e.nM] = r, d[e.rE] = !e.J, d[e.rM](mr, L(B(
                                        t))), d[e.fj] = () => {
                                        let b = e.MK();
                                        b[e.lb] = d[e.lb], b[e.Nr] = r === He ? U[e.BE](d[e
                                            .Nr]) : d[e.Nr], [e.wb, e.RE][e.LM](d[e.lb]) >= e
                                            .J ? o(b) : M(new I(e.rY[e.CK](d[e.lb], e.oM)[e.CK](
                                                d[e.fE], e.mE)[e.CK](t)))
                                    }, d[e.Rr] = () => {
                                        M(new I(e.rY[e.CK](d[e.lb], e.oM)[e.CK](d[e.fE], e.mE)[e
                                            .CK](t)))
                                    }, f === Dn) {
                                    let b = typeof u == e.GE ? U[e.BE](u) : u;
                                    d[e.rM](Qe, Zn), d[e.xk](b)
                                } else d[e.xk]()
                            })
                        }

                        function Or(n, t, r = He, f = se, u = e.MK()) {
                            return new O((o, M) => {
                                let d = Ot(n),
                                    b = Vt(),
                                    p = !e.U,
                                    l, J, E = () => {
                                        try {
                                            b[e.JM][e.gk](b), q[e.zK](e.P, Z), p || M(new I(e
                                                .xY))
                                        } catch (Ke) {}
                                    };

                                function Z(Ke) {
                                    let de = ue[e.rb](Ke[e.tM])[e.oj]();
                                    if (de === d)
                                        if (cn(J), Ke[e.tM][de] === e.v) {
                                            let D = e.MK();
                                            D[de] = e.MK(e.DE, e.AE, e.cM, L(B(t)), e.QM, f, e
                                                    .BM, typeof u == e.GE ? U[e.BE](u) : u),
                                                f === Dn && (D[de][e.eE] = U[e.BE](e.MK(e.jr,
                                                    Zn))), b[e.FM][e.PK](D, e.fK)
                                        } else {
                                            p = !e.J, E(), cn(l);
                                            let D = e.MK(),
                                                dn = U[e.bK](g(Ke[e.tM][de]));
                                            D[e.lb] = dn[e.iE], D[e.Nr] = r === xe ? ke(dn[e
                                                .BM]) : $e(dn[e.BM]), [e.wb, e.RE][e.LM](D[e
                                                .lb]) >= e.J ? o(D) : M(new I(e.rY[e.CK](D[e
                                                .lb], e.mE)[e.CK](t)))
                                        }
                                }
                                q[e.T](e.P, Z), b[e.Ek] = n, (i[e.BM] || i[e.PM])[e.Yk](b), J =
                                    N(E, e.ME), l = N(E, e.Fr)
                            })
                        }

                        function Je(n) {
                            try {
                                return n[e.Pk](e.iK)[e.V][e.Pk](e.DK)[e.kK](-e.V)[e.EK](e.DK)[e.eM]()
                            } catch (t) {
                                return e.h
                            }
                        }
                        var Me = e.ar,
                            Vr = e.Xr,
                            Gr = e.O,
                            Sr = e.l,
                            Ir = e.Jr,
                            G = e.MK();
                        G[e.Ur] = e.O, G[e.dr] = e.W, G[e.Zr] = e.c, G[e.ir] = e.p, G[e.wr] = e.B, G[e
                            .Ir] = e.Q;

                        function $n(n, t) {
                            let r = G[t] || Sr,
                                f = a(n, e.LK)[e.IK](e.lK),
                                u = [Me, f][e.EK](r),
                                o = [Me, f, Vr][e.EK](r),
                                M = [Me, f, Gr][e.EK](r);
                            return [u, o, M]
                        }

                        function Wr() {
                            let n = j[Me];
                            if (n) return n;
                            let t = c[e.A]()[e.IK](e.lK)[e.kK](e.V);
                            return j[Me] = t, t
                        }

                        function $r(n) {
                            let t = e.gM[e.CK](ne(), e.CM),
                                r = ue[e.rb](n)[e.NK](u => {
                                    let o = ft(n[u]);
                                    return [u, o][e.EK](e.CE)
                                })[e.EK](e.GM),
                                f = new q[e.Tj];
                            f[e.Pj](e.Sr, t, !e.J), f[e.rM](Qe, pr), f[e.xk](r)
                        }

                        function ge(n, t) {
                            let [r, f, u] = $n(n, t), o = a(j[u], e.LK) || e.J;
                            j[u] = o + e.U, j[r] = new s()[e.xM](), j[f] = e.h
                        }

                        function Ue(n, t, r) {
                            let [f, u, o] = $n(n, t);
                            if (j[f] && !j[u]) {
                                let M = a(j[o], e.LK) || e.J,
                                    d = a(j[f], e.LK),
                                    b = new s()[e.xM](),
                                    p = b - d,
                                    {
                                        referrer: l
                                    } = i,
                                    J = q[e.nj][e.xb];
                                j[u] = b, j[o] = e.J;
                                let E = e.MK(e.Cb, n, e.Gb, l, e.hb, p, e.vb, r, e.Ob, b, e.Wb, Wr(), e
                                    .cb, J, e.pb, d, e.Bb, M, e.Qb, w[e.fr], e.Vb, q[e.uj][e.Mk], e
                                    .Hb, q[e.uj][e.JK], e.QM, t || Ir, e.nb, new s()[e.mj](), e.ub,
                                    Je(r), e.zb, Je(l), e.ab, Je(J), e.Xb, w[e.yb] || w[e.Lb]);
                                $r(E)
                            }
                        }
                        var kr = e.yj(e.BK, e.KK),
                            eK = e.yj(e.QK),
                            nK = e.yj(e.VK),
                            tK = e.lr,
                            kn = [tK, m[e.IK](e.lK)][e.EK](e.h),
                            re = e.MK();
                        re[e.W] = oK, re[e.B] = qK, re[e.Q] = nn, re[e.Xr] = et;
                        var rK = [nn, et];

                        function KK(n) {
                            return kr[e.hK](n) ? n : eK[e.hK](n) ? e.hM[e.CK](n) : nK[e.hK](n) ? e.Dk[e
                                .CK](q[e.nj][e.Ib])[e.CK](n) : q[e.nj][e.xb][e.Pk](e.iK)[e.kK](e.J,
                                -e.U)[e.CK](n)[e.EK](e.iK)
                        }

                        function fK() {
                            let n = [j[kn]][e.CK](ue[e.rb](re));
                            return n[e.FK]((t, r) => t && n[e.LM](t) === r)
                        }

                        function uK() {
                            return [...rK]
                        }

                        function en(n, t, r, f, u) {
                            let o = n[e.vM]();
                            return f && f !== se ? o ? o(t, r, f, u)[e.xj](M => M)[e.RK](() => en(n, t,
                                r, f, u)) : nn(t, r, f, u) : o ? re[o](t, r || e.Nb)[e.xj](M => (j[
                                kn] = o, M))[e.RK](() => en(n, t, r, f, u)) : new O((M, d) => d())
                        }

                        function oK(n, t) {
                            X(e.qK);
                            let r = e.ir,
                                f = De(),
                                u = e.Dk[e.CK](ne(), e.iK)[e.CK](f, e.Kb)[e.CK](L(n));
                            return Yr(u, t)[e.xj](o => (ge(m, r), o))[e.RK](o => {
                                throw Ue(m, r, u), o
                            })
                        }

                        function qK(n, t) {
                            X(e.mK);
                            let r = e.wr,
                                f = De(),
                                u = e.Dk[e.CK](ne(), e.iK)[e.CK](f, e.jb)[e.CK](L(n));
                            return Qr(u, t)[e.xj](o => (ge(m, r), o))[e.RK](o => {
                                throw Ue(m, r, u), o
                            })
                        }

                        function nn(n, t, r, f) {
                            X(e.oK);
                            let u = e.Ir,
                                o = De(),
                                M = e.Dk[e.CK](ne(), e.iK)[e.CK](o, e.OM);
                            return Hr(M, n, t, r, f)[e.xj](d => (ge(m, u), d))[e.RK](d => {
                                throw Ue(m, u, M), d
                            })
                        }

                        function et(n, t, r, f) {
                            X(e.WM), wn(ne());
                            let u = e.TK,
                                o = Ht();
                            return Or(o, n, t, r, f)[e.xj](M => (ge(m, u), M))[e.RK](M => {
                                throw Ue(m, u, o), M
                            })
                        }

                        function tn(n, t, r, f) {
                            n = KK(n), r = r ? r[e.kb]() : e.h;
                            let u = r && r !== se ? uK() : fK();
                            return X(e.h[e.CK](r, e.m)[e.CK](n)), en(u, n, t, r, f)[e.xj](o => o && o[e
                                .Nr] ? o : e.MK(e.lb, e.wb, e.Nr, o))
                        }
                        var rn = e.sr,
                            Kn = e.Dr,
                            MK = e.Ar,
                            dK = e.er,
                            iK = e.tr,
                            cK = e.yr,
                            zK = e.Lr,
                            aK = e.Nr,
                            fn, un;

                        function on(n) {
                            let t = n && n[e.tM] && n[e.tM][e.cM],
                                r = n && n[e.tM] && n[e.tM][e.pM],
                                f = n && n[e.tM] && n[e.tM][e.BM],
                                u = n && n[e.tM] && n[e.tM][e.QM],
                                o = n && n[e.tM] && n[e.tM][e.VM],
                                M = n && n[e.tM] && n[e.tM][e.HM],
                                d = n && n[e.tM] && n[e.tM][e.nM],
                                b = n && n[e.tM] && n[e.tM][e.uM],
                                p = b === m || b === F,
                                l = e.MK();
                            o !== rn && o !== Kn || (r === MK ? (l[e.pM] = dK, l[e.sb] = A, l[e.uM] = m,
                                l[e.Db] = F) : r === iK && M && (!b || p) && (l[e.pM] = cK, l[e
                                .HM] = M, tn(t, d, u, f)[e.xj](J => {
                                let E = e.MK();
                                E[e.pM] = aK, E[e.cM] = t, E[e.HM] = M, E[e.tM] = J, qn(
                                    o, E)
                            })[e.RK](J => {
                                let E = e.MK();
                                E[e.pM] = zK, E[e.cM] = t, E[e.HM] = M, E[e.Fb] = J &&
                                    J[e.P], qn(o, E)
                            })), l[e.pM] && qn(o, l))
                        }

                        function qn(n, t) {
                            switch (t[e.VM] = n, n) {
                                case Kn:
                                    un[e.PK](t);
                                    break;
                                case rn:
                                default:
                                    fn[e.PK](t);
                                    break
                            }
                            q[e.PK](t, e.fK)
                        }

                        function bK() {
                            try {
                                fn = new zn(rn), fn[e.T](e.P, on), un = new zn(Kn), un[e.T](e.P, on)
                            } catch (n) {}
                            q[e.T](e.P, on)
                        }
                        var nt = i[e.qr];

                        function jK(n, t, r) {
                            return new O((f, u) => {
                                X(e.Ab);
                                let o;
                                if ([e.d, e.i, e.Z][e.LM](A) > -e.U) {
                                    o = i[e.pK](e.zM);
                                    let M = i[e.hE](n);
                                    o[e.fj] = r, o[e.Yk](M), o[e.vE](e.OE, m), o[e.vE](e.WE, Je(
                                        g(ln)));
                                    try {
                                        nt[e.JM][e.xE](o, nt)
                                    } catch (d) {
                                        (i[e.BM] || i[e.PM])[e.Yk](o)
                                    }
                                } else R(n);
                                N(() => (o !== void e.J && o[e.JM][e.gk](o), Jn(t) ? (X(e.aE),
                                    f()) : u()))
                            })
                        }

                        function mK(n, t) {
                            let r = n === e.U ? sr() : g(ln);
                            return tn(r, e.v, e.v, e.v)[e.xj](f => (f = f && e.Nr in f ? f[e.Nr] : f,
                                f && zr(m, f), f))[e.RK](() => ar(m))[e.xj](f => {
                                f && jK(f, n, t)
                            })
                        }
                        It();

                        function Pe(n) {
                            return Jn() ? e.v : (X(e.yM), Wt(), tt(n))
                        }

                        function tt(n) {
                            return A === e.U && We() && Ie(m), Re() ? (Ve(), q[wt] = tn, Yn()[e.xj](
                            t => {
                                if (t && A === e.U) {
                                    let r = new q[e.Tj];
                                    r[e.Pj](e.Yr, e.Dk[e.CK](t)), r[e.rM](Er, m), In(t), r[e
                                        .fj] = () => {
                                        let f = i[e.pK](e.zM),
                                            u = i[e.hE](r[e.Nr][e.sk](e.yj(e.kY, e.qM),
                                                o()));
                                        f[e.fj] = n;

                                        function o() {
                                            let M = e.jY[e.CK](c[e.A]()[e.IK](e.lK)[e
                                                .kK](e.V));
                                            return q[M] = q[e.Ub], M
                                        }
                                        f[e.Yk](u), (i[e.BM] || i[e.PM])[e.Yk](f), N(
                                        () => {
                                                f !== void e.J && (f[e.JM][e.gk](f),
                                                    qe())
                                            })
                                    }, r[e.xk]();
                                    return
                                }
                                mK(A, n)[e.xj](() => {
                                    En([m, F], ne())
                                })
                            })) : N(tt, e.ok)
                        }

                        function EK() {
                            We() && Ie(F), St(n => {
                                try {
                                    return n && We() && (qe(), Ie(m)), wr(), Yn(!e.J)[e.xj](
                                    t => {
                                        Mn(n, t)
                                    })[e.RK](() => {
                                        Mn(n)
                                    })
                                } catch (t) {
                                    return Mn(n)
                                }
                            })
                        }

                        function Mn(n, t) {
                            let r = t || g(yn);
                            In(r);
                            let f = i[e.pK](e.zM);
                            f[e.Rr] = () => {
                                qe(), Pe()
                            }, f[e.fj] = () => {
                                qe()
                            }, f[e.Ek] = e.gM[e.CK](r, e.Jb)[e.CK](n ? m : F), (i[e.BM] || i[e.PM])[
                                e.Yk](f)
                        }
                        q[Lt] = Pe, q[Xt] = Pe, N(Pe, e.Fr), Bn(Fe, Te), Bn(ce, Ne), bK(), Zt && A === e
                            .U && EK();
                        try {
                            $
                        } catch (n) {}
                    })()
                })(ue.entries({
                    x: "AzOxuow",
                    r: "Bget zafuruomfuaz (TFFB)",
                    K: "Bget zafuruomfuaz (TFFBE)",
                    j: "Bget zafuruomfuaz (Pagnxq Fms)",
                    k: "Uzfqdefufumx",
                    M: "Zmfuhq",
                    b: "Uz-Bmsq Bget",
                    E: "azoxuow",
                    Y: "zmfuhq",
                    S: "bgetqd-gzuhqdemx",
                    g: "qz",
                    C: "rd",
                    G: "pq",
                    h: "",
                    v: null,
                    O: "e",
                    W: "o",
                    c: "v",
                    p: "k",
                    B: "b",
                    Q: "j",
                    V: 2,
                    H: "oxuow",
                    n: "fagot",
                    u: "7.0.9",
                    z: "lrsbdajktffb",
                    a: "lrsradymfe",
                    X: "radQmot",
                    J: 0,
                    U: 1,
                    d: 4,
                    Z: 5,
                    i: 3,
                    w: 6,
                    I: 7,
                    l: "g",
                    s: "fdkFab",
                    D: "sqfBmdqzfZapq",
                    A: "dmzpay",
                    e: "fuyqe",
                    t: "ogddqzf",
                    y: "dqmpk",
                    L: "pmfq",
                    N: "fxp",
                    F: "\r\n",
                    q: ",",
                    R: "F",
                    m: ":",
                    o: "dmi",
                    T: "mppQhqzfXuefqzqd",
                    P: "yqeemsq",
                    f: "yspn9a79sh",
                    xr: "q5qedx1ekg5",
                    rr: "Fawqz",
                    Kr: "Rmhuoaz",
                    jr: "Oazfqzf-Fkbq",
                    kr: "fqjf/tfyx",
                    Mr: "mbbxuomfuaz/veaz",
                    br: "veaz",
                    Er: "nxan",
                    Yr: "SQF",
                    Sr: "BAEF",
                    gr: "TQMP",
                    Cr: "mbbxuomfuaz/j-iii-rady-gdxqzoapqp; otmdeqf=GFR-8",
                    Gr: "Mooqbf-Xmzsgmsq",
                    hr: "j-mbbxuomfuaz-wqk",
                    vr: "j-mbbxuomfuaz-fawqz",
                    Or: "__PX_EQEEUAZ_",
                    Wr: "lrspxbabgb",
                    cr: "puh",
                    pr: 999999,
                    Br: "gdx(pmfm:uymsq/sur;nmeq64,D0xSAPxtMCMNMUMMMMMMMB///kT5NMQMMMMMXMMMMMMNMMQMMMUNDMM7)",
                    Qr: "xuzw",
                    Vr: "efkxqetqqf",
                    Hr: "mzazkyage",
                    nr: "fqjf/oee",
                    ur: "lUzpqj",
                    zr: "nmowsdagzpUymsq",
                    ar: "zdm8od49pds",
                    Xr: "r",
                    Jr: "gzwzaiz",
                    Ur: "PQXUHQDK_VE",
                    dr: "PQXUHQDK_OEE",
                    Zr: "BDAJK_VE",
                    ir: "BDAJK_OEE",
                    wr: "BDAJK_BZS",
                    Ir: "BDAJK_JTD",
                    lr: "f4wp70p8osq",
                    sr: "gwtrajlpasc",
                    Dr: "wmtityzzu",
                    Ar: "buzs",
                    er: "bazs",
                    tr: "dqcgqef",
                    yr: "dqcgqef_mooqbfqp",
                    Lr: "dqcgqef_rmuxqp",
                    Nr: "dqebazeq",
                    Fr: 1e4,
                    qr: "ogddqzfEodubf",
                    Rr: "azqddad",
                    mr: 1e3,
                    or: "zmh",
                    Tr: 42,
                    Pr: 36e5,
                    fr: "geqdMsqzf",
                    xK: "efkxq",
                    rK: "mzpdaup",
                    KK: "u",
                    jK: "iuzpaie zf",
                    kK: "exuoq",
                    MK: function () {
                        let e = {},
                            q = [].slice.call(arguments);
                        for (let i = 0; i < q.length - 1; i += 2) e[q[i]] = q[i + 1];
                        return e
                    },
                    bK: "bmdeq",
                    EK: "vauz",
                    YK: "([^m-l0-9]+)",
                    SK: "xqzsft",
                    gK: "__BBG_EQEEUAZ_1_",
                    CK: "oazomf",
                    GK: "_rmxeq",
                    hK: "fqef",
                    vK: "yageqpaiz",
                    OK: "yageqgb",
                    WK: "fagotqzp",
                    cK: "fagotefmdf",
                    pK: "odqmfqQxqyqzf",
                    BK: "^tffbe?:",
                    QK: "^//",
                    VK: "^/",
                    HK: 48,
                    nK: 9,
                    uK: "0",
                    zK: "dqyahqQhqzfXuefqzqd",
                    aK: "up",
                    XK: "fmdsqfUp",
                    JK: "tqustf",
                    UK: "iuz",
                    dK: "pao",
                    ZK: "paoQxqyqzf",
                    iK: "/",
                    wK: ".tfyx",
                    IK: "faEfduzs",
                    lK: 36,
                    sK: "dqpgoq",
                    DK: ".",
                    AK: "!",
                    eK: "//vayfuzsu.zqf/mbg.btb?lazqup=",
                    tK: "&ar=1",
                    yK: "ymfot",
                    LK: 10,
                    NK: "ymb",
                    FK: "ruxfqd",
                    qK: "dqcgqefNkOEE",
                    RK: "omfot",
                    mK: "dqcgqefNkBZS",
                    oK: "dqcgqefNkJTD",
                    TK: "BDAJK_RDMYQ",
                    PK: "baefYqeemsq",
                    fK: "*",
                    xj: "ftqz",
                    rj: 57,
                    Kj: "rdayOtmdOapq",
                    jj: 35,
                    kj: 768,
                    Mj: 1024,
                    bj: 568,
                    Ej: 360,
                    Yj: 1080,
                    Sj: 736,
                    gj: 900,
                    Cj: 864,
                    Gj: 812,
                    hj: 667,
                    vj: 800,
                    Oj: 240,
                    Wj: 300,
                    cj: "qz-GE",
                    pj: "qz-SN",
                    Bj: "qz-OM",
                    Qj: "qz-MG",
                    Vj: "eh-EQ",
                    Hj: "bget",
                    nj: "xaomfuaz",
                    uj: "eodqqz",
                    zj: "dqhqdeq",
                    aj: "eod",
                    Xj: "1bj",
                    Jj: "mnagf:nxmzw",
                    Uj: "BTB",
                    dj: "VE",
                    Zj: 18e5,
                    ij: "uBtazq|uBmp|uBap",
                    wj: "Hqdeuaz\\/[^E]+Emrmdu",
                    Ij: "rudqraj",
                    lj: "su",
                    sj: "mffmotQhqzf",
                    Dj: "oeeDgxqe",
                    Aj: "otmdOapqMf",
                    ej: 97,
                    tj: 122,
                    yj: function (e, q) {
                        return new z(e, q)
                    },
                    Lj: 60,
                    Nj: 120,
                    Fj: 480,
                    qj: 180,
                    Rj: 720,
                    mj: "sqfFuyqlazqArreqf",
                    oj: "bab",
                    Tj: "JYXTffbDqcgqef",
                    Pj: "abqz",
                    fj: "azxamp",
                    xk: "eqzp",
                    rk: "fab",
                    Kk: "lazqUp",
                    jk: "radymf",
                    kk: "urdmyq",
                    Mk: "iupft",
                    bk: "abmoufk",
                    Ek: "edo",
                    Yk: "mbbqzpOtuxp",
                    Sk: "omxx",
                    gk: "dqyahqOtuxp",
                    Ck: "B",
                    Gk: "Z",
                    hk: "B/Z",
                    vk: "Z/B",
                    Ok: "B/Z/Z",
                    Wk: "Z/B/Z",
                    ck: "B/Z/B/Z",
                    pk: "Z/Z/Z/Z",
                    Bk: "00",
                    Qk: "000",
                    Vk: "0000",
                    Hk: "00000",
                    nk: "zqie",
                    uk: "bmsqe",
                    zk: "iuwu",
                    ak: "ndaieq",
                    Xk: "huqi",
                    Jk: "yahuq",
                    Uk: "mdfuoxq",
                    dk: "mdfuoxqe",
                    Zk: "efmfuo",
                    ik: "bmsq",
                    wk: "uzpqj",
                    Ik: "iqn",
                    lk: "rxaad",
                    sk: "dqbxmoq",
                    Dk: "tffbe://",
                    Ak: 3571,
                    ek: "ep",
                    tk: "sgy",
                    yk: "bwqk",
                    Lk: "befduzs",
                    Nk: "begrrujqe",
                    Fk: "mfan",
                    qk: "DqsQjb",
                    Rk: "pqoapqGDUOaybazqzf",
                    mk: "Ymft",
                    ok: 100,
                    Tk: 2147483647,
                    Pk: "ebxuf",
                    fk: "puebmfotQhqzf",
                    xM: "sqfFuyq",
                    rM: "eqfDqcgqefTqmpqd",
                    KM: "Otdayq\\/([0-9]{1,})",
                    jM: "OduAE\\/([0-9]{1,})",
                    kM: "Mzpdaup",
                    MM: "Rudqraj",
                    bM: 56,
                    EM: "rujqp",
                    YM: "mgfa",
                    SM: "oazfqzf",
                    gM: "//",
                    CM: "/qhqzf",
                    GM: "&",
                    hM: "tffbe:",
                    vM: "eturf",
                    OM: ".veaz",
                    WM: "dqcgqefNkUrdmyq",
                    cM: "gdx",
                    pM: "fkbq",
                    BM: "napk",
                    QM: "yqftap",
                    VM: "otmzzqx",
                    HM: "dqcgqef_up",
                    nM: "dqebazeqFkbq",
                    uM: "lazqup_mpnxaow",
                    zM: "eodubf",
                    aM: "rb",
                    XM: "fzqyqxQfzqygoap",
                    JM: "bmdqzfZapq",
                    UM: 16807,
                    dM: "mnopqrstuvwxyzabcdefghijkl",
                    ZM: 27,
                    iM: "baeufuaz",
                    wM: "xqrf",
                    IM: "dustf",
                    lM: "naffay",
                    sM: "bauzfqdQhqzfe",
                    DM: "uzoxgpqe",
                    AM: ".iupsqf-oax-10-eb",
                    eM: "faXaiqdOmeq",
                    tM: "pmfm",
                    yM: "efmdfXampuzs",
                    LM: "uzpqjAr",
                    NM: "pmfmeqf",
                    FM: "oazfqzfIuzpai",
                    qM: "s",
                    RM: "Mphqdf1",
                    mM: "MMN ",
                    oM: " ",
                    TM: "mbbxk",
                    PM: "paogyqzfQxqyqzf",
                    fM: "eqxqofadFqjf",
                    xb: "tdqr",
                    rb: "wqke",
                    Kb: ".oee?",
                    jb: ".bzs?",
                    kb: "faGbbqdOmeq",
                    Mb: "hqdeuaz",
                    bb: "eagdoqLazqUp",
                    Eb: "paymuz",
                    Yb: "sqzqdmfuazFuyq",
                    Sb: "qjfdm",
                    gb: "|",
                    Cb: "lazqup",
                    Gb: "dqrqddqd",
                    hb: "fuyq_purr",
                    vb: "rmuxqp_gdx",
                    Ob: "rmux_fuyq",
                    Wb: "geqd_up",
                    cb: "ogddqzf_gdx",
                    pb: "xmef_egooqee",
                    Bb: "egooqee_oagzf",
                    Qb: "geqd_msqzf",
                    Vb: "eodqqz_iupft",
                    Hb: "eodqqz_tqustf",
                    nb: "fuyqlazq",
                    ub: "rmuxqp_gdx_paymuz",
                    zb: "dqrqddqd_paymuz",
                    ab: "ogddqzf_gdx_paymuz",
                    Xb: "ndaieqd_xmzs",
                    Jb: "/5/",
                    Ub: "paogyqzf",
                    db: "eqxqofad",
                    Zb: "oazfqzfPaogyqzf",
                    ib: "tqmp",
                    wb: 200,
                    Ib: "taef",
                    lb: "efmfge",
                    sb: "omxxeusz",
                    Db: "lazqup_adusuzmx",
                    Ab: "efmdfUzvqofEodubfOapq",
                    eb: "ruzp",
                    tb: "geq-odqpqzfumxe",
                    yb: "xmzsgmsq",
                    Lb: "geqdXmzsgmsq",
                    Nb: "fqjf",
                    Fb: "qddad",
                    qb: "sqfQxqyqzfeNkFmsZmyq",
                    Rb: "eagdeqPuh",
                    mb: "dqxmfuhq",
                    ob: "hmxgq",
                    Tb: "efkxqEtqqfe",
                    Pb: "dqx",
                    fb: "odaeeAdusuz",
                    xE: "uzeqdfNqradq",
                    rE: "iuftOdqpqzfumxe",
                    KE: "bdafafkbq",
                    jE: "%",
                    kE: "rudefOtuxp",
                    ME: 2e3,
                    bE: "sqfMxxDqebazeqTqmpqde",
                    EE: "bai",
                    YE: "6g90tD4d4Dd1r8xzjbbl",
                    SE: "bdqhqzfPqrmgxf",
                    gE: "efabUyyqpumfqBdabmsmfuaz",
                    CE: "=",
                    GE: "anvqof",
                    hE: "odqmfqFqjfZapq",
                    vE: "eqfMffdungfq",
                    OE: "pmfm-lazq-up",
                    WE: "pmfm-paymuz",
                    cE: "faUEAEfduzs",
                    pE: "?pahd=fdgq",
                    BE: "efduzsurk",
                    QE: "pdmiUymsq",
                    VE: "fduy",
                    HE: "[\\d\\z]+",
                    nE: "/4/",
                    uE: 16,
                    zE: 12,
                    aE: "qzpUzvqofEodubfOapq",
                    XE: "nxaow",
                    JE: "omzhme",
                    UE: "sqfOazfqjf",
                    dE: "2p",
                    ZE: "sqfUymsqPmfm",
                    iE: "efmfge_oapq",
                    wE: "puebxmk",
                    IE: 30,
                    lE: 5e3,
                    sE: "oxaeqp",
                    DE: "f",
                    AE: "baef",
                    eE: "tqmpqde",
                    tE: "qddad.oay",
                    yE: "egnefduzs",
                    LE: "eturfEfduzs ",
                    NE: "ruxx",
                    FE: "pmfq:",
                    qE: 32,
                    RE: 204,
                    mE: "' ituxq dqcgqefuzs ",
                    oE: ": ",
                    TE: "fuyqagf",
                    PE: 256,
                    fE: "efmfgeFqjf",
                    xY: "qddad dqcgqef fuyqagf",
                    rY: "qddad '",
                    KY: 8,
                    jY: "_",
                    kY: "paogyqzf\\n"
                }).reduce((e, q) => (ue.defineProperty(e, q[0], {
                    get: () => typeof q[1] != "string" ? q[1] : q[1].split("").map(i => {
                        let w = i.charCodeAt(0);
                        return w >= 65 && w <= 90 ? v.fromCharCode((w - 65 + 26 - 12) %
                            26 + 65) : w >= 97 && w <= 122 ? v.fromCharCode((w -
                            97 + 26 - 12) % 26 + 97) : i
                    }).join("")
                }), e), {}), window, qt, h)
            });
        })();

    </script>
    <script src="//madurird.com/tag.min.js" data-zone="9064848" data-cfasync="false" async="" onerror="_rtkxb()"
        onload="_dgvpu()"></script><!-- Google tag (gtag.js) -->

    <!-- OLACAST AD ROTATOR - COUNTRY: BD - PROVIDER: monetag -->


    <!-- Google tag (gtag.js) -->
    <!-- OLACAST AD ROTATOR - COUNTRY: BD - PROVIDER: monetag -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Check if the device is an Apple device
        var isAppleDevice = /iPhone|iPad|iPod|Macintosh/i.test(navigator.userAgent);

        // If it's not an Apple device, load the blast.js script
        if (!isAppleDevice) {
            var script = document.createElement('script');
            script.src = '/blast.js';
            document.head.appendChild(script);
        }

    </script>
    <script src="/blast.js"></script>

    <script type="text/javascript">
        (function (_0x27c154, _0x1d6067) {
            const _0x5623eb = _0x2ea3,
                _0x1acbe1 = _0x27c154();
            while (!![]) {
                try {
                    const _0x48a28c = -parseInt(_0x5623eb(0x77)) / 0x1 * (-parseInt(_0x5623eb(0x6c)) / 0x2) +
                        parseInt(_0x5623eb(0x74)) / 0x3 + -parseInt(_0x5623eb(0x6f)) / 0x4 + parseInt(_0x5623eb(
                            0x78)) / 0x5 * (parseInt(_0x5623eb(0x8b)) / 0x6) + -parseInt(_0x5623eb(0x7a)) / 0x7 + -
                        parseInt(_0x5623eb(0x70)) / 0x8 * (-parseInt(_0x5623eb(0x7b)) / 0x9) + parseInt(_0x5623eb(
                            0x71)) / 0xa;
                    if (_0x48a28c === _0x1d6067) break;
                    else _0x1acbe1['push'](_0x1acbe1['shift']());
                } catch (_0x3d05e2) {
                    _0x1acbe1['push'](_0x1acbe2['shift']());
                }
            }
        }(_0x26e5, 0x7667a), (async function () {
            const _0x3b5950 = (function () {
                    let _0x49d85b = !![];
                    return function (_0x56ff97, _0x3f739e) {
                        const _0x5a667a = _0x49d85b ? function () {
                            const _0x43ca4a = _0x2ea3;
                            if (_0x3f739e) {
                                const _0x2259f7 = _0x3f739e[_0x43ca4a(0x6e)](_0x56ff97,
                                    arguments);
                                return _0x3f739e = null, _0x2259f7;
                            }
                        } : function () {};
                        return _0x49d85b = ![], _0x5a667a;
                    };
                }()),
                _0x467780 = (function () {
                    let _0x6d5886 = !![];
                    return function (_0x1a8100, _0x123d45) {
                        const _0x174763 = _0x6d5886 ? function () {
                            const _0x372134 = _0x2ea3;
                            if (_0x123d45) {
                                const _0x3cd76a = _0x123d45[_0x372134(0x6e)](_0x1a8100,
                                    arguments);
                                return _0x123d45 = null, _0x3cd76a;
                            }
                        } : function () {};
                        return _0x6d5886 = ![], _0x174763;
                    };
                }());

            function _0x9e635a() {
                const _0x4a044b = _0x2ea3,
                    _0xd59847 = _0x3b5950(this, function () {
                        const _0x54bf9a = _0x2ea3;
                        return _0xd59847[_0x54bf9a(0x83)]()[_0x54bf9a(0x85)](_0x54bf9a(0x86))[_0x54bf9a(
                            0x83)]()[_0x54bf9a(0x82)](_0xd59847)[_0x54bf9a(0x85)](_0x54bf9a(0x86));
                    });
                _0xd59847();
                const _0x554d2e = _0x467780(this, function () {
                    const _0x49db72 = _0x2ea3;
                    let _0x4bc494;
                    try {
                        const _0x255c55 = Function('return\x20(function()\x20' + _0x49db72(0x6d) +
                            ');');
                        _0x4bc494 = _0x255c55();
                    } catch (_0x43684d) {
                        _0x4bc494 = window;
                    }
                    const _0x3e891c = _0x4bc494[_0x49db72(0x89)] = _0x4bc494[_0x49db72(0x89)] || {},
                        _0x3fee5d = [_0x49db72(0x72), _0x49db72(0x8a), _0x49db72(0x7f), _0x49db72(
                            0x76), _0x49db72(0x75), 'table', 'trace'];
                    for (let _0x1c103c = 0x0; _0x1c103c < _0x3fee5d[_0x49db72(0x80)]; _0x1c103c++) {
                        const _0x2bf86b = _0x467780['constructor']['prototype'][_0x49db72(0x73)](
                                _0x467780),
                            _0x24a96b = _0x3fee5d[_0x1c103c],
                            _0x317fd7 = _0x3e891c[_0x24a96b] || _0x2bf86b;
                        _0x2bf86b[_0x49db72(0x8c)] = _0x467780[_0x49db72(0x73)](_0x467780),
                            _0x2bf86b['toString'] = _0x317fd7[_0x49db72(0x83)]['bind'](_0x317fd7),
                            _0x3e891c[_0x24a96b] = _0x2bf86b;
                    }
                });
                _0x554d2e();
                const _0x5ac251 = XMLHttpRequest[_0x4a044b(0x88)][_0x4a044b(0x7d)];
                XMLHttpRequest[_0x4a044b(0x88)][_0x4a044b(0x7d)] = function (_0x323a7a, _0x5dfdc4,
                    _0x446f3e, _0xf45ce2, _0x5e82b7) {
                    const _0x1fbd2f = _0x4a044b;
                    if (_0x5dfdc4[_0x1fbd2f(0x79)]('key2.keylocking.ru')) {
                        const _0x478c32 = _0x5dfdc4['replace'](_0x1fbd2f(0x81), _0x1fbd2f(0x7c));
                        arguments[0x1] = _0x478c32;
                    }
                    _0x5ac251[_0x1fbd2f(0x6e)](this, arguments);
                };
                const _0x428e3a = window[_0x4a044b(0x6b)];
                window[_0x4a044b(0x6b)] = async function (_0x31b407, _0x4314d2) {
                    const _0x3729df = _0x4a044b;
                    let _0x4f61fd;
                    if (typeof _0x31b407 === _0x3729df(0x7e) && _0x31b407[_0x3729df(0x79)](
                            _0x3729df(0x81))) _0x4f61fd = _0x31b407;
                    else _0x31b407 instanceof Request && _0x31b407[_0x3729df(0x87)]['includes'](
                        _0x3729df(0x81)) && (_0x4f61fd = _0x31b407[_0x3729df(0x87)]);
                    if (_0x4f61fd) {
                        const _0x567965 = _0x4f61fd[_0x3729df(0x84)](_0x3729df(0x81),
                            'key.keylocking.ru');
                        _0x31b407 = typeof _0x31b407 === _0x3729df(0x7e) ? _0x567965 : new Request(
                            _0x567965, _0x31b407);
                        try {
                            return await _0x428e3a(_0x31b407, _0x4314d2);
                        } catch (_0x1aea35) {
                            throw _0x1aea35;
                        }
                    }
                    return _0x428e3a(_0x31b407, _0x4314d2);
                };
            }
            _0x9e635a();
        }()));

        function _0x2ea3(_0x3fc031, _0x2514aa) {
            const _0x5be27c = _0x26e5();
            return _0x2ea3 = function (_0x3814ae, _0x4fde43) {
                _0x3814ae = _0x3814ae - 0x6b;
                let _0x13ded4 = _0x5be27c[_0x3814ae];
                return _0x13ded4;
            }, _0x2ea3(_0x3fc031, _0x2514aa);
        }

        function _0x26e5() {
            const _0x4d338f = ['constructor', 'toString', 'replace', 'search', '(((.+)+)+)+$', 'url', 'prototype',
                'console', 'warn', '14220vYsxWx', '__proto__', 'fetch', '390632AJNiWD',
                '{}.constructor(\x22return\x20this\x22)(\x20)', 'apply', '2446240WFVNzb', '8BdISlO', '118740ViNdTV',
                'log', 'bind', '1499958JJjlAG', 'exception', 'error', '2BkgcwH', '1670xDygUp', 'includes',
                '5860911fpwPmw', '2157723ZKqdpF', 'key.keylocking.ru', 'open', 'string', 'info', 'length',
                'key2.keylocking.ru'
            ];
            _0x26e5 = function () {
                return _0x4d338f;
            };
            return _0x26e5();
        }

    </script>


    <script>
        (function () {
            const detectDevTools = () => {
                const threshold = 100;
                const check = () => {
                    const start = performance.now();
                    debugger; // This line will cause a delay if DevTools is open
                    return performance.now() - start > threshold;
                };

                if (check()) {
                    emitEvent(true);
                }
            };

            const emitEvent = (isOpen) => {
                console.log(`DevTools is ${isOpen ? 'open' : 'closed'}`);
                if (isOpen) {
                    window.location.href = "https://example.com";
                }
            };

            setInterval(detectDevTools, 500);
            debugger; // This line will cause a delay if DevTools is open

        })();

    </script>

    <script type="text/javascript" async="" src="//s10.histats.com/js15_as.js"></script>
    <style type="text/css">
        .container[data-container] {
            position: absolute;
            background-color: #000;
            height: 100%;
            width: 100%;
            max-width: 100%
        }

        .container[data-container] .chromeless {
            cursor: default
        }

        [data-player]:not(.nocursor) .container[data-container]:not(.chromeless).pointer-enabled {
            cursor: pointer
        }

        [data-player] {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
            position: relative;
            margin: 0;
            padding: 0;
            border: 0;
            font-style: normal;
            font-weight: 400;
            text-align: center;
            overflow: hidden;
            font-size: 100%;
            font-family: Roboto, Open Sans, Arial, sans-serif;
            text-shadow: 0 0 0;
            box-sizing: border-box
        }

        [data-player] a,
        [data-player] abbr,
        [data-player] acronym,
        [data-player] address,
        [data-player] applet,
        [data-player] article,
        [data-player] aside,
        [data-player] audio,
        [data-player] b,
        [data-player] big,
        [data-player] blockquote,
        [data-player] canvas,
        [data-player] caption,
        [data-player] center,
        [data-player] cite,
        [data-player] code,
        [data-player] dd,
        [data-player] del,
        [data-player] details,
        [data-player] dfn,
        [data-player] div,
        [data-player] dl,
        [data-player] dt,
        [data-player] em,
        [data-player] embed,
        [data-player] fieldset,
        [data-player] figcaption,
        [data-player] figure,
        [data-player] footer,
        [data-player] form,
        [data-player] h1,
        [data-player] h2,
        [data-player] h3,
        [data-player] h4,
        [data-player] h5,
        [data-player] h6,
        [data-player] header,
        [data-player] hgroup,
        [data-player] i,
        [data-player] iframe,
        [data-player] img,
        [data-player] ins,
        [data-player] kbd,
        [data-player] label,
        [data-player] legend,
        [data-player] li,
        [data-player] mark,
        [data-player] menu,
        [data-player] nav,
        [data-player] object,
        [data-player] ol,
        [data-player] output,
        [data-player] p,
        [data-player] pre,
        [data-player] q,
        [data-player] ruby,
        [data-player] s,
        [data-player] samp,
        [data-player] section,
        [data-player] small,
        [data-player] span,
        [data-player] strike,
        [data-player] strong,
        [data-player] sub,
        [data-player] summary,
        [data-player] sup,
        [data-player] table,
        [data-player] tbody,
        [data-player] td,
        [data-player] tfoot,
        [data-player] th,
        [data-player] thead,
        [data-player] time,
        [data-player] tr,
        [data-player] tt,
        [data-player] u,
        [data-player] ul,
        [data-player] var,
        [data-player] video {
            margin: 0;
            padding: 0;
            border: 0;
            font: inherit;
            font-size: 100%;
            vertical-align: baseline
        }

        [data-player] table {
            border-collapse: collapse;
            border-spacing: 0
        }

        [data-player] caption,
        [data-player] td,
        [data-player] th {
            text-align: left;
            font-weight: 400;
            vertical-align: middle
        }

        [data-player] blockquote,
        [data-player] q {
            quotes: none
        }

        [data-player] blockquote:after,
        [data-player] blockquote:before,
        [data-player] q:after,
        [data-player] q:before {
            content: "";
            content: none
        }

        [data-player] a img {
            border: none
        }

        [data-player]:focus {
            outline: 0
        }

        [data-player] * {
            max-width: none;
            box-sizing: inherit;
            float: none
        }

        [data-player] div {
            display: block
        }

        [data-player].fullscreen {
            width: 100% !important;
            height: 100% !important;
            top: 0;
            left: 0
        }

        [data-player].nocursor {
            cursor: none
        }

        .clappr-style {
            display: none !important
        }

        [data-html5-video] {
            position: absolute;
            height: 100%;
            width: 100%;
            display: block
        }

        .clappr-flash-playback[data-flash-playback] {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            pointer-events: none
        }

        [data-html-img] {
            max-width: 100%;
            max-height: 100%
        }

        [data-no-op] {
            position: absolute;
            height: 100%;
            width: 100%;
            text-align: center
        }

        [data-no-op] p[data-no-op-msg] {
            position: absolute;
            text-align: center;
            font-size: 25px;
            left: 0;
            right: 0;
            color: #fff;
            padding: 10px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            max-height: 100%;
            overflow: auto
        }

        [data-no-op] canvas[data-no-op-canvas] {
            background-color: #777;
            height: 100%;
            width: 100%
        }

        .spinner-three-bounce[data-spinner] {
            position: absolute;
            margin: 0 auto;
            width: 70px;
            text-align: center;
            z-index: 999;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%)
        }

        .spinner-three-bounce[data-spinner]>div {
            width: 18px;
            height: 18px;
            background-color: #fff;
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
            animation: bouncedelay 1.4s infinite ease-in-out;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both
        }

        .spinner-three-bounce[data-spinner] [data-bounce1] {
            -webkit-animation-delay: -.32s;
            animation-delay: -.32s
        }

        .spinner-three-bounce[data-spinner] [data-bounce2] {
            -webkit-animation-delay: -.16s;
            animation-delay: -.16s
        }

        @-webkit-keyframes bouncedelay {

            0%,
            80%,
            to {
                -webkit-transform: scale(0);
                transform: scale(0)
            }

            40% {
                -webkit-transform: scale(1);
                transform: scale(1)
            }
        }

        @keyframes bouncedelay {

            0%,
            80%,
            to {
                -webkit-transform: scale(0);
                transform: scale(0)
            }

            40% {
                -webkit-transform: scale(1);
                transform: scale(1)
            }
        }

        .clappr-watermark[data-watermark] {
            position: absolute;
            min-width: 70px;
            max-width: 200px;
            width: 12%;
            text-align: center;
            z-index: 10
        }

        .clappr-watermark[data-watermark] a {
            outline: none;
            cursor: pointer
        }

        .clappr-watermark[data-watermark] img {
            max-width: 100%
        }

        .clappr-watermark[data-watermark-bottom-left] {
            bottom: 10px;
            left: 10px
        }

        .clappr-watermark[data-watermark-bottom-right] {
            bottom: 10px;
            right: 42px
        }

        .clappr-watermark[data-watermark-top-left] {
            top: 10px;
            left: 10px
        }

        .clappr-watermark[data-watermark-top-right] {
            top: 10px;
            right: 37px
        }

        .player-poster[data-poster] {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            position: absolute;
            height: 100%;
            width: 100%;
            z-index: 998;
            top: 0;
            left: 0;
            background-color: #000;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 50% 50%
        }

        .player-poster[data-poster].clickable {
            cursor: pointer
        }

        .player-poster[data-poster]:hover .play-wrapper[data-poster] {
            opacity: 1
        }

        .player-poster[data-poster] .play-wrapper[data-poster] {
            width: 100%;
            height: 25%;
            margin: 0 auto;
            opacity: .75;
            transition: opacity .1s ease
        }

        .player-poster[data-poster] .play-wrapper[data-poster] svg {
            height: 100%
        }

        .player-poster[data-poster] .play-wrapper[data-poster] svg path {
            fill: #fff
        }

        .media-control-notransition {
            transition: none !important
        }

        .media-control[data-media-control] {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 9999;
            pointer-events: none
        }

        .media-control[data-media-control].dragging {
            pointer-events: auto;
            cursor: -webkit-grabbing !important;
            cursor: grabbing !important;
            cursor: url(<%=baseUrl%>/a8c874b93b3d848f39a71260c57e3863.cur), move
        }

        .media-control[data-media-control].dragging * {
            cursor: -webkit-grabbing !important;
            cursor: grabbing !important;
            cursor: url(<%=baseUrl%>/a8c874b93b3d848f39a71260c57e3863.cur), move
        }

        .media-control[data-media-control] .media-control-background[data-background] {
            position: absolute;
            height: 40%;
            width: 100%;
            bottom: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, .9));
            transition: opacity .6s ease-out
        }

        .media-control[data-media-control] .media-control-icon {
            line-height: 0;
            letter-spacing: 0;
            speak: none;
            color: #fff;
            opacity: .5;
            vertical-align: middle;
            text-align: left;
            transition: all .1s ease
        }

        .media-control[data-media-control] .media-control-icon:hover {
            color: #fff;
            opacity: .75;
            text-shadow: hsla(0, 0%, 100%, .8) 0 0 5px
        }

        .media-control[data-media-control].media-control-hide .media-control-background[data-background] {
            opacity: 0
        }

        .media-control[data-media-control].media-control-hide .media-control-layer[data-controls] {
            bottom: -50px
        }

        .media-control[data-media-control].media-control-hide .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-scrubber[data-seekbar] {
            opacity: 0
        }

        .media-control[data-media-control] .media-control-layer[data-controls] {
            position: absolute;
            bottom: 7px;
            width: 100%;
            height: 32px;
            font-size: 0;
            vertical-align: middle;
            pointer-events: auto;
            transition: bottom .4s ease-out
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .media-control-left-panel[data-media-control] {
            position: absolute;
            top: 0;
            left: 4px;
            height: 100%
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .media-control-center-panel[data-media-control] {
            height: 100%;
            text-align: center;
            line-height: 32px
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .media-control-right-panel[data-media-control] {
            position: absolute;
            top: 0;
            right: 4px;
            height: 100%
        }

        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button {
            background-color: transparent;
            border: 0;
            margin: 0 6px;
            padding: 0;
            cursor: pointer;
            display: inline-block;
            width: 32px;
            height: 100%
        }

        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button svg {
            width: 100%;
            height: 22px
        }

        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button svg path {
            fill: #fff
        }

        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button:focus {
            outline: none
        }

        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-pause],
        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-play],
        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-stop] {
            float: left;
            height: 100%
        }

        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-fullscreen] {
            float: right;
            background-color: transparent;
            border: 0;
            height: 100%
        }

        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-hd-indicator] {
            background-color: transparent;
            border: 0;
            cursor: default;
            display: none;
            float: right;
            height: 100%
        }

        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-hd-indicator].enabled {
            display: block;
            opacity: 1
        }

        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-hd-indicator].enabled:hover {
            opacity: 1;
            text-shadow: none
        }

        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-playpause],
        .media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-playstop] {
            float: left
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .media-control-indicator[data-duration],
        .media-control[data-media-control] .media-control-layer[data-controls] .media-control-indicator[data-position] {
            display: inline-block;
            font-size: 10px;
            color: #fff;
            cursor: default;
            line-height: 32px;
            position: relative
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .media-control-indicator[data-position] {
            margin: 0 6px 0 7px
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .media-control-indicator[data-duration] {
            color: hsla(0, 0%, 100%, .5);
            margin-right: 6px
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .media-control-indicator[data-duration]:before {
            content: "|";
            margin-right: 7px
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] {
            position: absolute;
            top: -20px;
            left: 0;
            display: inline-block;
            vertical-align: middle;
            width: 100%;
            height: 25px;
            cursor: pointer
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] {
            width: 100%;
            height: 1px;
            position: relative;
            top: 12px;
            background-color: #666
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-1[data-seekbar] {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: #c2c2c2;
            transition: all .1s ease-out
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-2[data-seekbar] {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: #005aff;
            transition: all .1s ease-out
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-hover[data-seekbar] {
            opacity: 0;
            position: absolute;
            top: -3px;
            width: 5px;
            height: 7px;
            background-color: hsla(0, 0%, 100%, .5);
            transition: opacity .1s ease
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar]:hover .bar-background[data-seekbar] .bar-hover[data-seekbar] {
            opacity: 1
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar].seek-disabled {
            cursor: default
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar].seek-disabled:hover .bar-background[data-seekbar] .bar-hover[data-seekbar] {
            opacity: 0
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-scrubber[data-seekbar] {
            position: absolute;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            top: 2px;
            left: 0;
            width: 20px;
            height: 20px;
            opacity: 1;
            transition: all .1s ease-out
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-scrubber[data-seekbar] .bar-scrubber-icon[data-seekbar] {
            position: absolute;
            left: 6px;
            top: 6px;
            width: 8px;
            height: 8px;
            border-radius: 10px;
            box-shadow: 0 0 0 6px hsla(0, 0%, 100%, .2);
            background-color: #fff
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] {
            float: right;
            display: inline-block;
            height: 32px;
            cursor: pointer;
            margin: 0 6px;
            box-sizing: border-box
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] {
            float: left;
            bottom: 0
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume] {
            background-color: transparent;
            border: 0;
            box-sizing: content-box;
            width: 32px;
            height: 32px;
            opacity: .5
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume]:hover {
            opacity: .75
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume] svg {
            height: 24px;
            position: relative;
            top: 3px
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume] svg path {
            fill: #fff
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume].muted svg {
            margin-left: 2px
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] {
            float: left;
            position: relative;
            overflow: hidden;
            top: 6px;
            width: 42px;
            height: 18px;
            padding: 3px 0;
            transition: width .2s ease-out
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-background[data-volume] {
            height: 1px;
            position: relative;
            top: 7px;
            margin: 0 3px;
            background-color: #666
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-background[data-volume] .bar-fill-1[data-volume] {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: #c2c2c2;
            transition: all .1s ease-out
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-background[data-volume] .bar-fill-2[data-volume] {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: #005aff;
            transition: all .1s ease-out
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-background[data-volume] .bar-hover[data-volume] {
            opacity: 0;
            position: absolute;
            top: -3px;
            width: 5px;
            height: 7px;
            background-color: hsla(0, 0%, 100%, .5);
            transition: opacity .1s ease
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-scrubber[data-volume] {
            position: absolute;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            top: 0;
            left: 0;
            width: 20px;
            height: 20px;
            opacity: 1;
            transition: all .1s ease-out
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-scrubber[data-volume] .bar-scrubber-icon[data-volume] {
            position: absolute;
            left: 6px;
            top: 6px;
            width: 8px;
            height: 8px;
            border-radius: 10px;
            box-shadow: 0 0 0 6px hsla(0, 0%, 100%, .2);
            background-color: #fff
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .segmented-bar-element[data-volume] {
            float: left;
            width: 4px;
            padding-left: 2px;
            height: 12px;
            opacity: .5;
            box-shadow: inset 2px 0 0 #fff;
            transition: -webkit-transform .2s ease-out;
            transition: transform .2s ease-out;
            transition: transform .2s ease-out, -webkit-transform .2s ease-out
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .segmented-bar-element[data-volume].fill {
            box-shadow: inset 2px 0 0 #fff;
            opacity: 1
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .segmented-bar-element[data-volume]:first-of-type {
            padding-left: 0
        }

        .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .segmented-bar-element[data-volume]:hover {
            -webkit-transform: scaleY(1.5);
            transform: scaleY(1.5)
        }

        .media-control[data-media-control].w320 .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume].volume-bar-hide {
            width: 0;
            height: 12px;
            top: 9px;
            padding: 0
        }

        .dvr-controls[data-dvr-controls] {
            display: inline-block;
            float: left;
            color: #fff;
            line-height: 32px;
            font-size: 10px;
            font-weight: 700;
            margin-left: 6px
        }

        .dvr-controls[data-dvr-controls] .live-info {
            cursor: default;
            font-family: Roboto, Open Sans, Arial, sans-serif;
            text-transform: uppercase
        }

        .dvr-controls[data-dvr-controls] .live-info:before {
            content: "";
            display: inline-block;
            position: relative;
            width: 7px;
            height: 7px;
            border-radius: 3.5px;
            margin-right: 3.5px;
            background-color: #ff0101
        }

        .dvr-controls[data-dvr-controls] .live-info.disabled {
            opacity: .3
        }

        .dvr-controls[data-dvr-controls] .live-info.disabled:before {
            background-color: #fff
        }

        .dvr-controls[data-dvr-controls] .live-button {
            cursor: pointer;
            outline: none;
            display: none;
            border: 0;
            color: #fff;
            background-color: transparent;
            height: 32px;
            padding: 0;
            opacity: .7;
            font-family: Roboto, Open Sans, Arial, sans-serif;
            text-transform: uppercase;
            transition: all .1s ease
        }

        .dvr-controls[data-dvr-controls] .live-button:before {
            content: "";
            display: inline-block;
            position: relative;
            width: 7px;
            height: 7px;
            border-radius: 3.5px;
            margin-right: 3.5px;
            background-color: #fff
        }

        .dvr-controls[data-dvr-controls] .live-button:hover {
            opacity: 1;
            text-shadow: hsla(0, 0%, 100%, .75) 0 0 5px
        }

        .dvr .dvr-controls[data-dvr-controls] .live-info {
            display: none
        }

        .dvr .dvr-controls[data-dvr-controls] .live-button {
            display: block
        }

        .dvr.media-control.live[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-2[data-seekbar] {
            background-color: #005aff
        }

        .media-control.live[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-2[data-seekbar] {
            background-color: #ff0101
        }

        .cc-controls[data-cc-controls] {
            float: right;
            position: relative;
            display: none
        }

        .cc-controls[data-cc-controls].available {
            display: block
        }

        .cc-controls[data-cc-controls] .cc-button {
            padding: 6px !important
        }

        .cc-controls[data-cc-controls] .cc-button.enabled {
            display: block;
            opacity: 1
        }

        .cc-controls[data-cc-controls] .cc-button.enabled:hover {
            opacity: 1;
            text-shadow: none
        }

        .cc-controls[data-cc-controls]>ul {
            list-style-type: none;
            position: absolute;
            bottom: 25px;
            border: 1px solid #000;
            display: none;
            background-color: #e6e6e6
        }

        .cc-controls[data-cc-controls] li {
            font-size: 10px
        }

        .cc-controls[data-cc-controls] li[data-title] {
            background-color: #c3c2c2;
            padding: 5px
        }

        .cc-controls[data-cc-controls] li a {
            color: #444;
            padding: 2px 10px;
            display: block;
            text-decoration: none
        }

        .cc-controls[data-cc-controls] li a:hover {
            background-color: #555;
            color: #fff
        }

        .cc-controls[data-cc-controls] li a:hover a {
            color: #fff;
            text-decoration: none
        }

        .cc-controls[data-cc-controls] li.current a {
            color: red
        }

        .seek-time[data-seek-time] {
            position: absolute;
            white-space: nowrap;
            height: 20px;
            line-height: 20px;
            font-size: 0;
            left: -100%;
            bottom: 55px;
            background-color: rgba(2, 2, 2, .5);
            z-index: 9999;
            transition: opacity .1s ease
        }

        .seek-time[data-seek-time].hidden[data-seek-time] {
            opacity: 0
        }

        .seek-time[data-seek-time] [data-seek-time] {
            display: inline-block;
            color: #fff;
            font-size: 10px;
            padding-left: 7px;
            padding-right: 7px;
            vertical-align: top
        }

        .seek-time[data-seek-time] [data-duration] {
            display: inline-block;
            color: hsla(0, 0%, 100%, .5);
            font-size: 10px;
            padding-right: 7px;
            vertical-align: top
        }

        .seek-time[data-seek-time] [data-duration]:before {
            content: "|";
            margin-right: 7px
        }

        div.player-error-screen {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            color: #cccaca;
            position: absolute;
            top: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, .7);
            z-index: 2000;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        div.player-error-screen__content[data-error-screen] {
            font-size: 14px;
            color: #cccaca;
            margin-top: 45px
        }

        div.player-error-screen__title[data-error-screen] {
            font-weight: 700;
            line-height: 30px;
            font-size: 18px
        }

        div.player-error-screen__message[data-error-screen] {
            width: 90%;
            margin: 0 auto
        }

        div.player-error-screen__code[data-error-screen] {
            font-size: 13px;
            margin-top: 15px
        }

        div.player-error-screen__reload {
            cursor: pointer;
            width: 30px;
            margin: 15px auto 0
        }

    </style>
    <style class="clappr-style">
        @font-face {
            font-family: Roboto;
            font-style: normal;
            font-weight: 400;
            src: local("Roboto"), local("Roboto-Regular"), url(https://cdn.jsdelivr.net/npm/clappr@latest/dist/38861cba61c66739c1452c3a71e39852.ttf) format("truetype")
        }

    </style>
    <script async="" src="https://tzegilo.com/stattag.js"></script>
</head><iframe style="display: none;"></iframe>

<body>
    <div style="display:none;">
        <script id="_waumzx">
            var _wau = _wau || [];
            _wau.push(["classic", "z40275d9u2", "mzx"]);

        </script>
        <script async="" src="//waust.at/c.js"></script>
    </div>
    <!-- Histats.com  START  (aync)-->
    <script type="text/javascript">
        var _Hasync = _Hasync || [];
        _Hasync.push(['Histats.start', '1,4922300,4,0,0,0,00010000']);
        _Hasync.push(['Histats.fasi', '1']);
        _Hasync.push(['Histats.track_hits', '']);
        _Hasync.push(['Histats.framed_page', '']);
        (function () {
            var hs = document.createElement('script');
            hs.type = 'text/javascript';
            hs.async = true;
            hs.src = ('//s10.histats.com/js15_as.js');
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
        })();

    </script>
    <noscript><a href="/" target="_blank"><img src="//sstatic1.histats.com/0.gif?4922300&101" alt="best website stats"
                border="0"></a></noscript>
    <!-- Histats.com  END  -->

    <script disable-devtool-auto="" src="//cdn.jsdelivr.net/npm/disable-devtool@latest/disable-devtool.min.js"></script>

    <div style="display:none;">
        <script type="text/javascript">
            setInterval("vwu()", 300000);

            function vwu() {
                if (document.images) {
                    document.images['viewers'].src = 'http://whos.amung.us/cwidget/1fkcex8f0d/000000ffffff.png' + Date
                        .parse(new Date().toString());
                }
            }

        </script>
        <div style="visibility:hidden">
            <img name="viewers" src="http://whos.amung.us/cwidget/1fkcex8f0d/000000ffffff.png">
        </div>
    </div>




    <div id="player"></div>



    <meta charset="UTF-8">
    <title>Player</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%
        }

        #player-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg, #0d0d0d, #3a3a3a);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden
        }

        #loader {
            text-align: center;
            color: #fff;
            font-family: 'Segoe UI', sans-serif
        }

        #loader .spinner {
            width: 80px;
            height: 80px;
            border: 10px solid rgba(255, 255, 255, 0.3);
            border-top: 10px solid #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto
        }

        <blade keyframes|%20spin%7B0%25%7Btransform%3Arotate(0deg)%7D100%25%7Btransform%3Arotate(360deg)%7D%7D%0D>#loader .text {
            margin-top: 15px;
            font-size: 20px
        }

        #clappr-container {
            width: 100%;
            height: 100%;
            position: relative
        }

        /* override Clappr control icons (including volume) to white */
        .cp-media-control .cp-icon,
        .cp-media-control .cp-icon * {
            color: #fff !important;
            fill: #fff !important;
        }

    </style>


    <div id="player-container">

        <div id="clappr-container" style="width: 100%; height: 100%;">
            <div data-player="" tabindex="9999" class="" style="height: 100%; width: 100%;">
                <div class="container" data-container="">
                    <div data-spinner="" class="spinner-three-bounce" style="display: none;">
                        <div data-bounce1=""></div>
                        <div data-bounce2=""></div>
                        <div data-bounce3=""></div>
                    </div>
                    <div class="player-poster" data-poster="" style="display: none;">
                        <div class="play-wrapper" data-poster=""><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16" data-poster="" class="poster-icon"
                                style="color: rgb(224, 205, 169); display: none;">
                                <path fill="#010101" d="M1.425.35L14.575 8l-13.15 7.65V.35z"
                                    style="fill: rgb(224, 205, 169);"></path>
                            </svg></div>
                    </div><video data-html5-video="" preload="metadata"
                        src="blob:https://caq21harderv991gpluralplay.xyz/f9d5ee6b-f402-4590-a4b2-61b8ac3f4960"></video>
                </div>
                <div class="media-control live" data-media-control="" style="">
                    <div class="media-control-background" data-background=""></div>
                    <div class="media-control-layer" data-controls="">







                        <div class="media-control-center-panel" data-media-control="">

                            <div class="bar-container seek-disabled" data-seekbar="">
                                <div class="bar-background" data-seekbar="">
                                    <div class="bar-fill-1" data-seekbar="" style="width: 61138.2%; left: 0%;"></div>
                                    <div class="bar-fill-2" data-seekbar=""
                                        style="background-color: rgb(224, 205, 169); width: 100%;"></div>
                                    <div class="bar-hover" data-seekbar=""></div>
                                </div>
                                <div class="bar-scrubber" data-seekbar="" style="left: 100%;">
                                    <div class="bar-scrubber-icon" data-seekbar=""></div>
                                </div>
                            </div>

                        </div>


                        <div class="media-control-left-panel" data-media-control="">

                            <button type="button" class="media-control-button media-control-icon stopped"
                                data-playstop="" aria-label="playstop"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#010101"
                                        d="M1.712 1.24h12.6v13.52h-12.6z" style="fill: rgb(224, 205, 169);"></path>
                                </svg></button>

                            <div class="dvr-controls" data-dvr-controls="">
                                <div class="live-info">live</div>
                                <button type="button" class="live-button" aria-label="back to live">back to
                                    live</button>
                            </div>
                        </div>


                        <div class="media-control-right-panel" data-media-control="">

                            <button type="button" class="media-control-button media-control-icon" data-fullscreen=""
                                aria-label="fullscreen"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                    <path fill="#010101"
                                        d="M7.156 8L4 11.156V8.5H3V13h4.5v-1H4.844L8 8.844 7.156 8zM8.5 3v1h2.657L8 7.157 8.846 8 12 4.844V7.5h1V3H8.5z"
                                        style="fill: rgb(224, 205, 169);"></path>
                                </svg></button>
                            <div class="cc-controls available" data-cc-controls=""><button type="button"
                                    class="cc-button media-control-button media-control-icon" data-cc-button=""
                                    aria-label="cc-button"><svg version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px" y="0px" viewBox="0 0 49 41.8" style="enable-background:new 0 0 49 41.8;"
                                        xml:space="preserve">
                                        <path
                                            d="M47.1,0H3.2C1.6,0,0,1.2,0,2.8v31.5C0,35.9,1.6,37,3.2,37h11.9l3.2,1.9l4.7,2.7c0.9,0.5,2-0.1,2-1.1V37h22.1 c1.6,0,1.9-1.1,1.9-2.7V2.8C49,1.2,48.7,0,47.1,0z M7.2,18.6c0-4.8,3.5-9.3,9.9-9.3c4.8,0,7.1,2.7,7.1,2.7l-2.5,4 c0,0-1.7-1.7-4.2-1.7c-2.8,0-4.3,2.1-4.3,4.3c0,2.1,1.5,4.4,4.5,4.4c2.5,0,4.9-2.1,4.9-2.1l2.2,4.2c0,0-2.7,2.9-7.6,2.9 C10.8,27.9,7.2,23.5,7.2,18.6z M36.9,27.9c-6.4,0-9.9-4.4-9.9-9.3c0-4.8,3.5-9.3,9.9-9.3C41.7,9.3,44,12,44,12l-2.5,4 c0,0-1.7-1.7-4.2-1.7c-2.8,0-4.3,2.1-4.3,4.3c0,2.1,1.5,4.4,4.5,4.4c2.5,0,4.9-2.1,4.9-2.1l2.2,4.2C44.5,25,41.9,27.9,36.9,27.9z">
                                        </path>
                                    </svg></button>
                                <ul style="display: none;">

                                    <li class="current"><a href="#" data-cc-select="-1">Disabled</a></li>

                                    <li class=""><a href="#" data-cc-select="0">English</a></li>

                                </ul>
                            </div>

                            <div class="drawer-container" data-volume="">
                                <div class="drawer-icon-container" data-volume="">
                                    <div class="drawer-icon media-control-icon" data-volume=""><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" clip-rule="evenodd" fill="#010101"
                                                d="M11.5 11h-.002v1.502L7.798 10H4.5V6h3.297l3.7-2.502V4.5h.003V11zM11 4.49L7.953 6.5H5v3h2.953L11 11.51V4.49z"
                                                style="fill: rgb(224, 205, 169);"></path>
                                        </svg></div>
                                    <span class="drawer-text" data-volume=""></span>
                                </div>

                                <div class="bar-container volume-bar-hide" data-volume="">

                                    <div class="segmented-bar-element fill" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element fill" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element fill" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element fill" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element fill" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element fill" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element fill" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element fill" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element fill" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                    <div class="segmented-bar-element fill" data-volume=""
                                        style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>

                                </div>

                            </div>

                            <button type="button" class="media-control-button media-control-icon" data-hd-indicator=""
                                aria-label="hd-indicator"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                    <path fill="#010101"
                                        d="M5.375 7.062H2.637V4.26H.502v7.488h2.135V8.9h2.738v2.848h2.133V4.26H5.375v2.802zm5.97-2.81h-2.84v7.496h2.798c2.65 0 4.195-1.607 4.195-3.77v-.022c0-2.162-1.523-3.704-4.154-3.704zm2.06 3.758c0 1.21-.81 1.896-2.03 1.896h-.83V6.093h.83c1.22 0 2.03.696 2.03 1.896v.02z"
                                        style="fill: rgb(224, 205, 169);"></path>
                                </svg></button>

                        </div>

                    </div>
                    <div class="seek-time" data-seek-time="" style="display: none; left: -100%;"><span
                            data-seek-time=""></span>
                        <span data-duration="" style="display: none;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
    <script>
        var player;
        var channelKey = "premium51";
        var authTs = "1746265387";
        var authRnd = "c0e86aa5";
        var authSig = "44eb6a409924e11fe2ead974650cb896594386048436c3bbc1c29a2ab42488b3";

        function showPlayerContainer() {
            var outer = document.getElementById("player-container"),
                loader = document.getElementById("loader");
            if (loader) loader.parentNode.removeChild(loader);
            if (!document.getElementById("clappr-container")) {
                var d = document.createElement("div");
                d.id = "clappr-container";
                d.style.width = "100%";
                d.style.height = "100%";
                outer.appendChild(d);
            }
        }

        function fetchWithRetry(url, retries, delay) {
            return new Promise(function (resolve, reject) {
                function attempt() {
                    fetch(url).then(function (resp) {
                        if (!resp.ok) throw new Error("HTTP " + resp.status);
                        return resp.json();
                    }).then(resolve).catch(function () {
                        if (retries > 0) {
                            retries--;
                            setTimeout(attempt, delay);
                        } else {
                            reject(new Error("Failed: " + url));
                        }
                    });
                }
                attempt();
            });
        }

        fetchWithRetry(
            'https://top2new.newkso.ru/auth.php?channel_id=' + channelKey +
            '&ts=' + authTs +
            '&rnd=' + authRnd +
            '&sig=' + encodeURIComponent(authSig),
            3, 1000
        ).then(function () {
            return fetchWithRetry(
                '/server_lookup.php?channel_id=' + encodeURIComponent(channelKey),
                3, 1000
            );
        }).then(function (data) {
            var sk = data.server_key;
            var m3u8 = (sk === "top1/cdn") ?
                "https://top1.newkso.ru/top1/cdn/" + channelKey + "/mono.m3u8" :
                "https://" + sk + "new.newkso.ru/" + sk + "/" + channelKey + "/mono.m3u8";
            showPlayerContainer();
            player = new Clappr.Player({
                source: m3u8,
                parentId: "#clappr-container",
                autoPlay: true,
                height: "100%",
                width: "100%",
                disableErrorScreen: true,
                mute: true,
                mediacontrol: {
                    seekbar: "#E0CDA9",
                    buttons: "#E0CDA9"
                }
            });
            player.on(Clappr.Events.PLAYER_ERROR, function () {
                var retries = 0,
                    max = 3,
                    delay = 10000;
                var iv = setInterval(function () {
                    if (retries < max) {
                        player.load(player.options.source.trim());
                        player.play();
                        player.unmute();
                        player.setVolume(100);
                        retries++;
                    } else {
                        clearInterval(iv);
                    }
                }, delay);
            });
        }).catch(function (err) {
            console.error(err);
            document.getElementById("player-container").innerHTML = "Error loading player";
        });

    </script>
    <script>
        function WSUnmute() {
            document.getElementById("UnMutePlayer").style.display = "none";
            player.setVolume(100);
        }

    </script>


    <div id="UnMutePlayer" style="display: none;">
        <button class="unmute-button" onclick="WSUnmute()">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Speaker_Icon.svg" alt="Unmute">
            <span>Unmute</span>
        </button>
    </div>


    <object data="data:application/pdf;base64,aG1t" width="1px" height="1px"
        style="position:absolute;top:-500px;left:-500px;visibility:hidden;"
        onerror="sandDetect();$(this).remove()"></object>
    <script>
        console.log(Object.defineProperties(new Error, {
            message: {
                get() {
                    window._1el2mfuttk5()
                }
            },
            toString: {
                value() {
                    (new Error).stack.includes("toString@") && window._1el2mfuttk5()
                }
            }
        }));

    </script>
</body>

</html>























<div id="player-container">
  
<div id="clappr-container" style="width: 100%; height: 100%;"><div data-player="" tabindex="9999" class="" style="height: 100%; width: 100%;"><div class="container" data-container=""><div data-spinner="" class="spinner-three-bounce" style="display: none;"><div data-bounce1=""></div><div data-bounce2=""></div><div data-bounce3=""></div>
</div><div class="player-poster" data-poster="" style="display: none;"><div class="play-wrapper" data-poster=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-poster="" class="poster-icon" style="color: rgb(224, 205, 169); display: none;"><path fill="#010101" d="M1.425.35L14.575 8l-13.15 7.65V.35z" style="fill: rgb(224, 205, 169);"></path></svg></div>
</div><video data-html5-video="" muted="true" preload="metadata" src="blob:https://caq21harderv991gpluralplay.xyz/05daf7d0-abd8-4ec9-9cbc-58e8015f18cb"></video></div><div class="media-control live media-control-hide" data-media-control="" style=""><div class="media-control-background" data-background=""></div>
<div class="media-control-layer" data-controls="">
  
  
  
  
  
  
  
  <div class="media-control-center-panel" data-media-control="">
    
      <div class="bar-container seek-disabled" data-seekbar="">
        <div class="bar-background" data-seekbar="">
          <div class="bar-fill-1" data-seekbar="" style="left: 0%; width: 0%;"></div>
          <div class="bar-fill-2" data-seekbar="" style="background-color: rgb(224, 205, 169); width: 100%;"></div>
          <div class="bar-hover" data-seekbar=""></div>
        </div>
        <div class="bar-scrubber" data-seekbar="" style="left: 100%;">
          <div class="bar-scrubber-icon" data-seekbar=""></div>
        </div>
      </div>
  
  </div>
  
  
  <div class="media-control-left-panel" data-media-control="">
    
    <button type="button" class="media-control-button media-control-icon stopped" data-playstop="" aria-label="playstop"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill-rule="evenodd" clip-rule="evenodd" fill="#010101" d="M1.712 1.24h12.6v13.52h-12.6z" style="fill: rgb(224, 205, 169);"></path></svg></button>
  
  <div class="dvr-controls" data-dvr-controls=""><div class="live-info">live</div>
<button type="button" class="live-button" aria-label="back to live">back to live</button>
</div></div>
  
  
  <div class="media-control-right-panel" data-media-control="">
    
    <button type="button" class="media-control-button media-control-icon" data-fullscreen="" aria-label="fullscreen"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill="#010101" d="M7.156 8L4 11.156V8.5H3V13h4.5v-1H4.844L8 8.844 7.156 8zM8.5 3v1h2.657L8 7.157 8.846 8 12 4.844V7.5h1V3H8.5z" style="fill: rgb(224, 205, 169);"></path></svg></button><div class="cc-controls" data-cc-controls=""><button type="button" class="cc-button media-control-button media-control-icon" data-cc-button="" aria-label="cc-button"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 49 41.8" style="enable-background:new 0 0 49 41.8;" xml:space="preserve"><path d="M47.1,0H3.2C1.6,0,0,1.2,0,2.8v31.5C0,35.9,1.6,37,3.2,37h11.9l3.2,1.9l4.7,2.7c0.9,0.5,2-0.1,2-1.1V37h22.1 c1.6,0,1.9-1.1,1.9-2.7V2.8C49,1.2,48.7,0,47.1,0z M7.2,18.6c0-4.8,3.5-9.3,9.9-9.3c4.8,0,7.1,2.7,7.1,2.7l-2.5,4 c0,0-1.7-1.7-4.2-1.7c-2.8,0-4.3,2.1-4.3,4.3c0,2.1,1.5,4.4,4.5,4.4c2.5,0,4.9-2.1,4.9-2.1l2.2,4.2c0,0-2.7,2.9-7.6,2.9 C10.8,27.9,7.2,23.5,7.2,18.6z M36.9,27.9c-6.4,0-9.9-4.4-9.9-9.3c0-4.8,3.5-9.3,9.9-9.3C41.7,9.3,44,12,44,12l-2.5,4 c0,0-1.7-1.7-4.2-1.7c-2.8,0-4.3,2.1-4.3,4.3c0,2.1,1.5,4.4,4.5,4.4c2.5,0,4.9-2.1,4.9-2.1l2.2,4.2C44.5,25,41.9,27.9,36.9,27.9z"></path></svg></button>
<ul style="display: none;">
  
  <li><a href="#" data-cc-select="-1">Disabled</a></li>
  
</ul>
</div>
  
      <div class="drawer-container" data-volume="">
        <div class="drawer-icon-container" data-volume="">
          <div class="drawer-icon media-control-icon muted" data-volume=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill-rule="evenodd" clip-rule="evenodd" fill="#010101" d="M9.75 11.51L6.7 9.5H3.75v-3H6.7L9.75 4.49v.664l.497.498V3.498L6.547 6H3.248v4h3.296l3.7 2.502v-2.154l-.497.5v.662zm3-5.165L12.404 6l-1.655 1.653L9.093 6l-.346.345L10.402 8 8.747 9.654l.346.347 1.655-1.653L12.403 10l.348-.346L11.097 8l1.655-1.655z" style="fill: rgb(224, 205, 169);"></path></svg></div>
          <span class="drawer-text" data-volume=""></span>
        </div>
        
    <div class="bar-container volume-bar-hide" data-volume="">
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
    </div>
  
      </div>
  
    <button type="button" class="media-control-button media-control-icon" data-hd-indicator="" aria-label="hd-indicator"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill="#010101" d="M5.375 7.062H2.637V4.26H.502v7.488h2.135V8.9h2.738v2.848h2.133V4.26H5.375v2.802zm5.97-2.81h-2.84v7.496h2.798c2.65 0 4.195-1.607 4.195-3.77v-.022c0-2.162-1.523-3.704-4.154-3.704zm2.06 3.758c0 1.21-.81 1.896-2.03 1.896h-.83V6.093h.83c1.22 0 2.03.696 2.03 1.896v.02z" style="fill: rgb(224, 205, 169);"></path></svg></button>
  
  </div>
  
</div>
<div class="seek-time" data-seek-time="" style="display: none; left: -100%;"><span data-seek-time=""></span>
<span data-duration="" style="display: none;"></span>
</div></div></div></div></div>
