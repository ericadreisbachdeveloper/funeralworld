<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main" id="main">
	<section class="section">


		<div class="container">

      <?php $term = get_queried_object(); ?>

			<h1>Topic: <?= $term->name; ?> </h1>

		</div>


		<?php get_template_part('loop'); ?>


		<?php get_template_part('pagination'); ?>


	</section>
</main>



<?php get_footer(); ?>
