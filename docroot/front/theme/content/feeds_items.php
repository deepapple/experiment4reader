<?php
foreach($feed_items as $feed_item) {
  //print $feed_item->name . '<br>';
  //_d($feed_item);
  print theme('content/feeds_item', (array)$feed_item);
}