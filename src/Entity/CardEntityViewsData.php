<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Card entity entities.
 */
class CardEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
