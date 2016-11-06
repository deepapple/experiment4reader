<?php
/**
 * Created by PhpStorm.
 * User: Audrius
 * Date: 27/06/2015
 * Time: 22:35
 */

class randController extends baseController{
  function getPage() {
    $this->getRandomItems();
  }
  

  function getRandomItems($number = 20) {
    global $blocks;
    $feedsModel = new feedsModel();

    $variables = array(
      'feeds' => $feedsModel->getFeeds(),
      'active_feed_nid' => 0,
    );
    $blocks['sidebar'] = $this->theme('blocks/feeds', $variables);

    $variables['active_feed_nid'] = args(1);
    $variables['feed_items'] = $feedsModel->getFeedsItemsRandom($number);


    $feeds_items = $this->theme('content/feeds_items', $variables);

    $this->returnPage(array('content' => $feeds_items));
  }
}
