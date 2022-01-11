<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main">


	<div class="container">
		<h1>Author: <?php $obj = get_queried_object(); print_r($obj->display_name); ?></h1>

		<?php $author_id = $obj->ID; $author_meta = get_user_meta($author_id); if($author_meta['description'][0] !== '') : ?>
		<p class="deck"><?= $author_meta['description'][0]; ?> </p>
		<?php endif; ?>

	</div>


	<?php get_template_part('loop-nosidebar'); ?>


	<?php get_template_part('pagination'); ?>


</main>



<?php get_footer(); ?>
