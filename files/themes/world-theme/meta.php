<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<?php
  $terms = $firstterm = '';
  $terms = get_the_terms($post->ID, 'resource-type');
	if ($terms != '') { $firstterm = $terms[0]; }
?>


<div class="resource-below-hero">

  <div class="resource-meta">
    <div class="meta-time">
      <h2 class="meta-h2">PUBLISHED: </h2> <?php the_time('F j, Y'); ?></span>
    </div>


    <?php if($firstterm != '' && $firstterm->slug == 'video') : ?>
    <div class="meta-author">
      <h2 class="meta-h2">POSTED BY: </h2>
      <?php the_author_posts_link(); ?>
    </div>
    <?php else : ?>
    <div class="meta-author">
      <h2 class="meta-h2">AUTHOR: </h2>
      <?php the_author_posts_link(); ?>
    </div>
    <?php endif; ?>


    <?php $tags = get_the_tags(); if ($tags) : ?>
    <div class="meta-tags">
      <h2 class="meta-h2">TAGGED:</h2> <?php $i = 0; $c = count($tags); if($c >= 1) { foreach ($tags as $tag) { _e('<a href="' . WP_SITEURL . '/tag/' . $tag->slug . '" title="' . $tag->name . '">' . $tag->name . '</a>' ); $i++; if ($i < $c) { _e(', '); } } } ?>
    </div>
    <?php endif; ?>
  </div><!-- /.resource-meta -->


  <?php if(get_field('resource-pdf')) : ?>
  <?php $pdf = get_field('resource-pdf'); ?>
  <div class="resource-pdf">
    <a href="<?= esc_url($pdf['url']); ?>" title="<?php $pdf['title']; ?>" target="_blank" rel="noopener">Download PDF (<?= round($pdf['filesize'] / 1000000, 2); ?>MB) </a>
  </div>
  <?php endif; ?>


</div><!-- /.resource-below-hero -->
