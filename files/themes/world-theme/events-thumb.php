<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<a class="events-a" href="<?= esc_url(get_the_permalink()); ?>" title="<?= get_the_title(); ?>">

  <?php if(has_post_thumbnail()) : ?>

  <?php $img_id = get_post_thumbnail_id();
    $retina_arr = wp_get_attachment_image_src($img_id, 'large');
  $standard_arr = wp_get_attachment_image_src($img_id, 'medium'); ?>

  <picture class="picture resource-img-a">
    <source type="image/jpg" srcset="<?= esc_url($retina_arr[0]); ?> 2x" media="(min-width: 992px)">
    <img width="560" height="300" class="img" src="<?= esc_url($standard_arr[0]); ?>" />
  </picture>

<?php else : ?>
  <div class="default-resource-icon-div default-events-icon-div resource-img-wrapper">
    <div class="calendar-icon"> </div>
  </div>
<?php endif; ?>

</a>
