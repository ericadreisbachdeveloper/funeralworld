<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<!-- title is a block within the page editor, not echoed by default -->

<?php	global $post; if ( has_blocks( $post->post_content ) ) : ?>

  <?php $blocks = parse_blocks( $post->post_content ); ?>

<?php endif; ?>
