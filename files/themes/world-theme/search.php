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


		<?php

				$terms = $firstterm = '';
				$terms = get_the_terms($post->ID, 'resource-type');

				if ($terms != '') {

					$firstterm = $terms[0];

					$icon_alt = $firstterm->name;

					$default_svg = get_field('resource-icon-svg', $firstterm);
					$default_svg_url = $default_svg['url'];
					$default_png = get_field('resource-icon-png', $firstterm);
					$default_png_url = $default_png['url'];
				}
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<a class="resource-article-a" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

				<div class="container">

					<h2 class="archive-h2"><?php the_title(); ?>&nbsp;</h2>
					<?php if($terms != '') : ?>
						<picture class="icon archive-icon">
							<source type="image/svg+xml" srcset="<?= esc_url($default_svg_url); ?>">
							<img class="icon-img" src="<?= esc_url($default_png_url); ?>"  alt="<?= $icon_alt; ?>" width="14" height="14" />
						</picture>
					<?php endif; ?>

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
