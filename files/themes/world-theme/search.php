<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>


<!-- Advanced Search results AND full site search results        -->

<!-- if query includes 	audience   author  topic   resource-type -->
<!-- include clickable filter to remove                          -->

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
												<div class="container">


												<?php $s = sprintf( __('%s', 'dbllc'), $wp_query->found_posts);
												if($s == '1') { $sp = ''; } else { $sp = 's'; } ?>


												<h1 class="post search-results-h1<?php if(!array_filter($search_array)) : ?> -no-filters<?php endif; ?>"><?php _e(sprintf( __( '%s Search Result' . $sp , 'dbllc' ), $wp_query->found_posts ));  ?></h1>


												<?php if(isset($_GET['sort'])) { $sort = $_GET['sort']; } else { $sort = ''; } ?>
												<div class="sort-div">
													<label for="sort-by">Sort by &nbsp;</label>
													<select onchange="loadpage()" id="sort-by" class="select">
														<option id="newest"<?php           if($sort == 'newest')           { _e(' selected'); } ?>>Newest Added </option>
														<option id="oldest"<?php           if($sort == 'oldest')           { _e(' selected'); } ?>>Oldest Added </option>
														<option id="newest-published"<?php if($sort == 'newest-published') { _e(' selected'); } ?>>Newest Published </option>
														<option id="oldest-published"<?php if($sort == 'oldest-published') { _e(' selected'); } ?>>Oldest Published </option>
													</select>
												</div>
											</div>


											<div class="container">
												<?php if(array_filter($search_array)) : ?>
												<?php $audience_term = $author_term = $topic_term = $type_term = $filteredurl = '';  ?>
												<div class="filter-buttons">

													<?php //$uri = $_SERVER['REQUEST_URI']; ?>




													<!-- 0. Search Query -->
													<?php if($search_array[0] != '') : ?>

													<?php $filteredurl = WP_SITEURL . '?s=';

														if ($search_array[1] != '') {
															$audience_term = get_term_by('slug', $search_array[1], 'audience');
															$filteredurl  .= '&audience=' . $audience_term->slug;
														}

														if($search_array[2] != '') {
															$author_term  = get_user_by('id', $search_array[2]);
															$filteredurl .= '&author=' . $author_term->ID;
														}

														if($search_array[3] != '') {
															$topic_term   = get_term_by('slug', $search_array[3], 'topic');
															$filteredurl .= '&topic=' . $topic_term->slug;
														}

														if($search_array[4] != '') {
															$type_term    = get_term_by('slug', $search_array[4], 'resource-type');
															$filteredurl .= '&resource-type=' . $type_term->slug;
														}

														$filteredurl .= '&post_type=post'; ?>

													<a href="<?= esc_url($filteredurl); ?>" data-input="s" data-value="<?= $search_array[0]; ?>">SEARCH: <?= $search_array[0]; ?></a>
													<?php endif; ?>
													<!-- /0. Search -->


													<!-- 1. Audience -->
													<?php if($search_array[1] != '') : ?>

													<?php $audience_term  = get_term_by('slug', $search_array[1], 'audience'); ?>

													<?php $filteredurl = WP_SITEURL . '?s=';

														if ($search_array[0] != '') {
															$search_term  = $search_array[0];
															$search_term  = str_replace(' ', '+', $search_term);
															$filteredurl .= $search_term;
														}

														if($search_array[2] != '') {
															$author_term  = get_user_by('id', $search_array[2]);
															$filteredurl .= '&author=' . $author_term->ID;
														}

														if($search_array[3] != '') {
															$topic_term  = get_term_by('slug', $search_array[3], 'topic');
															$filteredurl .= '&topic=' . $topic_term->slug;
														}

														if($search_array[4] != '') {
															$type_term = get_term_by('slug', $search_array[4], 'resource-type');
															$filteredurl .= '&resource-type=' . $type_term->slug;
														}

														$filteredurl .= '&post_type=post'; ?>

													<a href="<?= esc_url($filteredurl); ?>" data-input="audience" data-value="<?= $search_array[1]; ?>">AUDIENCE: <?= $audience_term->name; ?></a>
													<?php endif; ?>
													<!-- /1. Audience -->


													<!-- 2. Author -->
													<?php if($search_array[2] != '') : ?>

													<?php $author_term  = get_user_by('id', $search_array[2]); ?>

													<?php $filteredurl = WP_SITEURL . '?s=';

														if ($search_array[0] != '') {
															$search_term  = $search_array[0];
															$search_term  = str_replace(' ', '+', $search_term);
															$filteredurl .= $search_term;
														}

														if ($search_array[1] != '') {
															$audience_term = get_term_by('slug', $search_array[1], 'audience');
															$filteredurl  .= '&audience=' . $audience_term->slug;
														}

														if($search_array[3] != '') {
															$topic_term  = get_term_by('slug', $search_array[3], 'topic');
															$filteredurl .= '&topic=' . $topic_term->slug;
														}

														if($search_array[4] != '') {
															$type_term = get_term_by('slug', $search_array[4], 'resource-type');
															$filteredurl .= '&resource-type=' . $type_term->slug;
														}

														$filteredurl .= '&post_type=post'; ?>

													<a href="<?= esc_url($filteredurl); ?>" data-input="author" data-value="<?= $search_array[2]; ?>">AUTHOR: <?= $author_term->display_name; ?></a>
													<?php endif; ?>
													<!-- /2. Author -->


													<!-- 3. Topic -->
													<?php if($search_array[3] != '') : ?>

													<?php $topic_term  = get_term_by('slug', $search_array[3], 'topic'); ?>

													<?php $filteredurl = WP_SITEURL . '?s=';

														if ($search_array[0] != '') {
															$search_term  = $search_array[0];
															$search_term  = str_replace(' ', '+', $search_term);
															$filteredurl .= $search_term;
														}

														if ($search_array[1] != '') {
															$audience_term = get_term_by('slug', $search_array[1], 'audience');
															$filteredurl  .= '&audience=' . $audience_term->slug;
														}

														if($search_array[2] != '') {
															$author_term  = get_user_by('id', $search_array[2]);
															$filteredurl .= '&author=' . $author_term->ID;
														}

														if($search_array[4] != '') {
															$type_term = get_term_by('slug', $search_array[4], 'resource-type');
															$filteredurl .= '&resource-type=' . $type_term->slug;
														}

														$filteredurl .= '&post_type=post'; ?>

													<a href="<?= esc_url($filteredurl); ?>" data-input="topic" data-value="<?= $search_array[3]; ?>">TOPIC: <?= $topic_term->name; ?></a>
													<?php endif; ?>
													<!-- /3. Topic -->


													<!-- 4. Type -->
													<?php if($search_array[4] != '') : ?>

													<?php $type_term = get_term_by('slug', $search_array[4], 'resource-type'); ?>

													<?php $filteredurl = WP_SITEURL . '?s=';

														if ($search_array[0] != '') {
															$search_term  = $search_array[0];
															$search_term  = str_replace(' ', '+', $search_term);
															$filteredurl .= $search_term;
														}

														if ($search_array[1] != '') {
															$audience_term = get_term_by('slug', $search_array[1], 'audience');
															$filteredurl  .= '&audience=' . $audience_term->slug;
														}

														if($search_array[2] != '') {
															$author_term  = get_user_by('id', $search_array[2]);
															$filteredurl .= '&author=' . $author_term->ID;
														}

														if($search_array[3] != '') {
															$topic_term  = get_term_by('slug', $search_array[3], 'topic');
															$filteredurl .= '&topic=' . $topic_term->slug;
														}

														$filteredurl .= '&post_type=post'; ?>

													<a href="<?= esc_url($filteredurl); ?>" data-input="topic" data-value="<?= $search_array[4]; ?>">RESOURCE TYPE: <?= $type_term->name; ?></a>
													<?php endif; ?>
													<!-- /4. Type -->


												</div><!-- /.filter-buttons -->
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
