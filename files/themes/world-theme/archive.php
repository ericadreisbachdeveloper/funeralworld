<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main">


	<div class="container">
		<h1 class="archive-h1">Archives </h1>
	</div>


	<?php get_template_part('loop'); ?>


	<?php get_template_part('pagination'); ?>


</main>



<?php get_footer(); ?>
