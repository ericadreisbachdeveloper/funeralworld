<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php /* Template Name: Events */ get_header(); ?>



<main data-role="main" id="main" class="default-page-main">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>


		<?php global $post; $post = get_post(); include(locate_template('template/hero.php')); ?>


		<?php include(locate_template('template/no_default_title.php')); ?>


		<?php include(locate_template('template/page_content.php')); ?>



			<?php
			  global $wp_query;

				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

				$tmw_dt = new DateTime('tomorrow', new DateTimeZone('UTC + 5'));
				$tmw    = $tmw_dt->format('Ymd');
				$tmw    = intval($tmw);

				$args = array(
				  'post_type' => 'events',
				  'posts_per_page' => 10,
				  'paged' => $paged,

					'meta_key' => 'event-start-date',
					'order_by' => 'meta_value',
					'order' => 'ASC',

					'meta_query' => array(

						'relation' => 'OR',

						array(
							'key' => 'event-start-date',
							'value' => $tmw,
							'compare' => '>'
						),

						array(
							'key' => 'event-end-date',
							'value' => $tmw,
							'compare' => '>'
						)
					)
				);

				$wp_query = new WP_Query( $args ); ?>

				<?php if ( $wp_query->have_posts() ) : ?>
				<div class="container">
					<div class="row">


					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

						<div class="col-md-6">

						<?php $display_date = $start = $end = '';

			          if(get_field('event-start-date')) {
			            // get start
			            $start = get_field('event-start-date');
			            $start = strtotime($start);
			            $start_d = date('j', $start);
			            $start_m = date('F', $start);
			            $start_y = date('Y', $start);
			          }

			          // multi-day event
			          if(get_field('event-end-date')) {

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

			          }

			          // one-day event
			          else {
			            $display_date = $start_m . ' ' . $start_d . ', ' . $start_y;
			          }
						?>


					  <?php include(locate_template('events-thumb.php')); ?>


				    <a href="<?= esc_url(get_the_permalink()); ?>" title="<?= get_the_title(); ?>"><h2 class="small-h2 events-h2"><?php the_title(); ?> </h2></a>
						<h3 class="events-h3"><?= $display_date; ?></h3>

					</div><!-- /.col-md-6 -->

				<?php endwhile; ?>
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->



		<?php get_template_part('pagination'); endif; wp_reset_query(); endwhile; ?><!-- /endwhile have_posts() for the page query -->



		<?php else: ?>
		<h2><?php _e( 'Sorry, nothing to display.', 'dbllc' ); ?></h2>


	<?php endif; ?>

</main>



<?php include(locate_template('template/editbutton.php')); ?>



<?php get_footer(); ?>
