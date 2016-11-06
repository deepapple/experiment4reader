<?php

/**
 * @file
 * User page callbacks for the token module.
 */
function page_reader_front(){
    global $user;
    $uid = 0;
    if($user->uid){
        $uid = $user->uid;
    }
    $o = '';
    $sql = "SELECT node.title, node.nid, source, COUNT(feeds_item.feed_nid) AS total_items
        FROM node 
        LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
        LEFT JOIN flag_content ON fid = 2 AND flag_content.content_id = feeds_item.entity_id AND flag_content.uid = $uid
        LEFT JOIN feeds_source ON feeds_source.feed_nid = node.nid
        WHERE node.type = 'feed' 
            AND flag_content.fcid IS NULL 
            AND feeds_item.feed_nid IS NOT NULL 
        GROUP BY node.nid 
        ORDER BY node.title";
    $results = db_query($sql);
    $o .= '<pre>';
    $o .= '<h2>New articles</h2>';
    foreach($results as $result){
        $o .= '<a href="' . url('node/' . $result->nid) . '">' . $result->title . ' </a><span style="font-weight:bold;">(' . $result->total_items . ')</span>';
        //$o .= ' <a href="' . $result->source . '"> orig site</a>';
        $o .= '</br>';
        //$o .= print_r($result, true);
    }
    
    $o .= '<h2>Total articles</h2>';
    $sql = "SELECT node.title, node.nid, source, COUNT(feeds_item.feed_nid) AS total_items
        FROM node 
        LEFT JOIN feeds_item ON node.nid = feeds_item.feed_nid
        LEFT JOIN feeds_source ON feeds_source.feed_nid = node.nid
        WHERE node.type = 'feed'
        GROUP BY node.nid 
        ORDER BY node.title";
    $results = db_query($sql);
    foreach($results as $result){
        $o .= '<a href="' . url('node/' . $result->nid) . '">' . $result->title . ' </a><span style="font-weight:bold;">(' . $result->total_items . ')</span>';
        //$o .= ' <a href="' . $result->source . '"> orig site</a>';
        $o .= '</br>';
        //$o .= print_r($result, true);
    }
    $o .= '</pre>';
    return $o;
}