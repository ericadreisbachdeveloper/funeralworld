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


  <?php $resource_types = ''; $resource_types = get_the_terms($post->ID, 'resource-type');  ?>

  <?php $resource_type_slugs = []; foreach ($resource_types as $type) {
    $resource_type_slugs[] = $type->slug;
  } ?>




  <?php if ($resource_type_slugs != '' && in_array('white-paper', $resource_type_slugs) && get_field('resource-pdf')) : ?>
  <div class="resource-pdf">
    <?php $pdf = get_field('resource-pdf'); ?>
    <h2 class="meta-h2"><a target="_blank" rel="noopener" href="<?= $pdf['url']; ?>" title="<?= $pdf['title']; ?> | <?= bloginfo( 'name' ); ?>">DOWNLOAD AS PDF</a></h2>
  </div>
  <?php endif; ?>

</div><!-- /.resource-below-hero -->
