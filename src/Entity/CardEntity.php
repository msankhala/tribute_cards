<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
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
 *     "list_builder" = "Drupal\tribute_cards\ListBuilder\CardEntityListBuilder",
 *     "views_data" = "Drupal\tribute_cards\Entity\CardEntityViewsData",
 *     "translation" = "Drupal\tribute_cards\Translation\CardEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\tribute_cards\Form\CardEntityForm",
 *       "add" = "Drupal\tribute_cards\Form\CardEntityForm",
 *       "edit" = "Drupal\tribute_cards\Form\CardEntityForm",
 *       "delete" = "Drupal\tribute_cards\Form\CardEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\tribute_cards\Routing\CardEntityHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\tribute_cards\AccessController\CardEntityAccessControlHandler",
 *   },
 *   base_table = "card_entity",
 *   data_table = "card_entity_field_data",
 *   translatable = TRUE,
 *   permission_granularity = "bundle",
 *   admin_permission = "administer card entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "tribute_type" = "tribute_type",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
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

  /**
   * {@inheritdoc}
   */
  public function getTributeType() {
    return $this->get('tribute_type')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTributeType($tributeType) {
    $this->set('tribute_type', $tributeType);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getHonoreeFirstName() {
    return $this->get('honoree_first_name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setHonoreeFirstName($firstName) {
    $this->set('honoree_first_name', $firstName);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getHonoreeLastName() {
    return $this->get('honoree_last_name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setHonoreeLastName($lastName) {
    $this->set('honoree_last_name', $lastName);
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

    $fields['tribute_type'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Tribute Type'))
      ->setDescription(t('The tribute type of gift.'))
      ->setSettings([
        'allowed_values' => [
          'in_memory_of' => 'In Memory of',
          'in_honor_of' => 'In Honor of',
        ],
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);

    $fields['honoree_first_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Honoree First Name'))
      ->setDescription(t('The first name of Honoree.'))
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
      ->setRequired(FALSE);

    $fields['honoree_last_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Honoree Last Name'))
      ->setDescription(t('The last name of Honoree.'))
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
      ->setRequired(FALSE);

    // $fields['status']->setDescription(t('A boolean indicating whether the Card entity is published.'))
    //   ->setDisplayOptions('form', [
    //     'type' => 'boolean_checkbox',
    //     'weight' => -3,
    //   ]);
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
