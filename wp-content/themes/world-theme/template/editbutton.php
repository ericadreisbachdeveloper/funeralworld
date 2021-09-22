<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>



<?php if(is_user_logged_in()) : ?>
  <div class="clear"> </div>
  <?php wp_reset_query(); edit_post_link(); ?>
  <div class="clear"> </div>
<?php endif; ?>
