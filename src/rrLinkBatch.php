<?php

namespace Drupal\remove_dead_links;

class rrLinkBatch {

  public static function removeDeadLinksBatch($nids,$link_url) {
    if (empty($context['removebrokenlinks'])) {
      $context['removebrokenlinks']['progress'] = 0;
      $context['removebrokenlinks']['current_id'] = 0;
      _get_body_value($nids,$link_url);
    }
  }

  public static function removeDeadLinksBatchFinishedCallback
      ($success, $results, $operations) {
    if ($success) {
      $message = t ('Successfully removed the broken link.');
    } else {
      $message = t ('Finished with an error.');
    }
    drupal_set_message ($message);
  }

  public static function replaceLinkBatch($nids,$link_url,$replace_url) {
    if (empty($context['removebrokenlinks'])) {
      $context['removebrokenlinks']['progress'] = 0;
      $context['removebrokenlinks']['current_id'] = 0;
      _replace_links($nids,$link_url,$replace_url);
    }
  }

  public static function replaceLinkBatchFinishedCallback
  ($success, $results, $operations) {
    if ($success) {
      $message = t ('Successfully replaced the broken link.');
    } else {
      $message = t ('Finished with an error.');
    }
    drupal_set_message ($message);
  }

}

