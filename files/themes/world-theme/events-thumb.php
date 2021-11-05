<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<!-- used in events grid display on Events and Past Events -->


<a class="events-grid-a<?php if(has_post_thumbnail()) : ?> -photo<?php else : ?> -icon<?php endif; ?>" href="<?= esc_url(get_the_permalink()); ?>" title="<?= get_the_title(); ?>">

  <?php if(has_post_thumbnail()) : ?>

  <?php $img_id = get_post_thumbnail_id();
    $retina_arr = wp_get_attachment_image_src($img_id, 'large');
  $standard_arr = wp_get_attachment_image_src($img_id, 'medium'); ?>

  <picture class="picture">
    <source type="image/jpg" srcset="<?= esc_url($retina_arr[0]); ?> 2x" media="(min-width: 992px)">
    <img width="560" height="300" class="img" src="<?= esc_url($standard_arr[0]); ?>" />
  </picture>

  <?php else : ?>
  <div class="icon-wrapper-div">
    <div class="calendar-icon"> </div>
  </div>
  <?php endif; ?>

</a>
