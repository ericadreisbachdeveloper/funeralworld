<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<!-- If the first block is a cover            -->
<!-- then within the page body                -->
<!-- output all blocks except the first block -->


<?php global $blocks; if ($blocks && $blocks[0]['blockName'] === 'core/cover' ) : ?>

<!-- set variable $isFirst to skip rendering the hero -->
<?php
  $isFirst = true;
  foreach($blocks as $block) {
    if($isFirst) { $isFirst = false; continue; }
    echo _e(apply_filters( 'the_content', render_block( $block ) ) );
  }
?>


<?php else : ?>

<?php
  if($blocks) {
    foreach($blocks as $block) {

      echo _e(apply_filters( 'the_content', render_block( $block ) ) );
    }
  }
?>


<?php endif; ?>
