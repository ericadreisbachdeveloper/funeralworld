<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<?php get_header(); ?>



<main data-role="main" id="main">
	<section class="section">


		<div class="container">
			<?php $s = sprintf( __('%s', 'dbllc'), $wp_query->found_posts);
			if($s == '1') { $sp = ''; } else { $sp = 's'; } ?>

			<h1><?php echo sprintf( __( '%s Search Result' . $sp . ' for &ldquo;', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); echo '&rdquo;'; ?></h1>
		</div>



		<?php get_template_part('loop'); ?>



		<?php get_template_part('pagination'); ?>



	</section>
</main>



<?php get_footer(); ?>
