<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main" id="main">
	<section class="section">
		<div class="container">



		<?php $s = sprintf( __('%s', 'dbllc'), $wp_query->found_posts);
		if($s == '1') { $sp = ''; } else { $sp = 's'; } ?>

		<h1><?php echo sprintf( __( '%s Search Result' . $sp . ' for &ldquo;', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); echo '&rdquo;'; ?></h1>


	</div><!-- /.container -->



			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

					<div class="container">

						<h2 class="article-h2"><?php the_title(); ?> </h2>

						<?php echo _e(get_template_part('meta-no-links')); ?>

					</div><!-- /.container -->

				</a>
			</article>
			<?php endwhile; ?>



			<?php else: ?>
			<article>
				<div class="container">
					<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
				</div>
			</article>
			<?php endif; ?>


			<?php get_template_part('pagination'); ?>


	</section>
</main>



<?php get_footer(); ?>
