<?php

function rd_exec_router() {
  global $path, $path_parts;

  if (isset($_GET['q'])) {
    $path = $_GET['q'];
  } else {
    $path = 'home';
  }
  $path_parts = explode('/', $path);

  if (empty($path_parts[0])) {
    $path_parts[0] = 'home';
  }

  $controller_name = $path_parts[0] . 'Controller';
  $controller = new $controller_name;
  $controller->getPage();
}


function args($no = 'all') {
  global $path, $path_parts;
  if ($no == 'all') {
    return $path;
  } elseif (isset($path_parts[$no])) {
    return $path_parts[$no];
  }
  return false;
}

function url($url) {
  return '/front/index.php?q=' . $url;
}