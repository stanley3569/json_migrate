<?php

namespace Drupal\json_migrate\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the json migrate entity edit forms.
 */
class JsonMigrateForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New json migrate %label has been created.', $message_arguments));
      $this->logger('json_migrate')->notice('Created new json migrate %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The json migrate %label has been updated.', $message_arguments));
      $this->logger('json_migrate')->notice('Updated new json migrate %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.json_migrate.canonical', ['json_migrate' => $entity->id()]);
  }

}
