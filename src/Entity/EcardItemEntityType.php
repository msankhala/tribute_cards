<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Ecard Item type entity.
 *
 * @ConfigEntityType(
 *   id = "ecard_item_type",
 *   label = @Translation("Ecard Item type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\tribute_cards\EcardItemEntityTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\tribute_cards\Form\EcardItemEntityTypeForm",
 *       "edit" = "Drupal\tribute_cards\Form\EcardItemEntityTypeForm",
 *       "delete" = "Drupal\tribute_cards\Form\EcardItemEntityTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\tribute_cards\EcardItemEntityTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "ecard_item_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "ecard_item",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/ecard_item_type/{ecard_item_type}",
 *     "add-form" = "/admin/structure/ecard_item_type/add",
 *     "edit-form" = "/admin/structure/ecard_item_type/{ecard_item_type}/edit",
 *     "delete-form" = "/admin/structure/ecard_item_type/{ecard_item_type}/delete",
 *     "collection" = "/admin/structure/ecard_item_type"
 *   }
 * )
 */
class EcardItemEntityType extends ConfigEntityBundleBase implements EcardItemEntityTypeInterface {

  /**
   * The Ecard Item type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Ecard Item type label.
   *
   * @var string
   */
  protected $label;

}
