<?php
/**
 * Get template part from path
 *
 * @param string $fileName - fileName
 * @param array $varsArray - view variables array
 * @param boolean $render - rendering
 */
function get_part($fileName, $varsArray = [], $render = true) {
  $filePath = INCLUDES . $fileName . '.php';

  if (file_exists($filePath)) {
    ob_start();
    extract($varsArray);

    include($filePath);
    $viewHtml = ob_get_clean();

    if ($render == false) return $viewHtml;
    echo $viewHtml;
  }
}