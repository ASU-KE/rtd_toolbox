<?php

namespace Drupal\rtd_toolbox\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class Settings.
 */
class Settings extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'rtd_toolbox.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rtd_toolbox_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('rtd_toolbox.settings');
    $form['file_type_icons'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('File type icons'),
      '#description' => $this->t('To add icons to links that open documents, such as PDFs, Word, etc...'),
      '#default_value' => $config->get('file_type_icons'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('rtd_toolbox.settings')
      ->set('file_type_icons', $form_state->getValue('file_type_icons'))
      ->save();
  }

}
