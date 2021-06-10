<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Ecard Item Entity entities.
 *
 * @ingroup tribute_cards
 */
interface EcardItemEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Ecard Item Entity name.
   *
   * @return string
   *   Name of the Ecard Item Entity.
   */
  public function getName();

  /**
   * Sets the Ecard Item Entity name.
   *
   * @param string $name
   *   The Ecard Item Entity name.
   *
   * @return \Drupal\tribute_cards\Entity\EcardItemEntityInterface
   *   The called Ecard Item Entity entity.
   */
  public function setName($name);

  /**
   * Gets the Ecard Item Entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Ecard Item Entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Ecard Item Entity creation timestamp.
   *
   * @param int $timestamp
   *   The Ecard Item Entity creation timestamp.
   *
   * @return \Drupal\tribute_cards\Entity\EcardItemEntityInterface
   *   The called Ecard Item Entity entity.
   */
  public function setCreatedTime($timestamp);

}
