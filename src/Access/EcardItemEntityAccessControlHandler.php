<?php

namespace Drupal\tribute_cards\Access;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Ecard Item entity.
 *
 * @see \Drupal\tribute_cards\Entity\EcardItemEntity.
 */
class EcardItemEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\tribute_cards\Entity\EcardItemEntityInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished ecard item entities');
        }

        return AccessResult::allowedIfHasPermission($account, 'view published ecard item entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit ecard item entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete ecard item entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add ecard item entities');
  }

}
