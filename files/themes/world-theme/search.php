<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>


<!-- Advanced Search results AND full site search results        -->

<!-- if query includes 	audience   author  topic   resource-type -->
<!-- include clickable filter to remove                          -->

<!-- if query includes post_type=post                            -->
<!-- then include searchform at the top of the page              -->

<!-- if query includes post_type=pages                           -->
<!-- then show separate results that look like archive.php       -->



<main data-role="main" id="main">


	<!-- if url begins with post_type=pages  -->
	<!-- then DON'T load compact search form -->
	<?php if( isset($_GET['post_type']) && substr($_GET['post_type'], 0, 4) == 'page') : ?>


	<!-- but otherwise, load it -->
	<?php else : ?>
	<section class="section">

		<?php get_template_part('searchform-compact'); ?>

	</section>
	<?php endif; ?>





	<!-- mimicking structure of /our-work/ built with native blocks -->
	<section class="section gutenberg-section core-group">
		<div class="gutenberg-container">
			<div class="wp-block-group mist-bg search-block-group">
				<div class="wp-block-group__inner-container">
					<div class="gutenberg-section core-columns">
						<div class="gutenberg-container">
							<div class="wp-block-columns search-columns">




								<!-- if url includes post_type=pages          -->
								<!-- then DON'T load sidebar                  -->
								<?php if( isset($_GET['post_type']) && substr($_GET['post_type'], 0, 4) !== 'page') : ?>


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


								<?php endif; ?>



								<div class="wp-block-column full-width-md-and-smaller" <?php if( isset($_GET['post_type']) && substr($_GET['post_type'], 0, 4) == 'page') : ?> <?php else : ?>style="flex-basis:75%"<?php endif; ?>>


									<?php
										if (isset($_GET['s'])) { $s = $_GET['s']; }

										global $audience_select; global $author_select; global $topic_select; global $type_select;

										global $search_array;
										       $search_array = array($s, $audience_select, $author_select, $topic_select, $type_select);
									?>


									<div class="gutenberg-section core-shortcode">
										<div class="gutenberg-container">
											<div id="search-results">



												<div class="container container-search-results-header">


													<div class="results-h1-and-buttons">
														<?php get_template_part('loop-search-query');

															 $s = $wp_query->found_posts;
														if($s == '1') { $sp = ''; } else { $sp = 's'; } ?>

														<h1 class="post search-results-h1<?php if( isset($_GET['post_type']) && substr($_GET['post_type'], 0, 4) == 'page') : ?> pages-events<?php endif; ?>"><?= $s . ' '; ?><?php if(isset($_GET['post_type']) && substr($_GET['post_type'], 0, 4) == 'page') { echo 'Site'; } ?><?= ' Search Result' . $sp; ?><?php if(isset($_GET['s']) && $_GET['s'] !== '') { _e(' for &ldquo;' . $_GET['s'] . '&rdquo;'); } ?></h1>

														<?php if(isset($_GET['post_type']) && substr($_GET['post_type'], 0, 4) == 'page') : ?>
														<p class="looking-for"><em>Looking for white papers, videos, and more? Try our <a href="<?= esc_url(WP_SITEURL) . 'resources/'; ?>">Resources</a> page!</em></p>
														<?php endif; ?>


														<?php get_template_part('filter-buttons'); ?>


													</div><!-- /.results-h1-and-buttons -->



													<?php if(isset($_GET['post_type']) && substr($_GET['post_type'], 0, 4) !== 'page') : ?>
													<?php if(isset($_GET['sort'])) { $sort = $_GET['sort']; } else { $sort = ''; } ?>
													<div class="sort-div<?php if( isset($_GET['sort']) && ( $_GET['sort'] == 'newest-published' || $_GET['sort'] == 'oldest-published') ) : ?> has-caveat<?php endif; ?>">


														<div class="sort-select">
															<label for="sort-by">Sort by &nbsp;</label>
															<select onchange="loadpage()" id="sort-by" class="select">
																<option id="newest"<?php           if($sort == 'newest' || (isset($_GET['sort']) && $_GET['sort'] == 'newest') ) { _e(' selected'); } ?>>Newest Added </option>
																<option id="oldest"<?php           if($sort == 'oldest' || (isset($_GET['sort']) && $_GET['sort'] == 'oldest') ) { _e(' selected'); } ?>>Oldest Added </option>
																<option id="newest-published"<?php if($sort == 'newest-published' || (isset($_GET['sort']) && $_GET['sort'] == 'newest-published') ) { _e(' selected'); } ?>>Newest Published </option>
																<option id="oldest-published"<?php if($sort == 'oldest-published' || (isset($_GET['sort']) && $_GET['sort'] == 'oldest-published')) { _e(' selected'); } ?>>Oldest Published </option>
															</select>
														</div><!-- /.sort-select -->


														<?php if( isset($_GET['sort']) && ( $_GET['sort'] == 'newest-published' || $_GET['sort'] == 'oldest-published') ) : ?>
														<p class="caveat"><em>Resources with no published date are excluded from results sorted by date published</em></p>
														<?php endif; ?>


													</div><!-- /.sort-div -->
													<?php endif; ?>



											</div><!-- /.container -->



											<?php get_template_part('loop-search'); ?>


											<?php get_template_part('pagination'); ?>



											</div><!-- /#search-results -->


										</div><!-- /.gutenberg-container -->
									</div><!-- /.gutenberg-section.core-shortcode -->




								</div><!-- /.wp-block-column -->



							</div><!-- /.wp-block-columns -->
						</div><!-- /.gutenberg-container -->
					</div><!-- /.gutenberg-section.core-columns -->
				</div><!-- /.wp-block-group__inner-container -->
			</div><!-- /.wp-block-group.mist-bg -->
 		</div><!-- /.gutenberg-container -->
	</section><!-- /#search-results -->
</main>



<?php get_footer(); ?>
