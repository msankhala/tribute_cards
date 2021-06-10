<?php

/**
 * @file
 * Contains card_entity.page.inc.
 *
 * Page callback for Card entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Card entity templates.
 *
 * Default template: card_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_card_entity(array &$variables) {
  // Fetch CardEntity Entity Object.
  $card_entity = $variables['elements']['#card_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
