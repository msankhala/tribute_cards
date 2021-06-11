<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\Core\Site\Settings;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityPublishedTrait;

/**
 * Defines the Ecard Item Entity entity.
 *
 * @ingroup tribute_cards
 *
 * @ContentEntityType(
 *   id = "ecard_item_entity",
 *   label = @Translation("Ecard Item"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\tribute_cards\EcardItemEntityListBuilder",
 *     "views_data" = "Drupal\tribute_cards\Entity\EcardItemEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\tribute_cards\Form\EcardItemEntityForm",
 *       "add" = "Drupal\tribute_cards\Form\EcardItemEntityForm",
 *       "edit" = "Drupal\tribute_cards\Form\EcardItemEntityForm",
 *       "delete" = "Drupal\tribute_cards\Form\EcardItemEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\tribute_cards\EcardItemEntityHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\tribute_cards\EcardItemEntityAccessControlHandler",
 *   },
 *   base_table = "ecard_item_entity",
 *   translatable = FALSE,
 *   admin_permission = "administer ecard item entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/ecard_item/{ecard_item_entity}",
 *     "add-form" = "/admin/structure/ecard_item/add",
 *     "edit-form" = "/admin/structure/ecard_item/{ecard_item_entity}/edit",
 *     "delete-form" = "/admin/structure/ecard_item/{ecard_item_entity}/delete",
 *     "collection" = "/admin/structure/ecard_item",
 *   },
 *   field_ui_base_route = "ecard_item_entity.settings"
 * )
 */
class EcardItemEntity extends ContentEntityBase implements EcardItemEntityInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    $file_public_path = Settings::get('file_public_path');
    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Ecard Item Entity entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('eCard Image'))
      ->setDescription(t('eCard Image field.'))
      ->setSettings([
        'file_directory' => $file_public_path,
        'alt_field_required' => FALSE,
        'file_extensions' => 'png jpg jpeg',
        'max_filesize' => '20MB',
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'image',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'label' => 'above',
        'type' => 'image_image',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status']->setDescription(t('A boolean indicating whether the Ecard Item Entity is published.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
