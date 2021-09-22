<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<div class="meta-div">
  <div class="meta-time"><span class="span"><i class="fas fa-clock"></i>&nbsp;<?php the_time('F j, Y'); ?></span></div>
  <div class="meta-author"><span class="span"><i class="fa fa-user"></i>&nbsp;<?php the_author_posts_link(); ?></span></div>
  <div class="meta-categories"><span class="span"><i class="fa fa-folder"></i>&nbsp;<?php the_category(', ') ?></span></div>
</div>
