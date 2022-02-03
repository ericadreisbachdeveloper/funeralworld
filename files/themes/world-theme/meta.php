<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<!-- used on Resource single -->

<?php
  $terms = $firstterm = '';
  $terms = get_the_terms($post->ID, 'resource-type');
	if ($terms != '') { $firstterm = $terms[0]; }
?>


<div class="resource-below-hero">

  <div class="resource-meta">

    <!-- if a custom publish date exists -->
    <?php if (get_field('resource_publish_date')) : ?>
    <?php $publishdate = get_field('resource_publish_date'); $displaydate = DateTime::createFromFormat('m/d/Y', $publishdate); ?>
    <div class="meta-time">
      <h2 class="meta-h2">PUBLISHED: <span class="meta-txt"><?= $displaydate->format('F j, Y'); ?></span></h2>
    </div>

    <!-- otherwise, use default Wordpress publish date -->
    <?php else : ?>

    <?php $displaydate = get_the_time("F j, Y"); ?>
    <div class="meta-time">
      <h2 class="meta-h2">DATE ADDED: <span class="meta-txt"><?= $displaydate; ?></span></h2>
    </div>
    <?php endif; ?>


    <!-- https://docs.wpvip.com/technical-references/plugins/incorporate-co-authors-plus-template-tags-into-your-theme/ -->
    <!-- between, betweenLast, before, after, null, echo -->
    <!-- null, null, null, null, false  -->

    <?php $authors = ''; $authors = array(); if(function_exists('coauthors')) { $authors[] = get_coauthors(); }
          $author_count = count($authors[0]); ?>

    <?php if($firstterm != '' && $firstterm->slug == 'video') : ?>
    <div class="meta-author">
      <h2 class="meta-h2">POSTED BY:
      <?php if(function_exists('coauthors_posts_links')) { coauthors_posts_links(', ' , ', ' , '', '', 'null', 'false'); }
            else { the_author_posts_link(); } ?>
      </h2>
    </div>
    <?php else : ?>
    <div class="meta-author">
      <h2 class="meta-h2">AUTHOR<?php if($author_count > 1) { _e('S'); } ?>:
      <?php if(function_exists('coauthors_posts_links')) { coauthors_posts_links(', ' , ', ' , '', '', 'null', 'false'); }
            else { the_author_posts_link(); } ?>
      </h2>
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
