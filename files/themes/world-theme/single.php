<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); global $site_url; ?>


<?php global $post; ?>


<main data-role="main" id="main">
	<div class="container">
		<!-- <div class="corset"> -->
			<section class="section">


				<!-- src: https://www.w3.org/TR/wai-aria-practices-1.1/examples/breadcrumb/index.html -->
				<nav aria-label="Breadcrumb" class="breadcrumb">
					<?php $topics = get_the_terms($post, 'topic');

								if ($topics) {
									foreach ($topics as $topic) {

									// 1. Resources
									echo '<ol class="breadcrumb-ol"><li class="breadcrumb-li"><a href="' . get_permalink(get_page_by_title('Resources')) . '">All Resources</a> </li>';


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

					<?php if(has_post_thumbnail()) : ?>

						<?php $img_id = get_post_thumbnail_id();
						  $retina_arr = wp_get_attachment_image_src($img_id, 'large');
						$standard_arr = wp_get_attachment_image_src($img_id, 'medium');
				  	// [0] = url
				  	// [1] = width
				  	// [2] = height
						?>

							<picture class="picture resource-img-wrapper">
								<source type="image/webp" srcset="<?php _e(esc_url($retina_arr[0])); ?>.webp 2x" media="(min-width: 561px)"><!-- retina webp -->
								<source type="image/jpg" srcset="<?php _e(esc_url($retina_arr[0])); ?> 2x" media="(min-width: 561x)"><!-- retina jpg -->
							  <source type="image/webp" srcset="<?php _e(esc_url($standard_arr[0])); ?>.webp"><!-- standard webp -->
							  <img class="img" src="<?php _e(esc_url($standard_arr[0])); ?>" /><!-- standard jpg -->
							</picture>

					<?php endif; ?>



					<?php echo _e(get_template_part('meta')); ?>



					<?php the_content(); ?>


				</article>
				<?php endwhile; ?>


				<?php else: ?>
				<article>
					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
				</article>
				<?php endif; ?>


			</section>
		<!-- </div><!-- /.corset -->
	</div><!-- /.container -->



	<!-- START: Related Articles -->
	<?php if ($topics != '' && count($topics) > 1) : ?>
	<div class="container-fluid related-articles">
		<div class="container">
			<div class="row">

			<?php $this_id = $post->ID;
			      foreach ($topics as $topic) : ?>

			<?php global $wp_query;
				$args = array(
					'post__not_in' => array($this_id),
			    'post_type' => 'post',
			    'posts_per_page' => 5,
					'tax_query' => array(
						array(
							'taxonomy' => 'topic',
							'field' => 'slug',
							'terms' => $topic->slug,
						)
					)
			  );

				$wp_query = new WP_Query( $args );
				if ( $wp_query->have_posts() ) : ?>
				<div class="col-md-6">

					<h2 class="small-h2">Related Articles about <?= $topic->name; ?> </h2>

					<ul class="ul">
						<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();  ?>
						<li class="li">
							<a href="<?= esc_url(get_the_permalink()); ?>" title="<?= get_the_title(); ?>">
								<?= get_the_title(); ?>
							</a>
						</li>
						<?php endwhile; ?>
					</ul>

					</div><!-- /.col-md-6 -->
					<?php endif; wp_reset_postdata(); endforeach; ?>

			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.container-fluid -->

	<?php endif; ?>



	<?php do_shortcode('[supportthefuture]'); ?>



</main>



<?php include(locate_template('template/editbutton.php')); ?>



<?php get_footer(); ?>
