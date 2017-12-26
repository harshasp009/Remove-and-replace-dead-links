(function($) {
  Drupal.behaviors.remove_dead_links = {
    attach: function (context, settings) {
      // Using once() to apply the myCustomBehaviour effect when you want to do just run one function.

      $('div.form-item-replace-url').hide();
      $(context).find('form.rr-dead-links .remove_option_type').on('change', function() {
        var val ;
        val = $('form.rr-dead-links .remove_option_type:checked').val();
        if(val == 'replace_link') {
          $('div.form-item-replace-url').show();
        } else {
          $('div.form-item-replace-url').hide();
        }
      })
    }
  };
})(jQuery);