// minified with https://javascript-minifier.com/ and placed just below <body> tag in header.php
var style_vsn = "<?= $style_vsn; ?>";
var tdir = "<?= esc_url(TDIR); ?>";

var e = document.getElementsByTagName("head")[0],
    t = document.body,
    d = document.createElement("link"),
    n = document.createElement("img"),
    r = tdir + '/css/style.css?' + style_vsn;
(d.href = r),
    (d.rel = "stylesheet"),
    e.appendChild(d),
    (n.onerror = function () {
        jQuery("body").addClass("-cssloaded"), t.removeChild(n);
    }),
    t.appendChild(n),
    (n.src = r);
