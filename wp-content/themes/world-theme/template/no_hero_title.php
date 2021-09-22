<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<!-- If the first block is a cover            -->
<!-- then within the page body                -->
<!-- output all blocks except the first block -->


<?php	global $post; if ( has_blocks( $post->post_content ) ) : ?>


  <?php $blocks = parse_blocks( $post->post_content ); ?>


  <?php if ( $blocks[0]['blockName'] === 'core/cover' ) : ?>


  <!-- if no cover / hero block, then output the title -->
  <?php else : ?>


  <div class="gutenberg-section -no-hero">
    <div class="gutenberg-container container">
      <h1><?php the_title(); ?></h1>
    </div>
  </div>


  <?php endif; ?>


<?php else : ?>
<!-- if no blocks at all, still output a title -->


  <div class="gutenberg-section -no-hero">
    <div class="gutenberg-container container">
      <h1><?php the_title(); ?></h1>
    </div>
  </div>


<?php endif; ?>
