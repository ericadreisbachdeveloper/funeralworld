<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<!-- Used on:
              /author/xx/    navigate to this archive via single
              /tag/xx/       navigate to this archive via single
              /category/learning/     ... not available ...
              /topic/xx/     navigate to this archive via single breadcrumbs
              /resource-type/xx/      ... not available ...
              /audience/xx/           ... not available ...
              /?s/

-->

  <?php global $terms; global $firstterm; global $post_type;
        $tags = get_the_tags();
  ?>

  <!-- used on Wordpress-generated Category, Tag, Author pages -->
  <!-- funeralworld.org/topic/covid/ -->
  <!-- funeralworld.org/topic/covid/ -->
  <div class="resource-meta">


    <!-- if a custom publish date exists -->
    <?php if (get_field('resource-publish-date')) : ?>
    <?php $publishdate = get_field('resource-publish-date'); $displaydate = DateTime::createFromFormat('m/d/Y', $publishdate); ?>
    <div class="meta-time">
      <h2 class="meta-h2">PUBLISHED:</h2> <span class="wide-br"></span><?= $displaydate->format('F j, Y'); ?>
    </div>

    <!-- otherwise, use default Wordpress publish date -->
    <?php else : ?>

    <?php $displaydate = get_the_time("F j, Y"); ?>
    <div class="meta-time">
      <h2 class="meta-h2">DATE ADDED:</h2> <span class="wide-br"></span><?= $displaydate; ?>
    </div>
    <?php endif; ?>



    <?php if($post_type == 'events') : ?>

    <?php $display_date = $start = $end = '';

          if(get_field('event-start-date')) {
            // get start
            $start = get_field('event-start-date');
            $start = strtotime($start);
            $start_d = date('j', $start);
            $start_m = date('M', $start);
            $start_y = date('Y', $start);
          }

          // multi-day event
          if(get_field('event-end-date')) {



            $end = get_field('event-end-date');
            $end = strtotime($end);
            $end_d = date('j', $end);
            $end_m = date('M', $end);
            $end_y = date('Y', $end);

            // different years
            if ($start_y !== $end_y) {
              $display_date = $start_m . ' ' . $start_d . ', ' . $start_y . ' &ndash; ' . $end_m . ' ' . $end_d . ', ' . $end_y;
            }

            // different months
            elseif ($start_m !== $end_m) {
              $display_date = $start_m . ' ' . $start_d . ' &ndash; ' . $end_m . ' ' . $end_d . ', ' . $start_y;
            }

            // same month + year
            else {
              $display_date = $start_m . ' ' . $start_d . ' &ndash; '. $end_d . ', ' . $start_y;
            }

          }

          // one-day event
          else {
            $display_date = $start_m . ' ' . $start_d . ', ' . $start_y;
          }
    ?>
    <div class="meta-event">
      <h2 class="meta-h2">EVENT: <?= $display_date; ?></h2>
    </div>
    <?php endif; ?>


    <?php if($firstterm != '' && $firstterm->slug == 'white-paper') : ?>
    <div class="meta-author">
      <h2 class="meta-h2">AUTHOR: </h2><span class="wide-br"></span>
      <?php $author = ''; $author = get_the_author(); _e($author);  ?>
    </div>
    <?php elseif($firstterm != '' && $firstterm->slug == 'video') : ?>
    <div class="meta-author">
      <h2 class="meta-h2">POSTED BY: </h2>
      <?php $author = ''; $author = get_the_author(); _e($author); ?>
    </div>
    <?php endif; ?>


    <?php if( $firstterm != '') : ?>
    <div class="meta-type">
      <h2 class="meta-h2">RESOURCE TYPE: </h2> <?= $firstterm->name; ?>
    </div>
    <?php endif; ?>


    <!--
    <?php // if ($tags) : ?>
    <div class="meta-tags">
      <h2 class="meta-h2">TAGGED: </h2> <?php // if($tags) { _e('<br />'); }?><?php // $i = 0; $c = count($tags); if($c >= 1) { foreach ($tags as $tag) { _e($tag->name); $i++; if ($i < $c) { _e(', '); } } } ?>
    </div>
    <?php // endif; ?>
    -->



  </div><!-- /.resource-meta -->
