<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>



<?php
  global $wp_query; global $posts_per_page;
  $count = ''; $variables = $tax_query_array = $tax_query = array();

  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;


  if(isset($_GET['s'])) { $query = $_GET['s']; }


  if(isset($_GET['audience']))        { $audience = $_GET['audience']; if($audience != '') { $variables[] = array('audience', $audience); } }

  if(isset($_GET['topic']))           { $topic = $_GET['topic']; if ($topic != '') { $variables[] = array('topic', $topic); } }

  if(isset($_GET['resource-type']))   { $type = $_GET['resource-type']; if ($type != '') { $variables[] = array('resource-type', $type); } }


  // construct tax_query from
  // the three custom taxonomy terms
  $count = count($variables);

  if ($count != 0) {
    $i = 0; foreach($variables as $variable) {
      if($i == 0) { $tax_query_array[] = array('relation' => 'AND'); }

      $tax_query_array[] = array('taxonomy' => $variable[0], 'field' => 'slug', 'terms' => $variable[1]);

      $i++;
    }

    $tax_query = array('tax_query' => $tax_query_array);
  }








  // author doesn't run in tax_query
  // thus author has a separate conditional
  if(isset($_GET['author']) && $_GET['author'] !== '')  {

    $author = $_GET['author'];

    $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',

      'posts_per_page' => $posts_per_page,
      'paged' => $paged,

      'author__in' => $author,

      's' => $query,

      // DESC leads with "So You ..."
      // ASC leads with "Featured Learning"
      //'order' => 'ASC',


      'tax_query' => $tax_query
    );
  }


  // no author specified
  else {
    $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',

      'posts_per_page' => $posts_per_page,
      'paged' => $paged,

      's' => $query,

      'tax_query' => $tax_query
    );

  }


  // Sort!
  $order = array();

  if(isset($_GET['sort'])) {
        $sort = $_GET['sort'];
     if($sort == 'newest') { $sort = 'DESC'; $args['order'] = $sort; }
 elseif($sort == 'oldest') { $sort = 'ASC'; $args['order'] = $sort; }

  }


  //print_r($args);







  // use global variable $wp_query
  // not, like, $loop or $news or whatever
  $wp_query = new WP_Query( $args ); ?>


<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>


<?php
		global $terms; global $firstterm; global

		$post_type;
		$post_type = get_post_type($post->ID);

		$post_types_with_no_meta = array('page', 'asp-products');

		$terms = $firstterm = '';
		$terms = get_the_terms($post->ID, 'resource-type');

		if ($terms !== false) {

			$firstterm = $terms[0];

			$icon_alt = $firstterm->name;

			$default_svg = get_field('resource-icon-svg', $firstterm);
			$default_svg_url = $default_svg['url'];
			$default_png = get_field('resource-icon-png', $firstterm);
			$default_png_url = $default_png['url'];
		}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a class="archive-a<?php if(dbllc_excerpt() == '' && $post_type !== 'events') { _e(' no-excerpt'); } ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

		<div class="container">


			<?php if (!in_array($post_type, $post_types_with_no_meta)) : ?>
			<div class="archive-img">

				<?php if(has_post_thumbnail()) : ?>
					<?php $img_id = get_post_thumbnail_id();

					$standard_arr = wp_get_attachment_image_src($img_id, 'medium');
					         $img = wp_prepare_attachment_for_js($img_id);
					     $img_alt = $img['alt'];
					?>

					<picture class="-photo picture">
						<source type="image/webp" srcset="<?= esc_url($standard_arr[0]); ?>.webp" />
						<img width="280" height="150" class="img" src="<?= esc_url($standard_arr[0]); ?>" alt="<?= $img_alt; ?>" />
					</picture>

				<?php elseif ($terms !== false) : ?>
					<div class="default-archive-img">
						<picture class="-icon picture">
							<source type="image/svg+xml" srcset="<?= esc_url($default_svg_url); ?>">
							<img width="100" height="100" src="<?= esc_url($default_png_url); ?> " alt="<?= $icon_alt; ?>" />
						</picture>
					</div>

				<?php elseif($post_type == 'events') : ?>
					<div class="default-archive-img icon-wrapper-div">
						<div class="calendar-icon"> </div>
					</div>

				<?php else : ?>
					<div class="no-img"> </div>
				<?php endif; ?>

			</div><!-- /.archive-img -->
			<?php endif; ?>



			<!-- START: archive text -->
			<div class="archive-txt">

				<div class="archive-title-excerpt<?php if (in_array($post_type, $post_types_with_no_meta)) : ?> -no-meta<?php endif; ?>">

					<?php if($terms !== false) : ?>
					<h2 class="archive-h2" id="archive-h2"><?php the_title(); ?></h2>&nbsp;&nbsp;<div class="picture-div">
						<picture class="icon archive-icon">
							<source type="image/svg+xml" srcset="<?= esc_url($default_svg_url); ?>">
							<img class="icon-img" src="<?= esc_url($default_png_url); ?>"  alt="<?= $icon_alt; ?>" width="14" height="14" />
						</picture>
					</div>

					<?php else : ?>
					<h2 class="archive-h2" id="archive-h2"><?php the_title(); ?></h2>
					<?php endif; ?>

					<p class="archive-p"><?php _e(dbllc_excerpt()); ?></p>

				</div><!-- /.archive-title-excerpt -->


				<div class="archive-meta">
				<?php if (!in_array($post_type, $post_types_with_no_meta)) : ?>
				<?php _e(get_template_part('meta-archive')); ?>
				<?php endif; ?>
			</div><!-- /.archive-meta -->


			</div><!-- /.archive-txt -->
			<!-- END: archive text -->

		</div><!-- /.container -->

	</a>
</article>
<?php endwhile; ?>


<?php endif; ?>
