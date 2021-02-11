<?php

  /* ---
    Auto-loading Flexible Content Field (ACF)
  --- */

  $sections = $args['section'];
  if ($sections) {
    foreach ($sections as $index => $section) {
      $path = 'wp-content/themes/sup-up/includes/flexible/' . $section['acf_fc_layout'] . '.php';
      if (file_exists($path)) {
        include $path;
      } else {
        error_log(sprintf(
          'Undefined section `%s` in Flexible Content Field: %s',
          $section['acf_fc_layout'],
          PHP_EOL . __FILE__
        ));
      }
    }
  }