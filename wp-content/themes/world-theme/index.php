<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main">
	<section class="section">

		<div class="container">
			<div class="corset">

				<h1 class="sr-only"><?php _e( 'Latest Blog Posts'); ?></h1>

				<?php get_template_part('loop'); ?>

				<?php get_template_part('pagination'); ?>

			</div>
		</div>

	</section>
</main>



<?php get_footer(); ?>
