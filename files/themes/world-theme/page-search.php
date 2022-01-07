<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php /* Template Name: Wordpress Search Results */ get_header(); ?>



<main data-role="main" id="main" class="default-page-main">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>


			<?php
			  global $wp_query;

				$tmw_dt = new DateTime('tomorrow', new DateTimeZone('UTC + 5'));
				$tmw    = $tmw_dt->format('Ymd');
				$tmw    = intval($tmw);

				$args = array(
				  'post_type' => array('page', 'events'),
				  'posts_per_page' => 999999,

					's' => $_GET['q'],

					'order' => 'ASC'
				);

				$wp_query = new WP_Query( $args ); ?>

				<?php if ( $wp_query->have_posts() ) : ?>
				<div class="container">
					<div class="row">


					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<a class="archive-a" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

								<div class="container">
									<h2 class="archive-h2" id="archive-h2"><?php the_title(); ?></h2>
								</div>

							</a>
						</article>

				<?php endwhile; ?>


			</div><!-- /.row -->
		</div><!-- /.container-fluid -->



		<?php endif; wp_reset_query(); endwhile; ?><!-- /endwhile have_posts() for the page query -->



		<?php else: ?>
		<h2><?php _e( 'Sorry, nothing to display.', 'dbllc' ); ?></h2>


	<?php endif; ?>

</main>



<?php include(locate_template('template/editbutton.php')); ?>



<?php get_footer(); ?>
