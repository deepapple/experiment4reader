<?php

function _d($var) {
  global $messages;
  $backtrace = debug_backtrace();

  $backtrace_caller = false;

  if (count($backtrace) > 2)
      $backtrace_caller = $backtrace[count($backtrace)-2];
  elseif (count($backtrace) > 1)
      $backtrace_caller = $backtrace[count($backtrace)-1];

  $line = $backtrace[0]['line'];
  $file = $backtrace[0]['file'];
  $o = '<div style="border: 1px solid #FF9999;">';
  $o .= '<br>' . $file . '. At line ' . $line . '<br>';
//    if ($backtrace_caller) {
//        $o .= print_r($backtrace_caller, true);
//        $o .= '<br>';
//    }
  $o .= '<pre>';
  $o .= print_r($var, true);
  $o .= '</pre>';
  $o .= '</div>';
  $messages[] = $o;
}

function rd_db_page_statistics($name = 'default') {
    static $stats;
    global $blocks;
    if (empty($blocks['debug_statistic'])) {
        $blocks['debug_statistic'] = array();
    }


    if ($name == 'all') {
      foreach ($stats as $name => $time) {
        $blocks['debug_statistic'][] = '<div><strong>' . $name . '</strong> ' . (microtime(true) - $time) . '</div>';
      }
      return;
    }


    if (!isset($stats[$name])) {
        $stats[$name] = microtime(true);
    } else {
        $blocks['debug_statistic'][] = '<div><strong>' . $name . '</strong> ' .  (microtime(true) - $stats[$name]) . '</div>';
        unset($stats[$name]);
    }
}

//register_shutdown_function('rd_db_page_statistics');

