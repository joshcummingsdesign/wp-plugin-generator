(function ($) {
  'use strict';

  /**
   * The main form validation function
   */
  var formValidation = function () {

    var $form      = $('#generator-form'),
        $inputs    = $form.find('.base-input'),
        $name      = $form.find('#generator-name'),
        $slug      = $form.find('#generator-slug'),
        $option    = $form.find('#generator-option'),
        $namespace = $form.find('#generator-namespace'),
        $version   = $form.find('#generator-version'),
        $url       = $form.find('#generator-url'),
        errors;

    /**
     * Initialize tooltipster
     */
    $('.tooltip').tooltipster({
      trigger: 'custom',
      onlyOne: false
    });

    /**
     * Clear errors on input focus
     */
    $inputs.focus(function () {
      $(this).tooltipster('hide').removeClass('error');
    });


    /**
     * Validate the input fields
     */
    function validate() {

      // Name
      if (!$name.val()) {
        errors++;
        $name.tooltipster('show').addClass('error');
      }

      // Slug
      var slugRegex = /^[a-z\-]+$/;
      if (!slugRegex.test($slug.val())) {
        errors++;
        $slug.tooltipster('show').addClass('error');
      }

      // Option
      var optionRegex = /^[a-z_]+$/;
      if (!optionRegex.test($option.val())) {
        errors++;
        $option.tooltipster('show').addClass('error');
      }

      // Namespace
      var namespaceRegex = /^[A-Za-z_\\]+$/;
      if (!namespaceRegex.test($namespace.val())) {
        errors++;
        $namespace.tooltipster('show').addClass('error');
      }

      // Version
      var versionRegex = /^[A-Za-z\d\.\-]+$/;
      if (!versionRegex.test($version.val())) {
        errors++;
        $version.tooltipster('show').addClass('error');
      }

      // URL
      var urlRegex = /^http(s?):\/\/([\dA-Za-z:\/\.\-_]+)$/,
          isUrl    = urlRegex.test($url.val()),
          urlLast  = $url.val().slice(-1);
      if (!isUrl || urlLast !== '/') {
        errors++;
        $url.tooltipster('show').addClass('error');
      }
    }

    /**
     * Run validation on form submit
     */
    $form.submit(function (e) {
      e.preventDefault();
      errors = 0;
      validate();
      if (errors === 0) $form[0].submit();
    });
  };

  /**
   * Fire JS on DOM Ready!
   */
  $(document).ready(function () {
    formValidation();
  });

})(jQuery);
