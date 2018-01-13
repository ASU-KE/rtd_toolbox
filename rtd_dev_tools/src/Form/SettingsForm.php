<?php

namespace Drupal\rtd_dev_tools\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SettingsForm.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'rtd_dev_tools.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rtd_dev_tools_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('rtd_dev_tools.settings');

    $form['example'] = [
      '#title' => $this->t('example'),
      '#type' => 'fieldset',
      '#tree' => true,
    ];
    $form['example']['sample_setting'] = [
      '#title' => $this->t('This is a sample setting.'),
      '#type' => 'checkbox',
      '#default_value' => $config->get('example.sample_setting'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $this->config('rtd_dev_tools.settings')
      ->set('example.sample_setting', $form_state->getValue(['example', 'sample_setting']))
      ->save();
  }

}