<?php
$top_o = '';
$new_o = '';
$old_o = '';

foreach ($feeds as $result) {
  $class = '';
  if ($active_feed_nid == $result->nid) {
    $class = ' class="active" ';
  }
  if ($result->total_items > $result->old_items) {
    $number = $result->total_items . '/<span class="new">' . ($result->total_items - $result->old_items) . '</span>'; //New
  } else {
    $number = $result->total_items; //Total
  }
  if (isset($_GET['list'])) {
    $feed_o = '<a href="' . url('feed/' . $result->nid) . '?list" ' . $class . '>' . $result->title . ' </a><span class="number" title="total ' . $result->total_items . '">(' . $number . ')</span>';
  } else {
    $feed_o = '<a href="' . url('feed/' . $result->nid) . '" ' . $class . '>' . $result->title . ' </a><span class="number" title="total ' . $result->total_items . '">(' . $number . ')</span>';
  }
  //$o .= ' <a href="' . $result->source . '"> orig site</a>';
  $feed_o .= '<br/>';
  if ($result->total_items > $result->old_items) {
    $new_o .= $feed_o;
  } else {
    $old_o .= $feed_o;
  }
  if ($active_feed_nid == $result->nid) {
    $top_o = $feed_o . '<br>';
  }
//    $o .= $feed_o;
  //$o .= print_r($result, true);
}
if ($new_o) {
  $new_o = '<div class="old-items"><h2>New items</h2>' . $new_o . '</div>';
}
if ($old_o) {
  $old_o = '<div class="old-items"><h2>Old items</h2>' . $old_o . '</div>';
}
print $top_o . $new_o . $old_o;