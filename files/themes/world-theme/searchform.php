<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>



<form class="search" method="get" action="<?php _e(home_url()); ?>" role="search">

	<a href="#display-search" role="button" aria-pressed="false" aria-label="Show/Hide Search Form"></a>

	<input id="nav-search" class="search-input" type="search" name="s" placeholder="<?php _e( 'Search', 'dbllc' ); ?>">
	<button class="search-submit" type="submit" aria-label="Search This Query"></button>

</form>
