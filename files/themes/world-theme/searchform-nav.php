<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>

<!-- full site search in nav          -->
<!-- results include Pages and Events -->

<form class="search nav-search" method="get" action="<?php _e(home_url() . '/search/'); ?>" role="search">

	<a href="#display-search" role="button" aria-pressed="false" aria-label="Show/Hide Search Form"></a>

	<input id="nav-search" class="search-input" type="search" name="s" placeholder="<?php _e( 'SEARCH', 'dbllc' ); ?>">

	<button class="search-submit" type="submit" aria-label="Search This Query"></button>

</form>
