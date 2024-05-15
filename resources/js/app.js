// import './bootstrap';

// import './vendors/js/vendor.bundle.base';
import './misc'

(function($) {
    'use strict';
    $(function() {
      $('[data-toggle="offcanvas"]').on("click", function() {
        $('.sidebar-offcanvas').toggleClass('active')
      });
    });
  })(jQuery);
