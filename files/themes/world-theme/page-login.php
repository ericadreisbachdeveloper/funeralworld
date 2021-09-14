<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>

<?php /* Template Name: Log In */ get_header(); ?>



<main data-role="main" id="main">
	<section class="gutenberg-section">
		<div class="gutenberg-container">


				<h1><?php the_title(); ?></h1>

				<p>If reCAPTCHA badge does not display in lower right, refresh this page. </p>


				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


				<?php
					$args = array( 'redirect' => get_site_url() . '/wp-admin/', 'remember' => false );
					wp_login_form($args);
				?>


				</article>
				<?php endwhile; ?>



				<?php else: ?>
				<article>
					<h2><?php _e( 'Sorry, nothing to display.', 'dbllc' ); ?></h2>
				</article>
				<?php endif; ?>


		</div>
	</section>



</main>



<?php include(locate_template('template/editbutton.php')); ?>



<?php get_footer(); ?>
