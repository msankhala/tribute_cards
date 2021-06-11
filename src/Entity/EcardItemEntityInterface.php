<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Ecard Item entities.
 *
 * @ingroup tribute_cards
 */
interface EcardItemEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Ecard Item name.
   *
   * @return string
   *   Name of the Ecard Item.
   */
  public function getName();

  /**
   * Sets the Ecard Item name.
   *
   * @param string $name
   *   The Ecard Item name.
   *
   * @return \Drupal\tribute_cards\Entity\EcardItemEntityInterface
   *   The called Ecard Item entity.
   */
  public function setName($name);

  /**
   * Gets the Ecard Item creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Ecard Item.
   */
  public function getCreatedTime();

  /**
   * Sets the Ecard Item creation timestamp.
   *
   * @param int $timestamp
   *   The Ecard Item creation timestamp.
   *
   * @return \Drupal\tribute_cards\Entity\EcardItemEntityInterface
   *   The called Ecard Item entity.
   */
  public function setCreatedTime($timestamp);

}
