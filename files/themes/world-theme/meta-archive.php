<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>

  <?php global $terms; global $firstterm; global $post_type;
        $tags = get_the_tags();
  ?>


  <div class="resource-meta">



    <?php if ($firstterm != '') : ?>
    <div class="meta-time">
      <h2 class="meta-h2">PUBLISHED: </h2> <?php the_time('F j, Y'); ?>
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
      <h2 class="meta-h2">AUTHOR: </h2>
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
