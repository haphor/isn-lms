
jQuery(document).ready(function ($) {

    // Perform AJAX login on form submit
    $('form#login').on('submit', function (e) {
        $('form#login p.status').show().html(ajax_login_object.loadingmessage);
        $.ajax(window.location.origin + '/' + window.location.pathname.split('/')[1] + '/wp-admin/admin-ajax.php', {
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(),
                'password': $('form#login #password').val(),
                'security': $('form#login #security').val()
            },
            success: function (data) {
                $('form#login p.status').html(data.message);
                if (data.loggedin == true) {
                    document.location.href = ajax_login_object.redirecturl;
                }
            }
        });
        e.preventDefault();
    });

});