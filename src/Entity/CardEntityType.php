<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Card entity type entity.
 *
 * @ConfigEntityType(
 *   id = "card_entity_type",
 *   label = @Translation("Card entity type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\tribute_cards\ListBuilder\CardEntityTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\tribute_cards\Form\CardEntityTypeForm",
 *       "edit" = "Drupal\tribute_cards\Form\CardEntityTypeForm",
 *       "delete" = "Drupal\tribute_cards\Form\CardEntityTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\tribute_cards\Routing\CardEntityTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "card_entity_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "card_entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/tribute-cards/card_entity_type/{card_entity_type}",
 *     "add-form" = "/admin/tribute-cards/card_entity_type/add",
 *     "edit-form" = "/admin/tribute-cards/card_entity_type/{card_entity_type}/edit",
 *     "delete-form" = "/admin/tribute-cards/card_entity_type/{card_entity_type}/delete",
 *     "collection" = "/admin/tribute-cards/card_entity_type"
 *   }
 * )
 */
class CardEntityType extends ConfigEntityBundleBase implements CardEntityTypeInterface {

  /**
   * The Card entity type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Card entity type label.
   *
   * @var string
   */
  protected $label;

}
