// ---------------------------------------
// StreamInfoRadionomy
// v5 - 2016-05-13
//
// Available at:
// www.wimpyplayer.com
//
// Documentation:
// http://www.wimpyplayer.com/docs/streaming.radionomy.html
// ---------------------------------------
! function () {
    function a(a) {
        function b(a) {
            if (a) {
                var b = a.tracks;
                if (b && j != b.uniqueid) {
                    var d = b.artist || b.artists;
                    "RADIONOMY" != d && "Targetspot" != d || (b.title = o, b.artist = p), j = b.uniqueid;
                    var e = b.cover || b.image;
                    if (e != q && (k.setCoverArt(e), q = e), (b.title || d || b.album) && (k.setInfo({
                            title: b.title,
                            artist: b.artist || b.artists,
                            album: b.album
                        }), i = b.title), b.pixel) {
                        if (!l) {
                            var f = document.createElement("img");
                            f.width = 1, f.height = 1;
                            var g = document.getElementById("body");
                            g && (g.appendChild(f), l = f)
                        }
                        l && (l.src = b.pixel)
                    }
                    var h = Number(b.callmeback),
                        m = Number(b.playduration),
                        n = m > h ? h : m;
                    !n || 0 > n || n == 1 / 0 || NaN == n ? n = 5e3 : n > 2e5 && (n = 2e5), c(n)
                }
            }
        }

        function c(a, b) {
            var c = parseInt(a) || n;
            m && clearInterval(m), b !== !0 && 1e3 > c && (c = 1e3), m = setInterval(d, c)
        }

        function d() {
            var a = h.apiURL + "?",
                b = [];
            for (var c in h) "url" != c && "apiURL" != c && b.push(c + "=" + h[c]);
            a += b.join("&"), new jbeeb.JSON_P(a, function () {})
        }

        function e() {
            j = null, c(100, !0)
        }

        function f() {
            m && clearInterval(m), k.setPlaylist([{
                file: a.listenURL + "?" + jbeeb.Utils.getTimestamp(),
                kind: "mp3",
                title: p
            }]), k.next(), k.stop(!0)
        }

        function g() {
            window.GetPlayInfo = b, k || (k = "string" == typeof a.player ? wimpy.getPlayer(a.player) : a.player), k.setPlaylist([{
                file: a.listenURL + "?" + jbeeb.Utils.getTimestamp(),
                kind: "mp3",
                title: p
            }]), k.addEventListener("play", e), k.addEventListener("pause", f), a.startOnLoad && k.play()
        }
        var h = {
                apiURL: a.apiURL || "http://api.radionomy.com/currentsong.cfm",
                radiouid: a.guid,
                apikey: a.apikey,
                type: "json",
                callmeback: "yes",
                type: "json",
                cover: "yes",
                previous: "no"
            },
            i = null,
            j = -1,
            k = null,
            l = null,
            m = null,
            n = a.pollFrequency || 10,
            o = a.adTitle || "Advertisement",
            p = a.listenTitle || "",
            q = null;
        wimpy.onReady(g)
    }
    window.StreamInfoRadionomy || (window.StreamInfoRadionomy = a)
}();