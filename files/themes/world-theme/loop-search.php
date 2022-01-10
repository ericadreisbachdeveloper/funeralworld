<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<!-- Template file for displaying individual search results -->
<!-- i.e. <article>                                         -->


<?php global $wp_query;

      if ( $wp_query->have_posts() ) : $i = 0; while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>


<?php
		global $terms; global $firstterm; global $search_array;

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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php if($i == 0 && !array_filter($search_array)) : ?> data-no-filters<?php endif; ?>>
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


          <?php $display_date = $start = $end = '';

                $tmw_dt = new DateTime('tomorrow', new DateTimeZone('UTC + 5'));
                $tmw    = $tmw_dt->format('Ymd');
                $tmw    = intval($tmw);

                if(get_field('event-start-date')) {
                  // get start
                  $start = get_field('event-start-date');
                  $start = strtotime($start);
                  $start = intval($start);
                }

                // multi-day event
                if(get_field('event-end-date')) {
                  $end = get_field('event-end-date');
                  $end = strtotime($end);
                  $end = intval($end);
                }

                if(isset($end) && $end > $tmw) { _e('<p class="event-passed"><em>This event has passed.</em> </p>'); }
                elseif (isset($start) && $start > $tmw) { _e('<p class="event-passed"><em>This event has passed.</em> </p>'); }
          ?>


          <!-- <p class="event-passed"><em>This event has passed. </em></p> -->
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
<?php $i++; endwhile; ?>


<?php endif; ?>
