<?php

namespace Drupal\tribute_cards;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Ecard Item Entity entities.
 *
 * @ingroup tribute_cards
 */
class EcardItemEntityListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Ecard Item Entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\tribute_cards\Entity\EcardItemEntity $entity */
    $row['id'] = $entity->toLink($entity->id());
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.ecard_item_entity.edit_form',
      ['ecard_item_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
