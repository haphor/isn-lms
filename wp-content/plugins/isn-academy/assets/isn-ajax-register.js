jQuery( document ).ready( function( $ ) {

    if ( $('#registerform').length ) {
        /*
         *  Register form
         */


        // Add front-end validation to registration form
        $('#registerform').on( 'submit', function( e ) {
            return validate_registration_form();
        });

    } else if ( $('#lostpasswordform').length ) {
        /*
         *  Forgot password form styling (this can also be done with WordPress filters but I'm too lazy to do this right now)
         */
         $('#login h2').css({
            textAlign: 'center',
            fontSize: '34px',
            margin: '25px 0 20px'
         })
    }

});

// E-mail address validation
function is_valid_email( email ) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test( email );
};


// Validate registration form
function validate_registration_form( scroll_focus ) {
    // Initialize
    var $ = jQuery;
    if ( typeof scroll_focus == 'undefined' ) {
        scroll_focus = true;
    }

    // Validate email fields
    $('#registerform input[type="email"]').each( function() {
        if ( ! is_valid_email( $(this).val() ) ) {
            $(this).closest('label').addClass('error');
        } else {
            $(this).closest('label').removeClass('error');
        }
    });

    // Validate email confirmation
    if ( $.trim( $('#email').val() ).length ) {
        if ( $('#email').val() != $('#confirm_email').val() ) {
            $('#confirm_email').closest('label').addClass('error');
        } else {
            $('#confirm_email').closest('label').removeClass('error');
        }
    }
  

    // Validate TOS and privacy policy
    if ( ! $('#terms_of_service').is(':checked') ) {
        $('#terms_of_service').closest('label').addClass('error');
    } else {
        $('#terms_of_service').closest('label').removeClass('error');
    }

    // Check validation
    if ( $('#registerform .error').length ) {
        if ( scroll_focus ) {
            $('html, body').stop().animate({ scrollTop: $('#registerform .error:first').offset().top - 30 }, 900);
            $('#registerform .error:first').focus();
        }
        return false;
    }

    return true;
}
