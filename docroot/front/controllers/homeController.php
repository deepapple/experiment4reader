<?php
/**
 * Created by PhpStorm.
 * User: Audrius
 * Date: 27/06/2015
 * Time: 17:14
 */

class homeController extends baseController{
    function getPage() {
        global $blocks;
        $feeds = new feedsModel();
        $variables = array(
          'feeds' => $feeds->getFeeds(),
          'active_feed_nid' => 0,
        );
        $blocks['sidebar'] = $this->theme('blocks/feeds', $variables);
//        _d($variables);
//        if (!empty(args(1))) {
//          $variables['active'] = args(1);
//        }
//        _d($feeds->getFeeds());

        $this->returnPage(array('content' => 'AAA'));
    }
}