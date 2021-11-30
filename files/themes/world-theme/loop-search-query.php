<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<?php
  global $wp_query; global $posts_per_page; global $args;

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



  // TO DO ... .... ...... if $sort then remove resources w/ no sort from number of results

  // Sort!
  $order = array();

  if(isset($_GET['sort'])) {

        $sort = $_GET['sort'];

     if($sort == 'newest') { $sort = 'DESC'; $args['order'] = $sort; }

 elseif($sort == 'oldest') { $sort = 'ASC';  $args['order'] = $sort; }

 elseif($sort == 'newest-published') {

             $args['orderby'] = 'meta_value';
             $args['order'] = 'DESC';

             $args['meta_query'] = array(
               array(
                 'key' => 'resource_publish_date',
                 'compare' => 'EXISTS',
               )
             );
           }

 elseif($sort == 'oldest-published') {

             $args['orderby'] = 'meta_value';
             $args['order'] = 'ASC';

             $args['meta_query'] = array(
               array(
                 'key' => 'resource_publish_date',
                 'compare' => 'EXISTS'
               )
             );
           }
  }



  $wp_query = new WP_Query( $args );



?>
