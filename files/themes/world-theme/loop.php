<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>



<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php if ( has_post_thumbnail()) : ?>

		<?php $img_id = get_post_thumbnail_id(); $img_array = wp_get_attachment_image_src($img_id, "medium"); $img = $img_array[0]; ?>

	<?php endif; ?>


	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>


	<?php echo _e(get_template_part('meta')); ?>


	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', ['class' => 'alignleft']); ?></a>


	<?php the_excerpt(); ?>


	<div class="tags"><?php the_tags('<i class="fa fa-tag"></i>&nbsp;', ' ', ''); ?></div>


</article>
<?php endwhile; ?>



<?php else: ?>
<article>
	<h2><?php _e( 'Sorry, nothing to display.', 'dbllc' ); ?></h2>
</article>
<?php endif; ?>
