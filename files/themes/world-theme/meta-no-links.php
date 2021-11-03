<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>



  <div class="resource-meta">
    <div class="meta-time">
      <h2 class="meta-h2">PUBLISHED: </h2> <?php the_time('F j, Y'); ?></span>
    </div>

    <div class="meta-author">
      <h2 class="meta-h2">AUTHOR: </h2>
      <?php $author = ''; $author = get_the_author(); print_r($author); ?>
    </div>


    <?php $tags = get_the_tags(); if ($tags) : ?>
    <div class="meta-tags">
      <h2 class="meta-h2">TAGGED:</h2> <?php $c = count($tags); if($c >= 1) { echo 'tag'; } else { 'no tag'; } ?>
    </div>
    <?php endif; ?>



  </div><!-- /.resource-meta -->
