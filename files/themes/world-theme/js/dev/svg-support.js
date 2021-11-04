// minified with https://javascript-minifier.com/ and placed in footer.php
if (!document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image", "1.1")) {
  document.body.setAttribute('data-svg', 'no-inlinesvg');

  var head  = document.getElementsByTagName('head')[0];
  var link  = document.createElement('link');
  link.id   = cssId;
  link.rel  = 'stylesheet';
  link.type = 'text/css';
  link.href = '<?= TDIR; ?>/css/legacy.css';
  link.media = 'all';
  head.appendChild(link);
}
