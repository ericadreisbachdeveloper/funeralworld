<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main">
	<section class="gutenberg-section">
		<div class="gutenberg-container">

			<h1><?php _e( 'Category: ' ); single_cat_title(); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>
		</div>
	</section>
</main>



<?php get_footer(); ?>
