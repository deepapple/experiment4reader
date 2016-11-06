<?php
/**
 * Created by PhpStorm.
 * User: Audrius
 * Date: 27/06/2015
 * Time: 17:47
 */

class feedsModel {
    function getFeeds() {
        $sql = "SELECT node.title, node.nid, source, COUNT(feeds_item.feed_nid) AS total_items , COUNT(flag_content.fcid) AS old_items
            FROM node
            LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
            LEFT JOIN flag_content ON fid = 2 AND flag_content.content_id = feeds_item.entity_id AND flag_content.uid = 1
            LEFT JOIN feeds_source ON feeds_source.feed_nid = node.nid
            WHERE node.type = 'feed'
    #            AND flag_content.fcid IS NULL
                AND feeds_item.feed_nid IS NOT NULL
            GROUP BY node.nid
            ORDER BY node.title";
        $feeds = db_query($sql);
        return $feeds;
    }

    function getFeedsItemsRandom($number) {
      $sql = "SELECT source, node_feed_item.*, field_feed_item_description_value
      FROM node
      LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
      LEFT JOIN feeds_source ON feeds_source.feed_nid = node.nid
      LEFT JOIN node AS node_feed_item ON feeds_item.entity_id = node_feed_item.nid
      LEFT JOIN field_data_field_feed_item_description AS field_feed_item_description ON field_feed_item_description.entity_id = node_feed_item.nid
      ORDER BY RAND() ";
  //JOIN (SELECT CEIL(RAND() *
  //        (SELECT MAX(nid)
  //           FROM node)) AS nid)
  //      AS r2
  $max = db_query("SELECT MAX(nid) as nid FROM node ");
  $from = rand(0, $max[0]->nid);
      $sql = "SELECT source, node_feed_item.*, field_feed_item_description_value
  FROM node 
    
  LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
  LEFT JOIN feeds_source ON feeds_source.feed_nid = node.nid
  LEFT JOIN node AS node_feed_item ON feeds_item.entity_id = node_feed_item.nid
  LEFT JOIN field_data_field_feed_item_description AS field_feed_item_description ON field_feed_item_description.entity_id = node_feed_item.nid
  
 WHERE node_feed_item.nid >= :from
 ORDER BY node_feed_item.nid ASC
 ";
      rd_db_page_statistics('pseudo random db query');
      $feed_items = db_query($sql, array(':from' => $from), $number);
      rd_db_page_statistics('pseudo random db query');
      return $feed_items;
    }
    
    function getFeedsItems($feed_id) {
      $count_sql = "SELECT COUNT(feeds_item.feed_nid) AS total
      FROM node
      LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
      LEFT JOIN feeds_source ON feeds_source.feed_nid = node.nid
      LEFT JOIN node AS node_feed_item ON feeds_item.entity_id = node_feed_item.nid
      LEFT JOIN field_data_field_feed_item_description AS field_feed_item_description ON field_feed_item_description.entity_id = node_feed_item.nid
      WHERE node.nid = :nid";

      $sql = "SELECT source, node_feed_item.*, field_feed_item_description_value
      FROM node
      LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
      LEFT JOIN feeds_source ON feeds_source.feed_nid = node.nid
      LEFT JOIN node AS node_feed_item ON feeds_item.entity_id = node_feed_item.nid
      LEFT JOIN field_data_field_feed_item_description AS field_feed_item_description ON field_feed_item_description.entity_id = node_feed_item.nid
      WHERE node.nid = :nid
      ORDER BY node_feed_item.created DESC,node_feed_item.nid DESC ";
      $feed_items = db_query($sql, array(':nid' => $feed_id), 5);
      return $feed_items;
    }

  function getFeedsItem($feed_item_id) {
    $count_sql = "SELECT COUNT(feeds_item.feed_nid) AS total
      FROM node
      LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
      LEFT JOIN feeds_source ON feeds_source.feed_nid = node.nid
      LEFT JOIN node AS node_feed_item ON feeds_item.entity_id = node_feed_item.nid
      LEFT JOIN field_data_field_feed_item_description AS field_feed_item_description ON field_feed_item_description.entity_id = node_feed_item.nid
      WHERE node.nid = :nid";

    $sql = "SELECT source, node_feed_item.*, field_feed_item_description_value
      FROM node
      LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
      LEFT JOIN feeds_source ON feeds_source.feed_nid = node.nid
      LEFT JOIN node AS node_feed_item ON feeds_item.entity_id = node_feed_item.nid
      LEFT JOIN field_data_field_feed_item_description AS field_feed_item_description ON field_feed_item_description.entity_id = node_feed_item.nid
      WHERE node.nid = :nid
      ORDER BY node_feed_item.created DESC,node_feed_item.nid DESC ";
    $feed_items = db_query($sql, array(':nid' => $feed_id));
    return $feed_items;
  }
}