<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<?php if (have_posts()): ?>


<?php while (have_posts()) : the_post(); ?>


<?php
		global $terms; global $firstterm; global $post_type;

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
	<a class="archive-a" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

		<div class="container">


			<div class="archive-img">

				<?php if(has_post_thumbnail()) : ?>
					<?php $img_id = get_post_thumbnail_id();

					$standard_arr = wp_get_attachment_image_src($img_id, 'medium');
					         $img = wp_prepare_attachment_for_js($img_id);
					     $img_alt = $img['alt'];
					?>

					<picture class="-photo picture">
						<source type="image/webp" srcset="<?= esc_url($standard_arr[0]); ?>.webp" />
						<img width="280" height="150" class="img" src="<?= esc_url($standard_arr[0]); ?>" alt="<?= $img_alt; ?>" />
					</picture>

				<?php elseif ($terms != '') : ?>
					<div class="default-archive-img">
						<picture class="-icon picture">
							<source type="image/svg+xml" srcset="<?= esc_url($default_svg_url); ?>">
							<img width="100" height="100" src="<?= esc_url($default_png_url); ?> " alt="<?= $icon_alt; ?>" />
						</picture>
					</div>
				<?php endif; ?>

			</div>


			<!-- START: archive text -->
			<div class="archive-txt">


				<div class="archive-title-excerpt">

					<?php if($terms != '') : ?>
					<h2 class="archive-h2" id="archive-h2"><?php the_title(); ?></h2>

					<div class="picture-div">
						<picture class="icon archive-icon">
							<source type="image/svg+xml" srcset="<?= esc_url($default_svg_url); ?>">
							<img class="icon-img" src="<?= esc_url($default_png_url); ?>"  alt="<?= $icon_alt; ?>" width="14" height="14" />
						</picture>
					</div>

					<?php else : ?>
					<h2 class="archive-h2" id="archive-h2"><?php the_title(); ?></h2>
					<?php endif; ?>

					<p class="archive-p"><?php _e(dbllc_excerpt()); ?></p>

				</div><!-- /.archive-title-excerpt -->


				<div class="archive-meta">
				<?php $post_types_with_no_meta = array('page', 'asp-products'); ?>
				<?php $post_type = get_post_type($post->ID); if (!in_array($post_type, $post_types_with_no_meta)) : ?>
				<?php _e(get_template_part('meta-archive')); ?>
				<?php endif; ?>
				</div>


			</div><!-- /.archive-txt -->
			<!-- END: archive text -->

		</div><!-- /.container -->

	</a>
</article>
<?php endwhile; ?>


<?php // else: ?>
	<!--
<article>
	<div class="container">
		<h2><?php // _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</div>
</article>
-->

<?php endif; ?>
