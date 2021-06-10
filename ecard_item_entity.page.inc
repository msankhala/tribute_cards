<?php

/**
 * @file
 * Contains ecard_item_entity.page.inc.
 *
 * Page callback for Ecard Item Entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Ecard Item Entity templates.
 *
 * Default template: ecard_item_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_ecard_item_entity(array &$variables) {
  // Fetch EcardItemEntity Entity Object.
  $ecard_item_entity = $variables['elements']['#ecard_item_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
