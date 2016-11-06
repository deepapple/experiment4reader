<?php
/**
 * Created by PhpStorm.
 * User: Audrius
 * Date: 27/06/2015
 * Time: 17:14
 */

class baseController {
    function returnPage($vars){
        global $messages, $blocks;
        $vars['messages'] = '';
        $vars['blocks'] = array();

        rd_db_page_statistics('all');

        if (!empty($messages)) {
          $vars['messages'] = implode('', $messages);
        }
        if (!empty($blocks)) {
          $vars['blocks'] = $blocks;
        }
        print $this->theme('html', $vars);
    }

    function theme($template, $variables) {
        return theme($template, $variables);
    }
}

function theme($template, $variables) {
  extract($variables);
  ob_start();
  include('theme/' . $template . '.php');
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}