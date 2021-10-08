
// 34. Display Recent or Featured posts
//     EXAMPLE in Shortcode block
//    [ resources cat=13 ]
add_shortcode( 'resources', 'show_resources' );

function show_resources($attr, $content = null) {

	global $post;

	// normalize attribute keys, lowercase
	$shortcode_args = '';
	$shortcode_args = shortcode_atts(
		array(
			'cat' => '',
		),
	$attr);


	// get posts with cat = 21 (Featured)
	$featured_args = array (
		'category__and' => array(21, $shortcode_arts['cat']),
		'post_type' => 'post',
		'posts_per_page' => 2,
	);

	$r = new WP_Query($featured_args);
	$featured_count = $r->found_posts;

	wp_reset_query();


	// if $count < 2 get other posts from the category
	if ($featured_count < 2) {
		$args = array (
			'cat' => $shortcode_args['cat'],
			'post_type' => 'post',
			'posts_per_page' => 2 - $featured_count,
			'order' => 'desc'
		);
	}

	$p = new WP_Query( $args );

  $q =

	if ($q->have_posts()) {
		$content = '<div class="row">';

	  while ($q->have_posts()) {
	      $q->the_post();

				$img_id = '';
				$retina_arr = '';
				$standard_arr = '';

				if(has_post_thumbnail()) {
					$img_id = get_post_thumbnail_id();

					$retina_arr = wp_get_attachment_image_src($img_id, 'medium-retina');
					$standard_arr = wp_get_attachment_image_src($img_id, 'medium-standard');
					// [0] = url
					// [1] = width
					// [2] = height
				}


				$terms = get_the_terms($q->ID, 'resource-type');
				$firstterm = $terms[0];

				$default_svg = get_field('resource-icon-svg', $firstterm);
				$default_svg_url = $default_svg['url'];
				$default_png = get_field('resource-icon-png', $firstterm);
				$default_png_url = $default_png['url'];


				// get feat img id
				// wp_prepare_attachment_for_js($img_id);

				// if no feat img
				// get the resource type
				// get the SVG for that type
				// get the PNG for that type
				$content .= '<div class="col-md-6 col-article">';

				$content .= '<a class="resource-img-a';
				if ( has_post_thumbnail()) {
					$content .= ' photo-thumb';
				}
				else {
					$content .= ' icon-thumb';
				}
				$content .= '" href="' . get_the_permalink() . '">';
				// image
				if ( has_post_thumbnail()) {
				$content .= '<picture class="picture resource-img-wrapper">';
				$content .= '<source type="image/jpg" srcset="' . $retina_arr[0] . ' 2x" media="(min-width: 992px)">';
				$content .= '<img class="img" src="' . $standard_arr[0] . '" />';
				$content .= '</picture>';
				}
				// icon
				else {
				$content .= '<div class="default-resource-icon-div resource-img-wrapper">';
				$content .= '<img class="img" src="' . $default_svg_url . '" />';
				$content .= '</div>';
				}
				$content .= '</a>';

				$content .= '<a class="resource-article-a" href="';
				$content .= get_the_permalink();
				$content .= '" title="' . get_the_title() . '">' . get_the_title();
				$content .= ' <img class="icon" type="image/svg" src="' . $default_svg_url . '" />';
				$content .= '</a>';
				$content .= '<p class="p">' . get_the_excerpt() . '</p>';
				$content .= '</div><!-- /.col-md-6 -->';
	  }

		$content .= '</div><!-- /.row -->';
	}

	wp_reset_postdata();

  return $content;
}
