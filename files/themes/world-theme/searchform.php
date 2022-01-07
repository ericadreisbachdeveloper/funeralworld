<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>

<!-- Advanced Search -->

<div class="corset">

	<form class="search-form" method="get" role="search" action="<?php _e(home_url()); ?>">

		<input id="search-input" class="search-input input" type="search" name="s" placeholder="<?php _e( 'What are you looking for?', 'dbllc' ); ?>">

		<h2 class="form-h2">Filter your search </h2>

		<div class="row advanced-search-row">


			<!-- HIDDEN - post_type = post -->
			<label class="hidden" for="post_type" tabindex="-1" style="display: none; max-height: 0; position: absolute; left: -99999px;">post_type</label>
			<input name="post_type" id="post_type" type="text" tabindex="-1" style="display: none; max-height: 0; position: absolute; left: -99999px;" value="post" />


			<!-- START Audience -->
			<div class="col-md-6 col-lg-3">

				<select name="audience" class="select">
					<option value="">For Everyone </option>
					<?php $audiences = get_terms('audience'); foreach($audiences as $audience) : ?>
					<option value="<?= $audience->slug; ?>"><?= $audience->name; ?> </option>
					<?php endforeach; ?>
				</select>

			</div>
			<!-- END Audience -->


			<!-- START Authors -->
			<div class="col-md-6 col-lg-3">

				<?php $authors = get_users(); ?>


				<select name="author" class="select">
					<option value="">Any Author </option>
					<?php foreach($authors as $author) : ?>
					<option value="<?= $author->ID; ?>"><?= $author->display_name; ?> </option>
					<?php endforeach; ?>
				</select>

			</div>
			<!-- END Authors -->


			<!-- START Topics -->
			<div class="col-md-6 col-lg-3">

				<select name="topic" class="select">
					<option value="">Any Topic </option>
					<?php $topics = get_terms('topic'); foreach($topics as $topic) : ?>
					<option value="<?= $topic->slug; ?>"><?= $topic->name; ?> </option>
					<?php endforeach; ?>
				</select>

			</div>
			<!-- END Topics -->


			<!-- START Resource Types -->
			<div class="col-md-6 col-lg-3">

				<select name="resource-type" class="select">
				  <option value="">Any Resource Type </option>
				  <?php $types = get_terms('resource-type'); foreach($types as $type) : ?>
				  <option value="<?= $type->slug; ?>"><?= $type->name; ?> </option>
				  <?php endforeach; ?>
				</select>

			</div>
			<!-- END Topics -->


		</div><!-- /.row -->


		<div class="row">
			<div class="col-xs-12">
				<button id="search-submit" class="search-submit" type="submit" aria-label="Search This Query">Search</button>
			</div>
		</div>


	</form>

</div><!-- /.corset -->



<script>
// always add post_type=post to search query ... invisible field ???
</script>
