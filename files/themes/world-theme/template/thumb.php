<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<?php

if(has_post_thumbnail()) {
  $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'small');
  $thumb_id = get_post_thumbnail_id();
  $thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', TRUE);
  $thumb_title = get_the_title($thumb_id);
}
else { $thumb = "no thumb"; }

?>
