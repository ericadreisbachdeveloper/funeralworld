<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>

<!-- full site search in nav          -->
<!-- results include Pages and Events -->

<form class="search nav-search" method="get" action="<?php _e(home_url('/')); ?>" role="search">

	<a href="#display-search" role="button" aria-pressed="false" aria-label="Show/Hide Search Form"></a>

	<input id="nav-search" class="search-input" type="search" name="s" placeholder="<?php _e( 'SEARCH', 'dbllc' ); ?>">


	<label class="hidden" for="post_type" tabindex="-1" style="display: none; max-height: 0; position: absolute; left: -99999px;">post_type</label>
	<input name="post_type" id="post_type" type="text" tabindex="-1" style="display: none; max-height: 0; position: absolute; left: -99999px;" value="pages%2Cevents" />


	<button class="search-submit" type="submit" aria-label="Search This Query"></button>

</form>
