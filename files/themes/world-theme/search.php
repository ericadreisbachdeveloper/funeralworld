<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main" id="main">
	<section class="section" id="search-results">


		<div class="container">
			<?php $s = sprintf( __('%s', 'dbllc'), $wp_query->found_posts);
			if($s == '1') { $sp = ''; } else { $sp = 's'; } ?>

			<h1 class="search-results-h1"><?php _e(sprintf( __( '%s Search Result' . $sp . ' for &ldquo;', 'dbllc' ), $wp_query->found_posts )); _e( get_search_query()); _e('&rdquo;'); ?></h1>
		</div>



		<?php get_template_part('loop'); ?>



		<?php get_template_part('pagination'); ?>



	</section><!-- /#search-results -->
</main>



<?php get_footer(); ?>
