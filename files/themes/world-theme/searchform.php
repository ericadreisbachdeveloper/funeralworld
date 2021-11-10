<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<div class="container gutenberg-container">
	<div class="corset">

		<form class="search" method="get" action="<?php _e(home_url()); ?>" role="search">

			<input id="search-input" class="search-input input" type="search" name="s" placeholder="<?php _e( 'What are you looking for?', 'dbllc' ); ?>">

			<h2 class="form-h2">Filter your search </h2>

			<div class="row">


				<!-- START Audience -->
				<div class="col-md-3">

					<select name="audience" class="select">
						<option value="">For Everyone </option>
						<?php $audiences = get_terms('audience'); foreach($audiences as $audience) : ?>
						<option value="<?= $audience->slug; ?>"><?= $audience->name; ?> </option>
						<?php endforeach; ?>
					</select>

				</div>
				<!-- END Audience -->


				<!-- START Authors -->
				<div class="col-md-3">

					<?php $authors = get_users(); ?>
					<select name="author" class="select">
						<option value="">Any Author </option>
						<?php foreach($authors as $author) : ?>
						<option value="<?= $author->user_nicename; ?>"><?= $author->display_name; ?> </option>
						<?php endforeach; ?>
					</select>

				</div>
				<!-- END Authors -->


				<!-- START Topics -->
				<div class="col-md-3">

					<select name="topic" class="select">
						<option value="">Any Topic </option>
						<?php $topics = get_terms('topic'); foreach($topics as $topic) : ?>
						<option value="<?= $topic->slug; ?>"><?= $topic->name; ?> </option>
						<?php endforeach; ?>
					</select>

				</div>
				<!-- END Topics -->


				<!-- START Resource Types -->
				<div class="col-md-3">

					<select name="type" class="select">
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
					<button class="search-submit" type="submit" aria-label="Search This Query">Search</button>
				</div>
			</div>


		</form>

	</div><!-- /.corset -->
</div><!-- /.container -->
