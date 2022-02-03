<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>
<!-- unsed on search.php -->

<?php global $search_array; ?>

<?php if( isset($_GET['post_type']) && substr($_GET['post_type'], 0, 4) !== 'page') : ?>
<?php if(array_filter($search_array)) : ?>
<?php $audience_term = $author_term = $topic_term = $type_term = $filteredurl = '';  ?>
<div class="filter-buttons">


  <!-- 0. Search Query -->
  <?php if($search_array[0] != '') : ?>

  <?php $filteredurl = WP_SITEURL . '?s=';

    if ($search_array[1] != '') {
      $audience_term = get_term_by('slug', $search_array[1], 'audience');
      $filteredurl  .= '&audience=' . $audience_term->slug;
    }

    if($search_array[2] != '') {
      $author_term  = get_user_by('id', $search_array[2]);
      $filteredurl .= '&author=' . $author_term->ID;
    }

    if($search_array[3] != '') {
      $topic_term   = get_term_by('slug', $search_array[3], 'topic');
      $filteredurl .= '&topic=' . $topic_term->slug;
    }

    if($search_array[4] != '') {
      $type_term    = get_term_by('slug', $search_array[4], 'resource-type');
      $filteredurl .= '&resource-type=' . $type_term->slug;
    }

    $filteredurl .= '&post_type=post';

    if(isset($_GET['sort'])) {
      $filteredurl .= '&sort=' . $_GET['sort'];
    } ?>

  <a href="<?= esc_url($filteredurl); ?>" data-input="s" data-value="<?= $search_array[0]; ?>">SEARCH: <?= $search_array[0]; ?></a>
  <?php endif; ?>
  <!-- /0. Search -->


  <!-- 1. Audience -->
  <?php if($search_array[1] != '') : ?>

  <?php $audience_term  = get_term_by('slug', $search_array[1], 'audience'); ?>

  <?php $filteredurl = WP_SITEURL . '?s=';

    if ($search_array[0] != '') {
      $search_term  = $search_array[0];
      $search_term  = str_replace(' ', '+', $search_term);
      $filteredurl .= $search_term;
    }

    if($search_array[2] != '') {
      $author_term  = get_user_by('id', $search_array[2]);
      $filteredurl .= '&author=' . $author_term->ID;
    }

    if($search_array[3] != '') {
      $topic_term  = get_term_by('slug', $search_array[3], 'topic');
      $filteredurl .= '&topic=' . $topic_term->slug;
    }

    if($search_array[4] != '') {
      $type_term = get_term_by('slug', $search_array[4], 'resource-type');
      $filteredurl .= '&resource-type=' . $type_term->slug;
    }

    $filteredurl .= '&post_type=post';

    if(isset($_GET['sort'])) {
      $filteredurl .= '&sort=' . $_GET['sort'];
    } ?>

  <a href="<?= esc_url($filteredurl); ?>" data-input="audience" data-value="<?= $search_array[1]; ?>">AUDIENCE: <?= $audience_term->name; ?></a>
  <?php endif; ?>
  <!-- /1. Audience -->


  <!-- 2. Author -->
  <?php if($search_array[2] != '') : ?>

  <?php $author_term  = get_user_by('id', $search_array[2]); ?>

  <?php $filteredurl = WP_SITEURL . '?s=';

    if ($search_array[0] != '') {
      $search_term  = $search_array[0];
      $search_term  = str_replace(' ', '+', $search_term);
      $filteredurl .= $search_term;
    }

    if ($search_array[1] != '') {
      $audience_term = get_term_by('slug', $search_array[1], 'audience');
      $filteredurl  .= '&audience=' . $audience_term->slug;
    }

    if($search_array[3] != '') {
      $topic_term  = get_term_by('slug', $search_array[3], 'topic');
      $filteredurl .= '&topic=' . $topic_term->slug;
    }

    if($search_array[4] != '') {
      $type_term = get_term_by('slug', $search_array[4], 'resource-type');
      $filteredurl .= '&resource-type=' . $type_term->slug;
    }

    $filteredurl .= '&post_type=post';

    if(isset($_GET['sort'])) {
      $filteredurl .= '&sort=' . $_GET['sort'];
    } ?>

  <a href="<?= esc_url($filteredurl); ?>" data-input="author" data-value="<?= $search_array[2]; ?>">AUTHOR: <?= $author_term->display_name; ?></a>
  <?php endif; ?>
  <!-- /2. Author -->


  <!-- 3. Topic -->
  <?php if($search_array[3] != '') : ?>

  <?php $topic_term  = get_term_by('slug', $search_array[3], 'topic'); ?>

  <?php $filteredurl = WP_SITEURL . '?s=';

    if ($search_array[0] != '') {
      $search_term  = $search_array[0];
      $search_term  = str_replace(' ', '+', $search_term);
      $filteredurl .= $search_term;
    }

    if ($search_array[1] != '') {
      $audience_term = get_term_by('slug', $search_array[1], 'audience');
      $filteredurl  .= '&audience=' . $audience_term->slug;
    }

    if($search_array[2] != '') {
      $author_term  = get_user_by('id', $search_array[2]);
      $filteredurl .= '&author=' . $author_term->ID;
    }

    if($search_array[4] != '') {
      $type_term = get_term_by('slug', $search_array[4], 'resource-type');
      $filteredurl .= '&resource-type=' . $type_term->slug;
    }

    $filteredurl .= '&post_type=post';

    if(isset($_GET['sort'])) {
      $filteredurl .= '&sort=' . $_GET['sort'];
    } ?>

  <a href="<?= esc_url($filteredurl); ?>" data-input="topic" data-value="<?= $search_array[3]; ?>">TOPIC: <?= $topic_term->name; ?></a>
  <?php endif; ?>
  <!-- /3. Topic -->


  <!-- 4. Type -->
  <?php if($search_array[4] != '') : ?>

  <?php $type_term = get_term_by('slug', $search_array[4], 'resource-type'); ?>

  <?php $filteredurl = WP_SITEURL . '?s=';

    if ($search_array[0] != '') {
      $search_term  = $search_array[0];
      $search_term  = str_replace(' ', '+', $search_term);
      $filteredurl .= $search_term;
    }

    if ($search_array[1] != '') {
      $audience_term = get_term_by('slug', $search_array[1], 'audience');
      $filteredurl  .= '&audience=' . $audience_term->slug;
    }

    if($search_array[2] != '') {
      $author_term  = get_user_by('id', $search_array[2]);
      $filteredurl .= '&author=' . $author_term->ID;
    }

    if($search_array[3] != '') {
      $topic_term  = get_term_by('slug', $search_array[3], 'topic');
      $filteredurl .= '&topic=' . $topic_term->slug;
    }

    $filteredurl .= '&post_type=post';

    if(isset($_GET['sort'])) {
      $filteredurl .= '&sort=' . $_GET['sort'];
    } ?>

  <a href="<?= esc_url($filteredurl); ?>" data-input="topic" data-value="<?= $search_array[4]; ?>">RESOURCE TYPE: <?= $type_term->name; ?></a>
  <?php endif; ?>
  <!-- /4. Type -->


</div><!-- /.filter-buttons -->
<?php endif; endif; ?>
