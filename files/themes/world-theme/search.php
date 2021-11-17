<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>


<!-- Advanced Search results AND full site search results        -->

<!-- if query includes 	audience   author  topic   resource-type -->
<!-- include clickable filter remove                             -->

<!-- if query includes post_type=post                            -->
<!-- then include searchform at the top of the page              -->
<!-- ... or ADVANCED SEARCH for everything ???                   -->


<main data-role="main" id="main">
	<section class="section" id="search-results">


		<?php get_template_part('searchform-compact'); ?>



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
