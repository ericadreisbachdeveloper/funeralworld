<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
</div><!-- /.wrapper -->



<footer class="site-footer container-fluid">

<div class="container">


	<!-- if is single, show navigation -->
	<?php //if(is_single()) { include(locate_template('template/pagination_single.php')); } ?>

	<!-- if is a child page, show navigation-->
	<?php //include(locate_template('template/pagination_from_menu.php')); ?>


		<div class="row footer-menus-row">
			<?php dynamic_sidebar( 'Footer Content' ); ?>
		</div>


		<div class="row footer-copyright-row">
		<?php if(is_active_sidebar('Copyright')) { dynamic_sidebar('Copyright'); } ?>
		</div>

	</div>
</footer>




<?php wp_footer(); ?>



<!-- 1. essential scripts for nav + forms -->
<!--    unminified in /js/dev/scripts.js -->
<script>
<?= file_get_contents( TDIR . '/js/dev/scripts.js'); ?>
</script>



<!-- 2. detect SVG support and update <body> attribute if needed - unminified version in THEME/js/dev/svg-support.js -->
<script>
document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image","1.1")||document.body.setAttribute("data-svg","no-inlinesvg");
</script>

<!-- 3. detect clip-path support and update <body> attribute if needed - unminified in THEME/js/dev/clip-path-support.js -->
<!-- unminified version in THEME/js/dev -->
<script>var areClipPathShapesSupported=function(){for(var t="clipPath",e=["webkit","moz","ms","o"],a=[t],r=document.createElement("testelement"),p=0,l=e.length;p<l;p++){var o=e[p]+t.charAt(0).toUpperCase()+t.slice(1);a.push(o)}for(p=0,l=a.length;p<l;p++){var n=a[p];if(""===r.style[n]&&(r.style[n]="polygon(50% 0%, 0% 100%, 100% 100%)",""!==r.style[n]))return!0}return!1};areClipPathShapesSupported()||document.body.setAttribute("data-clippath","no-clippath");</script>




<?php global $style_vsn, $site_url; ?>


<!-- Wordpress blocks -->
<link rel="preload" href="<?php _e($site_url); ?>/wp-includes/css/dist/block-library/style.min.css" as="style" />
<style><?= file_get_contents( $site_url . '/wp-includes/css/dist/block-library/style.min.css' ); ?></style>


<!-- theme styles -->
<link rel="preload" href="<?= esc_url(TDIR); ?>/css/style.css?ver=<?php _e($style_vsn); ?>" as="style" />
<style><?= file_get_contents( TDIR . '/css/style.css'); ?> </style>
<link rel="stylesheet" href="<?= esc_url(TDIR); ?>/css/style.css?ver=<?php _e($style_vsn); ?>" />


<!-- homepage styles -->
<?php if(is_front_page()) : ?>
<link rel="preload" href="<?= esc_url(TDIR); ?>/css/home.css?ver=<?php _e($style_vsn); ?>" as="style" />
<style><?= file_get_contents( TDIR . '/css/home.css'); ?> </style>
<link rel="stylesheet" href="<?= esc_url(TDIR); ?>/css/home.css?ver=<?php _e($style_vsn); ?>" />
<?php endif; ?>


</body>
</html>
