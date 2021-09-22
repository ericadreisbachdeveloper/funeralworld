<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } global $site_url; ?>
</div><!-- /.wrapper -->



<footer class="site-footer container-fluid">

<div class="container">


	<!-- if is single, show navigation -->
	<?php //if(is_single()) { include(locate_template('template/pagination_single.php')); } ?>

	<!-- if is a child page, show navigation-->
	<?php //include(locate_template('template/pagination_from_menu.php')); ?>


		<div class="row footer-menus-row">

			<div class="col-footer">
				<a href="<?php _e(esc_url($site_url)); ?>">
					<picture class="picture">

						<?php if(get_field('footer-logomark-svg', 'options')) : ?>
						<?php $footer_logomark_svg = get_field('footer-logomark-svg', 'options'); $footer_logomark_svg = $footer_logomark_svg['url']; ?>
						<source type="image/svg" srcset="<?= esc_url($footer_logomark_svg); ?>" />

						<?php else : ?>
						<source type="image/svg" srcset="<?= esc_url(TDIR . '/img/logo-mark-circle.svg'); ?>" />
						<?php endif; ?>


						<?php if(get_field('footer-logomark-svg', 'options')) : ?>
						<?php $footer_logomark_png = get_field('footer-logomark-png', 'options'); $footer_logomark_png = $footer_logomark_png['url']; ?>
						<img src="<?= esc_url($footer_logomark_png); ?>" title="<?= get_bloginfo('name'); ?>" alt="Logo for <?= get_bloginfo('name'); ?>" />

						<?php else : ?>
						<img src="<?= esc_url(TDIR . '/img/logo-mark-circle.png'); ?>" />
						<?php endif; ?>

					</picture>
				</a>
			</div>


			<?php dynamic_sidebar( 'Footer Menus' ); ?>


			<?php if(has_nav_menu('social-menu')) : ?>
			<div class="col-footer social-media-col">
				<h3 class="sr-only">Follow WORLD on social media </h3>
				<?php bare_nav('social-menu');  ?>
			</div>
			<?php endif; ?>


		</div>

		<?php //print_r(get_registered_nav_menus()); ?>


		<div class="row footer-socialmedia-row">
			<div class="container socialmedia-container">

			</div>
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
