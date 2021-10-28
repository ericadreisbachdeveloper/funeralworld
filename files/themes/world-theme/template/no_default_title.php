<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<!-- If the first block is a cover            -->
<!-- then within the page body                -->
<!-- output all blocks except the first block -->


<?php	global $post; if ( has_blocks( $post->post_content ) ) : ?>


  <?php $blocks = parse_blocks( $post->post_content ); ?>


<?php endif; ?>
