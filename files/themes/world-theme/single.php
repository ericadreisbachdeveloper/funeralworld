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
		</div><!-- /.corset -->
	</div><!-- /.container -->



	<?php do_shortcode('[supportthefuture]'); ?>



</main>



<?php include(locate_template('template/editbutton.php')); ?>



<?php get_footer(); ?>
