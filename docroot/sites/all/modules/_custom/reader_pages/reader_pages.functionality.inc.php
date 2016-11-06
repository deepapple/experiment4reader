<?php

/**
 * @file
 * User page callbacks for the token module.
 */
function page_mark_all_as_read(){
    global $user;
    $uid = 0;
    $nid = arg(1);
    if(!$user->uid){
        drupal_goto();
        return '';
    }
    $sql = "SELECT feeds_item.entity_id
        FROM node 
        LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
        LEFT JOIN flag_content ON fid = 2 AND flag_content.content_id = feeds_item.entity_id AND flag_content.uid = $uid
        WHERE node.type = 'feed' 
            AND flag_content.fcid IS NULL 
            AND feeds_item.feed_nid IS NOT NULL ";
    if($nid != 0){
        $sql .= '
            AND node.nid = :nid';
        $results = db_query($sql, array(':nid' => $nid));
    }else{
        $results = db_query($sql);
    }
    foreach($results as $result){
        $exists = db_select('flag_content')
            ->fields('flag_content', array('fid'))
            ->condition('fid', 2)
            ->condition('content_id', $result->entity_id)
            ->condition('uid', $user->uid)
            ->execute()
            ->fetchField();
        if(!$exists){
            db_insert('flag_content')->fields(array(
                'fid' => '2',
                'content_type' => 'node',
                'content_id' => $result->entity_id,
                'uid' => $user->uid,
                'sid' => 0,
                'timestamp' => REQUEST_TIME,
            ))->execute();
        }
//        $o .= '<a href="' . url('node/' . $result->nid) . '">' . $result->title . ' </a><span style="font-weight:bold;">(' . $result->total_items . ')</span>';
//        //$o .= ' <a href="' . $result->source . '"> orig site</a>';
//        $o .= '</br>';
//        //$o .= print_r($result, true);
    }
    drupal_set_message('All items marked as read.');
    if($nid){
        drupal_goto('node/' . $nid);
    }else{
        drupal_goto('<front>');    
    }
    return '.';
}

function page_mark_node_as_read($node){
  $result = flag('flag', 'read', arg(2));
  if ($result) {
    $return = array('status' => 'ok', 'nid' => arg(2));
  } else {
    $return = array('status' => 'error', 'nid' => arg(2));
  }
  drupal_json_output($return);
  drupal_exit();
}

function page_mark_node_unread($node){
  $result = flag('unflag', 'read', arg(2));
  if ($result) {
    $return = array('status' => 'ok', 'nid' => arg(2));
  } else {
    $return = array('status' => 'error', 'nid' => arg(2));
  }
  drupal_json_output($return);
  drupal_exit();
}