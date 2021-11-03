<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>



<form class="search" method="get" action="<?php _e(home_url()); ?>" role="search">

	<input id="search-input" class="search-input" type="search" name="s" placeholder="<?php _e( 'What are you looking for?', 'dbllc' ); ?>">

	<button class="search-submit" type="submit" aria-label="Search This Query"></button>

</form>
