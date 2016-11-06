<?php
function page_reader_front2_show_articles() {
  drupal_set_title('All');
  $o = '';
  $sql = "SELECT source, node_feed_item.*, field_feed_item_description_value
      FROM node 
      LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
      LEFT JOIN feeds_source ON feeds_source.feed_nid = node.nid
      LEFT JOIN node AS node_feed_item ON feeds_item.entity_id = node_feed_item.nid
      LEFT JOIN field_data_field_feed_item_description AS field_feed_item_description ON field_feed_item_description.entity_id = node_feed_item.nid
      ORDER BY node_feed_item.created DESC,node_feed_item.nid DESC LIMIT 15";
  $feed_items = db_query($sql);
  foreach ($feed_items as $feed_item) {
    $feed_item_info = get_info_of_feed_item($feed_item->nid);
//    dsm($feed_item);
//    dsm($feed_item_info);
    $classes = '';
    $o .= '<div class="' . $classes . ' well well-light" data-id="' . $feed_item->nid . '">';
    $o .= '<div class="item-header">';
    $ago = time() - $feed_item->created;
    $o .= '<div class="top-right-info" style="float:right">';
    if ($ago > 60 * 60 * 24 * 30 * 6) {
      $o .= '<div class="created">' . date('Y.m.d H:i', $feed_item->created) . '</div>';
    } else {
      $o .= '<div class="created">' . format_interval($ago) . ' ago</div>';
    }
    $o .= ' <div class="feed-item-source">From: ' . l($feed_item_info->feed_title, 'node/' . $feed_item_info->feed_nid) . ' </div> ';
    $o .= '</div>';
    //$o .= '<div class="created" style="float:right;">changed ' . date('Y.m.d H:i', $result->changed) . '</div>';
    $o .= '<h4>' . l($feed_item->title, 'node/' . $feed_item->nid) . '</h4>';
    $o .= '</div>';
    if (1 || empty($_SESSION['reader']['show_mode']) || $_SESSION['reader']['show_mode'] == 'full') {
      
      $text = $feed_item->field_feed_item_description_value;
      $text = aud_truncateHtml($text, 400);
      $o .= '<div class="content">' . check_markup($text, 'filtered_html') . '</div>';
//      $o .= '<div class="bottom-toolbar">';
//      $o .= '<a class="keep-unread" data-id="' . $feed_item->nid . '" href="#">keep unread</a>';
////            $o .= '<a class="add-to-favorites" data-id="' . $result->nid . '" href="#">add to favorites</a>';
//      $o .= '</div>';
//      $o .= '<a class="end-of-item" data-id="' . $feed_item->nid . '" href="#" >text</a>';
//      dsm(strlen($text));
      if (strlen($text) >= 400) {
        $o .= '<p><a class="btn btn-default" href="' . url('node/' . $feed_item->nid) . '">continue reading</a></p>';
      }
    }
    $o .= '</div>';
  }
  //$o .= 'Output';
  return $o;
}

