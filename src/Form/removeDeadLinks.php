<?php

namespace Drupal\remove_dead_links\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;


class removeDeadLinks extends FormBase {

  /**
   * Machine name of the form.
   */
  const FORM_ID = 'rr_dead_links';

  /**
   * {@inheritdoc}
   */
  public function getFormId () {
    return self::FORM_ID;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm (array $form, FormStateInterface $form_state) {
    $form['link_url'] = array (
     '#type' => 'textfield',
     '#title' => $this->t ('Dead Link URL'),
     '#description' => $this->t ('Enter the Broken Link URL'),
     '#required' => TRUE,
    );
    $form['option_type'] = array (
     '#type' => 'radios',
     '#title' => $this->t ('Select the Below Option'),
     '#description' => $this->t ('Select the option type that you want to process'),
     '#required' => TRUE,
     '#options' => array (
      'remove_links' => 'Remove Broken Link',
      'replace_link' => 'Replace the broken Link URL'
     ),
     '#attributes' => array ('class' => array ('remove_option_type')),
    );

    $form['replace_url'] = array (
     '#type' => 'textfield',
     '#title' => $this->t ('Replace URL'),
     '#description' => $this->t ('Enter the URL you want to Replace'),
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array (
     '#type' => 'submit',
     '#value' => $this->t ('Proceed'),
     '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm (array &$form, FormStateInterface $form_state) {
    $link_url = $form_state->getValue ('link_url');
    $option_type = $form_state->getValue ('option_type');
    $replace_url = $form_state->getValue ('replace_url');
    switch ($option_type) {
      case 'remove_links':
        $this->_remove_links($link_url);
        break;
      case 'replace_link' :
        $this->_replace_link($link_url, $replace_url);
        break;
    }
  }

  public function _remove_links($link_url) {
    $nids = _get_node_body($link_url);
    $msg = _get_body_value($nids,$link_url);
    if($msg) {
      $data_message = "successfully remove the dead links";
    } else {
      $data_message = "Error occured";
    }
    drupal_set_message($data_message);

  }

  public function _replace_link($link_url, $replace_url) {
    $nids = _get_node_body($link_url);
    $replaced_content = _replace_links($nids,$link_url,$replace_url);
    if($replaced_content) {
      $data_message = "successfully Replaced the links";
    } else {
      $data_message = "error occured.";
    }
    drupal_set_message($data_message);
    }
}