<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<?php

  global $main, $menu_items, $current_post, $current_post_id, $menu_items_ids, $current_page_array_key, $current_page_menu_object, $current_page_parent_menu_id, $data_footer;


  $main = wp_get_nav_menu_object('main-menu');

  $menu_items = wp_get_nav_menu_items( $main->term_id, array( 'order' => 'DESC' ) );

  $current_post = get_post();

  $current_post_id = $current_post->ID;

  foreach ($menu_items as $menu_item) {
    $menu_items_ids[] = $menu_item->object_id;
    $menu_parent_ids[] = $menu_item->menu_item_parent;
    $menu_items_urls[] = $menu_item->url;
    $menu_items_titles[] = $menu_item->title;
  }


  $current_page_array_key = array_search($current_post_id, $menu_items_ids);

  $current_page_menu_object    = $menu_items[$current_page_array_key];
  $current_page_parent_menu_id = $current_page_menu_object->menu_item_parent;

  if($current_page_parent_menu_id !== '0' ) { $data_footer = "has-pagination"; } elseif(is_single()) { $data_footer = "no-sticky"; } else { $data_footer = "no-pagination"; }

?>
