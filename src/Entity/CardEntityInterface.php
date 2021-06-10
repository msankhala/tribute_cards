<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Card entity entities.
 *
 * @ingroup tribute_cards
 */
interface CardEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Card entity name.
   *
   * @return string
   *   Name of the Card entity.
   */
  public function getName();

  /**
   * Sets the Card entity name.
   *
   * @param string $name
   *   The Card entity name.
   *
   * @return \Drupal\tribute_cards\Entity\CardEntityInterface
   *   The called Card entity entity.
   */
  public function setName($name);

  /**
   * Gets the Card entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Card entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Card entity creation timestamp.
   *
   * @param int $timestamp
   *   The Card entity creation timestamp.
   *
   * @return \Drupal\tribute_cards\Entity\CardEntityInterface
   *   The called Card entity entity.
   */
  public function setCreatedTime($timestamp);

}
