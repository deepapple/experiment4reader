<?php

function rd_db_connect() {
    global $settings, $rd_db_connection;
    $rd_db_connection = mysql_connect($settings['db']['host'], $settings['db']['user'], $settings['db']['pass']);
    mysql_select_db($settings['db']['db']);
    mysql_query('SET NAMES utf8');
}

function rd_db_disconnect() {
    global $rd_db_connection;
    mysql_close($rd_db_connection);
}

rd_db_connect();
register_shutdown_function('rd_db_disconnect');

/*
 *
 */
function db_query($sql, $params = array(), $per_page = 1000) {
    global $rd_db_connection;
    foreach($params as $name => $value) {
        $sql = str_replace($name, mysql_real_escape_string($value), $sql);
    }

    $page = 0;
    if (isset($_GET['page'])) {
      $page = $_GET['page'] - 1;
    }
    $sql .= " LIMIT " . ($page * $per_page) . ', ' . (($page + 1) * $per_page);

    //_d($sql);
    $result = mysql_query($sql);
    if (empty($result)) {
      throw new Exception(mysql_error($rd_db_connection));
    }
    $rows = [];
    while ($row = mysql_fetch_object($result)) {
        $rows[] = $row;
    }

    return $rows;
}