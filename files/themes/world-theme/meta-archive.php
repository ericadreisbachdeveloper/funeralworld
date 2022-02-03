<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<!-- Used on:
<!-- /?s=                                             -->
<!-- i.e. Native Search, Advanced Search              -->

<!-- Wordpress-generated Category, Tag, Author pages  -->
<!-- funeralworld.org/topic/covid/                    -->
<!-- funerworld.org/tagged/mortuary-science           -->
<!-- funeralworld.org/author/funeral-director/        -->

  <?php global $terms; global $firstterm; global $post_type;
        $tags = get_the_tags();
  ?>



  <div class="resource-meta">

    <!-- if a custom publish date exists -->
    <?php if (get_field('resource_publish_date')) : ?>
    <?php $publishdate = get_field('resource_publish_date'); $displaydate = DateTime::createFromFormat('m/d/Y', $publishdate); ?>
    <div class="meta-time">
      <h2 class="meta-h2">PUBLISHED: <span class="meta-txt"><?= $displaydate->format('F j, Y'); ?></span></h2>
    </div>
    <?php endif; ?>


    <?php if($post_type == 'events' || $post_type == 'any') : ?>

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
      <h2 class="meta-h2">EVENT DATE<?php if(isset($end_d)) { _e('s'); } ?>: <span class="meta-txt"><?= $display_date; ?></span></h2>
    </div>
    <?php endif; ?>




    <!-- https://docs.wpvip.com/technical-references/plugins/incorporate-co-authors-plus-template-tags-into-your-theme/ -->
    <!-- between, betweenLast, before, after, null, echo -->
    <!-- null, null, null, null, false  -->

    <?php $authors = ''; $authors = array(); if(function_exists('coauthors')) { $authors[] = get_coauthors(); }
          $author_count = count($authors[0]); ?>

    <?php if($firstterm != '' && ($firstterm->slug == 'white-paper' || $firstterm->slug == 'article') ): ?>
    <div class="meta-author">
      <h2 class="meta-h2">AUTHOR<?php if($author_count > 1) { _e('S'); } ?>: <?php if(function_exists('coauthors')) { coauthors('</span>, <span class="meta-txt">', '</span>, <span class="meta-txt">', '<span class="meta-txt">', '</span>'); } else { the_author(); } ?> </h2>
    </div>
    <?php elseif($firstterm != '' && ($firstterm->slug == 'video' || $firstterm->slug == 'website')) : ?>
    <div class="meta-author">
      <h2 class="meta-h2">POSTED BY: <?php if(function_exists('coauthors')) { coauthors('</span>, <span class="meta-txt">', '</span>, <span class="meta-txt">', '<span class="meta-txt">', '</span>'); } else { the_author(); } ?>
      </h2>
    </div>
    <?php endif; ?>


  </div><!-- /.resource-meta -->
