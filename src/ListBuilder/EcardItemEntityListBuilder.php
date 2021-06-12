<?php

namespace Drupal\tribute_cards\ListBuilder;

use Drupal\Core\Link;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a class to build a listing of Ecard Item entities.
 *
 * @ingroup tribute_cards
 */
class EcardItemEntityListBuilder extends EntityListBuilder {

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * Constructs a new PracticalListBuilder object.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type definition.
   * @param \Drupal\Core\Entity\EntityStorageInterface $storage
   *   The entity storage class.
   * @param \Drupal\Core\Datetime\DateFormatter $date_formatter
   *   The date formatter service.
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer.
   */
  public function __construct(EntityTypeInterface $entityType, EntityStorageInterface $storage, DateFormatter $dateFormatter, RendererInterface $renderer) {
    parent::__construct($entityType, $storage);

    $this->dateFormatter = $dateFormatter;
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entityType) {
    return new static(
      $entityType,
      $container->get('entity_type.manager')->getStorage($entityType->id()),
      $container->get('date.formatter'),
      $container->get('renderer')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header = [];
    $header['id'] = $this->t('Ecard Item ID');
    $header['name'] = $this->t('Name');
    // $header['image'] = $this->t('Image');
    $header['bundle_id'] = $this->t('Bundle');
    // $header['owner'] = $this->t('Owner');
    $header['created'] = $this->t('Created');
    $header['changed'] = $this->t('Changed');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row = [];
    /** @var \Drupal\tribute_cards\Entity\EcardItemEntity $entity */
    $row['id'] = $entity->toLink($entity->id());
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.ecard_item.canonical',
      ['ecard_item' => $entity->id()]
    );
    // $row['image'] = $entity->getRenderedImage();
    $row['bundle_id'] = $entity->bundle();
    // $row['owner'] = $entity->getOwner()->toLink($entity->getOwner()->label());
    $row['created'] = $this->dateFormatter->format($entity->getCreatedTime(), 'short');
    $row['changed'] = $this->dateFormatter->format($entity->getChangedTime(), 'short');
    return $row + parent::buildRow($entity);
  }

}
