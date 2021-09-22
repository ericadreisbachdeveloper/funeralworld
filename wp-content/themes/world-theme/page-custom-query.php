<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>



<?php
  global $wp_query;

  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'paged' => $paged
  );

  // use global variable $wp_query
  // not, like, $loop or $news or whatever
  $wp_query = new WP_Query( $args ); ?>

  <?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

  <section class="section">
    <div class="container">
      <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'square'); ?>
      <?php the_title(); ?>
    </div>
  </section>

  <?php endwhile; get_template_part('pagination'); endif; wp_reset_postdata();  ?>


  <!--

  	src: https://wordpress.stackexchange.com/posts/144344/revisions

  	wp_reset_query() - ensures that the main query has been reset to the original main query
    wp_reset_query() - immediately after every loop using query_posts()

  	wp_reset_postdata() - ensures that the global $post has been restored to the current post in the main query
    wp_reset_postdata() - immediately after every custom WP_Query()

  -->
