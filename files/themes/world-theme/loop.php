<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>



<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a title="<?= get_the_title(); ?>">


	<h2><?php the_title(); ?> </h2>


	<?= _e(get_template_part('meta')); ?>


	<div class="tags"><?php the_tags('<i class="fa fa-tag"></i>&nbsp;', ' ', ''); ?></div>

	</a>
</article>
<?php endwhile; ?>



<?php else: ?>
<article>
	<h2><?php _e( 'Sorry, nothing to display.', 'dbllc' ); ?></h2>
</article>
<?php endif; ?>
