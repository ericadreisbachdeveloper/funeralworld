<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>


<!-- Advanced Search results AND full site search results        -->

<!-- if query includes 	audience   author  topic   resource-type -->
<!-- include clickable filter remove                             -->

<!-- if query includes post_type=post                            -->
<!-- then include searchform at the top of the page              -->
<!-- ... or ADVANCED SEARCH for everything ???                   -->


<main data-role="main" id="main">



	<section class="section">

		<?php get_template_part('searchform-compact'); ?>

	</section>



	<!-- mimicking structure of /our-work/ built with native blocks -->
	<section class="section gutenberg-section core-group">
		<div class="gutenberg-container">
			<div class="wp-block-group mist-bg">
				<div class="wp-block-group__inner-container">
					<div class="gutenberg-section core-columns">
						<div class="gutenberg-container">
							<div class="wp-block-columns search-columns">


								<!-- sidebar -->
								<div class="wp-block-column hide-md-and-smaller" style="flex-basis: 25%;">
									<div class="gutenberg-section core-shortcode">
										<div class="gutenberg-container">
										<?php _e(do_shortcode("[searchsidebar]")); ?>
										</div>
									</div>
								</div>



								<div class="wp-block-column hide-md-and-smaller border-right" style="flex-basis:0px"></div>
								<div class="wp-block-column hide-md-and-smaller" style="flex-basis:0px"></div>



								<div class="wp-block-column full-width-md-and-smaller" style="flex-basis:75%">


									<?php
										if (isset($_GET['s'])) { $s = $_GET['s']; }
										global $audience_select; global $author_select; global $topic_select; global $type_select;

										$search_array = array($s, $audience_select, $author_select, $topic_select, $type_select);
									?>


									<div class="gutenberg-section core-shortcode">
										<div class="gutenberg-container">
											<div id="search-results">

											<?php $s = sprintf( __('%s', 'dbllc'), $wp_query->found_posts);
											if($s == '1') { $sp = ''; } else { $sp = 's'; } ?>

											<?php $str = get_search_query();
												    $for_query = ''; if($str != '') /* { $for_query = ' for &ldquo;' . $str . '&rdquo;'; }*/ ?>

											<h1 class="search-results-h1<?php if(!array_filter($search_array)) : ?> -no-filters<?php endif; ?>"><?php _e(sprintf( __( '%s Search Result' . $sp . $for_query, 'dbllc' ), $wp_query->found_posts ));  ?></h1>


											<?php if(array_filter($search_array)) : ?>

											<!-- all values are empty (where "empty" means == false) -->
											<div class="filter-buttons">

												<?php if($search_array[0] != '') : ?>
												<a href="#" data-input="s" data-value="<?= $search_array[0]; ?>">SEARCH: <?= $search_array[0]; ?></a>
												<?php endif; ?>

												<?php if($search_array[1] != '') : ?>
												<?php $audience_term = get_term_by('slug', $search_array[1], 'audience'); ?>
												<a href="#" data-input="audience" data-value="<?= $audience_term->slug; ?>">AUDIENCE: <?= $audience_term->name; ?></a>
												<?php endif; ?>

												<?php if($search_array[2] != '') : ?>
												<?php $author_term = get_user_by('id', $search_array[2]); ?>
												<a href="#" data-input="author" data-value="<?= $author_term->ID; ?>">AUTHOR: <?= $author_term->display_name; ?></a>
												<?php endif; ?>

												<?php if($search_array[3] != '') : ?>
												<?php $topic_term = get_term_by('slug', $search_array[3], 'topic'); ?>
												<a href="#" data-input="topic" data-value="<?= $topic_term->slug; ?>">TOPIC: <?= $topic_term->name; ?></a>
												<?php endif; ?>

												<?php if($search_array[4] != '') : ?>
												<?php $type_term = get_term_by('slug', $search_array[4], 'resource-type'); ?>
												<a href="#" data-input="resource-type" data-value="<?= $type_term->slug; ?>">RESOURCE TYPE: <?= $type_term->name; ?></a>
												<?php endif; ?>

											</div><!-- /.filter-buttons -->
											<?php endif; ?>


											<?php get_template_part('loop-search'); ?>


											<?php get_template_part('pagination'); ?>
											</div><!-- /#search-results -->


							</div><!-- /.gutenberg-container -->
						</div><!-- /.gutenberg-section.core-shortcode -->
					</div><!-- /.wp-block-column -->


<!--
<section class="section gutenberg-section core-group">
	<div class="gutenberg-container">
		<div class="wp-block-group mist-bg">
			<div class="wp-block-group__inner-container">
				<div class="gutenberg-section core-columns">
					<div class="gutenberg-container">
						<div class="wp-block-columns">

						-->
							</div><!-- /.wp-block-columns -->
						</div><!-- /.gutenberg-container -->
					</div><!-- /.gutenberg-section.core-columns -->
				</div><!-- /.wp-block-group__inner-container -->
			</div><!-- /.wp-block-group.mist-bg -->
 		</div><!-- /.gutenberg-container -->
	</section><!-- /#search-results -->
</main>



<?php get_footer(); ?>
