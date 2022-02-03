<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main" id="main">


	<div class="container archive-container">

    <?php $term = get_queried_object(); ?>

		<?php $tax = get_taxonomy( $term->taxonomy ); ?>

		<h1 class="archive-h1"><?= $tax->labels->singular_name; ?>: <?= $term->name; ?> </h1>

	</div>


	<?php get_template_part('loop-nosidebar'); ?>


	<?php get_template_part('pagination'); ?>


</main>



<?php get_footer(); ?>
