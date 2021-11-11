<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main" id="main">
	<section class="section" id="search-results">


		<div class="container">
			<?php $s = sprintf( __('%s', 'dbllc'), $wp_query->found_posts);
			if($s == '1') { $sp = ''; } else { $sp = 's'; } ?>

			<?php $str = get_search_query();
				    $for_query = ''; if($str != '') { $for_query = ' for &ldquo;' . $str . '&rdquo;'; } ?>

			<h1 class="search-results-h1"><?php _e(sprintf( __( '%s Search Result' . $sp . $for_query, 'dbllc' ), $wp_query->found_posts ));  ?></h1>
		</div>



		<?php get_template_part('loop-search'); ?>



		<?php get_template_part('pagination'); ?>



	</section><!-- /#search-results -->
</main>



<?php get_footer(); ?>
