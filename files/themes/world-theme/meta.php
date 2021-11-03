<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<div class="resource-below-hero">

  <div class="resource-meta">
    <div class="meta-time">
      <h2 class="meta-h2">PUBLISHED: </h2> <?php the_time('F j, Y'); ?></span>
    </div>

    <div class="meta-author">
      <h2 class="meta-h2">AUTHOR: </h2>
      <?php the_author_posts_link(); ?>
    </div>

    <?php $tags = get_the_tags(); if ($tags) : ?>
    <div class="meta-tags">
      <h2 class="meta-h2">TAGGED:</h2> <?php $c = count($tags); if($c > 1)  { the_tags(', '); } else { the_tags(''); } ?>
    </div>
    <?php endif; ?>
  </div><!-- /.resource-meta -->


</div><!-- /.resource-below-hero -->
