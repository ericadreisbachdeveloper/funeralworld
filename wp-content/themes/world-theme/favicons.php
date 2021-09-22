<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<!-- https://github.com/audreyfeldroy/favicon-cheat-sheet -->


<!-- also make 16x16 and 32x32 favicon.ico - ROOT -->
<!-- also make 32x32 favicon.png - ROOT -->


<!-- 196 -->
<!-- Favicon Chrome for Android -->
<link rel="shortcut icon" sizes="196x196" type="image/png" href="<?php _e(TDIR); ?>/favicons/favicon-196.png">


<!-- 180 -->
<link rel="apple-touch-icon-precomposed" href="<?php _e(TDIR); ?>/favicons/favicon-180.png">


<!-- 144 -->
<meta name="msapplication-TileColor" content="#FFFFFF">
<meta name="msapplication-TileImage" content="<?php _e(TDIR); ?>/favicons/favicon-144.png">


<!-- ieconfig.xml -->
<!-- 70           "smalltile"  -->
<!-- 150          "mediumtile" -->
<!-- 310 x 150    "widetile"   -->
<!-- 310 x 310    "largetile"  -->
<meta name="application-name" content="WORLD">
<meta name="msapplication-tooltip" content="Tooltip">
<meta name="msapplication-config" content="<?php _e(TDIR); ?>/ieconfig.xml">



<!-- SVG -->
<!-- Pinned tabs in Safari 9+ use an SVG vector mask for the favicon instead of any other PNG/ICO/etc. -->
<!-- Vector artwork in the SVG file should be black only -->
<!-- Also, a fill color needs to be defined in the <link> tag  -->
<link rel="mask-icon" href="<?php _e(TDIR); ?>/favicons/favicon.svg" color="#000">
