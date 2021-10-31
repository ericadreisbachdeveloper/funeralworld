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


					<?php
					if(get_field('event-end-date')) {
						$display_date = '';

						// get start
						$start = get_field('event-start-date');
						$start = strtotime($start);
						$start_d = date('j', $start);
						$start_m = date('F', $start);
						$start_y = date('Y', $start);

						$end = get_field('event-end-date');
						$end = strtotime($end);
						$end_d = date('j', $end);
						$end_m = date('F', $end);
						$end_y = date('Y', $end);

						// different years
						if ($start_y !== $end_y) {
							$display_date = $start_m . ' ' . $start_d . ', ' . $start_y . ' &ndash; ' . $end_m . ' ' . $end_d . ', ' . $end_y;
						}
						// different months
						elseif ($start_m !== $end_m) {
							$display_date = $start_m . ' ' . $start_d . ' &ndash; ' . $end_m . ' ' . $end_d . ', ' . $start_y;
						}
						// same month + year
						else {
							$display_date = $start_m . ' ' . $start_d . ' &ndash; '. $end_d . ', ' . $start_y;
						}

						$display_date = '<span class="date">' . $display_date . '</span> <br />';

					}

					else {
						$date = get_field('event-start-date');

						// convert to unix timestamp
						$date = strtotime($date);

						$date = date("F j, Y", $date);

						$display_date = '<span class="date">' . $date . '</span> <br />';
					}

					echo '<h2 class="event-h2">' . $display_date . '</h2>'; ?>




					<?php $display_time = ''; if(get_field('event-end-time') && get_field('event-start-time')) : ?>

						<?php $display_time = '<h2 class="event-h2">' . get_field('event-start-time') . ' &ndash; ' . get_field('event-end-time') . '</h2>'; ?>

					<?php elseif (get_field('event-start-time')) : ?>

						<?php $display_time = '<h2 class="event-h2">' . get_field('event-start-time') . '</h2>'; ?>

					<?php endif; echo $display_time; ?>




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

							<picture class="picture events-img-wrapper">
								<source type="image/webp" srcset="<?php _e(esc_url($retina_arr[0])); ?>.webp 2x" media="(min-width: 561px)"><!-- retina webp -->
								<source type="image/jpg" srcset="<?php _e(esc_url($retina_arr[0])); ?> 2x" media="(min-width: 561x)"><!-- retina jpg -->
							  <source type="image/webp" srcset="<?php _e(esc_url($standard_arr[0])); ?>.webp"><!-- standard webp -->
							  <img class="img" src="<?php _e(esc_url($standard_arr[0])); ?>" /><!-- standard jpg -->
							</picture>

					<?php endif; ?>



					<?php// echo _e(get_template_part('meta')); ?>


					<?php the_content(); ?>


				</article>
				<?php endwhile; ?>


				<?php else: ?>
				<article>
					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
				</article>
				<?php endif; ?>


			</section>
		</div><!-- /.corset -->
	</div><!-- /.container -->



	<!-- START: Related Articles -->
	<?php if ($topics != '') : ?>
	<div class="container-fluid related-articles">
		<div class="container">
			<div class="corset">
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

						<h2 class="-small-h2">Related Articles about <?= $topic->name; ?> </h2>

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
			</div><!-- /.corset -->
		</div><!-- /.container -->
	</div><!-- /.container-fluid -->

	<?php endif; ?>



	<?php do_shortcode('[supportthefuture]'); ?>



</main>



<?php include(locate_template('template/editbutton.php')); ?>



<?php get_footer(); ?>
