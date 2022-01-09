<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>

<?php /* Template Name: Stripe Default */ get_header(); ?>



<main data-role="main" id="main">
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>


		<?php global $post; $post = get_post(); include(locate_template('template/hero.php')); ?>


		<?php include(locate_template('template/no_hero_title_center.php')); ?>


		<?php include(locate_template('template/page_content.php')); ?>


		<?php endwhile; ?>


		<?php else: ?>
		<h2><?php _e( 'Sorry, nothing to display.', 'dbllc' ); ?></h2>


	<?php endif; ?>

</main>



<?php include(locate_template('template/editbutton.php')); ?>



<?php get_footer(); ?>
