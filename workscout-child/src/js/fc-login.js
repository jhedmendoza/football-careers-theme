(function ($) {

function init() {
  $('form#fc-login-form').on('submit', function(e){
      var redirecturl = $('input[name=_wp_http_referer]').val();
      var success;
      $('form#fc-login-form .notification.reg-form-output').removeClass('error').addClass('notice').show().text(workscout_core.loadingmessage);

          $.ajax({
              type: 'POST',
              dataType: 'json',
              url: workscout_core.ajax_url,
              data: {
                  'action': 'workscoutajaxlogin',
                  'username': $('form#fc-login-form #login-email').val(),
                  'password': $('form#fc-login-form #login-password').val(),
                  'login_security': $('form#workscout_login_form #login_security').val()
                 },

              }).done( function( data ) {
                  if (data.loggedin == true){
                      $('form#fc-login-form .notification.reg-form-output').show().removeClass('error').removeClass('notice').addClass('success').text(data.message);
                      success = true;
                  } else {
                      $('form#fc-login-form .notification.reg-form-output').show().addClass('error').removeClass('notice').removeClass('success').text(data.message);
                  }
          } )
          .fail( function( reason ) {
              // Handles errors only
              console.debug( 'reason'+reason );
          } )

          .then( function( data, textStatus, response ) {
              if(success){
                  $.ajax({
                      type: 'POST',
                      dataType: 'json',
                      url: workscout_core.ajax_url,
                      data: {
                          'action': 'get_logged_header',
                      },
                      success: function(new_data){

                          $('body').removeClass('user_not_logged_in');
                          $('.header-widget').html(new_data.data.output);
                          var magnificPopup = $.magnificPopup.instance;
                          if(magnificPopup) {
                              magnificPopup.close();
                              header_menu();
                          }

                      }
                  });

              }
          })
      e.preventDefault();
  });
}



  $(document).ready(init);

  }(jQuery));
