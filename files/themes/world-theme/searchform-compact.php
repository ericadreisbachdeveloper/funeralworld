<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<!-- Advanced Search - Compact        -->
<!-- appears at top of search results -->

<div class="container-fluid green-bg">



	<div id="advanced-search-trigger"><a href="#"></a></div>



	<div class="container" id="advanced-search-container">


		<form class="search-form search-compact" method="get" role="search" action="<?php _e(home_url()); ?>">

			<div class="row advanced-search-row">


				<?php global $s; global $audience_select; global $author_select; global $topic_select; global $type_select; ?>


				<!-- HIDDEN - post_type = post -->
				<label class="hidden" for="post_type" tabindex="-1" style="display: none; max-height: 0; position: absolute; left: -99999px;">post_type</label>
				<input name="post_type" id="post_type" type="text" tabindex="-1" style="display: none; max-height: 0; position: absolute; left: -99999px;" value="post" />


				<!-- START Query -->
				<div class="col-xs-12">
					<?php if (isset($_GET['s'])) { $s = $_GET['s']; } ?>
					<label class="hidden" for "search-input" tabindex="-1">
					<input id="search-input" class="search-input input" value="<?= $s; ?>" type="search" name="s" placeholder="<?php _e( 'What are you looking for?', 'dbllc' ); ?>">
				</div>
				<!-- END Query -->


				<!-- START Audience -->
				<div class="col-lg-3 col-sm-6 col-xs-12">

					<?php if (isset($_GET['audience'])) { $audience_select = $_GET['audience']; } ?>
					<select name="audience" class="select">
						<option value="">Audience </option>
						<?php $audiences = get_terms('audience'); foreach($audiences as $audience) : ?>
						<option value="<?= $audience->slug; ?>"<?php if($audience_select == $audience->slug) { _e( ' selected'); }?>><?= $audience->name; ?> </option>
						<?php endforeach; ?>
					</select>

				</div>
				<!-- END Audience -->


				<!-- START Authors -->
				<div class="col-lg-3 col-sm-6 col-xs-12">

					<?php $authors = get_users(); ?>
					<?php if (isset($_GET['author'])) { $author_select = $_GET['author']; } ?>
					<select name="author" class="select">
						<option value="">Author </option>
						<?php foreach($authors as $author) : ?>
						<option value="<?= $author->ID; ?>"<?php if($author_select == $author->ID) { _e(' selected'); }?>><?= $author->display_name; ?> </option>
						<?php endforeach; ?>
					</select>

				</div>
				<!-- END Authors -->


				<!-- START Topics -->
				<div class="col-lg-2 col-sm-6 col-xs-12">

					<?php if (isset($_GET['topic'])) { $topic_select = $_GET['topic']; } ?>
					<select name="topic" class="select">
						<option value="">Topic </option>
						<?php $topics = get_terms('topic'); foreach($topics as $topic) : ?>
						<option value="<?= $topic->slug; ?>"<?php if($topic_select == $topic->slug) { _e(' selected'); } ?>><?= $topic->name; ?> </option>
						<?php endforeach; ?>
					</select>

				</div>
				<!-- END Topics -->


				<!-- START Resource Types -->
				<div class="col-lg-2 col-sm-6 col-xs-12">

					<?php if (isset($_GET['resource-type'])) { $type_select = $_GET['resource-type']; } ?>
					<select name="resource-type" class="select">
					  <option value="">Type </option>
					  <?php $types = get_terms('resource-type'); foreach($types as $type) : ?>
					  <option value="<?= $type->slug; ?>"<?php if($type_select == $type->slug) { _e(' selected'); }?>><?= $type->name; ?> </option>
					  <?php endforeach; ?>
					</select>

				</div>
				<!-- END Topics -->


				<!-- START Button -->
				<div class="col-lg-2 col-xs-12">
					<button id="search-submit" class="search-submit" type="submit" aria-label="Search This Query">Search</button>
				</div>
				<!-- END Button -->


			</div><!-- /.row -->


		</form>


	</div><!-- /.container #advanced-search-container -->



</div>




<script>
// always add post_type=post to search query ... invisible field ???
</script>
