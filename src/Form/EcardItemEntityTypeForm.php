<?php

namespace Drupal\tribute_cards\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class EcardItemEntityTypeForm.
 */
class EcardItemEntityTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $ecard_item_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $ecard_item_type->label(),
      '#description' => $this->t("Label for the Ecard Item type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $ecard_item_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\tribute_cards\Entity\EcardItemEntityType::load',
      ],
      '#disabled' => !$ecard_item_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $ecard_item_type = $this->entity;
    $status = $ecard_item_type->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Ecard Item type.', [
          '%label' => $ecard_item_type->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label Ecard Item type.', [
          '%label' => $ecard_item_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($ecard_item_type->toUrl('collection'));
  }

}
