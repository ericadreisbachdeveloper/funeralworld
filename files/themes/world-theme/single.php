<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main">
	<div class="container">
		<div class="corset">
			<section class="section">


				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


					<h1 class="resource-single-h1"><?php the_title(); ?> </h1>


					<?php echo _e(get_template_part('meta')); ?>


					<?php the_content(); ?>


					<div class="tags<?php if(get_the_tags() == '') : ?> -empty<?php endif; ?>"><?php the_tags('<i class="fa fa-tag"></i>&nbsp;', ' ', ''); ?></div>


				</article>
				<?php endwhile; ?>


				<?php else: ?>
				<article>
					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
				</article>
				<?php endif; ?>



				<div class="pagination-single">
					<div class="pagination-div -prev">
						<?php previous_post_link('%link', '<span class="pagination-span"><i class="fa fa-angle-double-left"></i>&nbsp;Previous</span> <br /><span class="pagination-title">%title</span>'); ?>
					</div>

					<div class="pagination-div -next">
						<?php next_post_link('%link', '<span class="pagination-span">Next&nbsp;<i class="fa fa-angle-double-right"></i></span> <br /><span class="pagination-title">%title</span>'); ?>
					</div>
				</div>



			</section>
		</div><!-- /.corset -->
	</div><!-- /.container -->



</main>



<?php include(locate_template('template/editbutton.php')); ?>



<?php get_footer(); ?>
