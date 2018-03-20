<?php

/**
 * Alter the rate widget before display.
 *
 * @param object $widget Widget object
 * @param array $context
 *   array(
 *     'content_type' => $content_type,
 *     'content_id' => $content_id,
 *   );
 */
function ess_rate_widget_alter(&$widget, $context) {
//   print "<pre style='border: 1px solid red; padding: 1em;'>";
//   var_dump($widget, $context);
//   print "</pre>";
}

function ess_preprocess_node(&$variables) {
  // Hide the rating title fully if there isn't a rating widget to display.
  if (empty($variables['content']['rate_workshop_interest']['#markup'])) {
    unset($variables['content']['rate_workshop_interest']);
  }
}

function ess_preprocess_html(&$variables) {
  drupal_add_feed(
    url('feed',
    array('absolute' => TRUE)), 'Proposals and Requests'
  );
  drupal_add_feed(
    url('comments/feed',
    array('absolute' => TRUE)), 'Comments'
  );
}

function ess_theme() {
  $items = array();
    
  $items['user_login'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'ess'),
    'template' => 'user-login',
    'preprocess functions' => array(
       'ess_preprocess_user_login'
    ),
  );

  return $items;
}

function ess_preprocess_user_login(&$variables) {
  $variables['intro_text'] = 'To propose workshops, request skills, or post comments, please log in. If you do not have an account you can create one or log in via one of the services below (Google, Facebook, etc).';
}