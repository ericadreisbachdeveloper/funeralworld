<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>

<!-- Used on:
              /author/xx/    navigate to this archive via single
              /tag/xx/       navigate to this archive via single
              /topic/xx/     navigate to this archive via single breadcrumbs

              /category/xx/           ... not directly available ...
              /resource-type/xx/      ... not directly available ...
              /audience/xx/           ... not directly available ...
-->

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

		<div class="container"><div class="archive-container">

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


			<?php $post_types_with_no_meta = array('page', 'asp-products'); ?>
			<?php $post_type = get_post_type($post->ID); if (!in_array($post_type, $post_types_with_no_meta)) : ?>
			<?php _e(get_template_part('meta-archive-nosidebar')); ?>
			<?php endif; ?>

		</div><!-- /.archive-container --></div><!-- /.container -->

	</a>
</article>
<?php endwhile; ?>



<?php endif; ?>
