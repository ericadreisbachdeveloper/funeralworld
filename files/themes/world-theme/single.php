<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); global $site_url; ?>



<main data-role="main">
	<div class="container">
		<div class="corset">
			<section class="section">


				<!-- src: https://www.w3.org/TR/wai-aria-practices-1.1/examples/breadcrumb/index.html -->
				<nav aria-label="Breadcrumb" class="breadcrumb">
					<?php $topics = get_the_terms($post, 'topic');

								if ($topics) {
									foreach ($topics as $topic) {

									// 1. Home
									echo '<ol class="breadcrumb-ol"><li class="breadcrumb-li"><a href="' . $site_url . '">Home</a> </li>';


									// 2. ancestor topics, if they exist
								  $ancestors = get_ancestors($topic->term_id, 'topic');

									foreach($ancestors as $ancestor) {

										$grand = get_term_by('id', $ancestor, 'topic');

										echo '<li class="breadcrumb-li"><a href="' . $site_url . '/topic/' . $grand->slug . '">' . $grand->name . '</a></li>';
									}


									// 3. closest topic
									echo '<li class="breadcrumb-li"><a href="' . $site_url . '/topic/' . $topic->slug . '">' . $topic->name . '</a></li>';


									// 4. this page
									echo '<li class="breadcrumb-li" data-li-current><a data-a="current-article" href="' . get_permalink() . '">' . get_the_title() . '</a></li>';

									echo '</ol>';
								} // END foreach $topics as $topic
							} // END if $topics
					?>
				</nav>


				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


					<h1 class="resource-single-h1"><?php the_title(); ?> </h1>


					<?php $args = array(
						            'before_widget' => '<div class="msb-container">',
												'after_widget' => '</div>',
												'before_title' => '<h2 class="h2-share">',
												'after_title' => '</h2>',
												'title' => __( 'SHARE', 'mytextdomain' ),
											);
								msb_display_buttons($args, true); ?>


					<?php echo _e(get_template_part('meta')); ?>


					<?php the_content(); ?>


					<div class="tags<?php if(get_the_tags() == '') : ?> -empty<?php endif; ?>"><?php the_tags('<i class="fa fa-tag"></i>&nbsp;', ' ', ''); ?></div>


				</article>
				<?php endwhile; ?>


				<?php else: ?>
				<article>
					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
				</article>
				<?php endif; ?>



				<div class="pagination-single">
					<div class="pagination-div -prev">
						<?php previous_post_link('%link', '<span class="pagination-span"><i class="fa fa-angle-double-left"></i>&nbsp;Previous</span> <br /><span class="pagination-title">%title</span>'); ?>
					</div>

					<div class="pagination-div -next">
						<?php next_post_link('%link', '<span class="pagination-span">Next&nbsp;<i class="fa fa-angle-double-right"></i></span> <br /><span class="pagination-title">%title</span>'); ?>
					</div>
				</div>



			</section>
		</div><!-- /.corset -->
	</div><!-- /.container -->



</main>



<?php include(locate_template('template/editbutton.php')); ?>



<?php get_footer(); ?>
