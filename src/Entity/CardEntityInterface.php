<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

// Use Drupal\Core\Entity\EntityPublishedInterface;.

/**
 * Provides an interface for defining Card entity entities.
 *
 * @ingroup tribute_cards
 */
interface CardEntityInterface extends ContentEntityInterface, EntityChangedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Card entity tribute type.
   *
   * @return string
   *   Tribute type of the Card entity.
   */
  public function getTributeType();

  /**
   * Sets the Card entity tribute type.
   *
   * @param string $tributeType
   *   The Card tribute type.
   *
   * @return \Drupal\tribute_cards\Entity\CardEntityInterface
   *   The called Card entity entity.
   */
  public function setTributeType($tributeType);

  /**
   * Gets the Card entity honoree first name.
   *
   * @return string
   *   honoree first name of the Card entity.
   */
  public function getHonoreeFirstName();

  /**
   * Sets the Card entity honoree first name.
   *
   * @param string $lastName
   *   The Card honoree last name.
   *
   * @return \Drupal\tribute_cards\Entity\CardEntityInterface
   *   The called Card entity entity.
   */
  public function setHonoreeFirstName($lastName);

  /**
   * Gets the Card entity honoree last name.
   *
   * @return string
   *   honoree last name of the Card entity.
   */
  public function getHonoreeLastName();

  /**
   * Sets the Card entity honoree last name.
   *
   * @param string $lastName
   *   The Card honoree last name.
   *
   * @return \Drupal\tribute_cards\Entity\CardEntityInterface
   *   The called Card entity entity.
   */
  public function setHonoreeLastName($lastName);

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
