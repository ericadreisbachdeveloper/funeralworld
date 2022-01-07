<?php if ( ! defined( 'ABSPATH' ) ) {  exit; } ?>


<?php $display_date = $start = $end = ''; global $display_date; 

    if(get_field('event-start-date')) {
      // get start
      $start = get_field('event-start-date');
      $start = strtotime($start);
      $start_d = date('j', $start);
      $start_m = date('F', $start);
      $start_y = date('Y', $start);
    }

    // multi-day event
    if(get_field('event-end-date')) {

      $end = get_field('event-end-date');
      $end = strtotime($end);
      $end_d = date('j', $end);
      $end_m = date('F', $end);
      $end_y = date('Y', $end);

      // different years
      if ($start_y !== $end_y) {
        $display_date = $start_m . ' ' . $start_d . ', ' . $start_y . ' &ndash; ' . $end_m . ' ' . $end_d . ', ' . $end_y;
      }

      // different months
      elseif ($start_m !== $end_m) {
        $display_date = $start_m . ' ' . $start_d . ' &ndash; ' . $end_m . ' ' . $end_d . ', ' . $start_y;
      }

      // same month + year
      else {
        $display_date = $start_m . ' ' . $start_d . ' &ndash; '. $end_d . ', ' . $start_y;
      }

    }

    // one-day event
    else {
      $display_date = $start_m . ' ' . $start_d . ', ' . $start_y;
    }
?>
