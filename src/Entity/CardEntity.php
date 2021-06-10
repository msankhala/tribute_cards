<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Card entity entity.
 *
 * @ingroup tribute_cards
 *
 * @ContentEntityType(
 *   id = "card_entity",
 *   label = @Translation("Card entity"),
 *   bundle_label = @Translation("Card entity type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\tribute_cards\CardEntityListBuilder",
 *     "views_data" = "Drupal\tribute_cards\Entity\CardEntityViewsData",
 *     "translation" = "Drupal\tribute_cards\CardEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\tribute_cards\Form\CardEntityForm",
 *       "add" = "Drupal\tribute_cards\Form\CardEntityForm",
 *       "edit" = "Drupal\tribute_cards\Form\CardEntityForm",
 *       "delete" = "Drupal\tribute_cards\Form\CardEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\tribute_cards\CardEntityHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\tribute_cards\CardEntityAccessControlHandler",
 *   },
 *   base_table = "card_entity",
 *   data_table = "card_entity_field_data",
 *   translatable = TRUE,
 *   permission_granularity = "bundle",
 *   admin_permission = "administer card entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/card_entity/{card_entity}",
 *     "add-page" = "/admin/structure/card_entity/add",
 *     "add-form" = "/admin/structure/card_entity/add/{card_entity_type}",
 *     "edit-form" = "/admin/structure/card_entity/{card_entity}/edit",
 *     "delete-form" = "/admin/structure/card_entity/{card_entity}/delete",
 *     "collection" = "/admin/structure/card_entity",
 *   },
 *   bundle_entity_type = "card_entity_type",
 *   field_ui_base_route = "entity.card_entity_type.edit_form"
 * )
 */
class CardEntity extends ContentEntityBase implements CardEntityInterface {

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

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Card entity entity.'))
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

    $fields['status']->setDescription(t('A boolean indicating whether the Card entity is published.'))
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
