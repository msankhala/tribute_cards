<?php

namespace Drupal\tribute_cards\Entity;

use Drupal\file\Entity\File;
use Drupal\Core\Site\Settings;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityStorageInterface;

/**
 * Defines the Ecard Item entity.
 *
 * @ingroup tribute_cards
 *
 * @ContentEntityType(
 *   id = "ecard_item",
 *   label = @Translation("Ecard Item"),
 *   bundle_label = @Translation("Ecard Item type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\tribute_cards\ListBuilder\EcardItemEntityListBuilder",
 *     "views_data" = "Drupal\tribute_cards\Entity\EcardItemEntityViewsData",
 *     "translation" = "Drupal\tribute_cards\Translation\EcardItemEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\tribute_cards\Form\EcardItemEntityForm",
 *       "add" = "Drupal\tribute_cards\Form\EcardItemEntityForm",
 *       "edit" = "Drupal\tribute_cards\Form\EcardItemEntityForm",
 *       "delete" = "Drupal\tribute_cards\Form\EcardItemEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\tribute_cards\Routing\EcardItemEntityHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\tribute_cards\Access\EcardItemEntityAccessControlHandler",
 *   },
 *   base_table = "ecard_item",
 *   data_table = "ecard_item_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer ecard item entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/tribute-cards/ecard_item/{ecard_item}",
 *     "add-page" = "/admin/tribute-cards/ecard_item/add",
 *     "add-form" = "/admin/tribute-cards/ecard_item/add/{ecard_item_type}",
 *     "edit-form" = "/admin/tribute-cards/ecard_item/{ecard_item}/edit",
 *     "delete-form" = "/admin/tribute-cards/ecard_item/{ecard_item}/delete",
 *     "collection" = "/admin/tribute-cards/ecard_item",
 *   },
 *   bundle_entity_type = "ecard_item_type",
 *   field_ui_base_route = "entity.ecard_item_type.edit_form"
 * )
 */
class EcardItemEntity extends ContentEntityBase implements EcardItemEntityInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

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
  public function getImageTargetId() {
    return $this->image__target_id;

  }

  /**
   * Returns the rendered image or empty array.
   */
  public function getRenderedImage($imageStyle = 'thumbnail') {
    $imageFile = File::load($this->getImageTargetId());

    // Eearly return if image file not found.
    if (!$imageFile) {
      return [];
    }

    $imageUri = $imageFile->getFileUri();
    $variables = [
      'style_name' => $imageStyle,
      'uri' => $imageUri,
    ];

    // The image.factory service will check if our image is valid.
    $image = \Drupal::service('image.factory')->get($imageUri);
    if ($image->isValid()) {
      $variables['width'] = $image->getWidth();
      $variables['height'] = $image->getHeight();
    }
    else {
      $variables['width'] = $variables['height'] = NULL;
    }

    $image_render_array = [
      '#theme' => 'image_style',
      '#width' => $variables['width'],
      '#height' => $variables['height'],
      '#style_name' => $variables['style_name'],
      '#uri' => $variables['uri'],
    ];

    // Add the file entity to the cache dependencies.
    // This will clear our cache when this entity updates.
    $renderer = \Drupal::service('renderer');
    $renderer->addCacheableDependency($image_render_array, $imageFile);

    return $image_render_array;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entityType) {
    $fields = parent::baseFieldDefinitions($entityType);
    $filePublicPath = Settings::get('file_public_path');
    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entityType);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Ecard Item entity.'))
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
        'file_directory' => $filePublicPath,
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

    $fields['status']->setDescription(t('A boolean indicating whether the Ecard Item is published.'))
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
