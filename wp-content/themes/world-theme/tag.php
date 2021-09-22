<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main">
	<div class="container">
		<div class="corset">
			<section class="section">

				<h1 class="sr-only"><?php single_tag_title(); ?></h1>

				<?php get_template_part('loop'); ?>

				<?php get_template_part('pagination'); ?>

			</section>
		</div>
	</div>
</main>



<?php get_footer(); ?>
