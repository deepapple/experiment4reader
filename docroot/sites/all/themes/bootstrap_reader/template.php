<?php

/**
 * @file
 * template.php
 */

function bootstrap_reader_preprocess_page(&$vars) {
  if (!empty($vars['node']->type) && $vars['node']->type == 'feed_item') {
    $feed_item_info = get_info_of_feed_item($vars['node']->nid);
    $vars['title'] = l($vars['node']->title, $feed_item_info->url);
  }
}