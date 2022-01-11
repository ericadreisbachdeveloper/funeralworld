<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } global $site_url; ?>
</div><!-- /.wrapper -->



<footer class="site-footer footer-logomark">


	<div class="container-fluid footer-social-media">
		<div class="container">
			<div class="row footer-social-row">
				<?php if(has_nav_menu('social-menu')) : ?>
				<div class="social-media-col">
					<h3 class="sr-only">Follow WORLD on social media </h3>
					<?php bare_nav('social-menu');  ?>
				</div>
				<?php endif; ?>

			</div><!-- END .footer-social-row -->
		</div>
	</div>


	<div class="container-fluid footer-menus">
		<div class="container">

			<!-- if is single, show navigation -->
			<?php //if(is_single()) { include(locate_template('template/pagination_single.php')); } ?>

			<!-- if is a child page, show navigation-->
			<?php //include(locate_template('template/pagination_from_menu.php')); ?>


			<div class="row footer-menus-row">

				<div class="col-footer -logo">
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


			</div>

			<?php //print_r(get_registered_nav_menus()); ?>


			<div class="row footer-socialmedia-row">
				<div class="container socialmedia-container">

				</div>
			</div>


			<div class="row footer-copyright-row">
			<?php if(is_active_sidebar('Copyright')) { dynamic_sidebar('Copyright'); } ?>
			</div>


		</div><!-- /.container -->
	</div> <!-- /.container-fluid.footer-logomark -->
</footer>




<?php wp_footer(); ?>



<!-- 1. essential scripts for nav + forms -->
<!--    unminified in /js/dev/scripts.js -->
<script>
<?= file_get_contents( TDIR . '/js/dev/scripts.js'); ?>
</script>


<!-- 2. detect SVG support and update <body> attribute if needed - unminified version in THEME/js/dev/svg-support.js -->
<script>
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
</script>



<!-- 3. detect clip-path support and update <body> attribute if needed - unminified in THEME/js/dev/clip-path-support.js -->
<!-- unminified version in THEME/js/dev -->
<script>var areClipPathShapesSupported=function(){for(var t="clipPath",e=["webkit","moz","ms","o"],a=[t],r=document.createElement("testelement"),p=0,l=e.length;p<l;p++){var o=e[p]+t.charAt(0).toUpperCase()+t.slice(1);a.push(o)}for(p=0,l=a.length;p<l;p++){var n=a[p];if(""===r.style[n]&&(r.style[n]="polygon(50% 0%, 0% 100%, 100% 100%)",""!==r.style[n]))return!0}return!1};areClipPathShapesSupported()||document.body.setAttribute("data-clippath","no-clippath");</script>



</body>
</html>
