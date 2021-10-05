<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<?php
	// minify html
	function sanitize_output($buffer) {
	require_once('minify/html.php');
  $buffer = Minify_HTML::minify($buffer);
  return $buffer;
}
ob_start('sanitize_output');
?>



<meta charset="<?php bloginfo('charset'); ?>">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0">



<?php global $site_url; $site_url = get_site_url(); ?>


<?php //do_action( 'wpseo_head' );  ?>


<!-- https://developer.wordpress.org/reference/functions/wp_title/ -->
<title><?php wp_title(' | ', true, 'right'); bloginfo( 'name' ); if(is_front_page()) { _e(' | ' . get_bloginfo('description')); } ?></title>



<!-- Social / Open Graph -->
<meta name="og:url" property="og:url" content="<?php echo _e(get_permalink(), 'dbllc'); ?>">
<meta name="og:type" property="og:type" content="website">
<meta name="og:site_name" property="og:site_name" content="<?php _e(get_bloginfo('name')); echo _e(' | '); _e(get_bloginfo('description')); ?>">

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content=" XXXX " />



<!-- Meta Description -->
<?php $metadescription = "";  ?>

<!-- 1st choice - post meta description field -->
<!-- archives don't have descriptions -->
<?php if($post != '' && class_exists('acf') && get_field('meta-description', $post->ID)) : ?>
<?php $metadescription = get_field('meta-description'); ?>

<!-- 2nd choice - Wordpress-generated excerpt -->
<!-- archives don't have descriptions -->
<?php elseif( $post != '' ) : ?>
<?php $metadescription = get_the_excerpt($post->ID);  ?>

<?php endif; ?>

<meta name="description" property="description" content="<?php _e($metadescription); ?>">
<meta property="og:description" content="<?php _e($metadescription); ?>" />
<meta name="twitter:description" content="<?php _e($metadescription); ?>">



<!-- Fonts -->
<style>@font-face{font-family:mreaves-book;font-display:swap;unicode-range:U+000-5FF;src:url('<?= TDIR; ?>/fonts/mreaves-book.eot?#iefix') format('eot'),url('<?= TDIR; ?>/fonts/mreaves-book.woff') format('woff')}@font-face{font-family:mreaves;font-display:swap;unicode-range:U+000-5FF;src:url('<?= TDIR; ?>/fonts/mreaves-reg.eot?#iefix') format('eot'),url('<?= TDIR; ?>/fonts/mreaves-reg.woff') format('woff')}@font-face{font-family:mreaves-ital;font-display:swap;unicode-range:U+000-5FF;src:url('<?= TDIR; ?>/fonts/mreaves-reg-ital.eot?#iefix') format('eot'),url('<?= TDIR; ?>/fonts/mreaves-reg-ital.otf') format('woff')} </style>



<!-- Image -->
<?php $socialimg = ""; ?>

<!-- 1st choice - featured image -->
<?php if(has_post_thumbnail()) : ?>
<?php $socialimg = get_the_post_thumbnail_url($post->ID,'hero'); ?>

<!-- 2nd choice - global default -->
<?php elseif(class_exists('acf') && get_field('social-img','option')) : ?>
<?php $socialimg = get_field('social-img', 'option', $post->ID); $socialimg = $socialimg['url']; ?>
<?php endif; ?>

<meta name="og:image" property="og:image" content="<?php echo esc_url($socialimg); ?>">
<meta name="twitter:image" content="<?php echo esc_url($socialimg); ?>">



<!-- Favicons -->
<?php include(locate_template('favicons.php')); ?>
<link href="<?= esc_url(get_home_url()); ?>/favicon.ico" type="image/x-icon" rel="shortcut icon">



<!-- Google Analytics - conditionally hidden from PageSpeed Insights -->
<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false): ?>
<link href="//www.google-analytics.com" rel="dns-prefetch">

<!-- SNIPPET HERE -->
<?php endif; ?>



<!-- pre-load + load assets -->

<!-- theme priority (above-the-fold) styles -->
<?php global $style_vsn, $isnewvisitor; $isnewvisitor = (isset($_COOKIE['v']))? false: (function() { setcookie('v',1, time()+3600*24*14);return true;})(); ?>

<?php if($isnewvisitor) : ?>
<style><?= file_get_contents( TDIR . '/css/priority.css'); ?> </style>
<?php else : ?>
<link rel="preload" href="<?= esc_url(TDIR); ?>/css/priority.css?ver=<?php _e($style_vsn); ?>" as="style">
<link rel="stylesheet" href="<?= esc_url(TDIR); ?>/css/priority.css?ver=<?php _e($style_vsn); ?>" />
<?php endif; ?>


<!-- fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">



<!-- ... one of the plugins might also add this tho? ... -->
<link rel="dns-prefetch" href="//code.jquery.com" />


<!-- unminified vsn in THEME/sass/__0-fonts.scss -->



<?php $custom_logo_svg = get_theme_mod( 'logo_svg' );
			$custom_logo_svg_mobile = get_theme_mod( 'logo_svg_mobile' );
      $custom_logo_png = get_theme_mod( 'logo_png_fallback' );
			$custom_logo_png_mobile = get_theme_mod( 'logo_png_fallback_mobile' ); ?>

<?php if($custom_logo_svg) : ?>
<link rel="preload" as="image" href="<?= esc_url($custom_logo_svg); ?>">
<?php else : ?>
<link rel="preload" as="image" href="<?= esc_url(TDIR); ?>/img/logo.svg">
<?php endif; ?>

<style>[data-svg="no-inlinesvg"] .pngbg.logo-a { background-image: url('<?= esc_url($custom_logo_png); ?>'); }</style>


<?php wp_head(); ?>


</head>

<!-- default assumption - browser supports inline svgs - a reasonable assumption: https://caniuse.com/?search=svg -->
<body <?php body_class(); ?> data-svg="inlinesvg" data-clippath="clippath">



	<a href="#main" id="skip-link" class="sr-only-focusable">Skip to main content</a>


	<div class="wrapper">


		<header class="site-header clear" >
			<div class="gutenberg-container">


				<div class="logo-div">

					<a href="<?php echo esc_url(get_home_url()); ?>" class="pngbg logo-a">

						<picture class="picture">

		          <source type="image/webp" srcset="<?= esc_url($custom_logo_svg); ?>" media="(min-width: 992px)" />
		          <source type="image/webp" srcset="<?= esc_url($custom_logo_svg_mobile); ?>" />
		          <source type="image/png"  srcset="<?= esc_url($custom_logo_png); ?>"  media="(min-width: 992px)"  />
		          <source type="image/png"  srcset="<?= esc_url($custom_logo_png_mobile); ?>" />

							<?php if($custom_logo_svg) : ?>
							<img class="logo-img" src="<?= esc_url($custom_logo_svg); ?>" srcset="<?= esc_url($custom_logo_svg_mobile); ?> 992px" title="<?= get_bloginfo('name'); ?>" alt="logo for <?= get_bloginfo('name'); ?>"/>

							<?php else : ?>
							<img height="80" width="80" class="logo-img" src="<?= esc_url(TDIR); ?>/img/logo.svg" title="<?= get_bloginfo('name'); ?>" alt="Logo for <?= get_bloginfo('name'); ?>" />
							<?php endif; ?>

		        </picture>

					</a>
				</div>


				<nav class="nav">

					<div class="navbar-header">
						<button id="navbar-toggle" class="navbar-toggler navbar-toggle collapsed" type="button" data-toggle="collapse" aria-controls="navmenu" aria-expanded="false" aria-label="Toggle navigation">
							<span class="sr-only">Toggle navigation</span>
							<span class="opennav icon-bar -top"></span>
							<span class="opennav icon-bar -middle"></span>
							<span class="opennav icon-bar -bottom"></span>
						</button>
					</div>


					<div id="navmenu" class="navbar-collapse collapse">
						<!-- <div class="container-on-mobile"> -->
							<?php dbllc_nav('main-menu'); dbllc_nav('offsite-menu'); ?>
							<?php //include(locate_template('searchform.php')); ?>
						<!-- </div> -->
					</div>

				</nav>


			</div><!-- /.gutenberg-container -->
		</header>
