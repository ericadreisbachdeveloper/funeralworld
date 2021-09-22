<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<!-- If the first block is a cover                   -->
<!-- output the cover but NOT the default page title -->


<?php	global $post; if ( has_blocks( $post->post_content ) ) : ?>

  <?php $blocks = parse_blocks( $post->post_content ); ?>

  <!-- if first block is a cover block -->
  <?php if ( $blocks[0]['blockName'] === 'core/cover' ) : ?>

  <!-- hide default title except to screenreaders -->
  <h1 class="sr-only"><?php the_title(); ?></h1>

  <!-- and display the cover as a hero image -->
  <?php echo _e(apply_filters( 'the_content', render_block( $blocks[0] ) ) );  ?>

<?php endif; endif; ?>
