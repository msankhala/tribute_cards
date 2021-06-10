<?php

// namespace Drupal\tribute_cards;

// use Drupal\Core\StringTranslation\StringTranslationTrait;
// use Drupal\tribute_cards\Entity\CardEntity;


// /**
//  * Provides dynamic permissions for Card entity of different types.
//  *
//  * @ingroup tribute_cards
//  *
//  */
// class CardEntityPermissions{

//   use StringTranslationTrait;

//   /**
//    * Returns an array of node type permissions.
//    *
//    * @return array
//    *   The CardEntity by bundle permissions.
//    *   @see \Drupal\user\PermissionHandlerInterface::getPermissions()
//    */
//   public function generatePermissions() {
//     $perms = [];

//     foreach (CardEntity::loadMultiple() as $type) {
//       $perms += $this->buildPermissions($type);
//     }

//     return $perms;
//   }

//   /**
//    * Returns a list of node permissions for a given node type.
//    *
//    * @param \Drupal\tribute_cards\Entity\CardEntity $type
//    *   The CardEntity type.
//    *
//    * @return array
//    *   An associative array of permission names and descriptions.
//    */
//   protected function buildPermissions(CardEntity $type) {
//     $type_id = $type->id();
//     $type_params = ['%type_name' => $type->label()];

//     return [
//       "$type_id create entities" => [
//         'title' => $this->t('Create new %type_name entities', $type_params),
//       ],
//       "$type_id edit own entities" => [
//         'title' => $this->t('Edit own %type_name entities', $type_params),
//       ],
//       "$type_id edit any entities" => [
//         'title' => $this->t('Edit any %type_name entities', $type_params),
//       ],
//       "$type_id delete own entities" => [
//         'title' => $this->t('Delete own %type_name entities', $type_params),
//       ],
//       "$type_id delete any entities" => [
//         'title' => $this->t('Delete any %type_name entities', $type_params),
//       ],
//     ];
//   }

// }
